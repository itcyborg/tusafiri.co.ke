<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 8/3/2017
 * Time: 7:06 PM
 */

use Mailjet\Resources;

if (isset($_POST['to'], $_POST['message'])) {
    $to = $_POST['to'];
    $msg = $_POST['message'];
    $subject = $_POST['subject'];
    $firstname = $_POST['name'];
    $res = mailS($firstname, $msg, $to, $subject);

    $file = fopen('mail.txt', 'w');
    fwrite($file, $res);
    fclose($file);
}

function mailS($firstname, $msg, $to, $subject)
{
    require_once "../functions/vendor/autoload.php";
    require_once "../functions/mailer.php";
    $apikey = '06a822914dbbb469f45b9a9b37e92af7';
    $apisecret = '1f89d38458d6fef8300f74ea19918b3b';

    $mj = new \Mailjet\Client($apikey, $apisecret);
    $body = [
        'FromEmail' => "no-reply@tusafiri.co.ke",
        'FromName' => $firstname,
        'Subject' => "$subject",
        'Text-part' => strip_tags($msg),
        'Html-part' => "$msg",
        'Recipients' => [['Email' => $to]]
    ];

    $response = $mj->post(Resources::$Email, ['body' => $body]);
    return $response->success();
}