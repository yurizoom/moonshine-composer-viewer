<?php

declare(strict_types=1);

namespace MoonShine\ComposerViewer\Components;

use Illuminate\Support\Str;
use MoonShine\Components\MoonShineComponent;

/**
 * @method static static make()
 */
final class ComposerViewerComponent extends MoonShineComponent
{
    protected string $view = 'moonshine::composer-viewer';

    public function __construct()
    {
        //
    }

    protected function viewData(): array
    {
        return [
            'packages' => $this->getComposerPackages()
        ];
    }

    protected function getComposerPackages()
    {
        $composer = config('moonshine.composer_viewer.composer');
        try {
            $command = 'cd ' . base_path() . (!$this->isWin() ? ' | ' : ' && ') . $composer . ' show --latest --format=json';
            exec($command, $output);
            $packages = json_decode(implode('', $output), true)['installed'];

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
            return $packages;
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function isWin(): bool
    {
        return Str::of(PHP_OS)->upper()->startsWith('WIN');
    }
}
