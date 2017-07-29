<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/10/2017
 * Time: 9:37 PM
 */
@session_start();
require "../libs/vendor/autoload.php";

define('SITE_URL','http://www.tusafiri.co.ke');

$paypal=new PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AR9lpsLHZ2lduiOXAeUaMv9ZPOzh905pPxeUNDcEKhPcdB8nr1vhheidWqVRERLUOkvPJrbEatH2ogjh',
        'EOPQwVG-dXtPw1rR1udZHqNgyZybTUGk_6cfeVZpd_2cm_mO3kjz91X_rtnxQKMOuAQfWHMwTnE33i38'
    )
);