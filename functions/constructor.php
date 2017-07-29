<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 6/27/2017
 * Time: 5:31 PM
 */
@session_start();
if(isset($_POST['destination']) && !isset($_POST['createTrip'])){
    $destination=trim($_POST['destination']);
    $_SESSION['destination']=$destination;
    if(sizeof($_SESSION['destination'])>0){
        echo true;
    }else{
        echo false;
    }
}
if(isset($_POST['tripname']) && !isset($_POST['createTrip'])){
    $tripname=trim($_POST['tripname']);
    $_SESSION['tripname']=$tripname;
    if(sizeof($_SESSION['tripname'])>0){
        echo true;
    }else{
        echo false;
    }
}
if(isset($_POST['tripcategory']) && !isset($_POST['createTrip'])){
    $tripcat=trim($_POST['tripcategory']);
    $_SESSION['tripcategory']=$tripcat;
    if(sizeof($_SESSION['tripcategory'])>0){
        echo true;
    }else{
        echo false;
    }
}
if(isset($_POST['schedule']) && !isset($_POST['createTrip'])){
    $_SESSION['schedule']=array('from'=>$_POST['from'],'to'=>$_POST['to']);
    if(isset($_SESSION['destination']) && isset($_SESSION['tripname']) && isset($_SESSION['tripcategory']) && isset($_SESSION['schedule'])){
        if(isset($_SESSION['user']) && isset($_SESSION['id'])){
            $url=$_SERVER['HTTP_REFERER'];
            if(strstr($url,'user')){
                $response = array('status' => true, 'url' => 'index.php?proceed=true');
            }else {
                $response = array('status' => true, 'url' => 'user/?proceed=true');
            }
        }else{
            $response=array('status'=>true,'url'=>'login.php?from=createTrip');
            $_SESSION['refurl']='createTrip';
        }
        echo json_encode($response);
    }else{
        echo json_encode(false);
    }
}

if(isset($_POST['removePhoto'])){
    $url=$_POST['id'];
    if(unlink($url)){
        $files=$_SESSION['files'];
        $nfiles=null;
        foreach ($files as $file) {
            if(strpos($file,$url)){

            }else{
                $nfiles[]=$file;
            }
        }
        $_SESSION['files']=$nfiles;

        echo json_encode("success");
    }else{
        echo json_encode("failed");
    }
}

if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = passHash($_POST['password']);
        //add the class and create a new instance
        require_once "autoload.php";
        $db = new Db_connector();

        //set the type of query you want to run
        #insert
        $db->isInsert();
        #update
        //$db->isUpdate();
        #delete
        //$db->isDelete();
        #select
        //$db->isSelect();

        //set the table
        $db->setTable("users");

        //pass the database details
        $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

        //set the data in an associative array with column name as key and value as value to be inserted
        $data = array(
            'Email' =>      $email,
            'Password' =>   $password,
            'uniqueID'=>    generateID()
        );

        //set the conditions if is update,delete or select querys
        //$db->setCondition("id='1'");

        //pass the data
        $db->setData($data);

        //execute the query and get the response
        $res = $db->exec();

        //check for messages
        echo $db->getMsg();

        //view the response
        echo $res;
}

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    //add the class and create a new instance
    require_once "autoload.php";
    $db = new Db_connector();

    $db->isSelect();

    //set the table
    $db->setTable("users");

    //pass the database details
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

    //set the data in an associative array with column name as key and value as value to be inserted
    $data = array(
        '*'
    );

    //set the conditions if is update,delete or select querys
    $db->setCondition("Email='$email'");

    //pass the data
    $db->setData($data);

    //execute the query and get the response
    $res = $db->exec()['result'];

    $ref=$_SERVER['HTTP_REFERER'];
    if(strpos($ref,'joinTrip')){
        $id=explode('id=',$ref)[1];
        $urls='continue.php?from=joinTrip&&id='.$id;
    }

    if(passVerify($password,$res->Password)){
        @session_start();
        $_SESSION['user']=$email;
        $_SESSION['id']=$res->uniqueID;
        $_SESSION['role']=$res->Role;
        if($_SESSION['role']>=2) {
            header('location:../user/' . $urls);
        }elseif ($_SESSION['role']>=1){
            $_SESSION['return_to']="../bus/";
            header('location:../bus/../user/' . $urls);
        }elseif($_SESSION['role']>=0){
            $_SESSION['return_to']="../admin/";
            header('location:../admin/' . $urls);
        }
    }else{
        die("Wrong credentials");
    }
    //check for messages
    echo $db->getMsg();
}

