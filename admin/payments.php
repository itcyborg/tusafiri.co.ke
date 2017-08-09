<?php
@session_start();
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Paper Dashboard by Creative Tim</title>

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
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- This is what you need -->
    <script src="assets/js/sweetalert2.min.js" async defer></script>
    <link rel="stylesheet" href="assets/js/sweetalert2.min.css">

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js" async defer></script>
    <!--.......................-->

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
                <li>
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
                <li class="active">
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
                                <li><a href="../bus/signout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4>Users</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 table-responsive">
                                        <table id="userstable" class="col-sm-12 col-lg-12 col-md-12 table table-bordered table-condensed">
                                            <thead>
                                            <tr>
                                                <th>PaymentID</th>
                                                <th>Email</th>
                                                <th>Invoice</th>
                                                <th>Item</th>
                                                <th>Status</th>
                                                <th>Payment Type</th>
                                                <th>Payer</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            require_once "../functions/autoload.php";
                                            $db=new Db_connector();
                                            $data=array(
                                                '*'
                                            );
                                            $conn=array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true);
                                            $db->setDetails($conn);
                                            $results=$db->setTable('payments')
                                                ->isSelect()
                                                ->setData($data)
                                                ->exec();
                                            $tz=new DateTimeZone('Africa/Nairobi');
                                            if ($results['count'] == 0) {

                                            } else {
                                                foreach ($results['result'] as $result) {
                                                    $date = $result->PaymentDate;
                                                    $date = new DateTime($date);
                                                    $date = $date->setTimezone($tz);
                                                    $date = $date->format('d - M, Y h:m:s A');
                                                    echo "<tr>
                                                  <td>$result->UQPID</td>
                                                  <td>$result->PayerEmail</td>
                                                  <td>$result->Invoice</td>
                                                  <td>$result->Item</td>
                                                  <td>$result->PStatus</td>
                                                  <td>$result->PaymentType</td>
                                                  <td>$result->PaymentBy</td>
                                                  <td>$result->Amount</td>
                                                  <td>$result->Currency</td>
                                                  <td>$date</td>
                                                </tr>";
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="../js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script>
    $('document').ready(function(){
        $('#userstable').DataTable();

    });
</script>

</html>
