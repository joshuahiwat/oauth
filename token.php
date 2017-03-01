<?php

use Application\TokenController;

$token = new TokenController();

$showToken = $token->getToken();

echo $showToken;