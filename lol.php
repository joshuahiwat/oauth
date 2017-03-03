<?php

use Client\Domain\ClientRepository;

$getToken = new ClientRepository();

$showToken = $getToken->getTokenInformation('http://nathalielonden.nl/token');

var_dump($showToken);
