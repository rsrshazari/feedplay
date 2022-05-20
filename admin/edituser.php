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
if (isset($_GET['uid'])&&$_GET['uid']!='') {
  $uid=base64_decode($_GET['uid']);
  $userDetails=mysqli_fetch_array(mysqli_query($con,"select * from user where id=$uid"));
}
if (isset($_POST['basic'])) {
  $hidId=$_POST['hidId'];
  $name=$_POST['uName'];
  $email=$_POST['email'];
  $bio=$_POST['bio'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $image=$_FILES['image']['tmp_name'];
  $imageName=$_FILES['image']['name'];
  if($imageName==''){
    $filename=$_POST['imgId'];
  }else{
    $filename=$imageName;
    $location="../assets1/img/user/".$imageName;
    move_uploaded_file($image,$location);
  }
  $qry="update user set `name`='$name',`email_id`='$email',`contact_no`='$phone',`bio`='$bio',`photo`='$filename',`address`='$address' where id='$hidId'";
  $exec=mysqli_query($con,$qry);
  if($exec){
    header('location:users.php?msg=upd');
  }else{
    header("location:users.php?msg=err");
  }
}
if (isset($_POST['password_submit'])) {
  $hidId=$_POST['hidId'];
  $password=md5($_POST['password']);
  $qry="update user set `password`='$password' where id='$hidId'";
  $exec=mysqli_query($con,$qry);
  if($exec){
    header('location:users.php?msg=upd');
  }else{
    header("location:users.php?msg=err");
  }
}

if (isset($_POST['social_submit'])) {
  $hidId=$_POST['hidId'];
  $twitter=$_POST['twitter'];
  $linkedin=$_POST['linkedin'];
  $website=$_POST['website'];
  $instagram=$_POST['instagram'];
  $facebook=$_POST['facebook'];
  $qry="update user set `twitter`='$twitter',`linkedin`='$linkedin',`website`='$website',`instagram`='$instagram',`facebook`='$facebook' where id='$hidId'";
  $exec=mysqli_query($con,$qry);
  if($exec){
    header('location:users.php?msg=upd');
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
          <h6 class="font-weight-bolder text-white mb-0">Edit User</h6>
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
              <div class="col-lg-3">
                <div class="card position-sticky top-1">
                  <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                        <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Profile</span>
                      </a>
                    </li>
                    <li class="nav-item pt-2">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                        <i class="ni ni-books me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Basic Info</span>
                      </a>
                    </li>
                    <li class="nav-item pt-2">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#password">
                        <i class="ni ni-atom me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Change Password</span>
                      </a>
                    </li>

                    <li class="nav-item pt-2">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#accounts">
                        <i class="ni ni-badge me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Social Accounts</span>
                      </a>
                    </li>
                    <li class="nav-item pt-2">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#notifications">
                        <i class="ni ni-bell-55 me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Notifications</span>
                      </a>
                    </li>

                    <li class="nav-item pt-2">
                      <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                        <i class="ni ni-userss-gear-65 me-2 text-dark opacity-6"></i>
                        <span class="text-sm">Delete Account</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-9 mt-lg-0 mt-4">
                <!-- Card Profile -->
                  <form class=""  method="post" enctype="multipart/form-data">
                <div class="card card-body" id="profile">
                  <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                      <div class="avatar avatar-xl position-relative">
                        <?php if ($userDetails['photo']==''){ ?>
                              <img id="profileImg" src="../assets1/img/user/1.png" alt="<?=$userDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
                        <?php }else{ ?>
                      <img id="profileImg" src="../assets1/img/user/<?=$userDetails['photo']?>" alt="<?=$userDetails['name']?>" class="w-100 border-radius-lg shadow-sm">
                    <?php } ?>
                        <label for="image" href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                        <i class="ni ni-cloud-upload-96" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" title="Edit Image" ></i>
                        <input type="file" name="image" style="display:none" id="image" accept="image/gif,image/jpeg,image/jpg,image/png"  onchange="loadFile(event)">
                      </label>
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
                <!-- Card Basic Info -->
                <div class="card mt-4" id="basic-info">
                  <div class="card-header">
                    <h5>Basic Info</h5>
                  </div>
                  <div class="card-body pt-0">
                    <input type="hidden" name="imgId" value="<?=$userDetails['photo']?>">
                    <input type="hidden" name="hidId" value="<?=$userDetails['id']?>">
                      <div class="row">
                      <div class="col-12">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                          <input id="uName" name="uName" class="form-control" value="<?=$userDetails['name']?>" type="text" placeholder="Alec" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label class="form-label mt-4">Email</label>
                        <div class="input-group">
                          <input id="email" name="email" class="form-control" type="email" value="<?=$userDetails['email_id']?>" placeholder="example@email.com" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="form-label mt-4">Confirmation Email</label>
                        <div class="input-group">
                          <input id="confirmation" name="confirmation" class="form-control" type="email" placeholder="example@email.com" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label class="form-label mt-4">Your location</label>
                        <div class="input-group">
                          <input id="address" name="address" class="form-control" type="text" value="<?=$userDetails['address']?>" placeholder="Sydney, A" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="form-label mt-4">Phone Number</label>
                        <div class="input-group">
                          <input id="phone" name="phone" class="form-control" type="number" value="<?=$userDetails['contact_no']?>" placeholder="+40 735 631 620" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <label class="form-label mt-4">Bio</label>
                        <div class="input-group">
                          <textarea name="bio" id="bio" rows="8" cols="80" class="form-control"><?=$userDetails['bio']?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-end">
                          <button name="basic" id="basic" type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
                <div class="card mt-4" id="password">
                  <div class="card-header">
                    <h5>Change Password</h5>
                  </div>

                  <div class="card-body pt-0">
                      <form id="passwordForm"class="" method="post">
                    <label class="form-label">Current password</label>
                    <div class="form-group">
                      <input id="oldpwd" name="oldpwd" class="form-control" type="password" placeholder="Current password" onfocus="focused(this)" onfocusout="defocused(this)">
                      <input type="hidden" name="hidId" value="<?=$userDetails['id']?>">
                    </div>
                    <label class="form-label">New password</label>
                    <div class="form-group">
                      <input id="password" name="password" class="form-control" type="password" placeholder="New password" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <label class="form-label">Confirm new password</label>
                    <div class="form-group">
                      <input id="cnfpwd" name="cnfpwd" class="form-control" type="password" placeholder="Confirm password" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <h5 class="mt-5">Password requirements</h5>
                    <p class="text-muted mb-2">
                      Please follow this guide for a strong password:
                    </p>
                    <ul class="text-muted ps-4 mb-0 float-start">
                      <li>
                        <span class="text-sm">One special characters</span>
                      </li>
                      <li>
                        <span class="text-sm">Min 6 characters</span>
                      </li>
                      <li>
                        <span class="text-sm">One number (2 are recommended)</span>
                      </li>
                      <li>
                        <span class="text-sm">Change it often</span>
                      </li>
                    </ul>
                    <button type="submit" name="password_submit" id="password_submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                    </form>
                  </div>

                </div>
                <div class="card mt-4" id="accounts">
                  <div class="card-header">
                    <h5>Accounts</h5>
                    <p class="text-sm">Here you can setup and manage your integration userss.</p>
                  </div>

                  <div class="card-body">
                        <form id="socialForm" name="socialForm" class="" method="post">
                            <input type="hidden" name="hidId" value="<?=$userDetails['id']?>">
                    <div class="row">
                      <div class="col-12">
                        <label class="form-label">Website</label>
                        <div class="input-group">

                          <input id="website" name="website" class="form-control" value="<?=$userDetails['website']?>" type="text" placeholder="www.gofeeds.com" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label class="form-label">Twitter</label>
                        <div class="input-group">
                          <input id="twitter" name="twitter" class="form-control" value="<?=$userDetails['twitter']?>" type="text" placeholder="https://twitter.com/home?lang=en" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="form-label">Facebook</label>
                        <div class="input-group">
                          <input id="facebook" name="facebook" class="form-control" value="<?=$userDetails['facebook']?>" type="text" placeholder="Thompson" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label class="form-label mt-4">LinkedIn</label>
                        <div class="input-group">
                          <input id="linkedin" name="linkedin" class="form-control" type="text" value="<?=$userDetails['linkedin']?>" placeholder="example@email.com" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="form-label mt-4">Instagram</label>
                        <div class="input-group">
                          <input id="instagram" name="instagram" class="form-control" type="text" value="<?=$userDetails['instagram']?>" placeholder="example@email.com" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-end">
                        <input type="submit" name="social_submit" value="Save" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">
                      </div>
                    </div>
                      </form>
                  </div>

                </div>
                <!-- Card Notifications -->
                <div class="card mt-4" id="notifications">
                  <div class="card-header">
                    <h5>Notifications</h5>
                    <p class="text-sm">Choose how you receive notifications. These notification userss apply to the things you’re watching.</p>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table mb-0">
                        <thead>
                          <tr>
                            <th class="ps-1" colspan="4">
                              <p class="mb-0">Activity</p>
                            </th>
                            <th class="text-center">
                              <p class="mb-0">Email</p>
                            </th>
                            <th class="text-center">
                              <p class="mb-0">Push</p>
                            </th>
                            <th class="text-center">
                              <p class="mb-0">SMS</p>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="ps-1" colspan="4">
                              <div class="my-auto">
                                <span class="text-dark d-block text-sm">Mentions</span>
                                <span class="text-xs font-weight-normal">Notify when another user mentions you in a comment</span>
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault11">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault12">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault13">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="ps-1" colspan="4">
                              <div class="my-auto">
                                <span class="text-dark d-block text-sm">Comments</span>
                                <span class="text-xs font-weight-normal">Notify when another user comments your item.</span>
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault14">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault15">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault16">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="ps-1" colspan="4">
                              <div class="my-auto">
                                <span class="text-dark d-block text-sm">Follows</span>
                                <span class="text-xs font-weight-normal">Notify when another user follows you.</span>
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault17">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault18">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault19">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="ps-1" colspan="4">
                              <div class="my-auto">
                                <p class="text-sm mb-0">Log in from a new device</p>
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault20">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault21">
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                <input class="form-check-input" checked="" type="checkbox" id="flexSwitchCheckDefault22">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Card Sessions -->

                <!-- Card Delete Account -->
                <div class="card mt-4" id="delete">
                  <div class="card-header">
                    <h5>Delete Account</h5>
                    <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                  </div>
                  <div class="card-body d-sm-flex pt-0" style="justify-content: space-between;">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                      <div>
                        <div class="form-check form-switch mb-0">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault0">
                        </div>
                      </div>
                      <div class="ms-2">
                        <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                        <span class="text-xs d-block">I want to delete my account.</span>
                      </div>
                    </div>
                    <?php if ($userDetails['is_active']=='1'){ ?>
                      <a href='users.php?uid=<?php echo  base64_encode($userDetails['id'])?>&act=<?=$userDetails['is_active']?>'><button class="btn btn-outline-secondary mb-0 ms-auto" type="button" name="button">Block User</button></a>
                    <?php }else{ ?>
                    <a href='users.php?uid=<?php echo  base64_encode($userDetails['id'])?>&act=<?=$userDetails['is_active']?>'><button class="btn btn-outline-secondary mb-0 ms-auto" type="button" name="button">Activate User</button></a>
                      <?php } ?>
                    <a href='users.php?did=<?php echo base64_encode($userDetails['id'])?>'> <button onclick="return confirm('Are you sure want to delete!!')" class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete Account</button>
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
