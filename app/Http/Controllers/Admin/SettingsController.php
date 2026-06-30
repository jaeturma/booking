<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = AppSetting::caSettings();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'ca_signatory_name' => 'required|string|max:255',
            'ca_signatory_position' => 'required|string|max:255',
            'ca_theme_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'ca_esign' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ca_pnpki' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ca_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'login_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'app_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kiosk_title' => 'required|string|max:100',
            'kiosk_footer' => 'nullable|string|max:255',
            'screensaver_video_1' => 'nullable|string|max:500',
            'screensaver_video_2' => 'nullable|string|max:500',
            'screensaver_video_3' => 'nullable|string|max:500',
            'screensaver_video_4' => 'nullable|string|max:500',
            'screensaver_video_5' => 'nullable|string|max:500',
            'screensaver_video_1_enabled' => 'nullable|boolean',
            'screensaver_video_2_enabled' => 'nullable|boolean',
            'screensaver_video_3_enabled' => 'nullable|boolean',
            'screensaver_video_4_enabled' => 'nullable|boolean',
            'screensaver_video_5_enabled' => 'nullable|boolean',
            'screensaver_timeout' => 'nullable|integer|min:10|max:3600',
        ]);

        AppSetting::setValue('ca_signatory_name', $data['ca_signatory_name']);
        AppSetting::setValue('ca_signatory_position', $data['ca_signatory_position']);
        AppSetting::setValue('ca_theme_color', $data['ca_theme_color']);

        $this->storeImageSetting($request, 'ca_esign', 'ca_esign_path');
        $this->storeImageSetting($request, 'ca_pnpki', 'ca_pnpki_path');
        $this->storeImageSetting($request, 'ca_background', 'ca_background_path');
        $this->storeImageSetting($request, 'login_logo', 'login_logo_path');
        $this->storeImageSetting($request, 'app_logo', 'app_logo_path');
        AppSetting::setValue('kiosk_title', $data['kiosk_title']);
        AppSetting::setValue('kiosk_footer', $data['kiosk_footer'] ?? '');

        for ($i = 1; $i <= 5; $i++) {
            AppSetting::setValue("screensaver_video_{$i}", $data["screensaver_video_{$i}"] ?? '');
            AppSetting::setValue("screensaver_video_{$i}_enabled", isset($data["screensaver_video_{$i}_enabled"]) ? '1' : '0');
        }
        AppSetting::setValue('screensaver_timeout', $data['screensaver_timeout'] ?? 60);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }

    private function storeImageSetting(Request $request, string $input, string $settingKey): void
    {
        if (!$request->hasFile($input)) {
            return;
        }

        $file = $request->file($input);
        $directory = public_path('images/settings');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = $input.'-'.Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        AppSetting::setValue($settingKey, 'images/settings/'.$filename);
    }
}
