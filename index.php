<?php
ob_start();
session_start();
//$adminId=$_SESSION['aid'];
include_once("configuration/connect.php");
include_once("configuration/functions.php");
if(isset($_SESSION["usrid"])) {
if(isLoginSessionExpired()) {
header("Location:logout.php");
}
}
if(isset($_POST['submit']))
	{
		$email=$_POST['email'];
		$apwd=md5($_POST['password']);
			$admres=mysqli_query($con,"select * from `user` where `email_id`='$email' and `password`='$apwd' and is_active='1' ");
      $numrows=mysqli_num_rows($admres);
			if($numrows>0)
			{   $adm=mysqli_fetch_row($admres);$aid=$adm[0];
		      $_SESSION['usrid']=$aid;
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
		$msgText="Wrong Username Or Password";
	}elseif($msg=='cpt'){
		$msgText="Wrong captcha";
	}elseif($msg=='exp'){
		$msgText="Your Session is expired login again";
	}
	elseif($msg=='na'){
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
  <title>GoFeeds</title>
  <link rel="icon" href="assets1/img/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets1/css/nuceloicon.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets1/css/gofeed.css" type="text/css">

</head>
<body >
  <main class="main-content  mt-0">
   <section>
     <div class="page-header min-vh-100">
       <div class="container">
         <div class="row">
           <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ">
             <div class="card card-plain">
               <div class="">
                   <img src="assets1/img/logo.png" style="width:94%">
               </div>
               <div class="card-header pb-0 text-start">
                 <h4 class="font-weight-bolder">Sign In</h4>
                 <p class="mb-0">Enter email and password to sign in</p>
               </div>
               <div class="card-body">
                    <?php if(isset($_GET['msg'])) {?>
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">

     <?=$msgText?></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php }?>
                 <form role="form" method="post" >
                   <div class="mb-3">
                     <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email">
                   </div>
                   <div class="mb-3">
                     <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                   </div>
                   <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" id="rememberMe">
                     <label class="form-check-label" for="rememberMe">Remember me</label>
                   </div>
                   <div class="text-center">
                     <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                   </div>
                 </form>
               </div>
               <div class="card-footer text-center pt-0 px-lg-2 px-1">
                 <p class="mb-4 text-sm mx-auto">
                   Don't remember password?
                   <a href="reset.php" class="text-primary text-gradient font-weight-bold">Reset Password</a>
                 </p>
               </div>
             </div>
           </div>
           <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
             <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets1/img/signup-ill.jpg');
         background-size: cover;">
               <span class="mask bg-gradient-primary opacity-6"></span>
               <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
               <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
 </main>
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="assets/js/argon.min5438.js?v=1.2.0"></script>
</body>
</html>
