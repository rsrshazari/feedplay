<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
if(isset($_GET['fid'])&&$_GET['fid']!=''){
	$fid=base64_decode($_GET['fid']);
	$feedData=mysqli_fetch_array(mysqli_query($con,"select * from feeds where id=$fid"));
}
if (isset($_GET['cpid'])&&$_GET['cpid']!='') {
  $cid=base64_decode($_GET['cpid']);
  $qry=mysqli_query($con,"SELECT chapter.name,feeds.name,chapter.id,feeds.id FROM chapter  INNER JOIN feeds  on feeds.id=chapter.feed_id where chapter.id=$cid");
	$num=mysqli_num_rows($qry);
	$fetchRow=mysqli_fetch_row($qry);
}
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$cpid=$_GET['cid'];
$pid=base64_decode($did);
$delQry=mysqli_query($con,"delete from `audio` where `id`='$pid'");
if($delQry){
header("location:create-feed.php?msg=dls&cpid=$cpid");
}else{
header("location:create-feed.php?msg=err&cpid=$cpid");
}
}
if(isset($_GET['msg'])&&$_GET['msg']!=''){
	$msg=$_GET['msg'];
	if($msg=='ins'){
    $class="success";
		$msgText='<strong>SUCCESS</strong> : Data has been saved successfull!!! ';
	}elseif($msg=='err'){
		$msgText='<strong> ERROR </strong>: Oopss something goes wrong!!! ';
    $class="danger";
	}elseif ($msg=='dls') {
    $class="success";
    $msgText='<strong> SUCCESS </strong>: Data deleted successfull!!! ';
  }
  elseif ($msg=='upd') {
    $class="success";
    $msgText='<strong> SUCCESS </strong>: Data updated successfull!!! ';
  }
	elseif($msg=='na'){
		$msgText="This IP address is not allowed";
	}else{
		$msgText='';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feed Play Create Feed </title>
<?php include 'include/css.php' ?>


<script src="https://www.webrtc-experiment.com/RecordRTC.js"></script>
	<script src="https://www.webrtc-experiment.com/gif-recorder.js"></script>
	<script src="https://www.webrtc-experiment.com/getScreenId.js"></script>
	<script src="https://www.webrtc-experiment.com/DetectRTC.js"> </script>

	<!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
	<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0"><?= $fetchRow[1]?></h6>
					<input type="hidden" id="hidFeedId" name="hidFeedId" value="<?=$fetchRow[3]?>">
					<input type="hidden" id="hidChapId" name="hidChapId" value="<?=$_GET['cpid']?>">
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <?php if(isset($_GET['msg'])) {?>
   <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert">

<?=$msgText?></span>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php }?>
      <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row gx-4">
          <div class="col-auto">
            <!-- <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div> -->
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= $fetchRow[0]?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                Add chapter Through upload,record and create audio form script
              </p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center active" data-bs-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-selected="true">
                    <i class="fa-solid fa-upload"></i>
                    <span class="ms-2">Upload Audio</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center" data-bs-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-selected="false">
                    <i class="fa-solid fa-microphone-lines "></i>
                    <span class="ms-2">Record Audio</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center" data-bs-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-selected="false">
                    <i class="fa-solid fa-edit"></i>
                    <span class="ms-2">Create Audio</span>
                  </a>
                </li>
            </ul>
            </div>

          </div>
        </div>
          <div class="dropdown-divider"></div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
              <div class="row mt-5">
                <div class="col-md-8 ml-auto mr-auto">
              <form class="formValidate"  method="post" enctype="multipart/form-data" name="audioForm" id="audioForm">
								 <input type="hidden" id="cpid" name="cpid" value="<?=$_GET['cpid']?>">
                <div class="row text-center mt-2">
                    <div class="media-body">
                      <div class="general-action-btn">
                        <label id="select-files" class="btn indigo mr-2">
                          <span>Upload new audio</span>
                          <input id="upfile" name="upfile" type="file" style="display:none" />
                        </label>
                      </div>
                      <small>Allowed mp3 file only. Max size of 5MB and 5min audio only</small>

                      <div id="progress-div"><div id="progress-bar"></div></div>
                      <div id="targetLayer"></div>
                      <div id="trans" style="color:#cb0c9f;font-weight:bold"></div>
                      <div id="loader-icon" style="text-align:center;display:none" ><img  src="loder.gif" Height="100" /></div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
              <div class="row mt-5">
                <div class="col-md-8 ml-auto mr-auto">
                        <form class="paaswordvalidate">
                        <div class="row">
                          <div class="col-md-6 col-xl-6 col-sm-12">
                            <div class="text-center" data-bs-toggle="modal" data-bs-target="#RecordApp" style="cursor:pointer">
                              <img style="width:100px" src="assets1/img/phone.png"></div>
                              <p class="text-center">Record on Mobile</p>
                            </div>
                            <div class="col-md-6 col-xl-6 col-sm-12">
                              <div class="text-center" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#BrowserApp" style="cursor:pointer">
																<img src="assets1/img/web.png" style="width:100px"></div>
                              	<p class="text-center">Record in Browser</p>
                            </div>
                          </div>

                        </form>
                      </div>
                </div>
              </div>
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
              <div class="row mt-5">
                <div class="col-md-8 ml-auto mr-auto">
                    <form class="paaswordvalidate">
                      <div class="row">
                      <div class="col-md-6 col-xl-6 col-sm-12">
                         <div class="text-center " data-bs-toggle="modal" data-bs-target="#blogModal" style="cursor:pointer"><img style="width:100px" src="assets1/img/blog.png"></div>
                         <p class="text-center">Get your script from URL</p>
                        </div>
                        <div class="col-md-6 col-xl-6 col-sm-12">
                         <div class="text-center" data-bs-toggle="modal" data-bs-target="#scriptModal" style="cursor:pointer"><img style="width:100px" src="assets1/img/script.png"></div>
                         <p class="text-center">Write your script</p>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
      <div class="row mt-4">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Audio</h5>
            </div>
            <div class="card-body p-3 ">
              <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl.No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Audio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $qry=mysqli_query($con,"select * from audio where user_id='$userId' order by id desc");
                        $sl=0;
                        $num_rows=mysqli_num_rows($qry);
                        if($num_rows>0) {
                        while ($fetch=mysqli_fetch_array($qry)) {
                        $sl++;
                       ?>
                      <tr>
                        <td class="align-middle text-center text-sm" ><?= $sl?></td>
                        <td class="align-middle text-center text-sm">
                          <div class="d-flex px-2 py-1 pl-6">
                            <div class="iconDiv">
                              <span id="aplay<?= $fetch['id']?>" onclick="audio_hit('<?= $fetch['id']?>')" style="cursor:pointer"><i class="ni ni-button-play iconBtn"></i></span>
                              <span id="apause<?= $fetch['id']?>" onclick="audio_hit2('<?= $fetch['id']?>')" style="display:none;cursor:pointer" ><i class="ni ni-button-pause iconBtn"></i></span>
                              <audio id="amp<?= $fetch['id']?>" style="display:none;" preload="auto" loop="false" class="w-100" controls><source src="audio/<?= $fetch['file']?>" type="audio/mp3"></audio>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 ml-2 text-sm pl-5">    <?= $fetch['name']?></h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?= getAudioType($fetch['type'])?>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?= date('M d, Y', strtotime($fetch['date'])) ?></span>
                        </td>
                        <td class="align-middle text-center text-sm">
  											<span id="<?=$fetch['id']?>" onclick="linkcontent(this.id)" data-bs-toggle="modal" data-bs-target="#linkPop" class="collection-item"><span class="badge badge-sm bg-gradient-success shadow" style="cursor:pointer">Link Content</span></span>
  											<a href="create-feed.php?did=<?=base64_encode($fetch['id'])?>&cid=<?=$_GET['cpid']?>" onClick="return confirm(' Are you sure you want to delete !!')"><span class="badge badge-sm bg-gradient-danger" >Delete</span></a>
              					</td>
                      </tr>
                    <?php }}else{  ?>
                    <tr><td colspan="5" align="center">--No audio found--</td></tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div id="RecordApp" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
		   <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		      <div class="modal-content">
		          <div class="modal-header">
		              <h6 class="modal-title" id="modal-title-default">Record Audio From App</h6>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">×</span>
		              </button>
		          </div>
		          <div class="modal-body text-center">
		          <h5>  Get the Fee Play  app</h5>
							<p>We've made it easy for you to record, edit, and seamlessly upload high quality audio right from your phone.</p>
							<p>Simply point your camera at the QR code to download feedplay app.</p>
							<img class="avatar avatar-xxl shadow" src="assets1/img/app/feedplay.png" alt="">
		          </div>
		      </div>
		  </div>
		</div>
<div id="BrowserApp" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h6 class="modal-title" id="modal-title-default">Record Audio From Browser</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
						</button>
				</div>
				<div class="modal-body text-center">
					<h5>Get ready to record up to 5 minutes of audio!</h5>
		<p>Recording in your browser is simple—just allow access your system microphone when prompted. If you’re feeling tongue-tied!</p>
				<section class="experiment recordrtc">
			<h2 class="header">
				<input class="recording-media" type="hidden" name="" value="record-audio">
				<input class="media-container-format" type="hidden" name="" value="WebM">
					<!-- <select class="recording-media">
							<option value="record-video">Video</option>
							<option value="record-audio">Audio</option>
							<option value="record-screen">Screen</option>
					</select>
					into
					<select class="media-container-format">
							<option>WebM</option>
							<option disabled>Mp4</option>
							<option disabled>WAV</option>
							<option disabled>Ogg</option>
							<option>Gif</option>
					</select> -->
					<button class="btn btn-primary">Start Recording</button>
			</h2>
			<div style="text-align: center; display: none;">
					<button class="btn btn-sm bg-gradient-warning" id="save-to-disk">Save To Disk</button>
					<button class="btn btn-sm bg-gradient-info" id="open-new-tab">Open New Tab</button>
					<button class="btn btn-sm bg-gradient-success" id="upload-to-server">Upload To Server</button>
			</div>
			<br>
			<video controls playsinline autoplay muted=false volume=1></video>
	</section>
				</div>
		</div>
</div>
</div>
<div id="linkPop" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h6 class="modal-title" id="modal-title-default">Audio Transcribing</h6>

				</div>
				<div class="modal-body text-center">
				<h5>  Audio Transcribing</h5>
				<p>Hold tight! Your audio is now transcribing. This should
                        take about few minute.</p>

				<div class="loderDiv">
						<div id="loader-icon" style="text-align:center;" ><img src="assets1/img/loder.gif" Height="100" /></div>
				</div>
				</div>
		</div>
</div>
</div>
<div id="blogModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Create Audio From BLog</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
          <form class="" action="texttospeech.php" method="post">
						<input type="hidden" id="type" name="type" value="5">
						 <input type="hidden" id="cpid" name="cpid" value="<?=$_GET['cpid']?>">
        <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <label class="form-label">Blog URL</label>
                <div class="input-group">
                  <input id="blogUrl" name="blogUrl" class="form-control"  type="text" placeholder="https://blog.com/apps/" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="workspace" class="btn bg-gradient-primary btn-sm">Next</button>
        </div>
         </form>
    </div>
</div>
</div>
<div id="scriptModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Create You Audio Form Script</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form class="" name="texttospeechForm" id="texttospeechForm" action="" method="post">
						  <input type="hidden" id="type" name="type" value="5">
							 <input type="hidden" id="cpid" name="cpid" value="<?=$_GET['cpid']?>">

    <div class="row" id="formDiv">
            <div class="col-md-8">
              <div class="paste-below">
                  <div class="paste-text">
                      <textarea max="200000000000" class="form-control" cols="75" id="text" name="text" style="height:300px;"></textarea>
                  </div>
                  <div class="counts" style="display:flex">
                      <small style="width:70%"> Character count: <span id="cc"></span> /limit 200000000000 characters</small>
                      <small style="width:30%;text-align:right;margin-right: 20px">  Words Count <span id="wc"></sapn></small>
                  </div>
              </div>
            </div>
                <div class="col-md-4 ">
                  <div class="" >
                    <div class="form-group">
                                      <label>Language</label>
                                           <select class="form-control" name="language" id="language" is="ms-dropdown" data-child-height="315">
                                              <?php $langQry=mysqli_query($con,"select * from country_language_code where status='1'") ;
                                              while ($langAry=mysqli_fetch_array($langQry)) {
                                                  $langName=$langAry['language'].' ,'.$langAry['country'];
                                                ?>
                                                <option value='<?= $langAry['code']?>' data-image-css="flag <?= $langAry['flag']?>" data-title="<?= $langName?>"><?= $langName?></option>
                                            <?php  }
                                              ?>
                          </select>
                   </div>
                   <div class="form-group">
                     <label for="">Voice</label>
                     <select class="form-control" id="voice" name="voice">
                       <option value="">Select Voice</option>
                       <option value="male" data-icon="widgets">Male</option>
                       <option value="female" data-icon="widgets">Female</option>
                     </select>
                   </div>
                   <div class="form-group ">
                       <button class="btn btn-primary w-100" name="generateBtn"id="generateBtn" type="submit">
                         <i class="ni ni-note-03"></i><span class="ms-2">Generate Audio</span></button>
                   </div>
                  </div>
                </div>
            </div>
            <div class="loderDiv">
                <div id="loader-div-icon" style="text-align:center;display:none" ><img src="assets1/img/loder.gif" Height="100" /></div>
            </div>
          </form>
        </div>
    </div>
</div>
</div>
<?php include 'include/script.php' ?>
<script type="text/javascript">
$('#text').keyup(function(){
var max=20000000;
var wordCount = $(this).val().split(/[\s\.\?]+/).length;
var len = $(this).val().length;
if(len>max){
 alert('Your Cross max charater limit');
}
$('#wc').html(wordCount);
$('#cc').html(len);
});
</script>
<script type="text/javascript">
function audio_hit(x) {
$('#apause' + x).show();
$('#aplay' + x).hide();
document.getElementById('amp'+ x).play();
}
function audio_hit2(x) {
$('#apause' + x).hide();
$('#aplay' + x).show();
document.getElementById('amp' + x).pause();
}
</script>
<script>
$(document).ready(function(){
    $("#audioForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progress-bar").width(percentComplete + '%');
                         $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>');
                         if(percentComplete==100){
                            $("#trans").html("Your video uploded now transcribing please wait a while..");
                            $("#progress-bar").hide();
                            }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'addaudio.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#progress-bar").width('0%');
                $('#loader-icon').show();
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                $('#loader-icon').hide();
                console.log(resp);
                window.location="create-feed.php?cpid="+resp;
            }
        });
    });
    // $("#upfile").change(function(){
    //     $("#audioForm").submit();
    // });
		var myFile = document.getElementById('upfile');

