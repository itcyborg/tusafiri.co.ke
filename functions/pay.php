<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/11/2017
 * Time: 11:38 AM
 */

@session_start();
require "../app/start.php";

if(!isset($_GET['success'],$_GET['paymentId'],$_GET['PayerID'])){
    die();
}

if((bool)$_GET['success']===false){
    die();
}

$paymentId=$_GET['paymentId'];
$payerId=$_GET['PayerID'];

$payment=\PayPal\Api\Payment::get($paymentId,$paypal);

$execute=new \PayPal\Api\PaymentExecution();
$execute->setPayerId($payerId);

try{
    $result=$payment->execute($execute,$paypal);
}catch (Exception $e){
    die($e);
}

header("Location:../user/continue.php?from=payment&complete=true&payment=true&PaymentID=".$paymentId);


