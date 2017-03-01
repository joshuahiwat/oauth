<?php

spl_autoload_register(function ($className) {

    if (substr($className, 0, 7) == 'OAuth2\\') {
        $fileName = str_replace('\\', '/', $className) . ".php";
        require_once dirname(__DIR__) . '/oauth/Vendor/' . $fileName;
        return;
    }

    $fileName = str_replace('\\', '/', $className) . ".php";

    require_once dirname(__DIR__) . '/oauth/' . $fileName;

});
