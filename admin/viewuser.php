<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
if(isset($_SESSION["aid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
if (isset($_GET['uid'])&&$_GET['uid']!='') {
  $uid=base64_decode($_GET['uid']);
  $userDetails=mysqli_fetch_array(mysqli_query($con,"select * from user where id=$uid"));
  $feed=getFeedOfUser($userDetails['id']);
  $chapter=getChapterOfUser($userDetails['id']);
  $audio=getTotalAudio($userDetails['id']);
  $brands=getBrandsByUserId($userDetails['id']);
  $work=getWorkspaceByUserId($userDetails['id']);
  $package=getSubscriptionDetailsById($userDetails['package']);

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
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feed Play | Profile </title>
<?php include 'include/css.php' ?>
<script>
var loadFile = function(event) {
var image = document.getElementById('profileImg');
image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">User Profile Details</h6>
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
      <div class="row mb-5">
              <div class="col-lg-12 mt-lg-0 mt-4">
                <!-- Card Profile -->

                <div class="card card-body" id="profile">
                  <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                      <div class="avatar avatar-xl position-relative">
                        <?php if ($userDetails['photo']==''){ ?>
                              <img id="profileImg" src="../assets1/img/user/1.png" alt="<?=$userDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
                        <?php }else{ ?>
                      <img id="profileImg" src="../assets1/img/user/<?=$userDetails['photo']?>" alt="<?=$userDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
                    <?php } ?>
                    </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                      <div class="h-100">
                        <h5 class="mb-1 font-weight-bolder">
                          <?=$userDetails['name']?>
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                          <?=$userDetails['email_id']?>
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                      <?php echo getuserStatus($userDetails['is_active']) ?>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="row mt-3">

        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <!-- <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i>
                  </a> -->
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light ">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp;   <?=$userDetails['name']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp;   <?=$userDetails['contact_no']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp;   <?=$userDetails['email_id']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp;   <?=$userDetails['address']?></li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <?php if ($userDetails['facebook']!='') {?>
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$userDetails['facebook']?>">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                <?php  } ?>
                      <?php if ($userDetails['twitter']!='') {?>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$userDetails['twitter']?>">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
              <?php    } ?>
                  <?php if ($userDetails['instagram']!='') {?>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$userDetails['instagram']?>">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              <?php  } ?>
    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Date:</strong> &nbsp;   <?= date('M d, Y', strtotime($user['created_date'])) ?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Account Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <!-- <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i>
                  </a> -->
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Published Feeds:</strong> &nbsp;   <?=$feed[2]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Draft Feeds:</strong> &nbsp;   <?=$feed[1]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Published Chapter:</strong> &nbsp;   <?=$chapter[2]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Draft Chapter:</strong> &nbsp;   <?=$chapter[1]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Total Audio:</strong> &nbsp;   <?=$audio?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Brands:</strong> &nbsp;   <?=$brands?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Workspace:</strong> &nbsp;   <?=$work?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4 mt-xl-0 mt-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Packege Information</h6>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Package Name:</strong> &nbsp;  <?=$package[6]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Package Type:</strong> &nbsp;  <?php if ($userDetails['package_type']=='1') { echo 'Yearly';}else{ echo 'Monthly' ;} ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Packege Amount:</strong> &nbsp;   <?php if ($userDetails['package_type']=='1') { echo $package[8];}else{ echo $package[7] ;} ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Feed Limit:</strong> &nbsp;   <?=$package[3]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Wokspace Limit:</strong> &nbsp;    <?=$package[2]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">User Limit:</strong> &nbsp;    <?=$package[1]?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Expiry:</strong> &nbsp; <?= date('M d, Y', strtotime($userDetails['expiry'])) ?>   </li>



              </ul>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
  <?php include 'include/script.php' ?>
  <script type="text/javascript">
  $(document).ready(function() {
  $(".alert").fadeTo(2000, 500).slideUp(500, function() {
    $(".alert").slideUp(500);
  });
});
$(document).ready(function() {

$(".close").click(function() {
  $(".alert").fadeTo(2000, 500).slideUp(500, function() {
    $(".alert").slideUp(500);
  });
});
});
  </script>
  </body>
  </html>
