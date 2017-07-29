<?php
@session_start();
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 5/27/2017
 * Time: 8:22 AM
 */

if (file_exists("../libs/Db_connector.inc")) {
    require "../libs/Db_connector.inc";
} else {
    die("Error loading some classes. Class file not found 1");
}

if (file_exists("../libs/upload.inc")) {
    require "../libs/upload.inc";
} else {
    die("Error loading some classes. Class file not found 2");
}

if (file_exists("../libs/prettyExceptions.inc")) {
    require "../libs/prettyExceptions.inc";
} else {
    die("Error loading some classes. Class file not found 3");
}