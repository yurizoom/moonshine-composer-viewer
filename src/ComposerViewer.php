<?php

namespace MoonShine\ComposerViewer;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class ComposerViewer
{
    const TTL = 300;

    static public function getComposerPackages($cache = false)
    {
        $cache_key = 'moonshine.composer_viewer.packages.'.auth()->user()->getAuthIdentifier();

        if ($cache) {
            return Cache::get($cache_key);
        }

        $composer = config('moonshine.composer_viewer.composer');
        try {
            $output = Process::path(base_path())
                ->env(['COMPOSER_HOME' => base_path()])
                ->run("{$composer} show --latest --format=json")
                ->output();

            $packages = json_decode($output, true)['installed'];

            foreach ($packages as &$package) {
                switch ($package['latest-status']) {
                    case 'up-to-date':
                        $package['badge'] = 'success';
                        break;
                    case 'update-possible':
                        $package['badge'] = 'warning';
                        break;
                    case 'semver-safe-update':
                        $package['badge'] = 'error';
                        break;
                }
            }

            Cache::set($cache_key, $packages);

            return $packages;
        } catch (\Exception) {
            return [];
        }
    }

    static public function isWin(): bool
    {
        return Str::of(PHP_OS)->upper()->startsWith('WIN');
    }
}