if(isset($_POST['loginGoogle'])){
    $email=$_POST['email'];
    $token=$_POST['token'];

    require_once "autoload.php";
    $db = new Db_connector();

    #select
    $db->isSelect();

    //set the table
    $db->setTable("users");

    //pass the database details
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

    //set the data in an associative array with column name as key and value as value to be inserted
    $data = array(
        '*'
    );

    //set the conditions if is update,delete or select querys
    $db->setCondition("Email='$email'");

    //pass the data
    $db->setData($data);

    //execute the query and get the response
    $res = $db->exec();

    if($res['count']==1) {
        require_once '../libs/vendor/autoload.php';
        $client = new Google_Client(['client_id' => $CLIENT_ID]);
        $payload = $client->verifyIdToken($token);
        if ($payload) {
            @session_start();
            $_SESSION['user']=$email;
            $_SESSION['id']=$res['result']->uniqueID;
            $_SESSION['role']=$res['result']->Role;
            $_SESSION['google']=true;
            $db=new Db_connector();
            $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
            $db->isUpdate();
            $db->setTable('users');
            $data1=array(
                'gAuthToken'=>$token
            );
            $db->setCondition("Email='$email'");
            $db->setData($data1);
            $db->exec();

            if($_SESSION['role']>=2) {
                echo json_encode(array('status'=>true,'url'=>'user/'));
            }elseif ($_SESSION['role']>=1){
                echo json_encode(array('status'=>true,'url'=>'bus/'));
            }elseif($_SESSION['role']>=0){
                echo json_encode(array('status'=>true,'url'=>'admin/'));
            }

        } else {
            // Invalid ID token
            echo json_encode(array('status'=>false));
        }
    }else{
        echo json_encode(array('status'=>false));
    }
}

if(isset($_POST['registerGoogle'])){
    $email=$_POST['email'];
    $token=$_POST['token'];
    $username=$_POST['username'];

    require_once "autoload.php";
    $db = new Db_connector();

    #select
    $db->isInsert();

    //set the table
    $db->setTable("users");

    //pass the database details
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

    //set the data in an associative array with column name as key and value as value to be inserted
    $data = array(
        'Email' =>      $email,
        'Password' =>   $password,
        'Username'=>$username,
        'uniqueID'=>    generateID()
    );

    //pass the data
    $db->setData($data);

    //execute the query and get the response
    $res = $db->exec();
    @session_start();
    $_SESSION['user']=$email;
    $_SESSION['id']=$res['result']->uniqueID;
    $_SESSION['google']=true;
    $db=new Db_connector();
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $db->isUpdate();
    $db->setTable('users');
    $data1=array(
        'gAuthToken'=>$token
    );
    $db->setCondition("Email='$email'");
    $db->setData($data1);
    $db->exec();
    echo json_encode(array('status'=>true,'url'=>'user/'));
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
}

