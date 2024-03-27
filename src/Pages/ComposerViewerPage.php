<?php

declare(strict_types=1);

namespace MoonShine\ComposerViewer\Pages;

use MoonShine\Attributes\Icon;
use MoonShine\ComposerViewer\Components\ComposerViewerComponent;
use MoonShine\Pages\Page;

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
