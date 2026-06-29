<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Office;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }



    public function getData()
    {
        // return a query builder, not ->get()
        $query = User::with(['position', 'office', 'roles']);

        return DataTables::eloquent($query)  // <-- this is efficient
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return $user->roles
                    ->map(fn($role) => "<span class='badge bg-success'>{$role->name}</span>")
                    ->implode(' ');
            })
            ->addColumn('actions', function ($user) {
                return '<div class="text-nowrap">'
                    . '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-info mr-1"><i class="fas fa-eye"></i> View</a>'
                    . '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i> Edit</a>'
                    . '<form action="' . route('admin.users.destroy', $user->id) . '" method="POST" style="display:inline;">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><i class="fas fa-trash"></i> Delete</button>'
                    . '</form>'
                    . '</div>';
            })
            ->rawColumns(['roles', 'actions'])
            ->make(true);
    }

    
    public function show($id)
    {
        $user = User::with(['position', 'office', 'roles'])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }


    public function create()
    {
        $roles = Role::all();
        $positions = \App\Models\Position::all();
        $offices = \App\Models\Office::all();

        return view('admin.users.create', compact('roles', 'positions', 'offices'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
            'roles'       => 'required|array',
            'employee_no' => 'required|string|max:50|unique:users,employee_no',
            'position_id' => 'required|exists:positions,id',
            'office_id'   => 'required|exists:offices,id',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'employee_no' => $request->employee_no,
            'position_id' => $request->position_id,
            'office_id'   => $request->office_id,
        ]);


        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $positions = \App\Models\Position::all();
        $offices = \App\Models\Office::all();

        return view('admin.users.edit', compact('user', 'roles', 'positions', 'offices'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'roles'       => 'required|array',
            'employee_no' => 'required|string|max:50|unique:users,employee_no,' . $user->id,
            'position_id' => 'required|exists:positions,id',
            'office_id'   => 'required|exists:offices,id',
        ]);

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'employee_no' => $request->employee_no,
            'position_id' => $request->position_id,
            'office_id'   => $request->office_id,
        ]);


        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="users_import_template.csv"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate',
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            // UTF-8 BOM so Excel opens it correctly
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['employee_no', 'name', 'email', 'password', 'position', 'office', 'role']);
            fputcsv($out, ['EMP001', 'Juan Dela Cruz', 'juan@deped.gov.ph', 'password123', 'Teacher I', 'Main Office', 'Validator']);
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate(['csv_file' => 'required|file|max:5120']);

        $ext = strtolower($request->file('csv_file')->getClientOriginalExtension());
        if (!in_array($ext, ['csv', 'txt'])) {
            return back()->withErrors(['csv_file' => 'Please upload a .csv file.']);
        }

        $path   = $request->file('csv_file')->getRealPath();
        $handle = fopen($path, 'r');

        // Strip UTF-8 BOM if present
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        $rawHeaders = fgetcsv($handle);
        if (!$rawHeaders) {
            fclose($handle);
            return back()->with('error', 'The CSV file is empty or could not be read.');
        }

        $columnNames = array_map(fn($h) => strtolower(trim($h)), $rawHeaders);
        $required    = ['employee_no', 'name', 'email', 'password', 'position', 'office', 'role'];
        $missing     = array_diff($required, $columnNames);

        if ($missing) {
            fclose($handle);
            return back()->with('error', 'Missing columns: ' . implode(', ', $missing));
        }

        // Pre-load lookups to avoid N+1 inside the loop
        $positions = Position::all()->keyBy(fn($p) => strtolower(trim($p->name)));
        $offices   = Office::all()->keyBy(fn($o) => strtolower(trim($o->name)));
        $roles     = Role::all()->keyBy(fn($r) => strtolower(trim($r->name)));

        $imported = 0;
        $errors   = [];
        $rowNum   = 1;

        while (($data = fgetcsv($handle)) !== false) {
            $rowNum++;

            // Skip blank rows
            if (!array_filter(array_map('trim', $data))) continue;

            $record = array_combine($columnNames, array_pad($data, count($columnNames), ''));
            $record = array_map('trim', $record);

            $emp          = $record['employee_no'];
            $name         = $record['name'];
            $email        = $record['email'];
            $password     = $record['password'];
            $positionName = $record['position'];
            $officeName   = $record['office'];
            $roleName     = $record['role'];

            $rowErrors = [];

            if (!$emp)                                           $rowErrors[] = 'employee_no required';
            if (!$name)                                          $rowErrors[] = 'name required';
            if (!$email)                                         $rowErrors[] = 'email required';
            if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $rowErrors[] = 'email invalid';
            if (strlen($password) < 6)                           $rowErrors[] = 'password must be 6+ characters';
            if (!$positionName)                                  $rowErrors[] = 'position required';
            if (!$officeName)                                    $rowErrors[] = 'office required';
            if (!$roleName)                                      $rowErrors[] = 'role required';

            $position = $positions[strtolower($positionName)] ?? null;
            if ($positionName && !$position)                     $rowErrors[] = "position \"{$positionName}\" not found";

            $office = $offices[strtolower($officeName)] ?? null;
            if ($officeName && !$office)                         $rowErrors[] = "office \"{$officeName}\" not found";

            if ($emp && User::where('employee_no', $emp)->exists())  $rowErrors[] = "employee_no \"{$emp}\" already exists";
            if ($email && User::where('email', $email)->exists())    $rowErrors[] = "email \"{$email}\" already exists";

            // Roles: pipe-separated e.g. "Validator|Admin"
            $roleModels = [];
            foreach (array_filter(array_map('trim', explode('|', $roleName))) as $rn) {
                $roleModel = $roles[strtolower($rn)] ?? null;
                if (!$roleModel) {
                    $rowErrors[] = "role \"{$rn}\" not found";
                } else {
                    $roleModels[] = $roleModel->name;
                }
            }

            if ($rowErrors) {
                $errors[] = "Row {$rowNum}: " . implode('; ', $rowErrors);
                continue;
            }

            try {
                DB::transaction(function () use ($emp, $name, $email, $password, $position, $office, $roleModels, &$imported) {
                    $user = User::create([
                        'name'        => $name,
                        'email'       => $email,
                        'password'    => bcrypt($password),
                        'employee_no' => $emp,
                        'position_id' => $position->id,
                        'office_id'   => $office->id,
                    ]);
                    $user->syncRoles($roleModels);
                    $imported++;
                });
            } catch (\Exception $e) {
                $errors[] = "Row {$rowNum}: " . $e->getMessage();
            }
        }

        fclose($handle);

        $summary = "{$imported} user(s) imported successfully.";
        if ($errors) {
            $summary .= ' ' . count($errors) . ' row(s) skipped with errors.';
        }

        return redirect()->route('admin.users.index')
            ->with('import_summary', $summary)
            ->with('import_errors', $errors);
    }
}
