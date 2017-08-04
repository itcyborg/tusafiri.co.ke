<?php
@session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id'],$_SESSION['role'])){
    if($_SESSION['role']==1){

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
    $result="";
    require_once "../functions/autoload.php";
    $email=$_SESSION['user'];
    try {
        $db = new Db_connector();
        $conn = array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true);
        $db->setDetails($conn);
        $db->isSelect()
            ->setTable('userprofile')
            ->setData(array('*'))
            ->setCondition("Email='$email'");
        $result = $db->exec()['result'];
        $country="Select Country";
        $options="";
        require_once "../libs/countries.php";
        foreach ($countries as $value){
            $options.="<option value='$value'>$value</option>";
        }
        if($result->Country!="" || trim($result->Country)!=""){
            $country=$result->Country;
        }
    }catch (Exception $e){
        die($e);
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../admin/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../admin/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tusafiri -Profile</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../admin/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../admin/assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../admin/assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../admin/assets/css/themify-icons.css" rel="stylesheet">
    <!-- This is what you need -->
    <script src="../admin/assets/js/sweetalert2.min.js" async defer></script>
    <link rel="stylesheet" href="../admin/assets/js/sweetalert2.min.css">

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js" async defer></script>
    <!--.......................-->

</head>
<body>
<style>
    .btn-bs-file{
        position:relative;
    }
    .btn-bs-file input[type="file"]{
        position: absolute;
        top: -9999999;
        filter: alpha(opacity=0);
        opacity: 0;
        width:0;
        height:0;
        outline: none;
        cursor: inherit;
    }
</style>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <img src="../admin/assets/img/logo.png" class="logoimg">
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
                <li>
                    <a href="payments.php">
                        <i class="ti-money"></i>
                        <p>Payments</p>
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
                    <a class="navbar-brand" href="#">Settings</a>
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
                                <p><?php echo $_SESSION['user']; ?></p>
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
                    <div class="col-lg-4 col-md-5">
                        <!--User Card-->
                        <div class="card card-user">
                            <div class="image">
                                <img src="../<?php echo $result->ProfPic;?>" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" id="profpicH" src="../<?php echo $result->ProfPic;?>" alt="Profile"/>
                                  <h4 class="title"><?php echo $result->Username;?><br />
                                     <small><?php echo $result->Email;?></small></a>
                                  </h4>
                                  <hr>
                                    <div class="row">
                                        <div class="uploadStatus"></div>
                                        <label class="btn-bs-file btn  btn-primary">
                                            Upload File
                                            <input type="file" name="prof" id="prof" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h2><i class="ti-lock"></i> Change Password</h2>
                            </div>
                            <div class="content">
                                <form id="passform">
                                    <div class="row"><div id="status"></div></div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control border-input"><br>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" id="cpassword" name="cpassword" class="form-control border-input">
                                    </div>
                                    <button class="btn btn-primary btn-fill" id="pbut">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form id="profileUpdate">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input id="company" type="text" class="form-control border-input" placeholder="Company" value="<?php echo $result->Company;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" id="username" class="form-control border-input" placeholder="Username" value="<?php echo $result->Username; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" id="email" class="form-control border-input" placeholder="Email" value="<?php echo $result->Email;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" id="fname" class="form-control border-input" placeholder="Full Name" value="<?php echo $result->FullName;?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" id="address" class="form-control border-input" placeholder="Home Address" value="<?php echo $result->Address;?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select id="country" class="form-control border-input">
                                                    <option value="<?php echo $country;?>"><?php echo $country;?></option>
                                                    <?php echo $options;?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" id="city" class="form-control border-input" placeholder="City" value="<?php echo $result->City;?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" id="postalcode" class="form-control border-input" placeholder="Postal Code" value="<?php echo $result->PostalCode;?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input type="text" id="twitter" class="form-control border-input" placeholder="Twitter" value="<?php echo $result->Twitter;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" id="facebook" class="form-control border-input" placeholder="Facebook" value="<?php echo $result->Facebook;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="number" id="phone" class="form-control border-input" placeholder="Telephone" value="<?php echo $result->Contact;?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" id="about" class="form-control border-input" placeholder="Here can be your description"><?php echo $result->About;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
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
    <script src="../admin/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../admin/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../admin/assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../admin/assets/js/bootstrap-notify.js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="../admin/assets/js/paper-dashboard.js"></script>
    <script type="text/javascript">
        $('document').ready(function(){
           $('#profileUpdate').submit(function(e){
               e.preventDefault();
               swal({
                   title: 'Are you sure?',
                   confirmButtonText: 'yes',
                   showCancelButton:true,
                   showLoaderOnConfirm: true,
                   preConfirm: function (email) {
                       return new Promise(function (resolve, reject) {
                           $.ajax({
                               url: '../functions/constructor.php',
                               data:{
                                   'updateprofile':true,
                                   'userid':'<?php echo $result->uniqueID;?>',
                                   'email': $('#email').val(),
                                   'username':$('#username').val(),
                                   'address':$('#address').val(),
                                   'postalcode':$('#postalcode').val(),
                                   'fname':$('#fname').val(),
                                   'city':$('#city').val(),
                                   'twitter':$('#twitter').val(),
                                   'facebook':$('#facebook').val(),
                                   'company':$('#company').val(),
                                   'country':$('#country').val(),
                                   'contact':$('#phone').val(),
                                   'about':$('#about').val()
                               },
                               type:'POST',
                               dataType:'JSON',
                               success:function(data){
                                    swal(JSON.stringify(data));
                               }
                           });
                       })
                   },
                   allowOutsideClick: false
               }).then(function (email) {
                   swal({
                       type: 'success',
                       title: 'Ajax request finished!',
                       html: 'Submitted email: ' + email
                   })
               })
           });
           $('#passform').submit(function(f){
               f.preventDefault();
               var cpass=$('#cpassword').val();
               var pass=$('#password').val();
               if(pass!==cpass){
                   swal({
                       type:'warning',
                       title:'Error',
                       text:'Passwords do not match!'
                   });
               }else{
                   swal({
                       title: 'Are you sure?',
                       confirmButtonText: 'Confirm',
                       showCancelButton:true,
                       showLoaderOnConfirm: true,
                       preConfirm: function () {
                           return new Promise(function (resolve, reject) {
                               $.ajax({
                                   url: '../functions/constructor.php',
                                   data:{
                                       'changePass':true,
                                       'pass':pass,
                                       'cpass':cpass
                                   },
                                   type:'POST',
                                   dataType:'JSON',
                                   success:function(data){
                                       swal(JSON.stringify(data));
                                   }
                               });
                           })
                       },
                       allowOutsideClick: false
                   });
               }
           });
           $('#cpassword').keyup(function(){
               var cpass=$('#cpassword').val();
               var pass=$('#password').val();
               if(pass!==cpass){
                   $('#cpassword').addClass('warning');
                   $('#status').html('Passwords do not match.').addClass('alert alert-danger');
               }else{
                   $('#cpassword').removeClass('warning');
                   $('#status').html('').removeClass('row alert alert-danger');
               }
           });
        });

        $('#prof').on('change',photoUpload);

        function photoUpload(event){
            //notify user about the file upload status
            $(".uploadStatus").html("Uploading...");

            //get selected file
            files = event.target.files;

            //form data check the above bullet for what it is
            var data = new FormData();

            //file data is presented as an array
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if(!file.type.match('image.*')) {
                    //check file type
                    $(".uploadStatus").html("Please choose an images file.");
                }else if(file.size > 5242880){
                    //check file size (in bytes)
                    $(".uploadStatus").html("Sorry, your file is too large (>5 MB)");
                }else{
                    //append the uploadable file to FormData object
                    data.append('file', file, file.name);
                    data.append('profileUpload',true);

                    //create a new XMLHttpRequest
                    var xhr = new XMLHttpRequest();

                    //post file data for upload
                    xhr.open('POST', '../functions/constructor.php', true);
                    xhr.send(data);
                    xhr.onload = function () {
                        //get response and show the uploading status
                        var response = JSON.parse(xhr.responseText);
                        if(xhr.status === 200 && response.status == 'ok'){
                            $(".uploadStatus").html("File has been uploaded successfully.");
                        }else if(response.status == 'type_err'){
                            $(".uploadStatus").html("Please choose an images file. Click to upload another.");
                        }else{
                            if(response.msg){
                                $(".uploadStatus").html(response.msg);
                            }else {
                                $(".uploadStatus").html("Some problem occured, please try again.");
                            }
                        }
                    };
                }
            }
        }
    </script>
</html>
