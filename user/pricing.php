<?php

/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 6/27/2017
 * Time: 6:45 PM
 */
@session_start();
$id="";
if(isset($_SESSION['user']) && isset($_SESSION['id'])){

}else{
    header('location:../login.php');
}
if($_GET['id']){
    $id=$_GET['id'];
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
    <title>Tusafiri-Pricing</title>
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
    <div class="container-fluid">
        <h2>Pricing</h2>
        <hr>
        <div class="pull-right col-md-4 col-lg-5 col-sm-12">
            <div class="jumbotron">
                <h2 class="text-center">Guide</h2>
                <p><b>Pricing: </b>How much are you charging the trip?</p>
                <p><b>Welcome Message: </b>Send a custom message to participants emails upon registration.</p>
            </div>
        </div>
        <div class="col-md-8 col-lg-7 pull-left col-sm-12">
            <form action="../functions/constructor.php" method="post" class="col-md-12">
                <br>
                <hr>
                <input type="text" name="id" value="<?php echo $id?>" hidden>
                <div class="row form-inline">
                    <div class="col-lg-6 col-sm-11 col-md-6">
                        How much does the trip cost?<br>
                        <input type="number" class="form-control col-md-12 col-sm-12 col-lg-12" name="cost"> &nbsp;&nbsp;Ksh
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-6">
                        Per:
                        <br>
                        <select name="costgroup" class="form-control col-md-12 col-sm-12 col-lg-12">
                            <option value="person">Person</option>
                            <option value="family">School</option>
                            <option value="couple">Couple</option>
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="row">
                    Welcome Message
                    <textarea name="welcome"></textarea>
                </div>
                <hr>
                <a href="tripDescription.php?id=<?php echo $id; ?>" class="pull-left btn btn-primary btn-lg">< Back</a>
                <table class="pull-right" style="padding: 20px;">
                    <tr>
                        <td style="padding: 10px;">
                            <button name="save" class="btn btn-default btn-lg">Save</button>
                        </td>
                        <td style="padding: 10px;">
                            <button name="savePost" class="btn btn-primary btn-lg">Save & Post</button>
                        </td>
                    </tr>
                </table>
            </form>
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
                    <li><a href="https://www.facebook.com/Tusafiri_KE" class="facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="https://www.twitter.com/Tusafiri_KE" class="twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/Tusafiri_KE/" class="instagram"><i class="icon-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/user/TusafiriPlanner" class="youtube"><i class="icon-social-youtube"></i></a></li>
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



