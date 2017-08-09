<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/13/2017
 * Time: 5:53 AM
 */
session_start();
$msg="";
if(isset($_GET['from'],$_GET['id'],$_SESSION['user'],$_SESSION['id'])){
    $from=$_GET['from'];
    $id=$_GET['id'];
    if($from=="joinTrip" && $id!=""){
        require_once "../functions/autoload.php";
        $db=new Db_connector();
        $bookid=generateID();
        $data=array(
            'TripID'=>$id,
            'BookID'=>$bookid,
            'UserID'=>$_SESSION['id'],
            'UQTID'=>$id.$_SESSION['id']
        );
        $conn=array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true);
        $db->isInsert();
        $db->setTable('joinedtrips');
        $db->setDetails($conn);
        $db->setData($data);
        $db->exec();
        if($db->isError()){
            $response['status']=false;
            $response['error']=$db->getMsg();
            echo json_encode($response);
            die();
        }else{
            unset($_SESSION['joinTrip']);
            header("location:finish.php?action=joinTrip&&id=$id&&book=$bookid");
        }
    }
}

if(isset($_GET['from'],$_GET['complete'],$_GET['payment'],$_GET['PaymentID'])){
    @session_start();
    if($_SESSION['role']==1){
        $_SESSION['return_to']='../bus/';
    }elseif($_SESSION['role']==0){
        $_SESSION['return_to']='../admin/';
    }else{
        $_SESSION['return_to']='../user/';
    }
    $return=$_SESSION['return_to'];
    $msg = "Payment Complete.<br> A mail will be sent to your email address once it has been verified.<br><i>Note: If payment was made via paypal, the verification will be sent to their emails associated to paypal.</i><br><b>Payment ID:<i>" . $_GET['PaymentID'] . "</i></b><hr><a href='$return' class='btn btn-primary'><i class='glyphicon glyphicon-chevron-left'></i> Go Back Home</a> ";
}
function generateID(){
    $idkeyspace='ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $length=8;
    $idstr=array();
    $max=strlen($idkeyspace)-1;
    for($i=0;$i<$length;++$i){
        $n=rand(0,$max);
        $idstr[]=$idkeyspace[$n];
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
    <title>Tusafiri-Complete</title>
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

    <link rel="stylesheet" href="../css/imagepop.css">

</head>
<body>
<header role="banner" id="fh5co-header">
    <div class="fluid-container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="index.php"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span>My Trips</span></a></li>
                    <li><a class="external" href="login.php"></a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" id="menu1" class="dropdown-toggle"><i class="icon-user"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li><a href="settings.php"><i class="icon-settings"></i> Settings</a></li>
                            <li><a href="#" onclick="sign_Out();"><i class="icon-logout"></i> Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<hr>
<section id="fh5co-testimony" data-section="contact">
    <hr>
    <br>
    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-1 col-lg-7 pull-left col-sm-12">
            <?php echo $msg;?>
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

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<script src="https://cdn.ckeditor.com/4.7.1/standard-all/ckeditor.js" onload="ck();" defer async></script>
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

<!-- Modernizr JS -->
<script src="../js/modernizr-2.6.2.min.js" async defer></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="../js/respond.min.js" async defer></script>
<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="../js/main.js"></script>

<script type="text/javascript">
    function ck(){
        CKEDITOR.replace( 'welcome' );
    };
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




