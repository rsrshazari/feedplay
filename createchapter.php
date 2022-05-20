<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
$cname=$_POST['chaptername'];
$date=date('Y-m-d ');
$time=date("h:i sa");
$id=$userId;
$fid=$_POST['hidFeedId'];
$chapter=mysqli_query($con,"INSERT INTO `chapter`(`feed_id`, `user_id`, `name`, `audio_id`, `content`, `date`, `time`, `image`, `color`, `desp`, `author`, `status`)
VALUES ('$fid','$userId','$cname','','','$date','$time','','','','','0')");
$cpid=base64_encode(mysqli_insert_id($con));
header("location:create-feed.php?cpid=$cpid");
 ?>
