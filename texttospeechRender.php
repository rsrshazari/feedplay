<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
require_once 'vendor/autoload.php';
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $date=date("Y-d-m");
      $text1=$_POST['text'];
      $lang=$_POST['language'];
      $voice=$_POST['voice'];
      $type=$_POST['type'];
      $cpid=$_POST['cpid'];
      $output=time().".mp3";
      $time=date('h:m:sa');
      $loc='audio/'.$output;
      $sql=mysqli_query($con,"INSERT INTO `texttospeech`( `language`, `lang`, `voice`, `text`,`audio`,`embed` ,`date`, `user_id`, `status`)
      VALUES ('$lang','$lang','$voice','$text1','$output','$output','$date','$userId','1')");
      $sql2=mysqli_query($con,"INSERT INTO `audio`( `file`, `name`, `duration`, `user_id`,`type`, `date`, `time`, `status`)
       VALUES ('$output','$output','','$userId','$type','$date','$time','1')");
          try {
    /** Uncomment and populate these variables in your code */
    $text = $text1;
        // create client object
    $client = new TextToSpeechClient();
      putenv('GOOGLE_APPLICATION_CREDENTIALS=gofeeds-6c072988373d.json');
    $input_text = (new SynthesisInput())
        ->setText($text);
    //$lang="hi-IN";
    if($voice=='MALE'){
        $gender=SsmlVoiceGender::MALE;
    }else{
        $gender=SsmlVoiceGender::FEMALE;
    }

    // note: the voice can also be specified by name
    // names of voices can be retrieved with $client->listVoices()
    $voice = (new VoiceSelectionParams())
        ->setLanguageCode($lang)
        ->setSsmlGender($gender);

    $audioConfig = (new AudioConfig())
        ->setAudioEncoding(AudioEncoding::LINEAR16);
    $response = $client->synthesizeSpeech($input_text, $voice, $audioConfig);
    $audioContent = $response->getAudioContent();
    file_put_contents($loc, $audioContent);
    $client->close();
    } catch(Exception $e) {
        echo $e->getMessage();
    }
echo $cpid;
}
?>
