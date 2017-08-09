<?php
session_start();
$db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri','{@dE*Zby?llT' );
$now = date('Y-m-d');
$sql = "SELECT trips.*,users.* FROM trips JOIN users ON users.uniqueID=trips.ByUser WHERE trips.Post='YES' AND FinishDate >= '$now' ORDER BY StartDate DESC";
$data="";
$_SESSION['return_to']=$_SERVER['HTTP_REFERER'];
if(isset($_GET['page'])){
    $res=$db->query($sql);
    $count=$res->rowCount();
    $limit=10;
    $pgs=$count/$limit;
    if($pgs>1){
        $page=$_GET['page'];
        $sql.= " LIMIT " . ( ( $page - 1 ) * $limit ) . ", $limit";
        for ($i=0;$i<=$pgs;$i++){
            $pages[]='trips.php?page='.$i;
        }
        $result=$db->query($sql);
        $no=$result->rowCount();
        if($no>0) {
            $data=$result->fetchAll(PDO::FETCH_OBJ);
        }else{
            die("page not found");
        }
    }else{
        $result=$db->query($sql);
        $data=$result->fetchAll(PDO::FETCH_OBJ);
    }
}else{
    $result=$db->query($sql);
    $data=$result->fetchAll(PDO::FETCH_OBJ);
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

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


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
<br>
<div class="container-fluid">
<section id="fh5co-explore" data-section="explore">
    <div class="row">
        <div class="container">
            <form action="" id="searchform" class="form-inline searchbox" method="post" style="border:1px solid green;">
                <div class="input-group input-daterange input-group-lg">
                    <div class="input-group-addon" style="background-color:white; border:none;"><span class="fa fa-map-marker"></span></div>
                    <select class="form-control" id="destination"  style="background-color:white; border:none;">
                        <option value="">Destination</option>
                    </select>
                    <div class="input-group-addon" style="background-color:white; border:none;">
                        <span class="glyphicon glyphicon-calendar" style="background-color:white; border:none;"></span>
                    </div>
                    <input type="text" class="form-control" id="start" name="start" placeholder="From" style="background-color:white; border:none;">
                    <div class="input-group-addon" style="background-color:white; border:none;"><span class="glyphicon glyphicon-arrow-right"></span></div>
                    <input type="text" class="form-control" id="end" name="end" placeholder="To" style="background-color:white; border:none;">
                </div>
                <div class="input-group-lg input-group">
                    <div class="input-group-addon" style="background-color:white; border:none;"><span class="fa fa-dollar"></span></div>
                    <select class="form-control" style="background-color:white; border:none;" id="price">
                        <option value="">Price</option>
                        <option value="1">0-4999</option>
                        <option value="2">5000-9999</option>
                        <option value="3">10000-14999</option>
                        <option value="4">15000 and above</option>
                    </select>
                    <div class="input-group-btn">
                        <button class="btn btn-default" name="searchtrip" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h1>Trips</h1>
    <div class="gradient" id="tripsalert"></div>
    <div class="container-fluid to-animate">
        <div class="row col-md-12 col-lg-12 col-sm-12" id="tripscontent">
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
                $state = "";
                if ($result->StartDate > $now) {
                    $state = "Upcoming";
                } elseif ($result->FinishDate <= $now) {
                    $state = "Ending or Ended";
                } else {
                    $state = "Started/ Starting";
                }
                if($result->Classification=="featured") {
                    $images = $result->Photos;
                    $date = date('d M', strtotime($result->StartDate));
                    $stopdate = date('d M, Y', strtotime($result->FinishDate));
                    $photo = explode(',', $images)[0];
                    $info=limit_text(strip_tags($result->Info),30);
                    echo "
                            <a href='showtrips.php?id=$result->UQID' style='height:500px;'><div class='col-md-7 col-lg-7 col-sm-12 col-xs-12' style='margin-bottom:20px;'>
                                <div class='card'>
                                    <img src='$photo'>
                                    <div class='header'>
                                        <h4><span class='fa fa-plane'></span> $date - $stopdate</h4>
                                    </div>
                                    <div class='footer'>
                                        <h3>$result->Name ($state)</h3>
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
                } else {
                    $images = $result->Photos;
                    $date = date('d M', strtotime($result->StartDate));
                    $stopdate = date('d M, Y', strtotime($result->FinishDate));
                    $photo = explode(',', $images)[0];
                    $info = limit_text(strip_tags($result->Info), 30);
                    echo "
                            <a href='showtrips.php?id=$result->UQID'><div class='col-md-4 col-lg-4 col-sm-12 col-xs-12' style='margin-bottom:20px;'>
                                <div class='card'>
                                    <img src='$photo'>
                                    <div class='header'>
                                        <h4><span class='fa fa-plane'></span> $date - $stopdate</h4>
                                    </div>
                                    <div class='footer'>
                                        <h3>$result->Name ($state)</h3>
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
</div>

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
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
<!-- Main JS (Do not remove) -->
<script src="js/main.js"></script>
<script src="js/datepicker.js"></script>
<script>
    getDestinations();

    function getDestinations() {
        $.ajax({
            url: "functions/constructor.php",
            data: {
                'getDestinations': 1
            },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    $('#destination').append(data.options);
                } else {

                }
            }
        });
    }
    $('document').ready(function(){
        var searchurl="functions/search.php";
        $('.input-daterange').datepicker({
            todayBtn: "linked",
            format:'yyyy-mm-dd'
        });
        $('#searchform').submit(function(e){
            e.preventDefault();
            var destination=$('#destination').val();
            var price=$('#price').val();
            var startD=$('#start').val();
            var end=$('#end').val();
            $.ajax({
                url :searchurl,
                type:'post',
                data:{
                    'searchtrip':true,
                    'destination':destination,
                    'start':startD,
                    'end':end,
                    'price':price
                },
                dataType:'json',
                beforeSend:function(){
                    $('#tripscontent').hide();
                    $('#tripsalert').html("Loading...");
                },
                success:function(data){
                    $('#tripsalert').html(data);
                }
            });
        });
    });

</script>

</body>
</html>