if(isset($_POST['createTrip'])){
    $name=$_POST['tripname'];
    $destination=$_POST['destination'];
    $from=$_POST['from'];
    $to=$_POST['to'];
    $meeting=$_POST['meeting'];
    $slots=$_POST['slots'];
    $uploads="";
    if(isset($_SESSION['todb'])){
        $files=$_SESSION['todb'];
        foreach ($files as $file) {
            if($uploads==""){
                $uploads.=$file;
            }else{
                $uploads.=",".$file;
            }
        }
    }
    //add the class and create a new instance
    require_once "autoload.php";
    $db = new Db_connector();

    //set the type of query you want to run
    #insert
    $db->isInsert();

    //set the table
    $db->setTable("trips");

    //pass the database details
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

    $uqid=generateID();
    $_SESSION['tid']=$uqid;

    //set the data in an associative array with column name as key and value as value to be inserted
    $data = array(
        'UQID'          =>  $uqid,
        'Name'          =>  $name,
        'Classification'=>  $_SESSION['tripcategory'],
        'Destination'   =>  $_SESSION['destination'],
        'StartDate'     =>  $from,
        'FinishDate'    =>  $to,
        'MeetingPoint'  =>  $meeting,
        'Slots'         =>  $slots,
        'Photos'        =>  $uploads,
        'ByUser'            =>  $_SESSION['id']
    );

    //pass the data
    $db->setData($data);

    //execute the query and get the response
    $res = $db->exec();
    $id=$res['id'];

    //check for messages
    if($db->isError()){
        die($db->getMsg());
        header('location:'.$_SERVER['HTTP_REFERER']);
    }else{
        $_SESSION['files']="";
        header('location:../user/tripDescription.php?id='.$id);
    }

    //echo $db->getMsg();
    //view the response
    //echo $res;
}

if(isset($_POST['tripInfo'])){
    $tripinfo=$_POST['tripinfo'];
    $id=$_POST['id'];
    require_once "autoload.php";
    $db=new Db_connector();
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $db->isUpdate();
    $data=array(
        'Info'  =>  $tripinfo
    );
    $db->setCondition("ID='$id'");
    $db->setTable("trips");
    $db->setData($data);
    $res=$db->exec();
    if($db->isError() && $res['status']!=false){
        $_SESSION['info']=$tripinfo;
        header('location:'.$_SERVER['HTTP_REFERER'].'?id='.$id);
    }else{
        header('location:../user/pricing.php?id='.$id);
    }
}

if(isset($_POST['TripimageUpload'])){
    if($_SESSION['count']>5){
        $response['msg']='limit reached';
        $response['status']='err';
        die(json_encode($response));
    }
    if(sizeof($_SESSION['files'])>6){
        $response['msg']='limit reached';
        $response['status']='err';
        die(json_encode($response));
    }
    //add the class
    require_once "autoload.php";
    //create a new instance of the class
    $upload = new Upload();
    try {
        //pass the file variable ($_FILES['file'])
        $upload->setFile($_FILES['file']);

        //set a list of allowed file types(optional)
        $upload->setAllowed(array('jpeg', 'png','jpg','JPG'));

        //set the maximum file size allowed in bytes(optional)
        $upload->setMaxSize(5242880);

        //finish the configurations
        $upload->setAll();

        $name=$upload->getName();

        $upload->setName(generateID().".".$upload->getExt());

        //get status message: errors and status(optional)
        $upload->getMsg();

        //upload the file
        $upload->up();

        //get the url of the file after a successful file upload(optional)
        $response['status']='ok';
        $url='../uploads/'.$upload->getName();
        $ids=generateID();
        $file='<div id="'.$ids.'" class="row alert alert-success"><span class="img_pop" onclick="pop(\''.$url.'\')">'.$name.'</span><button onclick="removeFile(\''.$url.'\',\''.$ids.'\')" class="close">X</button></div>';
        $response['files']=$file;
        $_SESSION['files'][]=$file;
        $_SESSION['todb'][]=$url;
        $_SESSION['count']++;
        echo json_encode($response,true);
    } catch (Exception $e) {
        //print the error and stop
        $response['status']='err';
        $response['msg']=$e->getMessage();
        echo json_encode($response,true);
    }
}

if(isset($_POST['save']) || isset($_POST['savePost'])){
    $id=$_POST['id'];
    $cost=$_POST['cost'];
    $costgroup=$_POST['costgroup'];
    $welcome=$_POST['welcome'];
    require_once "autoload.php";
    $db=new Db_connector();

    //set the table
    $db->setTable("trips");

    //pass the database details
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));

    $db->isUpdate();

    $post="";

    if(isset($_POST['savePost'])){
        $post="YES";
    }else{
        $post="NO";
    }

    $data=array(
        'Amount'    =>  $cost,
        'Per'       =>  $costgroup,
        'Welcome'   =>  $welcome,
        'Post'      =>  $post
    );

    $db->setCondition("ID='$id'");

    $db->setData($data);

    $res=$db->exec();

    if($db->isError() || $res['status']==false){
        header("location:".$_SERVER['HTTP_REFERER']."?id=".$id);
    }else{
        header("location:../user/tripCreated.php?id=".$id);
    }
}

