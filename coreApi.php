<?php

spl_autoload_register(function ($className) {

    if (substr($className, 0, 7) == 'OAuth2\\') {
        $fileName = str_replace('\\', '/', $className) . ".php";
        require_once __DIR__ . '/Vendor/' . $fileName;
        return;
    }

    $fileName = str_replace('\\', '/', $className) . ".php";

    require_once __DIR__ . '/' . $fileName;

});
