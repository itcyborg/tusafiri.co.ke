<?php
@session_start();
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/13/2017
 * Time: 6:22 AM
 */

if(isset($_GET['action'])){
    if ($_GET['action'] == "payment" && isset($_GET['id'])) {
        $book = $_GET['id'];
        $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
        $results = $db->query("SELECT * from joinedtrips where UQID='$book'");
        $results=$results->fetch(PDO::FETCH_OBJ);
        $name = $results->Name;
        $email = $results->Email;
        $tripid = $results->TripID;
        $date = date('d M, Y', strtotime($results->Timestamp));
        $res=$db->query("SELECT * FROM trips WHERE UQID='$tripid'");
        $res=$res->fetch(PDO::FETCH_OBJ);
        $tripname=$res->Name;
        $tripamount = $res->Amount;
    }elseif($_GET['action']=="trippayment" && isset($_GET['id'])){
        $id=$_GET['id'];
        $book="TRIP".$id;
        $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
        $results=$db->query("SELECT * FROM trips WHERE ID='$id'");
        $result=$results->fetch(PDO::FETCH_OBJ);
        $tripname = $result->Name;
        $userid = $result->ByUser;
        $date = $result->Timestamp;
        $res=$db->query("SELECT * FROM users WHERE uniqueID='$userid'");
        $res=$res->fetch(PDO::FETCH_OBJ);
        $name=$res->FullName;
        if($name==""){
            $name=$res->Company;
        }
        $email = $res->Email;
        $featureoption=$_GET['option'];
        $tripamount=0;
        if($featureoption==1){
            $tripamount=1500;
        }elseif($featureoption==2){
            $tripamount=4500;
        }elseif($tripamount==3){
            $tripamount=9000;
        }elseif($featureoption==4){
            $tripamount=$_GET['days']*500;
        }
    }
}else{
    die("Error");
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
    <meta name="google-signin-client_id" content="790717079724-ipugme6a8ua7oat501rr7abepjt3130p.apps.googleusercontent.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tusafiri-Happy Safaris</title>
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
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
<header id="fh5co-header">
    <div class="fluid-container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="user/index.php"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span>My Trips</span></a></li>
                    <li><a class="external" href="login.php"></a></li>
                    <li class="dropdown" style="display: inline-block">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle external"><i class="icon-user"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="settings.php"><i class="icon-settings"></i> Settings</a></li>
                            <li><a href="#" onclick="sign_Out();"><i class="icon-logout"></i> Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="fh5co-services" role="article">
    <div class="container">
        <form action="functions/checkout.php" method="post">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                        <input type="text" name="trippayment" value="<?php echo $_GET['action'];?>" hidden>
                        <h2></h2><h3 class="pull-right">Order # <?php echo $book;?></h3>
                        <input type="text" value="<?php echo $book;?>" hidden name="invoice">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                <?php echo $name;?><br>
                                <?php echo $email; ?><br>
                                <input type="email" value="<?php echo $email; ?>" name="email" hidden>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Payment Method:</strong><br>
                                <input type="radio" name="paymentmethod" value="Paypal"> PayPal<br>
                                <input type="radio" name="paymentmethod" value="Mpesa"> MPesa
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                <?php echo $date;?><br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>
                                        <td><?php echo $tripname;?></td>
                                        <input type="text" name="product" hidden value="<?php echo $tripname;?>">
                                        <td class="text-center"><?php echo $tripamount;?> Kshs</td>
                                        <td class="text-right"><?php echo $tripamount;?> Kshs</td>
                                        <input type="number" hidden name="price" value="<?php echo $tripamount;?>">
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th class="text-center"><?php echo $tripamount;?> Kshs</th>
                                        <th class="text-right"><?php echo $tripamount;?> Kshs</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-lg"><i class="glyphicon glyphicon-coins"></i> Pay</button>
        </form>
    </div>
</div>

<div id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-lg-9 to-animate">
                <h3 class="section-title">About Tusafiri</h3>
                <a href="team.html">Team</a><br>
                <a href="contact.html">Contacts</a><br>
                <a href="press.html">Press</a>
            </div>
            <br>
            <div class="col-md-4 col-sm-12 col-lg-3 col-lg">
                <h3 class="section-title">Connect with Us</h3>
                <ul class="social-media">
                    <li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
                    <li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
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

<script src="https://apis.google.com/js/platform.js" async defer></script>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="js/jquery.stellar.min.js"></script>
<!-- Owl Carousel -->
<script src="js/owl.carousel.min.js"></script>

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>

<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>
<script type="text/javascript">
    <?php
    if(isset($_SESSION['google'])){
        echo '
    window.setTimeout(function() {
        $("#galert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);';
    }
    ?>

    function sign_Out() {
        $.ajax({
            url     :   '../functions/constructor.php',
            data    :   'logout',
            type    :   'POST',
            beforeSend:function(){
            },
            success :   function (data) {
                console.log(data);
                window.location.href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://www.tusafiri.co.ke";
            }
        });

    }
</script>
</body>
</html>


