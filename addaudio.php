<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
$date=date('d-m-Y h:i:sa');
checkIntrusion($userId);
function mbmGetFLVDuration($file){
  //$time = 00:00:00.000 format
  $time =  exec("ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
  $duration = explode(":",$time);
  $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);
  return $duration_in_seconds;
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
   {
        $audio = $_FILES["upfile"]["tmp_name"];
        $fname = $_FILES['upfile']['name'];
        $date=date("Y-m-d");
        $time=date("h:i sa");
        $tm=time();
        $cpid=$_POST['cpid'];
        $extension = pathinfo($fname, PATHINFO_EXTENSION);
        $filename=$tm.".".$extension;
        $file = basename($fname,".".$extension);
        $location = "audio/".$filename;
        //$duration = mbmGetFLVDuration($audio);
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        move_uploaded_file($audio,$location);
        $sql=mysqli_query($con,"INSERT INTO `audio`( `file`, `name`, `duration`, `user_id`,`type`, `date`, `time`, `status`)
         VALUES ('$filename','$fname','$duration','$userId','1','$date','$time','1')");
        $id=mysqli_insert_id($con);
        echo $cpid;
      }
?>
