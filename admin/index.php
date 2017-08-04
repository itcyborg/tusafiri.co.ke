<?php
    session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['id'],$_SESSION['role'])){
        if($_SESSION['role']==0){

        }else{
            $from=$_SERVER['REQUEST_URI'];
            header("Location:../error.php?error=unauthorised&from=$from");
            die();
        }

        $_SESSION['profile']=explode("@",$_SESSION['user'])[0];
    }else{
        header('location:../login.php');
    }
    if(isset($_GET['proceed']) || isset($_SESSION['refurl'])=='createTrip'){
        $_SESSION['proceed']='createTrip';
        header('location:createTrip.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tusafiri- Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <img src="assets/img/logo.png" class="logoimg">
                </a>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="index.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href="trips.php">
                        <i class="fa fa-plane"></i>
                        <p>Trips</p>
                    </a>
                </li>
                <li>
                    <a href="mytrips.php">
                        <i class="fa fa-map-signs"></i>
                        <p>My Trips</p>
                    </a>
                </li>
                <li>
                    <a href="payments.php">
                        <i class="ti-money"></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li>
                    <a href="system.php">
                        <i class="ti-panel"></i>
                        <p>System Preferences</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Payments</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-user"></i>
                                <p><?php echo $_SESSION['user'];?></p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="settings.php"><i class="ti-settings"></i> Profile</a></li>
                                <li><a href="signout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="fa fa-plane"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Travel</p>
                                            <a href="../trips.php">All Trips</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr>
                                <div class="stats" style="padding: 5px;">
                                    <a href="../createTrip.php" class="btn btn-primary btn-lg">Create a trip</a>
                                    <a href="../trips.php" class="btn btn-info btn-lg btn-fill"><i class="ti-arrow-right"></i> Join a Trip</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-wallet"></i>
                                        </div>
                                        MPesa
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Account (KSH)</p>
                                            <span id="accountksh"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-right" style="padding: 5px;">
                                        <a href="payments.php" class="btn btn-primary btn"><i class="ti-arrow-right"></i> Go</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="fa fa-paypal"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Account (USD)</p>
                                            <span id="accountusd"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-right" style="padding: 5px;">
                                        <a href="payments.php" class="btn btn-primary btn-lg"><i class="ti-arrow-right"></i> Go</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-settings"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Profile</p>
                                            Settings
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-right" style="padding: 5px;">
                                        <a href="settings.php" class="btn btn-primary btn-lg"><i class="ti-arrow-right"></i> Go</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <?php echo date('Y');?>, Tusafiri made by <a href="http://itcyborg.azurewebsites.net">Itcyborg Systems</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: "../functions/constructor.php",
                data:{
                    'getAccount':true
                },
                type:'post',
                dataType:'json',
                beforeSend:function(){
                    $('#accountksh').html('Loading...');
                    $('#accountusd').html('Loading...');
                },
                success:function(data){
                    if(data.status==true){
                        $('#accountksh').html('KSHS '+data.ksh);
                        $('#accountusd').html('$ '+data.usd);
                    }
                }
            });
        });
    </script>
</html>