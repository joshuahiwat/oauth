<?php

use Application\ResourceController;

$resource = new ResourceController();

$getResource = $resource->getResource();

echo $getResource;