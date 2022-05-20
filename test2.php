<?php
ob_start();
session_start();
//$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
 header('Content-Type:application:json');
$date=date('d-m-Y h:i:sa');
//checkIntrusion($userId);
// require_once 'vendor/autoload.php';
// use Google\Cloud\Speech\V1\SpeechClient;
// use Google\Cloud\Speech\V1\RecognitionAudio;
// use Google\Cloud\Speech\V1\RecognitionConfig;
// use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
// use Google\Protobuf\Internal\GPBUtil;
// use Google\Cloud\Storage\StorageClient;
     $records=array();
//
// for ($i=0; $i < 10; $i++) {
//   $arr=array($i,$i);
// }
//         $array= json_encode($records);
//         print_r ($array);
//         $data=mysqli_real_escape_string($con,$array);
//         $abc=mysqli_query($con,"INSERT INTO 'audio'( 'content','status') VALUES ('$array','1')");
//         //echo $abc;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
<body>
    <?php
  //   $qry=mysqli_fetch_array(mysqli_query($con,'select * from audio where id=33'));
  //   $data=json_decode($qry['content'], true);
  //   foreach ($data  as  $value) {
  //   echo $value['start']."<br>";
  // }
$domain="koralapp.in";
$dns = dns_get_record($domain, DNS_A);
 echo "<pre>";
 print_r($dns);
echo $dns[0]['ip'];
// echo time() . "<br>";
// echo microtime(true) . "<br>";
// $time = time();
// $startTime = date("H:i", strtotime('-30 minutes', $time));
// $endTime = date("H:i", strtotime('+30 minutes', $time));
// echo $time. "<br>";
// echo $startTime. "<br>";
// echo $endTime . "<br>";
// echo strtotime('+40 minutes',time());
//
// // $filename = 'C:\xampp\apache\conf\extra\httpd-vhosts.conf';
// // $myfile   = fopen($filename, "a+");
// // fwrite($myfile, PHP_EOL );
// // $template = '<VirtualHost *:80>
// //     ServerAdmin webmaster@aara.health
// //     DocumentRoot "C:/xampp/htdocs/gofeednew"
// //     ServerName aara.health
// //     ErrorLog "logs/aara.health-error.log"
// //     CustomLog "logs/aara.health.log" common
// // 	<Directory "C:/xampp/htdocs/gofeednew">
// //       AllowOverride All
// //       Order allow,deny
// //       Allow from all
// //    </Directory>
// // </VirtualHost>';
// //
// // fwrite($myfile, $template );
// // fclose($myfile);
//
//  //$cmd = 'move ' . $filename . ' /apache/conf/extra';
// //  $cmd='net start apache2.2';
// //
// //  shell_exec($cmd);
// // echo $cmd;
// ?>
// <?php //echo shell_exec('service httpd restart &'); ?>
// <?php //echo shell_exec('systemctl reload apache2');
// public function app_install() {
//         $postdata = json_decode(file_get_contents("php://input"), true);
//         $data = array(
//           'fcm_token'=>$postdata['fcm_token'],
//             'device_id'=>$postdata['device_id'],
//              'device_type'=>$postdata['device_type'],
//               'login_type'=>$postdata['login_type'],
//                'version_relese'=>$postdata['version_relese'],
//                 'version_sdk_number'=>$postdata['version_sdk_number'],
//                  'board'=>$postdata['board'],
//                   'bootloader'=>$postdata['bootloader'],
//                    'brand'=>$postdata['brand'],
//                     'cpu_abi'=>$postdata['cpu_abi'],
//                      'manufacturer'=>$postdata['manufacturer'],
//                       'model'=>$postdata['model'],
//                        'product'=>$postdata['product'],
//                         'time'=>$postdata['time'],
//                          'type'=>$postdata['type'],
//                           'date'=>$date,
//                            'status'=>$status,
//         );
//
//         $query = $this->db->insert('app_install', $data);
//         if ($query == TRUE) {
//             echo $data['success'] = json_encode(array('status' => TRUE,'slug'=>TRUE, 'message' => 'success', 'data' =>$data));
//         } else {
//             echo $data['error'] = json_encode(array('status' => FALSE, 'message' => 'Something went wrong', 'data' => NULL));
//         }
//     }
    ?>
</body>
</html>
