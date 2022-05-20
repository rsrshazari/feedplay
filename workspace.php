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
$wqry=mysqli_query($con,"select * from worksapce where user_id='$userId' order by id desc");
$num=mysqli_num_rows($wqry);
$fetch=mysqli_fetch_array($wqry);
$date=date('Y-m-d');
if (isset($_POST['adduser'])) {
  $wid=$_POST['wid'];
    $username=$_POST['uname'];
      $email=$_POST['email'];
        $mobile=$_POST['mobile'];
          $password=md5($_POST['password']);
          $exp=$_POST['exp'];
          $qry="INSERT INTO `user`( `wid`, `name`, `email_id`, `password`, `contact_no`,`package`,`user_type`,`expiry`, `created_by`, `is_active`, `is_deleted`, `created_date`)
          VALUES ('$wid','$username','$email','$password','$mobile','0','2','$exp','$userId','1','0','$date')";
          $checkEmail=checkEmailofUser($email);
          if ($checkEmail=='0') {
          $exec=mysqli_query($con,$qry);
          if($exec){
            header('location:workspace.php?msg=ins');
          }else{
            header("location:workspace.php?msg=err");
          }
        }else{
          	 header('location:workspace.php?msg=err2');
        }
}
if (isset($_POST['workspace'])) {
  $worksapce=$_POST['wname'];
$uid=$_POST['uid'];
  $image=$_FILES['image']['tmp_name'];
    $imageName=$_FILES['image']['name'];
  if($imageName==''){
    $filename='worksapce.png';
  }else{
    $filename=$imageName;
    $location="assets1/img/workspace/".$imageName;
    move_uploaded_file($image,$location);
  }
  $qry="insert into worksapce (`user_id`,`logo`,`name`,`status`,`is_deleted`) values($uid,'$filename','$worksapce','1','0')";
  $exec=mysqli_query($con,$qry);
  if($exec){
    header('location:workspace.php?msg=ins');
  }else{
    header("location:workspace.php?msg=err");
  }
}
if (isset($_POST['updateWorkSpace'])) {
  $worksapce=$_POST['wname'];
  $wlogo=$_POST['wlogo'];
  $id=$_POST['hidId'];
  $image=$_FILES['image']['tmp_name'];
  $imageName=$_FILES['image']['name'];
  if($imageName==''){
    $filename=$wlogo;
  }else{
    $filename=$imageName;
    $location="assets1/img/workspace/".$imageName;
    move_uploaded_file($image,$location);
  }
  $qry="update worksapce set `logo`='$filename',`name`='$worksapce' where id='$id'";
  $exec=mysqli_query($con,$qry);
  if($exec){
    header('location:workspace.php?msg=upd');
  }else{
    header("location:workspace.php?msg=err");
  }
}
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$pid=base64_decode($did);
$delQry=mysqli_query($con,"delete from `user` where `id`='$pid'");
if($delQry){
header("location:workspace.php?msg=dls");
}else{
header("location:workspace.php?msg=err");
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
  elseif($msg=='err2'){
		$msgText='<strong> ERROR </strong>:Email is exits!!! ';
		$class="danger";
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
  <title>GoFeeds Workspace </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="assets1/css/datatable.css">
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
          <h6 class="font-weight-bolder text-white mb-0">Workspace</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>

    <div class="container-fluid py-4">

    <div class="row">
      <div class="col-12">

        <div class="card">
          <!-- Card header -->
          <div class="card-header pb-0">
            <?php if(isset($_GET['msg'])) {?>
         <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert">
    <?=$msgText?></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php }?>
            <div class="d-lg-flex">
                <div class="col-auto">
                  <div class="avatar avatar-xl position-relative">
                      <?php if ($num>0){?>
                    <img src="assets1/img/workspace/<?=$fetch['logo']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                      <?php }else{ ?>
                        <img src="assets1/img/favicon.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        <?php } ?>
                  </div>
                </div>
                <div class="col-auto my-auto">
                  <div class="h-100  ml-2">
                    <h5 class="mb-1">
                                      <?php if ($num>0){?> <?= $fetch['name']?> <?php }else{ ?> Wroksapce Name  <?php } ?>

                    </h5>
                  </div>
                </div>

              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <?php if ($num>0){?>
                    <button type="button" class="btn bg-gradient-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                    Update  Workspace
                   </button>
                   <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog mt-lg-10">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="ModalLabel">Update Worksapce</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form class="" method="post" enctype="multipart/form-data">
                           <div class="row">
                             <div class="col-md-6">
                                 <div class="avatar avatar-xl position-relative">
                                <img src="assets1/img/workspace/<?= $fetch['logo']?>" alt="images" class="w-100 border-radius-lg shadow-sm"  id="profileImg">
                                <label for="image" href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                                                  <i class="ni ni-cloud-upload-96" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" title="Edit Image" ></i>
        <input type="file" name="image" style="display:none" id="image" accept="image/gif,image/jpeg,image/jpg,image/png"  onchange="loadFile(event)">
        </label>
                              </div>

                             </div>
                             <div class="col-md-6">
                               <label for="wname">Workspace Name</label>
                               <input type="text" name="wname" id="wname" value="<?= $fetch['name']?>" class="form-control">
                               <input type="hidden" name="wlogo" id="wlogo" value="<?= $fetch['logo']?>" class="form-control">
                                <input type="hidden" name="hidId" id="hidId" value="<?= $fetch['id']?>" class="form-control">
                                    <input type="hidden" name="uid" id="uid" value="<?= $userId?>" class="form-control">
                             </div>
                             <div class="col-md-12">
                                 <label class="custom-control-label" >Allowed JPG, GIF or PNG. Max size of 800kB</label>
                             </div>
                           </div>
                           <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                             <label class="custom-control-label" for="importCheck">I accept the terms and conditions</label>
                           </div>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                           <button type="submit" name="updateWorkSpace" class="btn bg-gradient-primary btn-sm">Save</button>
                         </div>
                          </form>
                       </div>
                     </div>
                   </div>
                   <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#adduser">
                  Add User
                  </button>
                  <div class="modal fade" id="adduser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog mt-lg-10">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalLabel">Add New User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="" method="post" id="userform" name="userform">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12">
                              <label for="uname">User Name</label>
                              <input type="text" name="uname" id="uname" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                              <label for="email">Email</label>
                              <input type="email" name="email" id="email" value="" class="form-control">
                              <input type="hidden" name="wid" id="wid" value="<?=$fetch['id']?>" class="form-control">
                                <input type="hidden" name="exp" id="exp" value="<?=$userDetails['expiry']?>" class="form-control">
                            </div>
                            <div class="col-md-6">
                              <label for="mobile">Mobile</label>
                              <input type="text" name="mobile" id="mobile" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                              <label for="password">Password</label>
                              <input type="password" name="password" id="password" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                              <label for="cnfpwd">Confirm Password</label>
                              <input type="password" name="cnfpwd" id="cnfpwd" value="" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="adduser" class="btn bg-gradient-primary btn-sm">Save</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#workspace">
                    Create  Workspace
                   </button>
                   <div class="modal fade" id="workspace" tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog mt-lg-10">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="ModalLabel"> Create Worksapce</h5>

                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form class="" method="post" enctype="multipart/form-data" id="createworkspaceForm">
                           <div class="row">
                             <div class="col-md-6">
                                 <div class="avatar avatar-xl position-relative">
                                <img src="assets1/img/workspace/workspace.png" alt="images" class="w-100 border-radius-lg shadow-sm"  id="profileImg">
                                <label for="image" href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                    <i class="ni ni-cloud-upload-96" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" title="Edit Image" ></i>
        <input type="file" name="image" style="display:none" id="image" accept="image/gif,image/jpeg,image/jpg,image/png"  onchange="loadFile(event)">
        </label>
                              </div>

                             </div>
                             <div class="col-md-6">
                               <label for="wname">Workspace Name</label>
                               <input type="text" name="wname" id="wname" value="" class="form-control">
                                 <input type="hidden" name="uid" id="uid" value="<?= $userId?>" class="form-control">
                             </div>
                             <div class="col-md-12">
                                 <label class="custom-control-label" >Allowed JPG, GIF or PNG. Max size of 800kB</label>
                             </div>
                           </div>
                           <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                             <label class="custom-control-label" for="importCheck">I accept the terms and conditions</label>
                           </div>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                           <button type="submit" name="workspace" class="btn bg-gradient-primary btn-sm">Create</button>
                         </div>
                          </form>
                       </div>
                     </div>
                   </div>
                <?php } ?>
              </div>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pb-0">
              <?php if ($num>0){?>
            <div class="table-responsive">
              <table class="table table-flush" id="products-list">
                <thead class="thead-light">
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $wid=$fetch['id'];
                  $qry=mysqli_query($con,"select * from user where wid='$wid' order by id desc");
                    $sl=0;
                    $num_rows=mysqli_num_rows($qry);
                    if($num_rows>0) {
                    while ($user=mysqli_fetch_array($qry)) {
                    $sl++;
                   ?>
                  <tr>
                    <td class="text-sm"><?= $sl?></td>
                    <td>
                      <div class="d-flex px-2 py-1">
                          <div>
                            <img src="assets1/img/1.png" class="avatar avatar-sm me-3" alt="<?=$user['name']?>">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$user['name']?></h6>
                          </div>
                        </div>
                      </td>
                    <td class="text-sm"><?= $user['email_id']?></td>
                    <td class="text-sm"><?= $user['contact_no']?></td>
                    <td class="text-sm"><?= date('M d, Y', strtotime($user['created_date'])) ?></td>
                    <td class="text-sm"><?php echo getuserStatus($user['is_active']); ?></td>

                    <td class="text-sm">
                      <a href="viewuser.php?uid=<?=base64_encode($user['id'])?>" class=" badge badge-sm bg-gradient-success" title="Preview ">
                      <i class="fa-solid fa-desktop"></i>
                      </a>
                      <a href="edituser.php?uid=<?=base64_encode($user['id'])?>" class=" badge badge-sm bg-gradient-info" title="Edit User">
                      <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a href="workspace.php?did=<?=base64_encode($user['id'])?>" onClick="return confirm(' Are you sure you want to delete !!')" class="badge badge-sm bg-gradient-danger" title="Delete User">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php }}else{  ?>
                <tr><td colspan="7" align="center">--No user found--</td></tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </main>
<?php include 'include/script.php' ?>
<script src="assets1/js/plugins/datatables.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script>
$(document).ready(function() {
$('#userform').validate({
	rules: {
	uname: "required",
  email:{
    required:true;
    email:true;
  },
mobile: {
  required:true,
	number: true,
	minlength: 10,
	maxlength: 10
	},
  password: {
  	required: true,
  	minlength: 6,

  },
    cnfpwd: {
    	required: true,
    	minlength: 6,

      equalTo: "#password"
    	}
	},
	messages: {
	uname: "User name required",
  email:"Email required",
	contact: {
	minlength: "Please enter 10 digit contact no",
	maxlength: "Please enter 10 digit contact no"
	},
  password:{
	required:"Please enter new password",
	minlength:"Password should be minimum 5 digit."
} ,
cnfpwd:{
	required: "Please enter retype  password",
	minlength: "Password should be minimum 5 digit.",
	equalTo: "Please should be the same as new password"
}
	},
submitHandler: function(form) { // for demo
	form.submit();
}
});
});
</script>
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
