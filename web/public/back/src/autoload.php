<?php

spl_autoload_register(function ($class) {

    $pastas = [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../middleware/',
        __DIR__ . '/'
    ];

    foreach ($pastas as $pasta) {
        $arquivo = $pasta . $class . '.php';

        if (file_exists($arquivo)) {
            require_once $arquivo;
            return;
        }
    }
});