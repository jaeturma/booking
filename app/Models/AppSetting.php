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
        'kiosk_footer' => 'Schools Division of Davao de Oro | Department of Education',
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
