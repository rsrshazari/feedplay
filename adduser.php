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
	$name=$_POST['packagename'];
	$work=$_POST['workspacelimit'];
	$user=$_POST['userlimit'];
	$feed=$_POST['feedlimit'];
	$chapter=$_POST['chapterlimit'];
	$audio=$_POST['audiolimit'];
	$desp=$_POST['desp'];
	$status=$_POST['status'];
	$type=$_POST['type'];
	$yearly=$_POST['yearly'];
	$monthly=$_POST['monthly'];
	$qry="INSERT INTO `package`(`user_limit`,`workspace_limit`, `feed_limit`, `chapter_limit`, `audio_limit`, `name`, `type`,`yearly`,`monthly`, `description`, `status`, `is_deleted`, `created_date`)
	VALUES ('$user','$work','$feed','$chapter','$audio','$name','$type','$yearly','$monthly','$desp','$status','0','$date')";
	$exec=mysqli_query($con,$qry);
	if ($exec) {
		header('location:package.php?msg=ins');
	}else{
			header('location:package.php?msg=err');
	}
}
if (isset($_POST['update'])) {
	$id=$_POST['hidId'];
	$name=$_POST['packagename'];
	$work=$_POST['workspacelimit'];
	$user=$_POST['userlimit'];
	$feed=$_POST['feedlimit'];
	$chapter=$_POST['chapterlimit'];
	$audio=$_POST['audiolimit'];
	$desp=$_POST['desp'];
	$status=$_POST['status'];
	$type=$_POST['type'];
	$yearly=$_POST['yearly'];
	$monthly=$_POST['monthly'];
	$qry="UPDATE `package` SET `user_limit`='$user',`workspace_limit`='$work',`feed_limit`='$feed',`chapter_limit`='$chapter',`audio_limit`='$audio',`name`='$name',
	`type`='$type',`yearly`='$yearly',`monthly`='$monthly',`description`='$desp',`status`='$status',`is_deleted`='0' WHERE `id`='$id'";
	$exec=mysqli_query($con,$qry);
	if ($exec) {
		header('location:package.php?msg=upd');
	}else{
			header('location:package.php?msg=err');
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
  <title>Feed Play | Admin Package </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="../assets1/css/datatable.css">
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Packege</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <?php if(isset($_GET['msg'])) {?>
             <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert"><?=$msgText?></span>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
           <?php }?>
            <div class="card-header pb-0">
              <div class="d-lg-flex">
                <div>
                  <h5 class="mb-0">Add Packege</h5>
                  <p class="text-sm mb-0">

                  </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
										 <label for=""><span style="color:red;font-weight:bold">Limit</span> Textbox can be blank for unlimited</label>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
								<form class="" action="" enctype="multipart/form-data" method="post">
										<div class="row p-3">
											<div class="col-md-12 col-sm-12 col-xl-12">
												<div class="row">
													<div class="col-12 col-md-4 col-sm-6">
														<label for="amount">Select Package</label>
														<select class="form-control" name="type">
															 <option value="">Select package</option>
																<?php $qry=mysqli_query($con,"select * from package where status='1' and is_deleted='0' order by id asc");
																$pack=mysqli_fetch_array($qry);
																while($pack){?>
																 <option value="<?=$pack['id']?>"><?=$pack['name']?></option>
															 <?php } ?>
														</select>
													</div>
													<div class="col-12 col-md-4 col-sm-6">
													<label for="amount">Package Type</label>
													<select class="form-control" name="type">
														 <option value="1">Yearly</option>
														 <option value="2">Monthly</option>
													</select>
												</div>
													<div class="col-12 col-md-4 col-sm-6">
													 <label for="amount">Expiry</label>
													 <input type="text" name="expiry" class="form-control" value="" readonly>
												 </div>
												</div>
												<div class="row mt-1">
													<div class="col-12 col-md-4 col-sm-6">
													 <label for="userlimit">User Name</label>
													 <input type="text" name="name"  class="form-control" value="">
												 </div>
													<div class="col-12 col-md-4 col-sm-6">
													 <label for="userlimit">Email</label>
													 <input type="text" name="email_id"  class="form-control" value="">
												 </div>
												 <div class="col-12 col-md-4 col-sm-6">
													 <label for="feedlimit">Contact</label>
													 <input type="number" name="contact" maxlength="10" class="form-control" value="">
												 </div>

												</div>
												<div class="row mt-1">
													<div class="col-12 col-md-4 col-sm-6">
 													 <label for="chapterlimit">Password</label>
 													 <input type="password" name="pwd" class="form-control" value="">
 												 </div>
 												 <div class="col-12 col-md-4 col-sm-6">
 													 <label for="audiolimit">Confirm Password</label>
 													 <input type="password" name="rpwd" class="form-control" value="" >
 												 </div>
 												 <div class="col-12 col-md-4 col-sm-6">
 														 <label for="status">Status</label>
 													 <select class="form-control" name="status">
 														 <option value="1" <?php if($fetch['status']=='1'){ ?>selected<?php } ?> >Active</option>
 														 <option value="0" <?php if($fetch['status']=='0'){ ?>selected<?php } ?>>Block</option>
 													 </select>
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
