<?php
ob_start();
session_start();
$userId=$_SESSION['usrid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
if (isset($_GET['cid'])&&$_GET['cid']!='') {
  $cid=($_GET['cid']);
  //$qry=mysqli_query($con,"SELECT * FROM `chapter` where id=$cid");
  //$fetch=mysqli_fetch_array($qry);
  $link="https://feedplay.net/feed.php?cid=$cid";
}
?>
<!DOCTYPE html>
<html><head>
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
          <h6 class="font-weight-bolder text-white mb-0"></h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-lg-6 m-auto">
          <div class="card">
            <div class="card-body text-center">
            <h5>  Success! Your feed is now published</h5>
<p>Get it out into the world by sharing the link below via email,
text, or any of your favorite social channels.</p>
<div class="">
  <img src="assets1/img/illustrations/rocket-white.png" alt="" class="img-fluid" style="width:50%">
</div>
<div class=" text-center">
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$link?>" class="fb-xfbml-parse-ignore">Share</a></div>
  <a href="#" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-linkedin-in"></i></a>
    <a href="#" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-twitter"></i></a>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$link?>" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-facebook"></i></a>
        <a href="#" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-solid fa-envelope"></i></a>
</div>
<div class="input-group mb-3">
  <input id="linktext" name="linktext"  value="<?=$link?>" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-outline-primary mb-0" type="button" id="copybtn"  style=" border: 1px solid #d2d6da;">Copy</button>
</div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </main>
  <?php include 'include/script.php' ?>
  <script type="text/javascript">
  var text = document.getElementById("linktext");
var btn = document.getElementById("copybtn");
btn.onclick = function() {
  text.select();
  document.execCommand("copy");
}
  </script>
  </body>
  </html>