if(isset($_POST['joinTrip'],$_POST['tripid'])){
    $id=$_POST['tripid'];
    $_SESSION['joinTrip']=$id;
    if(isset($_SESSION['user'],$_SESSION['id'])){

    }else{
        $response['url']='login.php?from=joinTrip&&id='.$id;
        $response['redirect']=true;
        $response['status']=false;
        echo json_encode($response);
        die();
    }
    $bookid=generateID();
    require_once "autoload.php";
    $db=new Db_connector();
    $data=array(
        'TripID'=>$id,
        'BookID'=>$bookid,
        'UserID'=>$_SESSION['id'],
        'UQTID'=>$id.$_SESSION['id']
    );
    $conn=array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true);
    $db->isInsert();
    $db->setTable('joinedtrips');
    $db->setDetails($conn);
    $db->setData($data);
    $db->exec();
    if($db->isError()){
        if($db->getErrorCode()=="23000"){
            $response['error']="Sorry, you have already joined this trip. Please select another trip.";
        }else{
            $response['error']=$db->getMsg();
        }
        $response['redirect']=false;
        $response['status']=false;
        echo json_encode($response);
        die();
    }else{
        $response['status']=true;
        $response['url']="/user/finish.php?action=joinTrip&&id=$id&&book=$bookid";
        echo json_encode($response);
    }
}

if(isset($_POST['sendMessage'])){
    @session_start();
    $to=$_POST['to'];
    $msg=$_POST['msg'];
    $role="no-reply@tusafiri.co.ke";
    $subject="Messages";
    $from="admin@tusafiri.co.ke";
    if($_SESSION['role']<=2){
        $from="admin@tusafiri.co.ke";
        $subject="Message from Admin";
    }else{
        $from=$_SESSION['user'];
    }
    $response=sendMail($to,$msg,$from,$subject);
    $res=null;
    if($response===true){
        $res['status']=true;
        $res['to']=$to;
    }else{
        $res['status']=false;
        $res['to']=$to;
        $res['error']=$response;
    }
    echo json_encode($res);
}

if(isset($_POST['ResetpassA'])){
    $id=$_POST['id'];
    $res=resetPassword($id);
    echo json_encode($res);
}

if(isset($_POST['DeactivateAccount'])){
    $email=$_POST['email'];
    $res=deactivateAccount($email);
    echo json_encode($res);
}

if(isset($_POST['activateAccount'])){
    $email=$_POST['email'];
    $res=activateAccount($email);
    echo json_encode($res);
}

if(isset($_POST['updateprofile'])){
    require_once "../functions/autoload.php";
    $db=new Db_connector();
    $userid=$_POST['userid'];
    $db->setData(array(
        'City'=>$_POST['city'],
        'Country'=>$_POST['country'],
        'PostalCode'=>$_POST['postalcode'],
        'Address'=>$_POST['address'],
        'About'=>$_POST['about'],
        'Contact'=>$_POST['contact'],
        'Twitter'=>$_POST['twitter'],
        'Facebook'=>$_POST['facebook'],
        'Company'=>$_POST['company'],
        'UserID'=>$_POST['userid']
    ))
        ->isUpdate()
        ->setTable('profile')
        ->setCondition("UserID='$userid'");
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $result=$db->exec();
    if($db->isError()){
        echo json_encode($db->getMsg());
    }else{
        echo json_encode($db->getMsg());
    }
}