//binds to onchange event of the input field
myFile.addEventListener('change', function() {
  //this.files[0].size gets the size of your file.
	var si=this.files[0].size;
	var ss=parseFloat(si/(1024*1024));
	var s=ss.toFixed(2);
alert(si+"--"+ss+" "+s+" MB");

});
		// $('#upfile').bind('change', function() {
		// 	var si=this.files[0].size;
		// 	var ss=parseFloat(si/1024);
  	// alert(si+"--"+ss);
		// });
});
</script>
<script>
$(document).ready(function (e) {
  $('#texttospeechForm').on('submit',(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
       $('#loader-div-icon').show();
       $('#formDiv').hide();
         $("#generateBtn").html("Rendering..");
           $("#generateBtn").prop('disabled', true);
      	$.ajax({
          type:'POST',
          url:"texttospeechRender.php",
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          beforeSubmit: function() {
            $("#progress-bar").width('0%');
          },
          uploadProgress: function (event, position, total, percentComplete){
            $("#progress-bar").width(percentComplete + '%');
            $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
          },
          success:function(data){
              $('#loader-icon').hide();
              console.log("success");
              console.log(data);
            //  window.location="create-feed.php?cpid="+data;
          },
          error: function(data){
              console.log("error");
              console.log(data);
          }
      });
  }));
  $("#generateBtn").click(function(){
      $("#texttospeechForm").submit();
  });
});
</script>
<script type="text/javascript">
    $(function () {
        $(".close").click(function () {
            $(".modal").modal("hide");
        });
    });
    $(document).ready(function() {
    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });
});
</script>
<script type="text/javascript">
function linkcontent(id){
	var cid=document.getElementById('hidChapId').value;
		var fid=document.getElementById('hidFeedId').value;
	$.ajax({
			type: 'POST',
			dataType:'text',
			url: 'getAudioTranscribe.php',
			data:{id:id,cid:cid,fid:fid},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.error(errorThrown);
         alert(textStatus+" Status: Audio formtate not supported kindly create  you own audio"+ errorThrown );
				window.location="create-feed.php?cpid="+cid;
     },
			success: function(resp){
					$('#loader-icon').hide();
				//	var x=resp.subtitle['cid'];
				  //console.log(x);
					window.location="linkcontent.php?cid="+resp;
			}
	});
