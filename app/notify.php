<?php
@session_start();
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/17/2017
 * Time: 2:19 PM
 */
namespace Listener;

require('PaypalIPN.php');
$file=fopen('notification.txt','w');
foreach ($_POST as $item=>$value) {
    fwrite($file,$item."=>".$value."\n");
}
fclose($file);

$invoice=$_POST['invoice'];
$amount=$_POST['payment_gross'];
$paymentdate=$_POST['payment_date'];
$firstname=$_POST['first_name'];
$paymentstatus=$_POST['payment_status'];
$lastname=$_POST['last_name'];
$payeremail=$_POST['payer_email'];
$paymenttype=$_POST['payment_type'];
$item=$_POST['item_name1'];
$currency=$_POST['mc_currency'];
$ipntrackid=$_POST['ipn_track_id'];
$paymentmethod="Paypal";
$verifySign=$_POST['verify_sign'];
$payerid=$_POST['payer_id'];

require_once "../functions/autoload.php";
$db=new \Db_connector();
$data=array(
    'Invoice'=>$invoice,
    'PayerID'=>$payerid,
    'PStatus'=>$paymentstatus,
    'PaymentDate'=>$paymentdate,
    'FirstName'=>$firstname,
    'LastName'=>$lastname,
    'PayerEmail'=>$payeremail,
    'PaymentType'=>$paymenttype,
    'Currency'=>$currency,
    'Amount'=>$amount,
    'IPNTrackID'=>$ipntrackid,
    'PaymentBy'=>$paymentmethod,
    'VerifySign'=>$verifySign,
    'Item'=>$item,
    'UQPID'=>generateID()
);
$db->setTable("payments")
    ->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
$res=$db ->isInsert()
    ->setData($data)
    ->exec();

use PaypalIPN;

$ipn = new PaypalIPN();

// Use the sandbox endpoint during testing.
$ipn->useSandbox();
$verified = $ipn->verifyIPN();

if ($verified) {
    echo "verified";
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");

function generateID(){
    $idkeyspace='ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $length=16;
    $idstr=array();
    $max=strlen($idkeyspace)-1;
    for($i=0;$i<$length;++$i){
        $n=rand(0,$max);
        $idstr[]=$idkeyspace[$n];
    }

    return implode($idstr);
}