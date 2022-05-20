<?php
include_once("global.php");
include_once("connect.php");
$baseurl=$Global['baseurl'];
//include_once('class.phpmailer.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('PHPMailer/src/PHPMailer.php');
require ('PHPMailer/src/Exception.php');
require ('PHPMailer/src/SMTP.php');
error_reporting(1);
function isLoginSessionExpired() {
	$login_session_duration = 14400;
	$current_time = time();
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION['aid'])){
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
			return true;
		}
	}	return false;
}
function checkIntrusion($aid){
	if(!isset($_SESSION['usrid'])){
		header("location:logout.php");
	}
}
function htmlToPlainText($str) {
		$str = str_replace('&nbsp;', ' ', $str);
		$str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT, 'UTF-8');
		$str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
		$str = html_entity_decode($str);
		$str = htmlspecialchars_decode($str);
		$str = strip_tags($str);

		return $str;
}
function checkAdminIntrusion($aid){
	if(!isset($_SESSION['aid'])){
		header("location:logout.php");
	}
}
##-----------------------Admin Function----------------------##

function getCompleteUserDetail(){
	global $con;$total=0;$draft=0;$complete=0;$jan=0;$feb=0;$mar=0;$apr=0;$may=0;$jun=0;$jul=0;$aug=0;$sep=0;$oct=0;$nov=0;$dec=0;
		$execQry=mysqli_query($con,"select * from `user` where is_deleted='0' ");
		$total=mysqli_num_rows($execQry);
		if($total>0){
		while($fetch=mysqli_fetch_array($execQry)){
			if($fetch['is_active']=='1') {
				$complete++;
			}else{
				$draft++;
			}
			$month=explode('-',$fetch['created_date']);
			if($month[1]=='01'){$jan++;}if($month[1]=='02'){$feb++;}if($month[1]=='03'){$mar++;}if($month[1]=='04'){$apr++;}
			if($month[1]=='05'){$may++;}if($month[1]=='06'){$jun++;}if($month[1]=='07'){$jul++;}if($month[1]=='08'){$aug++;}
			if($month[1]=='09'){$sep++;}if($month[1]=='10'){$oct++;}if($month[1]=='11'){$nov++;}if($month[1]=='12'){$dec++;}
		}
	}else{
		$total=0;$draft=0;$complete=0;
	}

	$grp=array($jan,$feb,$mar,$apr,$mat,$jun,$jul,$aug,$sep,$oct,$nov,$dec);
	$arr=array();
	$arr[0]=$total;
	$arr[1]=$draft;
	$arr[2]=$complete;
	$arr[3]=$grp;
		return $arr;
	}
	function getTotalAudioForAdmin(){
		global $con;
		$execQry=mysqli_num_rows(mysqli_query($con,"select * from `audio`  "));
		return $execQry;
	}
	function getTotalFeedForAdmin(){
		global $con;
		$execQry=mysqli_num_rows(mysqli_query($con,"select * from `feeds`"));
		return $execQry;
	}
	function getTotalChapterForAdmin(){
		global $con;
		$execQry=mysqli_num_rows(mysqli_query($con,"select * from `chapter`  "));
		return $execQry;
	}

	function getTotalBrandForAdmin(){
		global $con;
		$execQry=mysqli_num_rows(mysqli_query($con,"select * from `brand`  "));
		return $execQry;
	}
	function getTotalWorkspaceForAdmin(){
		global $con;
		$execQry=mysqli_num_rows(mysqli_query($con,"select * from `worksapce`  "));
		return $execQry;
	}
	function getTotalEarningForAdmin(){
		global $con;$total=0;$draft=0;$amount=0;
			$execQry=mysqli_query($con,"select * from `user` where is_deleted='0' and package!='0' ");
			$total=mysqli_num_rows($execQry);
			if($total>0){
			while($fetch=mysqli_fetch_array($execQry)){
				$amount+=getPackageAmountById($fetch['package'],$fetch['package_type']);
			}
		}else{
			$amount=0;
		}
		$arr=array();
			return $amount;
	}

