<?php
ob_start();
session_start();
//$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
if(isset($_POST['submit']))
	{
		$email=$_POST['email'];
		$apwd=md5($_POST['password']);
			$admres=mysqli_query($con,"select * from `admin` where `email_id`='$email' and `password`='$apwd' ");
      $numrows=mysqli_num_rows($admres);
			if($numrows>0)
			{   $adm=mysqli_fetch_row($admres);$aid=$adm[0];
		      $_SESSION['aid']=$aid;
						header("location:dashboard.php");
			}
			else
			{
					header("location:index.php?msg=inf");
			}


		}
if(isset($_GET['msg'])&&$_GET['msg']!=''){
	$msg=$_GET['msg'];
	if($msg=='inf'){
		  $class="danger";
		$msgText="Invalid Credential";
	}elseif($msg=='cpt'){
		  $class="danger";
		$msgText="Wrong captcha";
	}elseif($msg=='exp'){
		  $class="danger";
		$msgText="Your Session is expired login again";
	}
	elseif($msg=='na'){
		  $class="danger";
		$msgText="This IP address is not allowed";
	}else{
		$msgText='';
	}
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>FeedPlay | Admin</title>
  <link rel="icon" href="../assets1/img/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets1/css/nuceloicon.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets1/css/gofeed.css" type="text/css">
</head>
<body >
	<main class="main-content main-content-bg mt-0">
	<div class="page-header min-vh-100" style="background-image: url('../assets1/img/pricing-header-bg.jpg');">
		<span class="mask bg-gradient-dark opacity-6"></span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-4 col-md-7">
					<div class="card border-0 mb-0">
						<div class="card-header bg-transparent">
							<a class="navbar-brand m-0 text-center" href="dashboard-2.html" target="_blank">
		            <img src="../assets1/img/logo.png" class="navbar-brand-img h-100" alt="main_logo" style="width:55%">
		            <!-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> -->
		          </a>
							<h5 class="text-dark text-center mt-2 mb-3">Admin Sign in</h5>
						</div>
						<div class="card-body px-lg-5 pt-0">
							<?php if(isset($_GET['msg'])) {?>
					 			<div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert"><?=$msgText?></span></div>
							<?php } ?>
							<form role="form" class="text-start" method="post">
								<div class="mb-3">
									<input type="email" name="email" class="form-control" required placeholder="Email" aria-label="Email">
								</div>
								<div class="mb-3">
									<input type="password" name="password" class="form-control" required placeholder="Password" aria-label="Password">
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" id="rememberMe">
									<label class="form-check-label" for="rememberMe">Remember me</label>
								</div>
								<div class="text-center">
									<button type="submit" name="submit" class="btn btn-primary w-100 my-4 mb-2">Sign in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
<?php include 'include/script.php' ?>
<script type="text/javascript">
$(document).ready(function() {
$(".alert").fadeTo(2000, 500).slideUp(500, function() {
	$(".alert").slideUp(500);
});
</script>
</html>
