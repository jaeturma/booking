<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public const DEFAULTS = [
        'ca_signatory_name' => 'NORBERTO S. MANLANGIT, CE, MPA',
        'ca_signatory_position' => 'Administrative Officer V',
        'ca_esign_path' => 'images/esign.png',
        'ca_pnpki_path' => null,
        'ca_background_path' => null,
        'ca_theme_color' => '#000000',
        'login_logo_path' => 'images/ddo_logo.png',
        'app_logo_path' => 'images/ddo_logo.png',
        'kiosk_title' => 'Self-Service Kiosk',
        'kiosk_footer' => 'DEPARTMENT OF EDUCATION | SCHOOLS DIVISION OF DAVAO DE ORO. 2026',
        'screensaver_enabled' => '1',
        'screensaver_mode' => 'video',
        'screensaver_image_folder' => null,
        'screensaver_image_interval' => '8',
        'screensaver_video_1' => null,
        'screensaver_video_1_enabled' => '1',
        'screensaver_video_2' => null,
        'screensaver_video_2_enabled' => '1',
        'screensaver_video_3' => null,
        'screensaver_video_3_enabled' => '1',
        'screensaver_video_4' => null,
        'screensaver_video_4_enabled' => '1',
        'screensaver_video_5' => null,
        'screensaver_video_5_enabled' => '1',
        'screensaver_timeout' => '60',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function caSettings(): array
    {
        $stored = static::query()
            ->whereIn('key', array_keys(static::DEFAULTS))
            ->pluck('value', 'key')
            ->all();

        return array_merge(static::DEFAULTS, $stored);
    }

    public static function assetUrl(?string $path): ?string
    {
        return $path ? asset($path) : null;
    }
}
