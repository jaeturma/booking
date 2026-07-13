<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Kiosk office hierarchy uses the `main` column: sections carry their parent
     * office name (Admin, CID, Finance, SGOD) while direct-service offices carry '1'.
     *
     * - ICT Unit and Legal Unit offer services directly, so they move to top level.
     * - OFFICE OF THE SDS / ASDS OFFICE / ADMIN OFFICE are document-routing rows
     *   with no services; clearing show_order removes them from the kiosk grid.
     */
    public function up(): void
    {
        DB::table('offices')
            ->whereIn('name', ['ICT Unit', 'Legal Unit'])
            ->update(['main' => '1']);

        DB::table('offices')
            ->whereIn('name', ['OFFICE OF THE SDS', 'ASDS OFFICE', 'ADMIN OFFICE'])
            ->where('group', 'SDO')
            ->update(['show_order' => null]);
    }

    public function down(): void
    {
        DB::table('offices')
            ->whereIn('name', ['ICT Unit', 'Legal Unit'])
            ->update(['main' => 'SDS']);

        foreach (['OFFICE OF THE SDS' => 1, 'ASDS OFFICE' => 2, 'ADMIN OFFICE' => 4] as $name => $order) {
            DB::table('offices')
                ->where('name', $name)
                ->where('group', 'SDO')
                ->update(['show_order' => $order]);
        }
    }
};
