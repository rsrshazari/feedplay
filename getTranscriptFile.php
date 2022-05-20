<?php
 include("configuration/connect.php");
 include("configuration/functions.php");
 header('Content-Type:application:json');
 ?>
<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
$vid = $_GET['id'];
  $qry=mysqli_fetch_array(mysqli_query($con,'select * from audio where id=5'));
  $abc['subtitle']=json_decode($qry['content']);
  echo json_encode($abc);
}
else{
	echo "error";
}

?>
