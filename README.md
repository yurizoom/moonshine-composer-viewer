# Composer Viewer for MoonShine 3

Веб-интерфейс установленных пакетов в Laravel.

### Поддержка версий MoonShine

| MoonShine | Пакет |
|-----------|-------|
| 2.0+      | 1.0+  |
| 3.0+      | 2.0+  |
| 4.0+      | 3.0+  |

## Скриншот

![screenshot](https://github.com/yurizoom/moonshine-composer-viewer/blob/main/blob/screenshot.jpg?raw=true)

## Установка

> Перед установкой убедитесь, что функция PHP exec() включена в вашем файле конфигурации php.ini.

```bash
$ composer require yurizoom/moonshine-composer-viewer -vvv
```

## Настройки

Если необходимо изменить настройки, добавьте в файле config/moonshine.php:

```php
[
    'composer-viewer' => [
        // Автоматическое добавление в меню
        'auto_menu' => true,
        // Указать расположение composer'а
        'composer' => '/usr/local/bin/composer', // !! ВАЖНО !!
    ]
]
```

### Добавление в меню

Для того чтобы добавить меню в другое место, вставьте следующий код в app/MoonShine/Layouts/MoonShineLayout.php:
```php
use YuriZoom\MoonShineComposerViewer\Pages\ComposerViewerPage;

protected function menu(): array
    {
        return [
            ...
            
            MenuItem::make(ComposerViewerPage::class),
        ];
    }
```

## Лицензия

[The MIT License (MIT)](LICENSE).
