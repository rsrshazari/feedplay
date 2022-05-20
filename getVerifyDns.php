<?php
 include("configuration/connect.php");
 include("configuration/functions.php");

 ?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$domId = $_POST['domId'];
$qry=mysqli_query($con,"select * from `customdomain` where id=$domId");
$res=mysqli_fetch_array($qry);
$domain=$res['domain'];
$cname=$res['cname'];
$dns = dns_get_record($domain, DNS_A);
$dnsIp=$dns[0]['ip'];
if ($cname==$dnsIp) {
  mysqli_query($con,"update customdomain set cname_verify='1' where id=$domId");
  $r=1;
  $html='<i class="fa-solid fa-check text-sm ms-1 mt-1 text-success"></i> Verified';
}else{
  $r=0;
  $html='Check';
}
}
echo $r.'#'.$html.'#'.$cname.'#'.$dnsIp;
?>