function getUserDetails($uid){
	global $con;
	$execQry=mysqli_query($con,"select * from `user` where id='$uid' ");
	$qry=mysqli_fetch_array($execQry);
	return $qry;
}
function getAdminDetails($uid){
	global $con;
	$execQry=mysqli_query($con,"select * from `admin` where id='$uid' ");
	$qry=mysqli_fetch_array($execQry);
	return $qry;
}
function getTotalAudio($uid){
	global $con;
	$execQry=mysqli_num_rows(mysqli_query($con,"select * from `audio` where user_id='$uid' "));
	return $execQry;
}
function getDraftChapter($uid){
	global $con;
	$execQry=mysqli_num_rows(mysqli_query($con,"select * from `chapter` where status='0' and user_id='$uid' "));
	return $execQry;
}
function getCompleteChapterOfUser($uid){
	global $con;
	$execQry=mysqli_num_rows(mysqli_query($con,"select * from `chapter` where status='1' and user_id='$uid' "));
	return $execQry;
}
function getPackageNameById($id){
	global $con;
	$execQry=mysqli_fetch_row(mysqli_query($con,"select `name` from `package` where `id`='$id'  "));
	return $execQry[0];
}
function getPackageAmountById($id,$type){
	global $con;
	$execQry=mysqli_fetch_row(mysqli_query($con,"select `monthly`,`yearly` from `package` where `id`='$id'  "));
	if($type=='1'){
		return $execQry[1];
	}else{
	return $execQry[0];
	}
}
function getUserIds($uid){
	global $con;
	$ids=array();
	$execQry=mysqli_query($con,"select id from `user` where id='$uid' or created_by='$uid' ");
	// $total=mysqli_num_rows($execQry);
	// if($total>0){
	while($fetch=mysqli_fetch_array($execQry)){
		$ids[]=$fetch['id'];
	}

//}
	return $ids;
}
function getFeedOfUser($uid){
	global $con;$total=0;$draft=0;$complete=0;
	$ids=getUserIds($uid);
	$execQry=mysqli_query($con,"select * from `feeds` where user_id in (".implode(',',$ids).") ");
	$total=mysqli_num_rows($execQry);
	if($total>0){
	while($fetch=mysqli_fetch_array($execQry)){
		if($fetch['status']=='1') {
			$complete++;
		}else{
			$draft++;
		}
	}
}else{
	$total=0;$draft=0;$complete=0;
}
$arr=array();
$arr[0]=$total;
$arr[1]=$draft;
$arr[2]=$complete;
	return $arr;
}

function getChapterOfUser($uid){
	global $con;$total=0;$draft=0;$complete=0;
	$execQry=mysqli_query($con,"select * from `chapter` where user_id='$uid' ");
	$total=mysqli_num_rows($execQry);
	if($total>0){
	while($fetch=mysqli_fetch_array($execQry)){
		if($fetch['status']=='1') {
			$complete++;
		}else{
			$draft++;
		}
	}
}else{
	$total=0;$draft=0;$complete=0;
}
$arr=array();
$arr[0]=$total;
$arr[1]=$draft;
$arr[2]=$complete;
	return $arr;
}

function getWorkspaceUserById($uid){
	global $con;
	$qry=mysqli_query($con,"select `id` from `user` where `wid`='$uid'");
	$num=mysqli_num_rows($qry);
	return $num;
}
function getWorkspaceByUserId($uid){
	global $con;
	$qry=mysqli_query($con,"select * from `worksapce` where `user_id`='$uid'");
	$num=mysqli_num_rows($qry);
	return $num;
}
function getWorkspaceDetailsById($uid){
	global $con;
	$qry=mysqli_query($con,"select * from `worksapce` where `user_id`='$uid'");
	$num=mysqli_fetch_row($qry);
	return $num;
}
function getBrandsByUserId($uid){
	global $con;
	$qry=mysqli_query($con,"select * from `brand` where `user_id`='$uid'");
	$num=mysqli_num_rows($qry);
	return $num;
}

