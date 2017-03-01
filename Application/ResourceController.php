<?php
namespace Application;

use Domain\CoreApiFactory;
use OAuth2\Request;

class ResourceController
{
    public function getResource()
    {
        // include our OAuth2 Server object
        $server = CoreApiFactory::getServer();

        // Handle a request to a resource and authenticate the access token
        if (!$server->verifyResourceRequest(Request::createFromGlobals())) {
            $server->getResponse()->send();
            die;
        }
        return json_encode(array('success' => true, 'message' => 'You accessed my APIs!'));
    }
}