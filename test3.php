<?php
ob_start();
session_start();
//$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
 header('Content-Type:application:json');
 header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
$date=date('d-m-Y h:i:sa');

//checkIntrusion($userId);
require_once 'vendor/autoload.php';
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Protobuf\Internal\GPBUtil;
use Google\Cloud\Storage\StorageClient;

$ids=getUserIds(1);
print_r($ids);
?>