if(isset($_POST['getAccount'])){
    $userid=$_SESSION['id'];
    require_once "autoload.php";
    $db=new Db_connector();
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $db->isSelect()
        ->setTable("paidtrips")
        ->setData(array("*"))
        ->setCondition("ByUser='$userid'");
    $result=$db->exec();
    $usd=0;
    $ksh=0;
    $res=null;
    $results=$result['result'];
    $response=null;
    if($result['count']<1){
        $response['status']=true;
        $response['ksh']=$ksh;
        $response['usd']=$usd;
    }else if($result['count']<2){
        $response['status']=true;
        if($results->Currency=="USD"){
            $usd=$results->Amount;
        }else{
            $ksh=$results->Amount;
        }
    }else{
        $response['status']=true;
        foreach ($results as $result) {
            if($result->Currency=="USD"){
                $usd+=$result->Amount;
            }else{
                $ksh+=$result->Amount;
            }
        }
    }
    if($db->isError()){
        $response['status']=false;
    }else{
        $response['status']=true;
    }
    $response['ksh']=$ksh;
    $response['usd']=$usd;
    echo json_encode($response);
}

function passHash($password)
{
    $options = [
        'cost' => 12
    ];
    return password_hash($password, PASSWORD_DEFAULT, $options);
}

function passVerify($pass, $hash)
{
    if (password_verify($pass, $hash)) {
        return true;
    } else {
        return false;
    }
}

function generateID(){
    $idkeyspace='ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $length=8;
    $idstr=array();
    $max=strlen($idkeyspace)-1;
    for($i=0;$i<$length;++$i){
        $n=rand(0,$max);
        $idstr[]=$idkeyspace[$n];
    }

    return implode($idstr);
}

function generateID1(){
    $idkeyspace='ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghjklmnopqrstuvwxyz<>{}[]./#$&^*()_+=123456789';
    $length=8;
    $idstr=array();
    $max=strlen($idkeyspace)-1;
    for($i=0;$i<$length;++$i){
        $n=rand(0,$max);
        $idstr[]=$idkeyspace[$n];
    }

    return implode($idstr);
}

function sendMail($to,$msg,$from,$subject=null){
    require_once "../libs/vendor/autoload.php";
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Set who the message is to be sent from
    $mail->setFrom($from,'Admin');
    //Set an alternative reply-to address
    $mail->addReplyTo('info@tusafiri.co.ke','Info');
    //Set who the message is to be sent to
    $mail->addAddress($to,$to);
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($msg);
    //Replace the plain text body with one created manually
    $mail->AltBody = $msg;

    //send the message, check for errors
    if (!$mail->send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return true;
    }
}

function resetPassword($email){
    $password=generateID1();
    require_once "autoload.php";
    $db=new Db_connector();
    $db->isUpdate()
        ->setTable('users')
        ->setData(array(
            'Password'=>passHash($password)
        ))
        ->setCondition("Email='$email'");
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $result=$db->exec();
    $response=null;
    if($db->isError()){
        $response['status']=false;
        $response['error']=$db->getMsg();
        $response['to']=$email;
    }else{
        $maild=sendMail($email,$password,'admin@tusafiri.co.ke','Password reset');
        if($maild) {
            $response['status'] = true;
            $response['to'] = $email;
        }else{
            $response['status']=false;
            $response['error']=$maild;
            $response['to']=$email;
        }
    }
    return $response;
}

function deactivateAccount($email){
    require_once "autoload.php";
    $db=new Db_connector();
    $db->isUpdate()
        ->setTable('users')
        ->setData(array(
            'Status'=>0
        ))
        ->setCondition("Email='$email'");
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $result=$db->exec();
    if($db->isError()){
        $response['status']=false;
        $response['error']=$db->getMsg();
        return $response;
    }else{
        $response['status']=true;
        return $response;
    }
}
function activateAccount($email){
    require_once "autoload.php";
    $db=new Db_connector();
    $db->isUpdate()
        ->setTable('users')
        ->setData(array(
            'Status'=>1
        ))
        ->setCondition("Email='$email'");
    $db->setDetails(array('host' => 'localhost', 'dbname' => 'kiboit_tusafiri', 'dbpass' => '{@dE*Zby?llT', 'dbuser' => 'kiboit_tusafiri', 'port' => '3306', 'showerrors' => true));
    $result=$db->exec();
    if($db->isError()){
        $response['status']=false;
        $response['error']=$db->getMsg();
        return $response;
    }else{
        $response['status']=true;
        return $response;
    }
}