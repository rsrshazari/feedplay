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
$delQry=mysqli_query($con,"delete from brand where `id`='$did'");
if($delQry){
header("location:brands.php?msg=dls");
}else{
header("location:brands.php?msg=err");
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
  <title>Feed Play | Admin Brands </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="../assets1/css/datatable.css">
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Brands</h6>
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
                  <h5 class="mb-0">All Brands</h5>
                  <p class="text-sm mb-0">

                  </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                    <!-- <a href="addbrands.php"  class="btn bg-gradient-danger btn-sm mb-0" ><i class="fa-solid fa-crown"></i> Create New brands</a> -->
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
                      <th>Brands</th>
											<th>User</th>
											<th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $qry=mysqli_query($con,"select * from brand order by id desc");
                      $sl=0;
                      $num_rows=mysqli_num_rows($qry);
                      if($num_rows>0) {
                      while ($fetch=mysqli_fetch_array($qry)) {
                      $sl++;

                     ?>
                    <tr>
                      <td class="text-sm"><?= $sl?></td>
											<td>
												<div class="d-flex px-2 py-1">
														<div>
															<?php if ($fetch['logo']==''): ?>
																	<img src="../assets1/img/logos/1.png" class="avatar avatar-sm me-3" alt="<?=$fetch['name']?>">
															<?php endif; ?>
															<img src="../assets1/img/logos/<?=$fetch['logo']?>" class="avatar avatar-sm me-3" alt="<?=$fetch['name']?>">
														</div>
														<div class="d-flex flex-column justify-content-center">
															<h6 class="mb-0 text-sm"><?=$fetch['name']?></h6>
														</div>
													</div>
												</td>
												<td class="text-sm"><?= getUserName($fetch['user_id'])?></td>
												<td class="text-sm"><?= date('M d, Y', strtotime($fetch['date'])) ?></td>
												<td class="text-sm"><?php echo getuserStatus($fetch['status']); ?></td>
                      <td class="text-sm">
                        <a href="brands.php?did=<?php echo base64_encode($fetch['id']) ?>" onclick="return confirm('Are you sure want to delete??')" class="collection-item"><span class="badge badge-sm bg-gradient-danger" ><i class="fas fa-trash"></i></span></a>
                      </td>
                    </tr>
                  <?php }}else{  ?>
                  <tr><td colspan="6" align="center">--No brands found--</td></tr>
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
