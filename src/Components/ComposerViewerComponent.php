<?php

declare(strict_types=1);

namespace MoonShine\ComposerViewer\Components;

use MoonShine\Components\MoonShineComponent;
use MoonShine\ComposerViewer\ComposerViewer;

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
            'packages' => ComposerViewer::getComposerPackages(true),
        ];
    }
}
