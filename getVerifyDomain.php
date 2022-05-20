<?php
 include("configuration/connect.php");
 include("configuration/functions.php");
 header('Content-Type:application:json');
 ?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$domain = $_POST['domain'];
$userId = $_POST['usrId'];
$dns = dns_get_record($domain, DNS_NS);
$no= count($dns);
if ($no>0) {
  $date=date('Y-m-d');
  $time=date('h:m:s');
  $cname='3.231.128.6';
  $filename = 'C:\xampp\apache\conf\extra\httpd-vhosts.conf';
  $myfile   = fopen($filename, "a+");
  fwrite($myfile, PHP_EOL );
  $template = '<VirtualHost *:80>
      ServerAdmin webmaster@'.$domain.'
      DocumentRoot "C:/xampp/htdocs/gofeednew/domain"
      ServerName '.$domain.'
      ErrorLog "logs/'.$domain.'-error.log"
      CustomLog "logs/'.$domain.'.log" common
  	<Directory "C:/xampp/htdocs/gofeednew/domain">
        AllowOverride All
        Order allow,deny
        Allow from all
     </Directory>
  </VirtualHost>';
  fwrite($myfile, $template );
  fclose($myfile);
  $qry=mysqli_query($con,"INSERT INTO `customdomain`(`user_id`, `domain`, `cname`, `domain_verify`, `cname_verify`, `date`, `time`)
  VALUES ('$userId','$domain','$cname','1','0','$date','$time')");
  $r=1;
  $html='<div class="alert alert-success  fade show text-white" role="alert">
<span class="alert-icon"><i class="ni ni-like-2"></i></span>
<span class="alert-text"><strong>Verified </strong> '.$cname.' </span>
</div>';
$html2='Add this A record to your domain by visiting your DNS provider or registrar.';
}else{
  $r=0;
  $html='<div class="alert alert-danger  fade show text-white" role="alert">
<span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
<span class="alert-text"><strong>Error!</strong> Domain is not Register </span>
</div>';
$html2='Enter the exact domain name you want your projects to be accessible with. It can be a subdomain <strong>(example.yourdomain.com)</strong> or root domain <strong>(yourdomain.com)</strong>';
}
}
echo $r.'#'.$html.'#'.$html2;

?>
