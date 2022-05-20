<?php
ob_start();
session_start();
//$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
 header('Content-Type:application:json');
$date=date('d-m-Y h:i:sa');
//checkIntrusion($userId);
require_once 'vendor/autoload.php';
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Protobuf\Internal\GPBUtil;
use Google\Cloud\Storage\StorageClient;

   // if ($_SERVER["REQUEST_METHOD"] == "POST")
   // {
     $records=array();
        // $video = $_FILES["video"]["tmp_name"];
        // $fname = $_FILES['video']['name'];
        // $lang=$_POST['video_language'];
        // $date=date("d-m-Y h:i sa");
        // $tm=time();
        // $extension = pathinfo($fname, PATHINFO_EXTENSION);
        // $filename=$tm.".".$extension;
        // $file = basename($fname,".".$extension);
        // $location = "video/".$filename;
        // $srt=$tm.".srt";$txt=$tm.".txt";
        //$audio="audio/".$tm.".mp3";
      //  $audiofname=$tm.".mp3";
    $audio="audio/t1.mp3";
     $audiofname="t1.mp3";
      //  audio\1646726894.mp3
    //     $trans ="srt/".$tm.".srt";
    //     $trans2="txt/".$tm.".txt";
    //     $logo=$tm.".jpg";
    //    $logo_loc="thumb/".$logo;
    //     $sql=mysqli_query($con,"INSERT INTO `tbl_add_videos`(`user_id`, `video`,`video_name`,`video_language`, `video_logo`, `video_srt`, `video_txt`, `video_out`, `video_status`, `created_at`, `updated_at`, `deleted_at`)
    //     VALUES ('$userId','$filename','$file','$lang','$logo','$srt','$audiofname','','0','$date','','')");
    //     $id=mysqli_insert_id($con);
    //     $ids=base64_encode($id);
		// //echo $ids;
    //    $cmd2="ffmpeg -i ".$video." -ss 00:00:02 -vframes 1 ".$logo_loc;
    //    $cmd="ffmpeg -i ".$video." -codec:a libmp3lame ".$audio;
    //     echo shell_exec($cmd);
    //     echo shell_exec($cmd2);
        // $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        // $file_extension = strtolower($file_extension);
        // move_uploaded_file($video,$location);
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
          $encoding = AudioEncoding::ENCODING_UNSPECIFIED;
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
        ->setEnableAutomaticPunctuation($a)
        ->setModel('video')
        ->setSampleRateHertz(16000)
        ->setAudioChannelCount(2);
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
        $transcript   = $mostLikely->getTranscript ();
        $confidence   = $mostLikely->getConfidence ();
        foreach ($mostLikely->getWords() as $wordInfo) {
          $i++;
            $wd= str_replace(['"',"'"], "", $wordInfo->getWord());
            $stime=GPBUtil::formatDuration($wordInfo->getStartTime());
            $endtime=GPBUtil::formatDuration($wordInfo->getEndTime());
            $st=round($stime/60,2);

          // mysqli_query($con,"INSERT INTO `subtitle`(`vid`, `vname`,`sl`, `st_sec`, `end_sec`, `start`, `end`, `text`) VALUES('$id','$srt','$i','$sec','$endsec','$st','$et','$data')");
           array_push($records,array("i"=>$i,
       		's'=>$st,
       		'e'=>$endtime,
       		't'=>trim($wd),
       		));
          }
        print_r($transcript);
        print_r($confidence);
        }
        $array= json_encode($records);

      //  $data=mysqli_real_escape_string($con,$array);
    //     $conn = mysqli_connect("localhost", "root", "", "gofeeds");
    //     $data=mysqli_real_escape_string($conn,$array);
    // mysqli_query($conn,"INSERT INTO `chapter`(`content`) VALUES ('$array')");
    //       print_r ($conn);
    //       print_r ($array);
    //      $sqid=mysqli_insert_id($conn);
        // echo $sqid.'--'.$abc;
        } else {
        print_r($operation->getError());
        }
        //echo $audioFile;
        $client->close();
    //}
?>
