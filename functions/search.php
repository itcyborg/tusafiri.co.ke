<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/30/2017
 * Time: 7:03 PM
 */
@session_start();
if(isset($_POST['searchtrip']))
{
    $state = "";
    $now = date('Y-m-d');
    $destination=trim($_POST['destination']);
    $start=trim($_POST['start']);
    $finish=trim($_POST['end']);
    $price=trim($_POST['price']);
    $sql="SELECT * FROM trips_all";
    $condition="";
    if($destination!==""){
        $condition.=" WHERE Destination like '%$destination%'";
    }
    if($start!=="" && $finish!==""){
        if($condition==""){
            $condition .= " WHERE StartDate between '$start' AND '$finish' || FinishDate between '$start' and '$finish'";
        }else {
            $condition .= " || StartDate between '$start' AND '$finish' || FinishDate between '$start' and '$finish'";
        }
    }
    if($price!==0 && $price!==""){
        $min = 0;
        $max = 0;
        if ($price == 1) {
            $min = 0;
            $max = 4999;
        } elseif ($price == 2) {
            $min = 5000;
            $max = 9999;
        } elseif ($price == 3) {
            $min = 10000;
            $max = 14999;
        } elseif ($price == 4) {
            $min = 15000;
            $max = "(SELECT MAX(Amount) FROM trips)";
        }
        if($condition==""){
            $condition .= " WHERE Amount BETWEEN '$min' AND $max";
        }else {
            $condition .= " || Amount BETWEEN '$min' AND $max";
        }
    }
    $sql=$sql.$condition;
    $options = array(PDO::ATTR_EMULATE_PREPARES => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, INFO_GENERAL);
    $db=new PDO("mysql:host=localhost;dbname=kiboit_tusafiri", 'kiboit_tusafiri', '{@dE*Zby?llT', $options);
    $results = $db->query($sql . "  ORDER BY StartDate DESC")->fetchAll(PDO::FETCH_OBJ);
    $output="";
    foreach ($results as $result) {
        if ($result->StartDate > $now) {
            $state = "Upcoming";
        } elseif ($result->FinishDate <= $now) {
            $state = "Ending or Ended";
        } else {
            $state = "Started/ Starting";
        }
        $photo=explode(",",$result->Photos)[0];
        $info=limit_text(strip_tags($result->Info),30);
        if ($result->Classification === "featured") {
            $class = "col-md-7 col-lg-7";
        } else {
            $class = "col-md-4 col-lg-4";
        }
        $output.= "
        <a href='showtrips.php?id=$result->UQID'><div class='$class col-sm-12 col-xs-12' style='margin-bottom:20px;'>
            <div class='card'>
                <img src='$photo'>
                <div class='header'>
                    <h4><span class='fa fa-plane'></span> $result->StartDate - $result->FinishDate</h4>
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
    echo json_encode($output);
}
function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}