// $.ajax({
// 		url:"getAudioTranscribe.php",type:"post",data:{id:id,cid:cid,fid:fid},
// 		success:function(data){
// 						$('#loader-icon').hide();
// 							console.log(data);
// 						window.location="linkcontent.php?cid="+data;
// 				},
// 				error: function(data){
// 						console.log("error");
// 						console.log(data);
// 				}
// 		});
}
</script>
<script>
            (function() {
                var params = {},
                    r = /([^&=]+)=?([^&]*)/g;
                function d(s) {
                    return decodeURIComponent(s.replace(/\+/g, ' '));
                }
                var match, search = window.location.search;
                while (match = r.exec(search.substring(1))) {
                    params[d(match[1])] = d(match[2]);
                    if(d(match[2]) === 'true' || d(match[2]) === 'false') {
                        params[d(match[1])] = d(match[2]) === 'true' ? true : false;
                    }
                }
                window.params = params;
            })();
        </script>
        <script>
            var recordingDIV = document.querySelector('.recordrtc');
            var recordingMedia = recordingDIV.querySelector('.recording-media');
            var recordingPlayer = recordingDIV.querySelector('video');
            var mediaContainerFormat = recordingDIV.querySelector('.media-container-format');
            recordingDIV.querySelector('button').onclick = function() {
                var button = this;
                if(button.innerHTML === 'Stop Recording') {
                    button.disabled = true;
                    button.disableStateWaiting = true;
                    setTimeout(function() {
                        button.disabled = false;
                        button.disableStateWaiting = false;
                    }, 2 * 1000);

                    button.innerHTML = 'Start Recording';

                    function stopStream() {
                        if(button.stream && button.stream.stop) {
                            button.stream.stop();
                            button.stream = null;
                        }
                    }

                    if(button.recordRTC) {
                        if(button.recordRTC.length) {
                            button.recordRTC[0].stopRecording(function(url) {
                                if(!button.recordRTC[1]) {
                                    button.recordingEndedCallback(url);
                                    stopStream();

                                    saveToDiskOrOpenNewTab(button.recordRTC[0]);
                                    return;
                                }

                                button.recordRTC[1].stopRecording(function(url) {
                                    button.recordingEndedCallback(url);
                                    stopStream();
                                });
                            });
                        }
                        else {
                            button.recordRTC.stopRecording(function(url) {
                                button.recordingEndedCallback(url);
                                stopStream();

                                saveToDiskOrOpenNewTab(button.recordRTC);
                            });
                        }
                    }

                    return;
                }

                button.disabled = true;

                var commonConfig = {
                    onMediaCaptured: function(stream) {
                        button.stream = stream;
                        if(button.mediaCapturedCallback) {
                            button.mediaCapturedCallback();
                        }

                        button.innerHTML = 'Stop Recording';
                        button.disabled = false;
                    },
                    onMediaStopped: function() {
                        button.innerHTML = 'Start Recording';

                        if(!button.disableStateWaiting) {
                            button.disabled = false;
                        }
                    },
                    onMediaCapturingFailed: function(error) {
                        if(error.name === 'PermissionDeniedError' && !!navigator.mozGetUserMedia) {
                            InstallTrigger.install({
                                'Foo': {
                                    // https://addons.mozilla.org/firefox/downloads/latest/655146/addon-655146-latest.xpi?src=dp-btn-primary
                                    URL: 'https://addons.mozilla.org/en-US/firefox/addon/enable-screen-capturing/',
                                    toString: function () {
                                        return this.URL;
                                    }
                                }
                            });
                        }

                        commonConfig.onMediaStopped();
                    }
                };

                if(recordingMedia.value === 'record-video') {
                    captureVideo(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            },
                            frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;

                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio') {
                    captureAudio(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'audio',
                            bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                            sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                            leftChannel: params.leftChannel || false,
                            disableLogs: params.disableLogs || false,
                            recorderType: DetectRTC.browser.name === 'Edge' ? StereoAudioRecorder : null
                        });

                        button.recordingEndedCallback = function(url) {
                            var audio = new Audio();
                            audio.src = url;
                            audio.controls = true;
                            recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                            recordingPlayer.parentNode.appendChild(audio);

                            if(audio.paused) audio.play();

                            audio.onended = function() {
                                audio.pause();
                                audio.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-video') {
                    captureAudioPlusVideo(commonConfig);

                    button.mediaCapturedCallback = function() {

                        if(DetectRTC.browser.name !== 'Firefox') { // opera or chrome etc.
                            button.recordRTC = [];

                            if(!params.bufferSize) {
                                // it fixes audio issues whilst recording 720p
                                params.bufferSize = 16384;
                            }

                            var audioRecorder = RecordRTC(button.stream, {
                                type: 'audio',
                                bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                                sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                                leftChannel: params.leftChannel || false,
                                disableLogs: params.disableLogs || false,
                                recorderType: DetectRTC.browser.name === 'Edge' ? StereoAudioRecorder : null
                            });

                            var videoRecorder = RecordRTC(button.stream, {
                                type: 'video',
                                disableLogs: params.disableLogs || false,
                                canvas: {
                                    width: params.canvas_width || 320,
                                    height: params.canvas_height || 240
                                },
                                frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                            });

                            // to sync audio/video playbacks in browser!
                            videoRecorder.initRecorder(function() {
                                audioRecorder.initRecorder(function() {
                                    audioRecorder.startRecording();
                                    videoRecorder.startRecording();
                                });
                            });

                            button.recordRTC.push(audioRecorder, videoRecorder);

                            button.recordingEndedCallback = function() {
                                var audio = new Audio();
                                audio.src = audioRecorder.toURL();
                                audio.controls = true;
                                audio.autoplay = true;

                                audio.onloadedmetadata = function() {
                                    recordingPlayer.src = videoRecorder.toURL();
                                };

                                recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                                recordingPlayer.parentNode.appendChild(audio);

                                if(audio.paused) audio.play();
                            };
                            return;
                        }

                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-screen') {
                    captureScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            }
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;
                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-screen') {
                    captureAudioPlusScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }
            };

            function captureVideo(config) {
                captureUserMedia({video: true}, function(videoStream) {
                    recordingPlayer.srcObject = videoStream;

                    config.onMediaCaptured(videoStream);

                    videoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudio(config) {
                captureUserMedia({audio: true}, function(audioStream) {
                    recordingPlayer.srcObject = audioStream;

                    config.onMediaCaptured(audioStream);

                    audioStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudioPlusVideo(config) {
                captureUserMedia({video: true, audio: true}, function(audioVideoStream) {
                    recordingPlayer.srcObject = audioVideoStream;

                    config.onMediaCaptured(audioVideoStream);

                    audioVideoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureAudioPlusScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    screenConstraints.audio = true;

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }

            function setMediaContainerFormat(arrayOfOptionsSupported) {
                var options = Array.prototype.slice.call(
                    mediaContainerFormat.querySelectorAll('option')
                );

                var selectedItem;
                options.forEach(function(option) {
                    option.disabled = true;

                    if(arrayOfOptionsSupported.indexOf(option.value) !== -1) {
                        option.disabled = false;

                        if(!selectedItem) {
                            option.selected = true;
                            selectedItem = option;
                        }
                    }
                });
            }

            recordingMedia.onchange = function() {
                if(this.value === 'record-audio') {
                    setMediaContainerFormat(['WAV', 'Ogg']);
                    return;
                }
                setMediaContainerFormat(['WebM', /*'Mp4',*/ 'Gif']);
            };

            if(DetectRTC.browser.name === 'Edge') {
                // webp isn't supported in Microsoft Edge
                // neither MediaRecorder API
                // so lets disable both video/screen recording options

                console.warn('Neither MediaRecorder API nor webp is supported in Microsoft Edge. You cam merely record audio.');

                recordingMedia.innerHTML = '<option value="record-audio">Audio</option>';
                setMediaContainerFormat(['WAV']);
            }

            if(DetectRTC.browser.name === 'Firefox') {
                // Firefox implemented both MediaRecorder API as well as WebAudio API
                // Their MediaRecorder implementation supports both audio/video recording in single container format
                // Remember, we can't currently pass bit-rates or frame-rates values over MediaRecorder API (their implementation lakes these features)

                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + '<option value="record-audio-plus-screen">Audio+Screen</option>'
                                            + recordingMedia.innerHTML;
            }

            // disabling this option because currently this demo
            // doesn't supports publishing two blobs.
            // todo: add support of uploading both WAV/WebM to server.
            if(false && DetectRTC.browser.name === 'Chrome') {
                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + recordingMedia.innerHTML;
                console.info('This RecordRTC demo merely tries to playback recorded audio/video sync inside the browser. It still generates two separate files (WAV/WebM).');
            }

            var MY_DOMAIN = 'http://localhost/gofeednew';

            function isMyOwnDomain() {
                // replace "webrtc-experiment.com" with your own domain name
                return document.domain.indexOf(MY_DOMAIN) !== -1;
            }

            function saveToDiskOrOpenNewTab(recordRTC) {
                recordingDIV.querySelector('#save-to-disk').parentNode.style.display = 'block';
                recordingDIV.querySelector('#save-to-disk').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    recordRTC.save();
                };

                recordingDIV.querySelector('#open-new-tab').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    window.open(recordRTC.toURL());
                };

                if(isMyOwnDomain()) {
                    recordingDIV.querySelector('#upload-to-server').disabled = true;
                    recordingDIV.querySelector('#upload-to-server').style.display = 'none';
                }
                else {
                    recordingDIV.querySelector('#upload-to-server').disabled = false;
                }

                recordingDIV.querySelector('#upload-to-server').onclick = function() {
                    if(isMyOwnDomain()) {
                        alert('PHP Upload is not available on this domain.');
                        return;
                    }

                    if(!recordRTC) return alert('No recording found.');
                    this.disabled = true;

                    var button = this;
                    uploadToServer(recordRTC, function(progress, fileURL) {
                        if(progress === 'ended') {
                            button.disabled = false;
                            button.innerHTML = 'Click to download from server';
                            button.onclick = function() {
                                window.open(fileURL);
                            };
                            return;
                        }
                        button.innerHTML = progress;
                    });
                };
            }

            var listOfFilesUploaded = [];

            function uploadToServer(recordRTC, callback) {
                var blob = recordRTC instanceof Blob ? recordRTC : recordRTC.blob;
                var fileType = blob.type.split('/')[0] || 'audio';
                var fileName = (Math.random() * 1000).toString().replace('.', '');

                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

                // create FormData
                var formData = new FormData();
                formData.append(fileType + '-filename', fileName);
                formData.append(fileType + '-blob', blob);

                callback('Uploading ' + fileType + ' recording to server.');

                // var upload_url = 'https://your-domain.com/files-uploader/';
                var upload_url = 'save.php';

                // var upload_directory = upload_url;
                var upload_directory = 'audio/';

                makeXMLHttpRequest(upload_url, formData, function(progress) {
                    if (progress !== 'upload-ended') {
                        callback(progress);
                        return;
                    }

                    callback('ended', upload_directory + fileName);

                    // to make sure we can delete as soon as visitor leaves
                    listOfFilesUploaded.push(upload_directory + fileName);
                });
            }

            function makeXMLHttpRequest(url, data, callback) {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        callback('upload-ended');
                    }
                };

                request.upload.onloadstart = function() {
                    callback('Upload started...');
                };

                request.upload.onprogress = function(event) {
                    callback('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
                };

                request.upload.onload = function() {
                    callback('progress-about-to-end');
                };

                request.upload.onload = function() {
                    callback('progress-ended');
                };

                request.upload.onerror = function(error) {
                    callback('Failed to upload to server');
                    console.error('XMLHttpRequest failed', error);
                };

                request.upload.onabort = function(error) {
                    callback('Upload aborted.');
                    console.error('XMLHttpRequest aborted', error);
                };

                request.open('POST', url);
                request.send(data);
            }

            window.onbeforeunload = function() {
                recordingDIV.querySelector('button').disabled = false;
                recordingMedia.disabled = false;
                mediaContainerFormat.disabled = false;

                if(!listOfFilesUploaded.length) return;

                var delete_url = 'https://webrtcweb.com/f/delete.php';
                // var delete_url = 'RecordRTC-to-PHP/delete.php';

                listOfFilesUploaded.forEach(function(fileURL) {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            if(this.responseText === ' problem deleting files.') {
                                alert('Failed to delete ' + fileURL + ' from the server.');
                                return;
                            }

                            listOfFilesUploaded = [];
                            alert('You can leave now. Your files are removed from the server.');
                        }
                    };
                    request.open('POST', delete_url);

                    var formData = new FormData();
                    formData.append('delete-file', fileURL.split('/').pop());
                    request.send(formData);
                });

                return 'Please wait few seconds before your recordings are deleted from the server.';
            };
        </script>
</body>
</html>
