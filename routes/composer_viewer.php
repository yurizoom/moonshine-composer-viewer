<?php

use Illuminate\Support\Facades\Route;
use YuriZoom\MoonShineComposerViewer\Controllers\ComposerViewerController;

$middleware = config('moonshine.auth.middleware');
$middleware = is_array($middleware) ? $middleware : [$middleware];

Route::group([
    'prefix' => config('moonshine.route.prefix'),
    'as' => 'moonshine.',
    'middleware' => [...$middleware, 'web'],
], function () {
    Route::get('composer/viewer', [ComposerViewerController::class, 'index'])->name('composer.viewer.index');
});
