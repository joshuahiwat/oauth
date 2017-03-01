<?php

use Application\AuthorizeController;

$authorize = new AuthorizeController();

$getAuthorize = $authorize->getAuthorize();

echo $getAuthorize;