<?php

declare(strict_types=1);

namespace YuriZoom\MoonShineComposerViewer\Components;

use MoonShine\Components\MoonShineComponent;
use YuriZoom\MoonShineComposerViewer\ComposerViewer;

/**
 * @method static static make()
 */
final class ComposerViewerComponent extends MoonShineComponent
{
    protected string $view = 'moonshine-composer-viewer::table';

    public function __construct()
    {
        //
    }

    protected function viewData(): array
    {
        return [
            'packages' => ComposerViewer::getComposerPackages(true),
        ];
    }
}
