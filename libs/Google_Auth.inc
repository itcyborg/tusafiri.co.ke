<?php

/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/2/2017
 * Time: 7:49 PM
 */
class Google_Auth
{
    protected $client;

    /**
     * Google_Auth constructor.
     */
    public function __construct(Google_Client $google_Client=null)
    {
        $this->client=$google_Client;
        if($this->client){
            $this->client->setClientId('790717079724-ipugme6a8ua7oat501rr7abepjt3130p.apps.googleusercontent.com');
            $this->client->setClientSecret('pXZrL8ED2j8rfcytH0JM_uTl');
            $this->client->setRedirectUri('http://www.tusafiri.co.ke/auth/index.php');
            $this->client->setScopes('email');
        }
    }
}