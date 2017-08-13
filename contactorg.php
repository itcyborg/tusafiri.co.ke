<?php 
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
        $db = new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri', '{@dE*Zby?llT');
        $sql="SELECT * FROM users WHERE uniqueID='$id'";
        $result=$db->query($sql);
        $data="";
        if($result->rowCount()>0){
        	$data=$result->fetch(PDO::FETCH_OBJ);
        	$name=$data->FullName;
        	if($name==""){
        		if($data->Company==""){
        			$name=$data->Username;
        		}else{
        			$name=$data->Company;
        		}
        	}
        	$email=$data->Email;
        	$mobile=$data->Mobile;
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
    <title>Tusafiri-Contact us</title>
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


    <!-- This is what you need -->
    <script src="admin/assets/js/sweetalert2.min.js" async defer></script>
    <link rel="stylesheet" href="admin/assets/js/sweetalert2.min.css">


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
                    <li><a href="#" data-nav-section="faq"><span>Login</span></a></li>
                    <li class="call-to-action"><a href="#"><span>Register</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="fh5co-testimony" data-section="contact">
    <hr>
    <div class="container">
        <h2>Contact <?php echo $name;?></h2>
        <div class="row">
            <div class="col-md-12 to-animate">
                <div class="row">
                    <form action="functions/constructor.php" method="post" id="contactmsg">
                        <div class="form-group">
                            <label>Name</label>*
                            <input type="text" required name="name" placeholder="Full Name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>*
                            <input type="email" required name="email" placeholder="Your Email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>(Optional)
                            <input type="tel" name="tel" placeholder="Telephone Number" id="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>*
                            <input type="text" required name="subject" placeholder="Subject" id="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Message</label>*
                            <textarea name="message" id="message" required class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success btn-lg"><span class="glyphicon glyphicon-send" id="sendbtn"></span> Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<section class="fh5co-explore fh5co-explore-bg-color">
    <div class="container">
        <h3>Emails</h3>
        <div class="row">
            <table class="table table-responsive">
                <thead>
                <tr><td></td><td></td></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="icon-support"></i> Help Desk</td>
                        <td><a href="mailto:helpdesk@tusafiri.co.ke">helpdesk@tusafiri.co.ke</a></td>
                    </tr>
                    <tr>
                        <td><i class="icon-info"></i> Info Desk</td>
                        <td><a href="mailto:info@tusafiri.co.ke">info@tusafiri.co.ke</a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="mailto:Vivyanne@tusafiri.co.ke">Vivyanne@tusafiri.co.ke</a></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

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

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    $('document').ready(function(){

    });
    $('#contactmsg').on('submit',function(e){
        e.preventDefault();
        var email=$('#email').val();
        var name=$('#name').val();
        var tel=$('#tel').val();
        var msg=$('#message').val();
        var subject=$('#subject').val();

        swal({
                title: 'Send Message',
                text:   'About : '+subject,
                showCancelButton: true,
                confirmButtonText: 'Send',
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url :   "../functions/constructor.php",
                            data:   {
                                'contactorg':true,
                                'organiser':'<?php echo $id; ?>',
                                'email':   	email,
                                'name': 	name,
                                'tel': 		tel,
                                'msg': 		msg,
                                'subject': 	subject,
                                'orgemail': '<?php echo $email;?>'
                            },
                            type:   'post',
                            dataType:'json',
                            success:function(data){
                                if(data.status==true){
                                    swal({
                                        type: 	'success',
                                        title: 	'Message has been sent',
                                        html: 	'To: ' + data.to
                                    });
                                }else{
                                    swal({
                                        type: 	'error',
                                        title: 	'An error has occured',
                                        html: 	'To: ' + data.error
                                    });
                                }
                            }
                        })
                    })
                },
                showLoaderOnConfirm: true,
                allowOutsideClick: false
            }
        )
    });
</script>
</body>
</html>

