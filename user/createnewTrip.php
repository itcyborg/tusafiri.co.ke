<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 6/27/2017
 * Time: 8:16 PM
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
    <title>Tusafiri-Create trip</title>
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


    <!-- Modernizr JS -->
    <script src="../js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../js/respond.min.js"></script>
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

<section id="fh5co-testimony" data-section="contact">
    <hr>
    <div class="container">
        <h2>Create a trip</h2>
        <div class="container-fluid">
            <div id="status"></div>
            <div id="step1">
                <h3>Where do you want to go?</h3>
                <form id="formstep1">
                    <input class="form-control" type="text" required name="location" id="location" placeholder="Enter Location i.e. Mombasa"><br>
                    <input type="submit" id="continue1" name="continue1" value="Continue >" class="btn btn-primary pull-right">
                </form>
            </div>
            <div id="step2">
                <h3>What is your trip name?</h3>
                <form id="formstep2">
                    <input class="form-control" required type="text" name="tripname" id="tripname" placeholder="i.e 6 - Day Diani Beach couples retreat"><br>
                    <input type="submit" id="continue2" name="continue2" value="Continue >" class="btn btn-primary pull-right">
                </form>
                <button name="back1" id="back1" onclick="back('step1','step2')" class="btn btn-primary pull-left">< Back</button>
            </div>
            <div id="step3">
                <h3>How can you classify your trip?</h3>
                <form id="formstep3">
                    <select class="form-control" required id="category" name="classification">
                        <option value="">Select classification</option>
                        <option value="normal">Normal</option>
                        <option value="featured">Featured</option>
                    </select><br>
                    <input type="submit" id="continue3" name="continue3" value="Continue >" class="btn btn-primary pull-right">
                </form>
                <button name="back2" id="back2" onclick="back('step2','step3')" class="btn btn-primary pull-left">< Back</button>
            </div>
            <div id="step4">
                <h3>When will your trip be?</h3>
                <form id="formstep4">
                    <div class="row form-inline">From <input required type="date" id="fromdate" class="form-control"> to <input required class="form-control" id="todate" type="date"></div><br>
                    <input type="submit" name="continue4" id="continue4" value="Continue >" class="btn btn-primary pull-right">
                </form>
                <button name="back3" id="back3" onclick="back('step3','step4')" class="btn btn-primary pull-left">< Back</button>
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

<script type="text/javascript">
    $('document').ready(function(){
        $('#step2,#step3,#step4').hide();
        $('#formstep1').submit(function(e){
            e.preventDefault();
            var location=$('#location').val();

            $.ajax({
                url :   '../functions/constructor.php',
                data:   {
                    'destination': location
                },
                type:   'POST',
                beforeSend:function(){},
                success:function(data){
                    if(data){
                        $('#step1').fadeOut();
                        $('#step2').fadeIn();
                    }else{
                        alert("An error occured. Please try again");
                    }
                }
            });
        });

        $('#formstep2').submit(function(f){
            f.preventDefault();
            var name=$('#tripname').val();
            $.ajax({
                url :   '../functions/constructor.php',
                data:   {
                    'tripname': name
                },
                type:   'POST',
                beforeSend:function(){},
                success:function(data){
                    if(data){
                        $('#step2').fadeOut();
                        $('#step3').fadeIn();
                    }else{
                        alert("An error occured. Please try again");
                    }
                }
            });
        });

        $('#formstep3').submit(function(g){
            g.preventDefault();
            var category=$('#category').val();
            if(category.length<1){
                alert("Please select a classification");
                $('#category').focus();
                return;
            }else{
                $.ajax({
                    url :   '../functions/constructor.php',
                    data:   {
                        'tripcategory': category
                    },
                    type:   'POST',
                    beforeSend:function(){},
                    success:function(data){
                        if(data){
                            $('#step3').fadeOut();
                            $('#step4').fadeIn();
                        }else{
                            alert("An error occurred. Please try again");
                        }
                    }
                });
            }
        });

        $('#formstep4').submit(function(h){
            h.preventDefault();
            var from=$('#fromdate').val();
            var to=$('#todate').val();
            if(to<from){
                alert("To date cannot be earlier than from date");
                $('#todate').focus();
                return;
            }else{$.ajax({
                url :   '../functions/constructor.php',
                data:   {
                    'schedule'  :   1,
                    'to'        :   to,
                    'from'      :   from
                },
                type:   'POST',
                dataType:'json',
                beforeSend:function(){},
                success:function(data){
                    alert(JSON.stringify(data));
                    if(data.status){
                        $('#step4').fadeOut();
                        window.location.href=data.url;
                    }else{
                        alert("An error occured. Please try again");
                    }
                }
            });
                $('#step4').fadeOut();
            }
        });
    });

    function back(step,prev) {
        $('#'+prev).fadeOut();
        $('#'+step).fadeIn();
    }
</script>

</body>
</html>


