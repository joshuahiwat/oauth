<?php
namespace Application;

use Domain\CoreApiFactory;
use OAuth2\Request;

class TokenController
{
    public function getToken()
    {
        $server = CoreApiFactory::getServer();

        return $server->handleTokenRequest(Request::createFromGlobals())->send();
    }
}