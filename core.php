<?php

require 'coreApi.php';

$url = parse_url($_SERVER['REQUEST_URI']);

if (substr($url['path'], -1) == '/') {
    $url['path'] .= 'index';
}

require __DIR__ . $url['path'] . '.php';
