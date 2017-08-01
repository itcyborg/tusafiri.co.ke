<?php
@session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id'])){
    header('Location:user/');
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
    <title>Tusafiri-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

    <meta name="google-signin-client_id" content="790717079724-ipugme6a8ua7oat501rr7abepjt3130p.apps.googleusercontent.com">

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

<section id="fh5co-services">
    <hr>
    <div class="container">
        <div class="row">
            <h2>Login</h2>
            <?php
                if(isset($_SESSION['refurl'])=='createTrip' || $_GET['from']=='createTrip' || $_GET['from']=='joinTrip'){
                    echo "<div class='alert alert-info text-center'>Please Login to continue. Don't have an account? <a class='call-to-action' href='register.php'>Register Here</a></div>";
                }
                if(isset($_SESSION['registration'])==true){
                    echo "<div class='alert alert-success text-center'>Registration successful. Please Login to continue.</div>";
                }
            ?>
            <div class="col-md-12 to-animate">
                <form action="functions/constructor.php" method="post" class="col-md-6 col-lg-offset-2 col-md-offset-2 col-lg-6 col-sm-12">
                    Email
                    <input type="email" required name="email" class="form-control" placeholder="Email"><br>
                    Password
                    <input type="password" required name="password" class="form-control" placeholder="Password"><br>
                    <button name="login" class="btn btn-primary pull-right">Login</button>
                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<hr>

<div id="fh5co-footer" role="footer">
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

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript">
    function signin(email,token,username){
        $.ajax({
            url :   "functions/constructor.php",
            data:   {
                'loginGoogle'   :   true,
                'email'         :   email,
                'token'         :   token
            },
            type:   'POST',
            dataType:'JSON',
            success:function(data){
                if(data.status===true){
                    window.location.href=data.url;
                }else{
                    register(email,token,username);
                }
            }
        });
    }
    function register(email,token,username){
        $.ajax({
            url :   "functions/constructor.php",
            data:   {
                'registerGoogle'   :   true,
                'email'         :   email,
                'token'         :   token,
                'username'      :   username
            },
            type:   'POST',
            dataType:'JSON',
            success:function(data){
                if(data.status===true){
                    window.location.href=data.url;
                }else{
                    register(email,token,username);
                }
            }
        });
    }
    function onSignIn(User) {
        var token=User.getAuthResponse().id_token;
        var profile = User.getBasicProfile();
        //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        //console.log('Name: ' + profile.getName());
        //console.log('Image URL: ' + profile.getImageUrl());
        var email=profile.getEmail(); // This is null if the 'email' scope is not present.
        signin(email,token,profile.getName());
    }

</script>

</body>
</html>

