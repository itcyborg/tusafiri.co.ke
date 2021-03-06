<?php
    session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['id'])){
        $_SESSION['profile']=explode("@",$_SESSION['user'])[0];
    }else{
        header('location:../login.php');
    }
    if(isset($_GET['proceed']) || isset($_SESSION['refurl'])=='createTrip'){
        $_SESSION['proceed']='createTrip';
        header('location:createTrip.php');
    }
    if(isset($_SESSION['joinTrip'])){
        header('location:continue.php?from=joinTrip&&id='.$_SESSION['joinTrip']);
    }

    $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
    $sql="SELECT trips.*,users.* FROM trips JOIN users ON users.uniqueID=trips.ByUser WHERE trips.Post='YES' LIMIT 10";
    $page=1;
    $pages;
    $data="";
    $result=$db->query($sql);
    $data=$result->fetchAll(PDO::FETCH_OBJ);
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



</head>
<body>
<?php
if(isset($_SESSION['google'])){
    echo '<div id="galert" class="alert alert-success text-center" style="z-index: 500; position: relative;" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> You have been signed in successfully using google!
</div>';
    $_POST['google']=false;
}
?>
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
                    <li><a href="organisedtrips.php"><span>My Organised Trips</span></a></li>
                    <li><a href="mytrips.php"><span>My Trips</span></a></li>
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
                                <a href="createnewTrip.php" class="btn btn-primary" style="text-decoration: none;">Create a trip</a>
                                <a href="../trips.php" class="btn btn-primary" style="text-decoration: none;">Join a Trip</a>
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
            function limit_text($text, $limit) {
                if (str_word_count($text, 0) > $limit) {
                    $words = str_word_count($text, 2);
                    $pos = array_keys($words);
                    $text = substr($text, 0, $pos[$limit]) . '...';
                }
                return $text;
            }
            foreach ($data as $result){
                if($result->Classification=="featured") {
                    $images = $result->Photos;
                    $date = date('d M', strtotime($result->StartDate));
                    $stopdate = date('d M, Y', strtotime($result->FinishDate));
                    $photo = explode(',', $images)[0];
                    $info=limit_text(strip_tags($result->Info),30);
                    echo "
                            <a href='showtrips.php?id=$result->UQID'><div class='col-md-4 col-lg-4 col-sm-12 col-xs-12' style='margin-bottom:20px;'>
                                <div class='card'>
                                    <img src='$photo'>
                                    <div class='header'>
                                        <h4><span class='fa fa-plane'></span> $date - $stopdate</h4>
                                    </div>
                                    <div class='footer'>
                                        <h3>$result->Name</h3>
                                        <div class='row'><div class='col-md-8'> <h4><span class='fa fa-map-marker'></span> $result->Destination</h4></div><div class='col-md-4'><span class='fa fa-user'></span> $result->Username</div> </div>
                                    </div>
                                    <div class='details'>
                                        <div>
                                                <h5 class='tcolor'>Details</h5>
                                                <p class='tcolor'>$info</p>
                                                <hr>
                                                <h4 class='tcolor'><b>Cost: </b> $result->Amount KSHS</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            ";
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
                <h3>My Trips</h3>
            </div>
            <div class="col-md-6 to-animate-2">
                <div class="call-to-actison text-right">
                    <a href="mytrips.php" class="sign-up btn btn-primary btn-lg">My Trips</a>
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

<script src="https://apis.google.com/js/platform.js" async defer></script>
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

<!-- Modernizr JS -->
<script src="../js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="../js/respond.min.js"></script>

<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="../js/main.js"></script>
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

