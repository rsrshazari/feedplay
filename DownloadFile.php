<?php
ob_start();
session_start();
//$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
header("Content-type: application/vnd.ms-excel");
header("Content-Type: application/force-download");
header("Content-Type: application/Json");
$date=date('d-m-Y h:i:sa');
if($_SERVER['REQUEST_METHOD']=='POST'){
$aid = $_POST['aId'];
$type = $_POST['typ'];
$abc=array();
$qry=mysqli_fetch_array(mysqli_query($con,"select * from audio where id=$aid"));
$content=$qry['content'];
//file_put_contents("geeks_data.json", $content);
$filename = 'generated_json_' . date( 'Y-m-d' );

header("Content-disposition: " . $filename . ".json");
header("Content-disposition: filename=" . $filename . ".json");

print $content;
exit;
}
else{
	echo "error";
}

?>
