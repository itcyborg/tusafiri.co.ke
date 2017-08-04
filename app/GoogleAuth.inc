<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 8/2/2017
 * Time: 3:54 PM
 */

class GoogleAuth
{
    protected $client;

    public function __construct(Google_Client $googleClient = null)
    {
        $this->client = $googleClient;
        if ($this->client) {
            $this->client->setClientId('790717079724-ipugme6a8ua7oat501rr7abepjt3130p.apps.googleusercontent.com');
            $this->client->setClientSecret('lbHRyWEodqpDjVGU6uYbjkGo');
            $this->client->setRedirectUri('http://www.tusafiri.co.ke/ind.php');
            $this->client->addScope("email");
            $this->client->addScope("profile");
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['access_token']);
    }

    public function getAuthUri()
    {
        return $this->client->createAuthUrl();
    }

    /**
     * @return Google_Client
     */
    public function checkRedirectCode()
    {
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            return true;
        }
        return false;
    }

}