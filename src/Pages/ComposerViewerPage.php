<?php

declare(strict_types=1);

namespace YuriZoom\MoonShineComposerViewer\Pages;

use MoonShine\Attributes\Icon;
use MoonShine\Pages\Page;
use YuriZoom\MoonShineComposerViewer\Components\ComposerViewerComponent;

#[Icon('heroicons.outline.cog-8-tooth')]
class ComposerViewerPage extends Page
{
    public function title(): string
    {
        return __('Composer Viewer');
    }

    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title(),
        ];
    }

    public function components(): array
    {
        return [
            ComposerViewerComponent::make(),
        ];
    }
}
