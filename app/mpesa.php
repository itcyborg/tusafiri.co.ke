<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 8/3/2017
 * Time: 4:20 PM
 */
/**
 * invoice      -joinid
 * payerID      -phonenumber
 * pstatus      -unverified
 * paymentdate  -now()
 * firstname    -name
 * lastname     -name
 * payeremail   -email
 * paymenttype  -paybill
 * currency     -ksh
 * amount       -amount(ksh)
 * ipntrackid   -mpesatxid
 * paymentby    -phonenumber
 * verifysign   -
 * item         -itemname
 * uqpid        -generated
 */


if (isset($_GET['invoice'], $_GET['fnd'])) {
    echo "sa";
    $invoice = $_GET['invoice'];
    $sql = "  SELECT trips.Amount,trips.Name as TripName,
        joinedtrips.Name as FName,joinedtrips.Email,joinedtrips.Contact,joinedtrips.Timestamp,joinedtrips.UQID FROM joinedtrips 
        JOIN trips ON joinedtrips.TripID=trips.UQID 
        WHERE joinedtrips.UQID='$invoice'";
    $db = new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri', '{@dE*Zby?llT');
    $result = $db->query($sql)->fetch(PDO::FETCH_OBJ);
    $payer = $result->Contact;
    $pstatus = "unverified";
    $payment_date = date('Y-m-d H:i:s');
    $firstname = explode(" ", $result->FName)[0];
    $lastname = explode(" ", $result->FName)[1];
    $payeremail = $result->Email;
    $paymenttype = 'paybill';
    $currency = "KSHS";
    $amount = $result->Amount;
    $paymentby = 'Mpesa';
    $item = $result->TripName;
    $uqpid = generateID();

    //insert the values
    require_once "../functions/autoload.php";
    $dbs = new Db_connector();
    $dbs->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $dbs->isInsert()
        ->setTable('payments')
        ->setData([
            'Invoice' => $invoice,
            'PayerID' => $payer,
            'PStatus' => $pstatus,
            'PaymentDate' => $payment_date,
            'FirstName' => $firstname,
            'LastName' => $lastname,
            'PayerEmail' => $payeremail,
            'PaymentType' => $paymenttype,
            'Currency' => $currency,
            'Amount' => $amount,
            'PaymentBy' => $paymentby,
            'Item' => $item,
            'UQPID' => generateID()
        ]);
    $dbs->exec();
    if ($dbs->isError()) {
        die($dbs->getMsg());
    } else {

    }
} else {
    die("error");
}


function generateID()
{
    $idkeyspace = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $length = 16;
    $idstr = array();
    $max = strlen($idkeyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
        $n = rand(0, $max);
        $idstr[] = $idkeyspace[$n];
    }

    return implode($idstr);
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tusafiri-Complete Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

    <!--
      //////////////////////////////////////////////////////

      FREE HTML5 TEMPLATE
      DESIGNED & DEVELOPED by FREEHTML5.CO

      Website: 		http://freehtml5.co/
      Email: 			info@freehtml5.co
      Twitter: 		http://twitter.com/fh5co
      Facebook: 		https://www.facebook.com/fh5co

      //////////////////////////////////////////////////////
       -->

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="../favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="../css/simple-line-icons.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">


    <!-- Modernizr JS -->
    <script src="../js/modernizr-2.6.2.min.js" async></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../js/respond.min.js" async></script>
    <![endif]-->

</head>
<body>
<header role="banner" id="fh5co-header">
    <div class="fluid-container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="../index.php"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-nav-section="team"><span>My Trips</span></a></li>
                    <li><a href="../login.php" class="external"><span>Login</span></a></li>
                    <li class="call-to-action"><a href="../register.php"><span>Register</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="fh5co-testimony" data-section="contact">
    <hr>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h2 class="text-center">Complete Payment</h2>
                <form action="processmpesa.php" method="post"
                      class="col-md-8 col-md-offset-1 col-lg-offset-1 col-lg-8 col-sm-12">
                    Mpesa Transaction ID<br><br>
                    <input type="email" hidden value="<?php echo $payeremail; ?>" name="email">
                    <input type="text" hidden name="invoice" value="<?php echo $_GET['invoice']; ?>">
                    <input type="text" class="text-uppercase form-control input-lg" name="tid"
                           placeholder="Mpesa Transaction ID"><br>
                    <button class="btn btn-primary btn-lg" name="mpesacomplete">Complete</button>
                </form>
            </div>
            <div class="col-md-4 jumbotron">
                <h3>Mpesa Payment Instructions</h3>
                <p>1. Go to Safaricom SIM Tool Kit, select M-PESA menu, select “Lipa na M-PESA“
                    <br>2. Select “Pay Bill“<br>
                    3. Select “Enter Business no.“, ...<br>
                    4. Select “Enter Account no.“, ...<br>
                    5. “Enter Amount“, <?php echo $_GET['fnd']; ?><br>
                    6. Enter your M-PESA PIN and press “OK”<br>
                    7. Enter the Transaction message in the textbox on this page, then press "Submit".</p>
            </div>
        </div>
    </div>
</section>
<hr>

<div id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-lg-9 to-animate">
                <h3 class="section-title">About Tusafiri</h3>
                <a href="../team.html">Team</a><br>
                <a href="../contact.html">Contacts</a><br>
                <a href="../press.html">Press</a>
            </div>
            <br>
            <div class="col-md-4 col-sm-12 col-lg-3 col-lg">
                <h3 class="section-title">Connect with Us</h3>
                <ul class="social-media">
                    <li><a href="https://www.facebook.com/Tusafiri_KE" class="facebook"><i
                                    class="icon-facebook"></i></a></li>
                    <li><a href="https://www.twitter.com/Tusafiri_KE" class="twitter"><i class="icon-twitter"></i></a>
                    </li>
                    <li><a href="https://www.instagram.com/Tusafiri_KE/" class="instagram"><i
                                    class="icon-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/user/TusafiriPlanner" class="youtube"><i
                                    class="icon-social-youtube"></i></a></li>
                    <li><a href="mailto:helpdesk@tusafiri.co.ke"><i class="icon-help2"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2017 Tusafiri
                </p>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="../js/jquery.js"></script>
<!-- jQuery Easing -->
<script src="../js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="../js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="../js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="../js/jquery.stellar.min.js"></script>
<!-- Owl Carousel -->
<script src="../js/owl.carousel.min.js"></script>
<!-- Main JS (Do not remove) -->
<script src="../js/main.js"></script>

</body>
</html>


