<?php
@session_start();
$id="";
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
if(isset($_POST['feature'],$_POST['onoffswitch3'],$_POST['id'])){
    $id=$_POST['id'];
    $option=$_POST['days'];
    if($_POST['onoffswitch3']){
        $url="finish.php?action=trippayment&&id=$id&&option=$option";
        if($option==4){
            $days=$_POST['customdays'];
            $url.="&&days=$days";
        }
        header("Location:$url");
    }else{
        header("Location:user/tripcreated.php?id=$id");
    }
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
    <title>Tusafiri-Featured</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

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
    <link rel="stylesheet" type="text/css" href="css/imagepop.css">


    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
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
                <a class="navbar-brand" href="index.php"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-nav-section="team"><span>My Trips</span></a></li>
                    <li><a href="login.php" class="external"><span>Login</span></a></li>
                    <li class="call-to-action"><a href="register.php"><span>Register</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="fh5co-testimony" data-section="contact">
    <hr>
    <div class="container">
        <h2><?php echo $name;?></h2>
        <div class="row">
            <div class="col-md-12 to-animate">
                <form action="paytrip.php" method="post">
                    <input type="text" name="id" value="<?php echo $id; ?>" hidden/>
                    Feature Trip on homepage for better visibility?
                    <div class="funkyradio">
                        <div class="funkyradio-primary">
                            <input type="radio" name="onoffswitch3" id="radio2"/ value="true">
                            <label for="radio2">Yes</label>
                        </div>
                        <div class="funkyradio-primary">
                            <input type="radio" name="onoffswitch3" id="radio1" value="false" checked/>
                            <label for="radio1">No</label>
                        </div>
                    </div>
                    <div class="row" id="payoptions">
                        <input type="radio" name="days" value="1"> 3 days for 1500 KSHS<br>
                        <input type="radio" name="days" value="2"> 7 days for 4500 KSHS<br>
                        <input type="radio" name="days" value="3"> 14 days for 9000 KSHS<br>
                        <input type="radio" name="days" value="4"> Custom<br>
                        <input type="number" name="customdays"> days for <input id="custom" type="number" name="amount">
                    </div>
                    <hr>
                    <button name="feature" class="btn btn-primary btn-lg pull-right">Submit</button>
                </form>
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
                <a href="team.html">Team</a><br>
                <a href="contact.html">Contacts</a><br>
                <a href="press.html">Press</a>
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
<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>
<script type="text/javascript">
    $('#payoptions').hide();
    $('#radio2').on('click',function(){
        $('#payoptions').fadeIn('slow');
    });
    $('#radio1').on('click',function(){
        $('#payoptions').fadeOut('slow');
    });
</script>
</body>
</html>