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
 ?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$aid = $_POST['id'];
$cid = base64_decode($_POST['cid']);
$fid = $_POST['fid'];
$abc=array();
$qry=mysqli_fetch_array(mysqli_query($con,"select * from audio where id=$aid"));
if($qry['content']!=''){
  $audiofname=$qry['file'];
  $array=$qry['content'];
  mysqli_query($con,"update `audio` set content='$array' where id='$aid'");
  mysqli_query($con,"update `chapter` set audio_id='$aid',audio_file='$audiofname',content='$array' where id='$cid'");
  $cpid=base64_encode($cid);
  // $arrayName = array('cid' => $cpid );
  // $abc['subtitle']=$arrayName;
    //echo json_encode($abc);
    //echo $cpid;
}else{
  $records=array();
  $audio="audio/".$qry['file'];
  $audiofname=$qry['file'];
  $storage = new StorageClient([
      'keyFilePath' => 'nth-autumn-298708-f07951b076ce.json',
  ]);
  $bucketName = 'vidreadzapp-bucket';
      $fileName = $audio;
      $bucket = $storage->bucket($bucketName);
      $object = $bucket->upload(
          fopen($fileName, 'r')
      );
  $audioFile = $audio;
  $audio1="gs://vidreadzapp-bucket/".$audiofname;
  $jsonFileUrl = 'nth-autumn-298708-f07951b076ce.json';
  putenv("GOOGLE_APPLICATION_CREDENTIALS=$jsonFileUrl");
  // change these variables if necessary
    $encoding = AudioEncoding::LINEAR16;
  $languageCode = 'en-US';
  $str='.';
  $a=1;
  $word_rslt="";
  $i=0;$j=0;$wrmer="";$res="";
  // get contents of a file into a string
  $content = file_get_contents($audioFile);
  // set string as audio content
  $audio = (new RecognitionAudio())
  //->setContent($content);
  ->setUri($audio1);
  // set config
  $config = (new RecognitionConfig())
  ->setEncoding($encoding)
  ->setLanguageCode($languageCode)
  ->setEnableWordTimeOffsets($a)
  ->setEnableAutomaticPunctuation($a);
  // ->setModel('video')
  // // ->setSampleRateHertz(16000)
  // ->setAudioChannelCount(2);
  $client = new SpeechClient();
  $operation = $client->longRunningRecognize($config, $audio);
  $operation->pollUntilComplete();
  if ($operation->operationSucceeded()) {
  $response = $operation->getResult();
  $final_transcript = '';
  foreach ($response->getResults() as $result) {
  $alternatives = $result->getAlternatives();
  $mostLikely = $alternatives[0];
  $final_transcript .= $mostLikely->getTranscript();
  //$transcript   = $mostLikely->getTranscript ();
  //$confidence   = $mostLikely->getConfidence ();
  foreach ($mostLikely->getWords() as $wordInfo) {
    $i++;
        $wd= str_replace(['"',"'"], "", $wordInfo->getWord());
      $stime=GPBUtil::formatDuration($wordInfo->getStartTime());
      $endtime=GPBUtil::formatDuration($wordInfo->getEndTime());
        $st=round($stime/60,2);
     array_push($records,array("i"=>$i,
    's'=>$st,
    //'e'=>$endtime,
    't'=>$wd,
    ));
    }
  }
  $array= json_encode($records);

  } else {
  print_r($operation->getError());
  }
  $client->close();
}
$conn = mysqli_connect("localhost", "root", "", "gofeeds");
$data=mysqli_real_escape_string($conn,$array);
mysqli_query($conn,"update `audio` set content='$array' where id='$aid'");
mysqli_query($conn,"update `chapter` set audio_id='$aid',audio_file='$audiofname',content='$array' where id='$cid'");
$cpid=base64_encode($cid);
// $arrayName = array('cid' => $cpid );
// $abc['subtitle']=$arrayName;
// echo json_encode($abc);
echo $cpid;
}
else{
	echo "error";
}

?>
