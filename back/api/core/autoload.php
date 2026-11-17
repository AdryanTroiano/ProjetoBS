<?php

spl_autoload_register(function ($class) {

    $pastas = [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../middleware/',
        __DIR__ . '/../auth/',

        // Classes da pasta web/app
        __DIR__ . '/../../../web/app/models/',
        __DIR__ . '/../../../web/app/controllers/',
        __DIR__ . '/../../../web/app/middleware/',
        __DIR__ . '/../../../web/app/core/'
    ];

    foreach ($pastas as $pasta) {

        $arquivo = $pasta . $class . '.php';

        if (file_exists($arquivo)) {
            require_once $arquivo;
            return;
        }
    }
});
