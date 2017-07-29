<?php

/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 6/27/2017
 * Time: 6:45 PM
 */
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id'])){

}else{
    header('location:../login.php');
}
if(isset($_SESSION['proceed']) || isset($_SESSION['refurl'])=="createTrip"){
    echo "Proceeding";
}
$_SESSION['count']=0;
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
    <title>Tusafiri</title>
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
<hr>
<section id="fh5co-testimony" data-section="contact">
    <div class="container-fluid">
        <h2>Trip Overview</h2>
        <div class="pull-right col-md-4 col-lg-5 col-sm-12">
            <div class="jumbotron">
                <h2 class="text-center">Guide</h2>
                <p><b>Trip Name:</b> Give your trip a short descriptive name e.g 6-day Beach couples retreat</p>
                <p><b>Destination: </b> Where do you want to go e.g Mombasa</p>
                <p><b>Date: </b> When does your trip start and end</p>
                <p><b>Meeting point: </b> Are you offering transport? If so tell your participants where you will pick them</p>
                <p><b>Slots Available</b> How many people can register for this trip? eg 20 or 12 couples, 6 families</p>
                <p><b>Trip Photos</b> Provide photos so that your participants know what to expect</p>
            </div>
        </div>
        <div class="col-md-8 col-lg-7 pull-left col-sm-12">
            <form id="overview" action="../functions/constructor.php" method="post" class="jumbotron">
                Trip Name
                <input type="text" required value="<?php echo $_SESSION['tripname'];?>" name="tripname" class="form-control" id="tripname"><br>
                Destination
                <input type="text" required value="<?php echo $_SESSION['destination'];?>"  name="destination" id="destination" class="form-control"><br>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    From
                    <input type="date" required class="form-control" name="from" value="<?php echo $_SESSION['schedule']['from'];?>" >
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    To
                    <input type="date" required class="form-control" name="to" value="<?php echo $_SESSION['schedule']['to'];?>" ><br>
                </div>
                Meeting point
                <input type="text" required placeholder="Meeting Point" name="meeting" class="form-control"><br>
                How many slots are available?
                <input type="number" min="1" name="slots" required class="form-control"><br>
                <div class="row">
                    upload Trip Photos
                    <div class="filestatus" id="filesUploaded">
                        <?php
                        if(isset($_SESSION['files'])) {
                            if (sizeof($_SESSION['files']) > 0) {
                                $files = $_SESSION['files'];
                                foreach ($files as $file) {
                                    echo $file;
                                }
                            }
                        }
                        ?>
                    </div>
                    <div id="dropBox">
                        Click to Select an image to upload
                        <p></p>
                    </div>
                    <input type="file" name="photoUpload" id="photoUpload">
                </div>
                <hr>
                <div class="row">
                    <button class="btn btn-primary pull-right" name="createTrip">Continue ></button>
                </div>
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

<!-- The Modal -->
<div id="myModal" class="modals">

    <!-- The Close Button -->
    <span class="closei" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modals-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
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
    $(function(){
        //file input field trigger when the drop box is clicked
        $("#dropBox").click(function(){
            $("#photoUpload").click();
        });

        //prevent browsers from opening the file when its dragged and dropped
        $(document).on('drop dragover', function (e) {
            e.preventDefault();
        });

        //call a function to handle file upload on select file
        $('#photoUpload').on('change', photoUpload);
    });

    function photoUpload(event){
        //notify user about the file upload status
        $("#dropBox").html(event.target.value+" uploading...");

        //get selected file
        files = event.target.files;

        //form data check the above bullet for what it is
        var data = new FormData();

        //file data is presented as an array
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if(!file.type.match('image.*')) {
                //check file type
                $("#dropBox").html("Please choose an images file.");
            }else if(file.size > 5242880){
                //check file size (in bytes)
                $("#dropBox").html("Sorry, your file is too large (>5 MB)");
            }else{
                //append the uploadable file to FormData object
                data.append('file', file, file.name);
                data.append('TripimageUpload',true);

                //create a new XMLHttpRequest
                var xhr = new XMLHttpRequest();

                //post file data for upload
                xhr.open('POST', '../functions/constructor.php', true);
                xhr.send(data);
                xhr.onload = function () {
                    //get response and show the uploading status
                    var response = JSON.parse(xhr.responseText);
                    if(xhr.status === 200 && response.status == 'ok'){
                        $("#dropBox").html("File has been uploaded successfully. Click to upload another.");
                        $('#filesUploaded').append(response.files);
                    }else if(response.status == 'type_err'){
                        $("#dropBox").html("Please choose an images file. Click to upload another.");
                    }else{
                        if(response.msg){
                            $("#dropBox").html(response.msg);
                        }else {
                            $("#dropBox").html("Some problem occured, please try again.");
                        }
                    }
                };
            }
        }
    }

    function removeFile(id,ids){
        if(window.confirm("Are you sure?\nThis cannot be undone.")) {
            $.ajax({
                url: '../functions/constructor.php',
                data: {
                    'removePhoto': true,
                    'id': id
                },
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function () {
                },
                success: function (data) {
                    if(data=="success"){
                        $('#'+ids).fadeOut();
                    }
                }
            });
        }
    }


    var modal=document.getElementById('myModal');
    var modalImg=document.getElementById('img01');

    function pop(url) {
        modal.style.display="block";
        modalImg.src=url;
    }

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

    var span=document.getElementsByClassName("closei")[0];
    span.onclick=function(){
        modal.style.display="none";
    }
</script>

</body>
</html>



