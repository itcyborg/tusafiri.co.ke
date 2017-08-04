<?php

use Mailjet\Resources;

@session_start();
// STEP 1: read POST data
// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

// Step 2: POST IPN data back to PayPal to validate
$ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
// the directory path of the certificate as shown below:
curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if (!($res = curl_exec($ch))) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    $file = fopen('notification.txt', 'w');
    fwrite($file, curl_error($ch));
    fclose($file);
    curl_close($ch);
    exit;
}

curl_close($ch);

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
$tid = generateID();

// inspect IPN validation result and act accordingly
if (strcmp($res, "VERIFIED") == 0) {
    // The IPN is verified, process it
    require_once "../functions/autoload.php";
    $db = new \Db_connector();
    $data = array(
        'Invoice' => $invoice,
        'PayerID' => $payerid,
        'PStatus' => $paymentstatus,
        'PaymentDate' => $paymentdate,
        'FirstName' => $firstname,
        'LastName' => $lastname,
        'PayerEmail' => $payeremail,
        'PaymentType' => $paymenttype,
        'Currency' => $currency,
        'Amount' => $amount,
        'IPNTrackID' => $ipntrackid,
        'PaymentBy' => $paymentmethod,
        'VerifySign' => $verifySign,
        'Item' => $item,
        'UQPID' => $tid
    );
    $db->setTable("payments")
        ->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $res = $db->isInsert()
        ->setData($data)
        ->exec();
    if (!$db->isError()) {
        $options = array(PDO::ATTR_EMULATE_PREPARES => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, INFO_GENERAL);
        $dbs = new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri', '{@dE*Zby?llT', $options);
        $sql = "SELECT * FROM joinedtrips WHERE UQID='$invoice'";
        $result = $dbs->query($sql);
        $to = "";
        if ($result->rowCount() > 0) {
            $data = $result->fetch(PDO::FETCH_OBJ);
            $to = $data->Email;
        }
        // set post fields
        require_once "../functions/vendor/autoload.php";
        require_once "../functions/mailer.php";
        $apikey = '06a822914dbbb469f45b9a9b37e92af7';
        $apisecret = '1f89d38458d6fef8300f74ea19918b3b';

        $msg = "
            <img src='http://www.tusafiri.co.ke/images/logo.png' style='width: 300px;height:100px;'>
            <hr>
            <h3>Payment made</h3>
            <p>Hey, </p>
            <p>We have recieved your payment for order # $invoice ($item) made via Paypal.
            <br>
            Your payment tracking id is :$tid, you will use this to follow up with our team in case of any issues. 
            <br>
            <br>
            </p>
            
            <p><i>If you have any issues or requests, please reply to this email or visit our <a href='http://www.tusafiri.co.ke/contact.html'>Contact page</a> </i></p>
        ";

        $mj = new \Mailjet\Client($apikey, $apisecret);
        $body = [
            'FromEmail' => "admin@tusafiri.co.ke",
            'FromName' => "Admin",
            'Subject' => "Payment Verified",
            'Text-part' => strip_tags($msg),
            'Html-part' => "$msg",
            'Recipients' => [['Email' => $to]]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
    }
} else if (strcmp($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation
}
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