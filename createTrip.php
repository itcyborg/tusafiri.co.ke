<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 6/27/2017
 * Time: 8:16 PM
 */
@session_start();
$from=$_SERVER['HTTP_REFERER'];
$_SESSION['return_to']=$from;
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
    <link rel="stylesheet" href="image-picker/image-picker.css">


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
                    <li class="call-to-action"><a href="register.php" class="external"><span>Register</span></a></li>
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
                    <select class="form-control show-labels" required id="category" name="classification">
                        <option value="">Select category</option>
                        <option data-img-src="images/category_Activity.jpeg" data-img-class="first"
                                data-img-alt="Activity" value="Activity">Activity
                        </option>
                        <option data-img-src="images/category_beach.jpeg" data-img-alt="Beach" valu2wwwe="Beach">Beach
                        </option>
                        <option data-img-src="images/category_culture.jpg" data-img-alt="Culture" value="Culture">
                            Culture
                        </option>
                        <option data-img-src="images/category_foodwine.jpeg" data-img-alt="Food & Wine"
                                value="Foodwine">Food & Wine
                        </option>
                        <option data-img-src="images/category_nightlife.jpg" data-img-alt="Night Life"
                                value="Nightlife">Night Life
                        </option>
                        <option data-img-src="images/category_safari_nature.jpeg" data-img-alt="Safari & Nature"
                                value="SafariNature">Safari & Nature
                        </option>
                        <option data-img-src="images/category_yoga.jpeg" data-img-alt="Yoga" value="Yoga">Yoga</option>
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
            <div id="step5">
                <form id="formstep5">
                    <div class="form-group">
                        Registration Deadline
                        <input type="date" name="registrationdeadline">
                    </div>
                    <div class="form-group">
                        Meeting Time
                        <input type="Date" name="meetingtime">
                    </div>
                    <div class="row form-inline">From <input required type="date" id="fromdate" class="form-control"> to
                        <input required class="form-control" id="todate" type="date"></div>
                    <br>
                    <input type="submit" name="continue5" id="continue5" value="Continue >"
                           class="btn btn-primary pull-right">
                </form>
                <button name="back4" id="back4" onclick="back('step4','step5')" class="btn btn-primary pull-left"><
                    Back
                </button>
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

<script src="image-picker/image-picker.js"></script>

<script type="text/javascript">
    $('document').ready(function(){
        $('#step2,#step3,#step4,#step5').hide();
        $('#formstep1').submit(function(e){
            e.preventDefault();
            var location=$('#location').val();

            $.ajax({
                url :   'functions/constructor.php',
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
                url :   'functions/constructor.php',
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
                    url :   'functions/constructor.php',
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
                url :   'functions/constructor.php',
                data:   {
                    'schedule'  :   1,
                    'to'        :   to,
                    'from'      :   from
                },
                type:   'POST',
                dataType:'json',
                beforeSend:function(){},
                success:function(data){
                    if(data.status){
                        $('#step4').fadeOut();
                    }else{
                        alert("An error occured. Please try again");
                    }
                }
            });
                $('#step4').fadeOut();
            }
        });

        $('#formstep5').submit(function (d) {
            d.preventDefault();
            var deadline = $('#registrationdeadline').val();
            var meetingtime = $('#meetingtime').val();
            $.ajax({
                url: 'functions/constructor.php',
                data: {
                    'meetinganddeadline': 1,
                    'meetingtime': meetingtime,
                    'deadline': deadline
                },
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status) {
                        $('#step5').fadeOut();
                        window.location.href = data.url;
                    } else {
                        alert("An error occured. Please try again");
                    }
                }
            });
            $('#step5').fadeOut();
        }
    });
    });

    function back(step,prev) {
        $('#'+prev).fadeOut();
        $('#'+step).fadeIn();
    }

    $('#category').imagepicker({
        show_label: true
    });
</script>

</body>
</html>


