<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}

if (isset($_POST['submit'])) {
	$name=$_POST['name'];
		$email=$_POST['email'];
	$old=$_POST['old'];
	$pwd=$_POST['pwd'];

	$imageName=$_FILES['image']['name'];
	if($imageName==''){
		$filename=$_POST['imgId'];
	}else{
		$filename=$imageName;
		$location="../assets1/img/user/".$imageName;
		move_uploaded_file($image,$location);
	}
	if($pwd==''){
		$pass=$old;
	}else{
			$pass=$pwd;
	}
 $qry="UPDATE `admin` SET `name`='$name',`email_id`='$email',`password`='$pass',`photo`='$filename' WHERE id='$adminId'";
	$exec=mysqli_query($con,$qry);
	if ($exec) {
		header('location:setting.php?msg=ins');
	}else{
			header('location:setting.php?msg=err');
	}
}

if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$pid=base64_decode($did);
$delQry=mysqli_query($con,"delete from `feeds` where `id`='$pid'");
if($delQry){
header("location:my-feeds.php?msg=dls");
}else{
header("location:my-feeds.php?msg=err");
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
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feed Play | Admin Setting </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="../assets1/css/datatable.css">
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
          <h6 class="font-weight-bolder text-white mb-0">Admin Setting</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
			<?php if(isset($_GET['msg'])) {?>
			 <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert"><?=$msgText?></span>
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					 <span aria-hidden="true">&times;</span>
				 </button>
			 </div>
		 <?php }?>
      <div class="row">
        <div class="col-12">
          <div class="card">

            <div class="card-header pb-0">
              <div class="d-lg-flex">
                <div>
                  <h5 class="mb-0">Setting</h5>
                  <p class="text-sm mb-0">

                  </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">

                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
								<form class="" action="" enctype="multipart/form-data" method="post">
										<div class="row p-3">
											<div class="col-md-12 col-sm-12 col-xl-12">

												<div class="row">
													<div class="col-12 col-md-2 col-sm-6">
														<div class="avatar avatar-xl position-relative">
			                        <?php if ($adminDetails['photo']==''){ ?>
			                              <img id="profileImg" src="../assets1/img/user/1.png" alt="<?=$adminDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
			                        <?php }else{ ?>
			                      <img id="profileImg" src="../assets1/img/user/<?=$adminDetails['photo']?>" alt="<?=$adminDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
			                    <?php } ?>
			                        <label for="image" href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
			                        <i class="ni ni-cloud-upload-96" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" title="Edit Image" ></i>
			                        <input type="file" name="image" style="display:none" id="image" accept="image/gif,image/jpeg,image/jpg,image/png"  onchange="loadFile(event)">
			                      </label>
			                      </div>
													</div>
													<div class="col-12 col-md-3 col-sm-6">
														<label for="feedlimit">Name</label>
														<input type="text" name="name" required class="form-control" value="<?=$adminDetails['name']?>">
													</div>
													<div class="col-12 col-md-3 col-sm-6">
														<label for="feedlimit">Email</label>
														<input type="email" name="email" required class="form-control" value="<?=$adminDetails['email_id']?>">
													</div>
													<div class="col-12 col-md-2 col-sm-6">
 													 <label for="chapterlimit">Password</label>
 													 <input type="password" name="pwd" class="form-control" value="">
													  <input type="hidden" name="old" class="form-control" value="<?=$adminDetails['password']?>">
 												 </div>
 												 <div class="col-12 col-md-2 col-sm-6">
 													 <label for="audiolimit">Confirm Password</label>
 													 <input type="password" name="rpwd" class="form-control" value="" >
 												 </div>

												</div>
												<div class="row mt-1">

													<div class="col-md-12 " style="text-align:right;">

															<input type="submit" class="btn bg-gradient-primary btn-sm mt-4" name="submit" value="Save">
													</div>
												</div>
											</div>
										</div>
								</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php include 'include/script.php' ?>
<script src="../assets1/js/plugins/datatables.js"></script>
<script>
  if (document.getElementById('products-list')) {
    const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
      searchable: true,
      fixedHeight: false,
      perPage: 7
    });
    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;
        var data = {
          type: type,
          filename: "soft-ui-" + type,
        };
        if (type === "csv") {
          data.columnDelimiter = "|";
        }
        dataTableSearch.export(data);
      });
    });
  };
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
