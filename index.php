<?php
    session_start();
    $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
    $sql="SELECT trips.*,users.* FROM trips JOIN users ON users.uniqueID=trips.ByUser WHERE trips.Post='YES' LIMIT 10";
    $page=1;
    $pages;
    $data="";
    $result=$db->query($sql);
    $data=$result->fetchAll(PDO::FETCH_OBJ);
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
    <link rel="stylesheet" href="css/imagepop.css">



</head>
<body>
<header id="fh5co-header">
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
                    <li><a class="external" href="login.php">Login</a></li>
                    <li class="call-to-action"><a href="register.php"><span>Register</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section class="home" id="fh5co-home" data-section="home">
    <div class="gradient"></div>
    <div class="container">
        <div class="text-wrap">
            <div class="text-inner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="to-animate">PLANNING GROUP ADVENTURES HAS NEVER BEEN THIS EASY</h1>
                        <h2 class="to-animate">'Plan, Promote,Manage, or Join a Trip instanly' </h2><br><br><br>
                        <div class="to-animate">
                            <div class="call-to-action">
                                <a href="createTrip.php" class="btn btn-primary" style="text-decoration: none;">Create a trip</a>
                                <a href="trips.php" class="btn btn-primary" style="text-decoration: none;">Join a Trip</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="fh5co-explore" data-section="explore">
    <br>
    <div class="gradient text-center">
        <h1 class="media-heading section-heading">Featured Trips</h1>
    </div>
    <div class="container-fluid to-animate">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <?php
            foreach ($data as $post){
                if($post->Classification=="featured") {
                    $images = $post->Photos;
                    $date = date('d-M', strtotime($post->StartDate));
                    $stopdate = date('d-M-Y', strtotime($post->FinishDate));
                    $image = explode(',', $images)[0];
                    echo "
                            <div class='col-md-4 col-lg-4 col-sm-12'>
                            <div class='card'>
                                <header>
                                    <img src='$image'>
                                    <div class='text-wrap'>
                                        <h2>$post->Name</h2>
                                        <h3>$post->Destination</h3>
                                    </div>
                                </header>
                                <main>
                                    <div class='info-wrap'>
                                        <p>Meeting Point: $post->MeetingPoint<br>
                                        <b>From: </b><i>$date</i> to <i>$stopdate</i><br><b>Slots:</b> $post->Slots<br>
                                        <b>By :</b> <a href='showtrips.php?user=$post->ByUser'>$post->Username</a>
                                        </p>
                                    </div>
                                    <a href='showtrips.php?id=$post->UQID' class='cta-wrap'>
                                        <span>More Info</span>
                                    </a>
                                </main>
                            </div>
                           </div >";
                }
            }
            ?>
        </div>
    </div>
</section>


<div class="getting-started getting-started-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 to-animate">
                <h3>Register</h3>
            </div>
            <div class="col-md-6 to-animate-2">
                <div class="call-to-action text-right">
                    <a href="#" class="sign-up">Register</a>
                </div>
            </div>
        </div>
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

<!-- Modals-->
<div class="modal fade" role="dialog" id="createTrip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Create a Trip</h2>
            </div>
            <div class="modal-body">
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
                                <option value="0">Select classification</option>
                                <option value="family">Family</option>
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
            <div class="modal-footer"><small>&copy; 2017 Tusafiri</small></div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="joinTrip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Join a Trip</h2>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
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

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>

</body>
</html>

