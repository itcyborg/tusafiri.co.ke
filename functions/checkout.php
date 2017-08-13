<?php
@session_start();
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/11/2017
 * Time: 9:53 AM
 */

use PayPal\Api\Item;
use PayPal\Api\Payer;

require '../app/start.php';

if(!isset($_POST['product'], $_POST['price'])){
    die();
}

$price=$_POST['price'];
$rate=1;

if(isset($_POST['paymentmethod'])){
    $method=$_POST['paymentmethod'];
    if($method=='Paypal'){
        $email = $_POST['email'];
        $_SESSION['sendemail'] = $email;
        $service_url="http://apilayer.net/api/live?access_key=aec58733dac52a780f6ff34e241ac654&currencies=KES&source=USD&format=1";
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decode=json_decode($curl_response);
        $res=$decode->quotes;
        $rate=$res->USDKES;

        $price = $price / $rate;
        $invoice = $_POST['invoice'];

        $product = $_POST['product'];
        $shipping = 1.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems([$item]);

        $details = new \PayPal\Api\Details();
        $details->setTax($shipping)
            ->setSubtotal($price);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('tusafiri Payment')
            ->setInvoiceNumber($invoice);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL . '/functions/pay.php?success=true')
            ->setCancelUrl(SITE_URL . '/functions/pay.php?success=false');

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);


        try {
            $payment->create($paypal);
        } catch (Exception $e) {
            die($e);
        }

        $approvalUrl = $payment->getApprovalLink();
        header("location:{$approvalUrl}");

    } elseif ($method == "Mpesa") {
        $email=$_POST['email'];
        $invoice = $_POST['invoice'];
        $price = $_POST['price'];
        $product = $_POST['product'];
        $details=$_POST['trippayment'];
        $urlx="";
        if($details=="trippayment"){
            $urlx="&&form=trip";
        }
        header("Location:../app/mpesa.php?invoice=$invoice&fnd=$price&price=$price&&email=$email".$urlx);
    }
}
