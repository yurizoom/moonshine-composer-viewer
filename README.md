# Composer Viewer for MoonShine

Веб-интерфейс установленных пакетов в Laravel.

## Скриншот

![wx20170809-165644](https://raw.githubusercontent.com/yurizoom/moonshine-composer-viewer/main/blob/screenshot.jpg)

## Установка

> Перед установкой убедитесь, что функция PHP exec() включена в вашем файле конфигурации php.ini.

```bash
$ composer require yurizoom/moonshine-composer-viewer -vvv
```

## Настройки

В файле config/moonshine.php добавьте конфигурации.

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

## Лицензия

[The MIT License (MIT)](LICENSE).
