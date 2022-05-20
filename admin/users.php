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
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=base64_decode($_GET['did']);
$delQry=mysqli_query($con,"update user set is_deleted='1' where `id`='$did'");
if($delQry){
header("location:users.php?msg=dls");
}else{
header("location:users.php?msg=err");
}
}
if(isset($_GET['uid'])&&$_GET['uid']!=''){
$did=base64_decode($_GET['uid']);
if($_GET['act']=='1'){
	$val='0';
}else{
	$val='1';
}
$delQry=mysqli_query($con,"update user set is_active='$val' where `id`='$did'");
if($delQry){
header("location:users.php?msg=dls");
}else{
header("location:users.php?msg=err");
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
  <title>Feed Play | Admin Users </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="../assets1/css/datatable.css">
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Users</h6>
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
                  <h5 class="mb-0">All Users</h5>
                  <p class="text-sm mb-0"></p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                    <a href="adduser.php"  class="btn bg-gradient-danger btn-sm mb-0" ><i class="fa-solid fa-user"></i> Create New User</a>
                </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
              <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                  <thead class="thead-light">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Email</th>
											<th>Contact</th>
											<th>Packege</th>
											<th>Feed</th>
											<th>Chapter</th>
                      <th>Status</th>
											<th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $qry=mysqli_query($con,"select * from user where is_deleted='0'  order by id asc");
                      $sl=0;
                      $num_rows=mysqli_num_rows($qry);
                      if($num_rows>0) {
                      while ($user=mysqli_fetch_array($qry)) {
                      $sl++;
											$feed=getFeedOfUser($user['id']);
											$chapter=getChapterOfUser($user['id']);
                     ?>
										 <tr>
	                     <td class="text-sm"><?= $sl?></td>
	                     <td class="text-sm"><?=$user['name']?></td>
	                     <td class="text-sm"><?= $user['email_id']?></td>
	                     <td class="text-sm"><?= $user['contact_no']?></td>
											 <td class="text-sm"><?=getPackageNameById($user['package'])?></td>
											 <td class="text-sm"><?=$feed[0]?></td>
											 <td class="text-sm"><?=$chapter[0]?></td>
											 <td class="text-sm"><?php echo getuserStatus($user['is_active']); ?></td>
	                     <td class="text-sm"><?= date('M d, Y', strtotime($user['created_date'])) ?></td>
	                     <td class="text-sm">
	                       <a href="viewuser.php?uid=<?=base64_encode($user['id'])?>" class=" badge badge-sm bg-gradient-success" title="Preview "><i class="fa-solid fa-desktop"></i></a>
	                       <a href="edituser.php?uid=<?=base64_encode($user['id'])?>" class=" badge badge-sm bg-gradient-info" title="Edit User"><i class="fa-solid fa-pen-to-square"></i></a>
	                       <a href="users.php?did=<?=base64_encode($user['id'])?>" onClick="return confirm(' Are you sure you want to delete !!')" class="badge badge-sm bg-gradient-danger" title="Delete User"><i class="fa-solid fa-trash"></i>
	                       </a>
	                     </td>
	                   </tr>
	                 <?php }}else{  ?>
	                 <tr><td colspan="7" align="center">--No audio found--</td></tr>
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
