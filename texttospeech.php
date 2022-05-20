<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
 header('Content-Type:application:json');
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$url = $_POST['blogUrl'];
$cpid=$_POST['cpid'];
$site = file_get_contents($url);
       $con1 = explode('<h1', $site);
       $work = '<h1' . $con1[1];
       $con2 = explode('<footer', $work);
       $urlCon1 = strip_tags($con2[0], "<p><h1><h2><h3><h4>");
       $urlCon2 = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $urlCon1);
       $urlCon=htmlToPlainText($urlCon2);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feed Play Dashboard </title>
<?php include 'include/css.php' ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Create Audio From Blog Url</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row mt-4">
              <div class="col-12">
                <?php if(isset($_GET['msg'])) {?>
                 <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert"><?=$msgText?></span>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
               <?php }?>
                <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                    <div class="d-lg-flex">
                    <div>
                      <h5 class="mb-0">Blog Text</h5>
                      <p class="text-sm mb-0">
                        The text contains in blog url.
                      </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                      <div class="ms-auto my-auto">
                        <!-- <a  href="#" data-bs-toggle="modal" data-bs-target="#createChapterModal" class="btn bg-gradient-primary btn-sm mb-0" >Create New Chapter</a> -->
                    </div>
                    </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                        <form class="" name="texttospeechForm" id="texttospeechForm" action="" method="post">
                          <input type="hidden" id="type" name="type" value="4">
                           <input type="hidden" id="cpid" name="cpid" value="<?=$cpid?>">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="paste-below">
                            <div class="paste-text">
                                <textarea max="200000000000" class="form-control" cols="75" id="text" name="text" style="height:300px;"><?= $urlCon?></textarea>
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
                      <div class="loderDiv">
                          <div id="loader-icon" style="text-align:center;display:none" ><img src="assets1/img/loder.gif" Height="100" /></div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
    </div>
    </main>
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
  <script>
  $(document).ready(function (e) {
    $('#texttospeechForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
         $('#loader-icon').show();
         $('#formDiv').hide();
           $("#generateBtn").html("Creating audio..");
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
                window.location="create-feed.php?cpid="+data;
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
  </body>
  </html>
