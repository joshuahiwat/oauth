<?php
namespace Client\Domain;

final class ClientRepository
{
    const REQUESTPROPERTY = 'client_credentials';
    const CLIENTID = 'testclient';
    const CLIENTSECRET = 'testpass';
    const REQUESTTYPEPOST = 'POST';

    private $params;
    private $token;

    public function __construct()
    {
        $this->params = [
            'client_id' => self::CLIENTID,
            'client_secret' => self::CLIENTSECRET,
            'grant_type' => self::REQUESTPROPERTY,
        ];
    }

    public function getTokenInformation($url)
    {
        $header[] = "Accept: application/vnd.api+json";
        $getToken = $this->curl_req($url, $this->params, self::REQUESTTYPEPOST, $header);

        $result = json_decode($getToken, true);

        $this->token = $result['access_token'];

        return $this->getResourceInformation();
    }

    private function getResourceInformation()
    {
        $tokenParams = [
            'access_token' => $this->token,
        ];

        $header[] = "Content-Type: application/x-www-form-urlencoded";

        return $this->curl_req('http://nathalielonden.nl/resource', $tokenParams, self::REQUESTTYPEPOST, $header);
    }

    private function curl_req($url, $params, $requestType, $header)
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        ];

        if( !empty($params) ) {
            $options += [
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_SAFE_UPLOAD => true
            ];
        }

        if( isset($requestType) ) {
            $options += array(CURLOPT_CUSTOMREQUEST => $requestType);
        }

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);

        echo '<pre>';
        var_dump($options);

        if(false === $result ) {
            echo curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
}