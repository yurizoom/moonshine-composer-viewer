<?php

declare(strict_types=1);

namespace YuriZoom\MoonShineComposerViewer\Pages;

use MoonShine\Laravel\Pages\Page;
use YuriZoom\MoonShineComposerViewer\Components\ComposerViewerComponent;

class ComposerViewerPage extends Page
{
    public function getTitle(): string
    {
        return __('Composer Viewer');
    }

    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function components(): array
    {
        return [
            ComposerViewerComponent::make(),
        ];
    }
}
