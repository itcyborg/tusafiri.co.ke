<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/10/2017
 * Time: 6:25 PM
 */
@session_start();
$output="";
$heading="";
$info="";
$photos="";
$slots="";
$name="";
$meetingPoint="";
$date="";
$username="";
if(isset($_GET['user'])){
    $userid=$_GET['user'];
    $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
    $sql="SELECT trips.*,users.* FROM trips JOIN users ON users.uniqueID=trips.ByUser WHERE trips.Post='YES' && ByUser='$userid'";
    $res=$db->query($sql);
    $data=$res->fetchAll(PDO::FETCH_OBJ);
    foreach ($data as $post){
        $heading="Trips by: ".$post->Username;
        $images = $post->Photos;
        $date = date('d-M', strtotime($post->StartDate));
        $stopdate = date('d-M-Y', strtotime($post->FinishDate));
        $image = explode(',', $images)[0];
        $output .= "<div class='col-md-4 col-lg-4 col-sm-12'>
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
}else
    if (isset($_GET['id'])) {
        $tripid = $_GET['id'];
        $db = new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri', '{@dE*Zby?llT');
        $sql = "SELECT trips.*,users.Username,users.FullName,users.uniqueID,users.Email,users.ProfPic FROM trips JOIN users ON users.uniqueID=trips.ByUser WHERE trips.Post='YES' && trips.UQID='$tripid'";
        $sql1="SELECT * from paidtrips WHERE TripID='$tripid'";
        $pcount=$db->query($sql1);
        $pcount=$pcount->rowCount();
        $res = $db->query($sql);
        if ($res->rowCount() == 1) {
            $result = $res->fetch(PDO::FETCH_OBJ);
            $id = $tripid;
            $profile = "uploads/defaultPic.png";
            $photos=explode(',',$result->Photos);
            $profile=$result->ProfPic;
            $info=$result->Info;
            $username=$result->Username;
            $fname = $result->FullName;
            $cost=$result->Amount;
            $per=$result->Per;
            $start=strtotime($result->StartDate);
            $start=date('d-M',$start);
            $stop=strtotime($result->FinishDate);
            $stop=date('d-M-Y',$stop);
            $slots=$result->Slots;
            $name=$result->Name;
            $meetingPoint=$result->MeetingPoint;
            $indicators="";
            $pics="";
            $byuser=$result->ByUser;
            $meetingTime=date('d-M-Y',strtotime($result->MeetingTime));
            $deadline=date('d-M-Y',strtotime($result->Deadline));
            $images = "";
            $imageshandler = "";
            $count = 0;
            foreach ($photos as $key=>$photo) {
                if ($images == "") {
                    $imageshandler = "<li data-target='#transition-timer-carousel' data-slide-to='$count' class='active'></li>";
                    $images = "                      
                        <div class='item active'>
                            <img style='max-height:540px; width:100%;' src='$photo'>
                        </div>
                    ";
                }else{
                    $imageshandler .= "<li data-target='#transition-timer-carousel' data-slide-to='$count'></li>";
                    $images .= "                      
                        <div class='item'>
                            <img style='max-height:540px; width:100%;' src='$photo'>
                        </div>
                    ";
                }
                $count++;
            }
        }
    } else {
        //error
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
    <link rel="stylesheet" href="test.css">
    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
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
<hr>
<div class="container-fluid" style="margin:20px;padding: 20px;">
    <hr>
    <div class="row">
        <div style="max-height: 500px;" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <!-- The carousel -->
            <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php echo $imageshandler; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php echo $images; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <!-- Timer "progress bar" -->
                <hr class="transition-timer-carousel-progress-bar animate"/>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <br>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="row" style="padding: 10px;"><h2 class="text-center">Trip Organiser</h2></div>
                <div class="row" style="padding: 10px;">
                    <div class="col-md-8">
                        <img src="<?php echo $profile; ?>" width="150px" height="150px" class="img-circle center-block">
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center"><?php echo $fname; ?></h3>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <hr>
                    <h4>Amount: <b><?php echo $cost; ?> KSHS</b></h4>
                    <h4>From: <?php echo $start; ?> <i class="glyphicon glyphicon-arrow-right"></i> <?php echo $stop; ?>
                    </h4>
                    <h4>Capacity: <?php echo $slots; ?></h4>
                    <h4>Registration Deadline: <?php echo $deadline; ?></h4>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php
                                if($slots>$pcount){
                                    echo '<a href="jointrip.php?id='.$id.'" class="btn btn-primary">Join Trip</a>';
                                }else{
                                    echo '<button class="btn btn-primary disabled">Trip Full</button>';
                                }
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Already joined :<?php echo $pcount;?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding: 10px; margin:20px;">
        <div class="container">
            <div class="row"><h1><?php echo $name; ?></h1></div>
            <div class="row">
                <div class="col-md-8">Meeting Point: <?php echo $meetingPoint; ?> at <?php echo $meetingTime; ?></div>
                <div class="col-md-4"><a href="<?php echo 'contactorg.php?id='.$byuser;?>" class="btn btn-primary">Contact Organiser</a></div>
            </div>
            <br>
            <div class="row-fluid">
                <h2>Trip Description</h2>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 jumbotron">
                    <?php echo $info; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->

<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>

</body>
</html>