function getSubscriptionIdByUserId($uid){
	global $con;
	$qry=mysqli_fetch_row(mysqli_query($con,"select `price_id` from `user` where `id`='$uid'"));
	return $qry[0];
}
function getSubscriptionVideoByUser($uid){
	global $con;
	$pid=getSubscriptionIdByUserId($uid);
	$execQry=mysqli_fetch_row(mysqli_query($con,"select video from `pricing` where `id`='$pid'"));
		return $execQry[0];
}
function getMenuIdByUrl($url){
	global $con;

	$menuArr=getMenuSubCategoryDetailByUrl($url);
	$subCategoryName=$menuArr[2];
	$categoryId=$menuArr[1];
	return $categoryId;
}
function getSiteTitle(){
	global $con;
	$sqlQry=mysqli_query($con,"select `site_name` from `websiteheader` ");
	$fetchQry=mysqli_fetch_row($sqlQry);
	echo stripslashes($fetchQry[0]);
}
function getProjectLogo(){
	global $con;
	$sqlQry=mysqli_query($con,"select `site_logo` from `websiteheader`");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
function limitContent($title,$value){
if(strlen($title)>$value){
	$content=substr($title,0,$value);
}else{
     $content=$title;
}
return $content;
}
function getAdminEmail($id){
	global $con;
	$sqlQry=mysqli_query($con,"select `email` from `user` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getUserName($id){
	global $con;
	$sqlQry=mysqli_query($con,"select `name` from `user` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getAdminName($id){
	global $con;
	$sqlQry=mysqli_query($con,"select `Name` from `admin` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getUserImage($id){
	global $con;
	$sqlQry=mysqli_query($con,"select `profile_photo_path` from `user` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
// function getPackageNameById($id){
// 	global $con;
// 	$sqlQry=mysqli_query($con,"select name from `package` where `id`='$id'");
// 	$fetchQry=mysqli_fetch_row($sqlQry);
// 	return $fetchQry[0];
// }
function getSubscriptionDetailsById($id){
	global $con;
	$sqlQry=mysqli_query($con,"select * from `package` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry;
}
function checkUrl($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_url` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function checkQuote($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_quote` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function checkHighlightTxt($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_highlight` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function checkDefination($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_defination` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function checkImage($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_image` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function checkProfile($id,$cid){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `feed_profile` where `content_id`='$id' and chapter_id='$cid'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function getAllChapterOfFeedByUser($uid,$fid){
	global $con;
	$qry=mysqli_query($con,"select * from chapter where user_id='$uid' and feed_id='$fid'");
	$fetch=mysqli_num_rows($qry);
	return $fetch;
}
function checkEmailofUser($email){
	global $con;
	$qry=mysqli_query($con,"select id from user where email_id='$email'");
	$fetch=mysqli_num_rows($qry);
	return $fetch;
}
function getUserTypeById($id){
	global $con;
	$qry=mysqli_query($con,"select user_type from user where id='$id'");
	$fetch=mysqli_fetch_row($qry);
	return $fetch;
}
function sendFeedBackMail($name,$email,$contact,$message,$baseurl){
	global $con;
$to="sagarallahabad@gmail.com";
$date=date("Y-m-d");
$cemail="thefootballlink.com";
$sub="A New Enquiry  has been received !";
$msg='<head>
	<title>New mail</title>
	<style>
	.mailcontent{
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		padding:5px;
		text-align:justify;
	}
	.verysmalltextblack{
		color:#2C2C2C;
		text-decoration:none;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
		font-weight:bold;
	}
	</style>
	</head>

<body>
<table width="100%" style="border:solid 1px #666666" cellpadding="10" cellspacing="0" bgcolor="#F0F0F0" >
  <tr  valign="top" bgcolor="#FFFFFF" >
    <td align="left" colspan="2"  valign="middle"><img src="'.$baseurl.'/images/logo.png" alt="TFL " > </td>
  </tr>
    <tr>
			<td class="mailcontent"><strong>Name  :</strong></td>
			<td class="verysmalltextblack">'.$name.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Mail :</strong></td>
				<td class="verysmalltextblack">'.$email.'</td>
			 </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Contact No :</strong></td>
               <td class="verysmalltextblack">'.$contact.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Message :</strong></td>
              <td class="verysmalltextblack">'.$message.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>

              </tr>
              <tr>
                <td class="mailcontent"><strong>Posted On:</strong></td>
              <td class="verysmalltextblack">'.$date.'</font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>


</table><body><html>';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$mail=@mail($to,$sub,$msg,$headers);
	if($mail){
		return true;
	}else{
		return false;
	}


}
function getPackageStatus($value){
	if($value==1){
		return '<span class="badge badge-pill badge-success">Active</span>';
	}
	if($value==0){
		return '<span class="badge badge-pill badge-warning">Block</span>';
	}
}
function getFeedStatus($value){
	if($value==1){
		return '<span class="badge badge-pill badge-success">Published</span>';
	}
	if($value==0){
		return '<span class="badge badge-pill badge-warning">In Draft</span>';
	}
}
function getChapterStatus($value){
	if($value==1){
		return '<span class="badge badge-pill badge-success"> Published</span>';
	}
	if($value==0){
		return '<span class="badge badge-pill badge-warning">In Draft</span>';
	}
}

function getStatus($value){
	if($value==1){
		return '<span class="badge rounded-pill bg-success"> Published</span>';
	}
	if($value==0){
		return '<span class="badge rounded-pill bg-warning">In Draft</span>';
	}
}
function getAudioType($value){
	if($value==1){
		return '<span class="badge rounded-pill bg-info">Upload</span>';
	}
	if($value==2){
		return '<span class="badge rounded-pill bg-warning">App</span>';
	}
	if($value==3){
		return '<span class="badge rounded-pill bg-primary">Browser</span>';
	}
	if($value==4){
		return '<span class="badge rounded-pill bg-danger">Blog</span>';
	}
	if($value==5){
		return '<span class="badge rounded-pill bg-success">Script</span>';
	}
}

function getuserStatus($value){
	if($value==1){
		return '<span class="badge badge-pill badge-success">Active</span>';
	}
	if($value==0){
		return '<span class="badge badge-pill badge-warning">Block</span>';
	}
	if($value==2){
		return '<span class="label label-danger">Dele</span>';
	}
	if($value==4){
		return '<span class="label label-info">Form Enter</span>';
	}
}
function getLastUpdate($table,$id){
	global $con;
	$execQry=mysqli_query($con,"select date from $table where `id`='$id'  ");
	$fetchRes=mysqli_fetch_row($execQry);
	return $fetchRes[0];
}
function getFirstSubtitleId($vid){
	global $con;
	$subqry=mysqli_query($con,"select * from `subtitle` where vid=$vid");
  $sub=mysqli_fetch_array($subqry);
      $id= '#'.$sub['id'].'_'.$sub['st_sec'];
	return $id;

}
function getNumberOfRecords($table){
	global $con;
	$execQry=mysqli_query($con,"select count(*) from $table where `status`='1'  ");
	$fetchRes=mysqli_fetch_row($execQry);
	return $fetchRes[0];
}

function resize_both($oldname,$width,$height,$padding='0')
{
  $imgName=$width."_".$height."_".$oldname;
  $newname = "thumb/". $imgName;
  if(!file_exists($newname)){
  $imgpath=$width."_".$height."_".$oldname;
  $thumbh = $height;
  $thumbw = $width;
  $nh = $thumbh;
  $nw = $thumbw;
  $size = getImageSize("photos/".$oldname);
  $w = $size[0];
  $h = $size[1];
  $img_type  = $size[2];
  // Applying calculations to dimensions of the image
  $ratio = $h / $w;
  $nratio = $nh / $nw;

  if($ratio > $nratio)
  {
    $x = intval($w * $nh / $h);
    if ($x < $nw)
    {
      $nh = intval($h * $nw / $w);
    }
    else
    {
      $nw = $x;
    }
  }
  else
  {
    $x = intval($h * $nw / $w);
    if ($x < $nh)
    {
      $nw = intval($w * $nh / $h);
    }
    else
    {
      $nh = $x;
    }
  }
 switch($img_type) {
          case '1':
          $resimage = imagecreatefromgif("photos/".$oldname);
          break;
          case '2':
          $resimage = imagecreatefromjpeg("photos/".$oldname);
          break;
          case '3':
          $resimage = imagecreatefrompng("photos/".$oldname);
          break;
      }
//  $resimage = imagecreatefromjpeg($oldname);
	$newimage = imagecreatetruecolor($nw, $nh);  // use alternate function if not installed
	$white = imagecolorallocate($newimage, 255, 255, 255);
	imagefill($newimage,0,0,$white);
	imagecopyresampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);
	$viewimage = imagecreatetruecolor($thumbw, $thumbh);
	imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);
	imagejpeg($viewimage, $newname, 85);
	if($padding==1)
	{
		return "<img src='thumb/$imgpath' style='padding:0px 10px 5px 0px ;'  align='left'  >";
	}else{
		return "<img src='thumb/$imgpath'  align='left'   >";
	}
	}else{
		if($padding==1)
		{
			return "<img src='$newname'  style='padding:0px 10px 5px 0px;' align='left'   >";
		}else{
			return "<img src='$newname'   align='left'   >";

		}
	}

}

function sendWelcomeMail($to,$from,$fromname,$subject,$msg,$Attech,$cardbenefits,$hotel,$prog_id){
		$uid=getUsernameAndPwdForEmail($prog_id);
		$uname=$uid[0];
		$upwd=$uid[1];
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		if($prog_id =='22' || $prog_id =='24' || $prog_id =='26' || $prog_id =='29' || $prog_id =='32' || $prog_id =='35'|| $prog_id =='33')
		{
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		}
		else{
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		}
		$mail->Username = $uname;                 // SMTP username
		$mail->Password = $upwd;                         // SMTP password

		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		//$mail->AddAttachment($Attech);
		//$mail->AddAttachment($cardbenefits);
		$mail=$mail->Send();
}
function sendBasicMail($to,$from,$fromname,$subject,$msg,$Attech,$cardbenefits,$prog_id){
		$uid=getUsernameAndPwdForEmail($prog_id);
		$uname=$uid[0];
		$upwd=$uid[1];
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		if($prog_id =='22' || $prog_id =='24' || $prog_id =='26' || $prog_id =='29' || $prog_id =='32' || $prog_id =='35'|| $prog_id =='33')
		{
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		}
		else{
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		}
		$mail->Username = $uname;                 // SMTP username
		$mail->Password = $upwd;                         // SMTP password
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From = $from;
		$mail->FromName=$fromname;
		$mail->AddAddress($to);
		$mail->Subject= $subject;
		$mail->Body= $msg;
		$mail->AddAttachment($Attech);
		$mail->AddAttachment($cardbenefits);
		$mail=$mail->Send();
}
function sendRenewalFormatMail($to,$from,$fromname,$subject,$msg,$prog_id){

	$uid=getUsernameAndPwdForEmail($prog_id);
		$uname=$uid[0];
		$upwd=$uid[1];
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		if($prog_id =='22' || $prog_id =='24' || $prog_id =='26' || $prog_id =='29' || $prog_id =='32' || $prog_id =='35'|| $prog_id =='33')
		{
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		}
		else{
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		}
		$mail->Username = $uname;                 // SMTP username
		$mail->Password = $upwd;                         // SMTP password

		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		/*if($mail){
		return true;
		}else{
		return false;
		}*/
}
function sendSecurityAlertMail($msg){
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;    // SMTP password
		$mail->Username = 'contactus@rezervedindia.in';                 // SMTP username
		$mail->Password = 'pms@1234';
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From ="info.privilegemember@gmail.com";
		$mail->FromName ="Privilege Member";
		$mail->AddAddress("it@coiclub.in");
		$mail->Subject ="Security Alert";
		$mail->Body = $msg;
			$maill=$mail->Send();
		if($maill){
		return true;
		}else{
		return false;
		}
}
function sendRoomReservationMail($to,$from,$fromname,$subject,$msg){
	$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->IsHTML(true);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->SMTPAuth = false;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendRoomMail($to,$from,$fromname,$subject,$msg,$cc,$bcc,$prog_id){
		$uid=getUsernameAndPwdForEmail($prog_id);
		$uname=$uid[0];
		$upwd=$uid[1];
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		if($prog_id =='22' || $prog_id =='24' || $prog_id =='26' || $prog_id =='29' || $prog_id =='32' || $prog_id =='35')	{
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		}
		else{
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		}// Specify main and backup SMTP servers
		                             // Enable SMTP authentication
		$mail->Username = $uname;                 // SMTP username
		$mail->Password = $upwd;                         // SMTP password
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$array =explode(',',$to);
		foreach($array as $email) {
		$mail->AddAddress($email);
		}
		if ($cc!=''){
		$ccarray =explode(',',$cc);
		foreach($ccarray as $ccemail) {
		$mail->AddCC($ccemail);
		}
		}
		if ($bcc!=''){
		$bccarray =explode(',',$bcc);
		foreach($bccarray as $bccemail) {
		$mail->AddBCC($bccemail);
		}
		}
		//$mail->AddCC('sanjeev.7836kumar@gmail.com');
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendGenralQueryMail($to,$from,$fromname,$subject,$msg){
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP

		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
                         // SMTP password
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From =$from;
		$mail->Username = $from;                 // SMTP username
		$mail->Password = 'pms@1234$';
		$mail->FromName =$fromname;
		$array =explode(',',$to);
		foreach($array as $email) {
		$mail->AddAddress($email);
		}
		//$mail->AddCC('sanjeev.7836kumar@gmail.com');
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendSocialLinkMail($to,$from,$fromname,$subject,$msg,$prog_id){
	$uid=getUsernameAndPwdForEmail($prog_id);
		$uname=$uid[0];
		$upwd=$uid[1];
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		if($prog_id =='22' || $prog_id =='24' || $prog_id =='26' || $prog_id =='29' || $prog_id =='32' || $prog_id =='35')	{
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		}
		else{
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		}		// Specify main and backup SMTP servers
		                             // Enable SMTP authentication
		$mail->Username = $uname;                 // SMTP username
		$mail->Password = $upwd;
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendBDMail($to,$cc,$subject,$msg){
	$Attech='The Choice of India.pptx';
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP

		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		$mail->Username = 'info@coiclub.com';                 // SMTP username
		$mail->Password = 'zsyxrehmbfrlpllh';
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From ='info@coiclub.com';
		$mail->FromName ='The Choice Of India';
		$array =explode(',',$to);
		foreach($array as $email){
		$mail->AddAddress($email);
		}
		if ($cc!=''){
		$ccarray =explode(',',$cc);
		foreach($ccarray as $ccemail) {
		$mail->AddCC($ccemail);
		}
		}
		$mail->AddAttachment($Attech);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendGOVGOBDMail($to,$cc,$subject,$msg){
	//$Attech='The Choice of India.pptx';
		$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer(true);
		$mail->IsHTML(true);
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPAuth = true;  		// Set mailer to use SMTP
		$mail->SMTPSecure = 'non ssl';
		$mail->Host = "mail.rezervedindia.in";
		$mail->Port = 25;
		$mail->Username = 'info@govgo.co.in';                 // SMTP username
		$mail->Password = 'Pms@1234';
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
		)
		);
		$mail->From ='info@govgo.co.in';
		$mail->FromName ='Go-V-Go';
		$array =explode(',',$to);
		foreach($array as $email){
		$mail->AddAddress($email);
		}
		if ($cc!=''){
		$ccarray =explode(',',$cc);
		foreach($ccarray as $ccemail) {
		$mail->AddCC($ccemail);
		}
		}
		//$mail->AddAttachment($Attech);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function sendSmtpMail2($to,$from,$fromname,$subject,$msg){

	$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP

		$mail->IsHTML(true);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';  // specify main and backup server
		$mail->Username = 'jayshreekumari1992@gmail.com';  // SMTP username
		$mail->Password = 'fb$rtq9694'; // SMTP password
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}
function compressImage($source_image, $compress_image) {
$image_info = getimagesize($source_image);
if ($image_info['mime'] == 'image/jpeg') {
$source_image = imagecreatefromjpeg($source_image);
imagejpeg($source_image, $compress_image, 75);
} elseif ($image_info['mime'] == 'image/gif') {
$source_image = imagecreatefromgif($source_image);
imagegif($source_image, $compress_image, 75);
} elseif ($image_info['mime'] == 'image/png') {
$source_image = imagecreatefrompng($source_image);
imagepng($source_image, $compress_image, 6);
}
elseif ($image_info['mime'] == 'image/svg') {
$source_image = imagecreatefrompng($source_image);
imagepng($source_image, $compress_image, 6);
}
elseif ($image_info['mime'] == 'image/ico') {
$source_image = imagecreatefrompng($source_image);
imagepng($source_image, $compress_image, 4);
}
return $compress_image;
}
function getPageNameById($id){
	global $con;
	$sqlQry=mysqli_query($con,"select `name` from `websitepage` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getTotalPage(){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `websitepage` ");
	$fetchQry=mysqli_num_rows($sqlQry);
	$res=$fetchQry+2;
	return $res;
}
function getCheckPageContentById($id){
	global $con;
	$sqlQry=mysqli_query($con,"select id from `websitepagecontent` where `pid`='$id'");
	$fetchQry=mysqli_num_rows($sqlQry);
	return $fetchQry;
}
function getNextPosition(){
	global $con;
	$sqlQry=mysqli_query($con,"select max(position) from `websitepage` ");
	$fetchQry=mysqli_fetch_row($sqlQry);
	$id=$fetchQry[0]+1;
	return $id;
}
function getContentNextPosition($id){
	global $con;
	$sqlQry=mysqli_query($con,"select max(position) from `websitepagecontent` where pid='$id' ");
	$fetchQry=mysqli_fetch_row($sqlQry);
	$id=$fetchQry[0];
	return $id;
}
function getThemePosition($id){
	global $con;
	if ($id==1) {
		$thm='Theme One';// code...
	}
	if ($id==2) {
		$thm='Theme Two';// code...
	}
	if ($id==3) {
		$thm='Theme Three';// code...
	}
	return $thm;
}
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getFeedBrand($id) {
global $con;
	$sqlQry=mysqli_query($con,"select * from `brand` where id='$id'  ");
	$num=mysqli_fetch_row($sqlQry);
	return $num;
}
function timeAgo($time_ago) {
		$time_ago = strtotime($time_ago);
		$cur_time = time();
		$time_elapsed = $cur_time - $time_ago;
		$seconds = $time_elapsed;
		$minutes = round($time_elapsed / 60);
		$hours = round($time_elapsed / 3600);
		$days = round($time_elapsed / 86400);
		$weeks = round($time_elapsed / 604800);
		$months = round($time_elapsed / 2600640);
		$years = round($time_elapsed / 31207680);
		// Seconds
		if ($seconds <= 60) {
				return "just now";
		}
		//Minutes
		else if ($minutes <= 60) {
				if ($minutes == 1) {
						return "one minute ago";
				} else {
						return "$minutes minutes ago";
				}
		}
		//Hours
		else if ($hours <= 24) {
				if ($hours == 1) {
						return "an hour ago";
				} else {
						return "$hours hrs ago";
				}
		}
		//Days
		else if ($days <= 7) {
				if ($days == 1) {
						return "yesterday";
				} else {
						return "$days days ago";
				}
		}
		//Weeks
		else if ($weeks <= 4.3) {
				if ($weeks == 1) {
						return "a week ago";
				} else {
						return "$weeks weeks ago";
				}
		}
		//Months
		else if ($months <= 12) {
				if ($months == 1) {
						return "a month ago";
				} else {
						return "$months months ago";
				}
		}
		//Years
		else {
				if ($years == 1) {
						return "one year ago";
				} else {
						return "$years years ago";
				}
		}
}
?>
