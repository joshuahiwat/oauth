<?php

namespace Domain;

use OAuth2\Autoloader;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\Server;
use OAuth2\Storage\Pdo as OauthPDO;
use PDO;
use PDOException;

final class CoreApiFactory
{
    const DATABASE = 'localhost';
    const DATABASENAME = 'nathalie_oauth';
    const DATABASEUSER = 'nathalie_oauth';
    const DATABASEPASSWORD = '';

    /**
     * @return PDO
     */
    public function getDatabase()
    {
        try {

            $dbh = new PDO('mysql:host=' . self::DATABASE . ';dbname=' . self::DATABASENAME, self::DATABASEUSER, self::DATABASEPASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die('DATABASE ERROR: ' . $e->getMessage());
        }

        return $dbh;
    }

    public static function getServer()
    {
        Autoloader::register();

        $dsn = 'mysql:dbname=' . self::DATABASENAME . ';host=' . self::DATABASE;

        // $dsn is the Data Source Name for your database
        $storage = new OauthPDO(['dsn' => $dsn, 'username' => self::DATABASEUSER, 'password' => self::DATABASEPASSWORD]);

        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new Server($storage);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new AuthorizationCode($storage));

        return $server;
    }
}
