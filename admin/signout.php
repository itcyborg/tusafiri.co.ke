<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 8/1/2017
 * Time: 10:47 AM
 */
@session_start();
die(var_dump($_SESSION));

@session_unset($_SESSION['access_token']);
@session_destroy();
@session_unset($_SESSION);

header("Location:../");