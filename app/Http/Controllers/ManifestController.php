<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManifestController extends Controller
{
    public function show()
    {
        $cfg = config('laravelpwa.manifest');
        $icons = [];
        foreach (($cfg['icons'] ?? []) as $size => $data) {
            $icons[] = [
                'src' => $data['path'] ?? '',
                'sizes' => $size,
                'type' => 'image/png',
                'purpose' => $data['purpose'] ?? 'any',
            ];
        }

        $manifest = [
            'name' => $cfg['name'] ?? config('app.name'),
            'short_name' => $cfg['short_name'] ?? config('app.name'),
            'start_url' => $cfg['start_url'] ?? '/',
            'display' => $cfg['display'] ?? 'standalone',
            'background_color' => $cfg['background_color'] ?? '#ffffff',
            'theme_color' => $cfg['theme_color'] ?? '#000000',
            'orientation' => $cfg['orientation'] ?? 'portrait',
            'icons' => $icons,
            'shortcuts' => $cfg['shortcuts'] ?? [],
        ];

        return response()->make(json_encode($manifest, JSON_UNESCAPED_SLASHES), 200, [
            'Content-Type' => 'application/manifest+json',
        ]);
    }
}
