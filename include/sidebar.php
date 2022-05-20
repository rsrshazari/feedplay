<?php $page=basename($_SERVER['PHP_SELF']);
$type=getUserTypeById($userId);
?>
<?php
if (isset($_POST['createfeed'])) {
$cname=$_POST['feedname'];
$date=date('Y-m-d ');
$time=date("h:i sa");
$id=$userId;
$qury=mysqli_query($con,"insert into feeds values(name,date,time,user_id,status)values('$cname','$date','$time','$id','0')");
if ($qury) {
$id=mysqli_insert_id($con);
$fid=base64_encode($id);
header("location:create-feed.php?fid=$fid");
}
}
 ?>
   <div class="min-height-300 bg-primary position-absolute w-100"></div>
   <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
       <div class="sidenav-header">
         <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
         <a class="navbar-brand m-0" href="dashboard-2.html" target="_blank">
           <img src="assets1/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
           <!-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> -->
         </a>
       </div>
       <hr class="horizontal dark mt-0">
       <div class="collapse navbar-collapse  w-auto h-auto ps " id="sidenav-collapse-main">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link <?php if($page=='dashboard.php'){?>active <?php } ?> " href="dashboard.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-gauge text-success text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Dashboard</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='create-feed.php'){?>active <?php } ?> " href="#" data-bs-toggle="modal" data-bs-target="#alertModal">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-microphone-lines text-warning text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Create Feed</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link  <?php if($page=='my-feeds.php'){?>active <?php } ?>" href="my-feeds.php" >
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fas fa-list-squares text-info text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">My Feeds</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='my-audios.php'){?>active <?php } ?>" href="my-audios.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-note-03 text-danger text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">My Audio</span>
             </a>
           </li>
           <?php if($type[0]=='1'){ ?>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='workspace.php'){?>active <?php } ?>" href="workspace.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-planet text-primary text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Workspace</span>
             </a>
           </li>
         <?php } ?>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='brand.php'){?>active <?php } ?>" href="brand.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-copyright text-secondary text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Brand</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='downloads.php'){?>active <?php } ?>" href="#">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-cloud-download-95 text-danger text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Download</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='add-domain.php'){?>active <?php } ?>" href="add-domain.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">

                 <i class="fa-solid fa-globe text-info text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Connect Domain</span>
             </a>
           </li>

           <!-- <li class="nav-item mt-3">
             <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
           </li>
           <li class="nav-item">
             <a class="nav-link " href="profile.html">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Profile</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link " href="sign-in.html">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Sign In</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link " href="sign-up.html">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-collection text-info text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Sign Up</span>
             </a>
           </li> -->
         </ul>
       </div>
       <div class="sidenav-footer mx-3 ">
         <div class="card card-plain shadow-none" id="sidenavCard">
           <img class="w-50 mx-auto" src="assets1/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
           <div class="card-body text-center p-3 w-100 pt-0">
             <div class="docs-info">
               <h6 class="mb-0">Need help?</h6>
               <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
             </div>
           </div>
         </div>
         <a href="#" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
         <a class="btn btn-primary btn-sm mb-0 w-100" href="pricing.php" type="button"><i class="fa-solid fa-crown"></i> Upgrade Packege</a>
       </div>
       <div id="createFeedModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
       <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
           <div class="modal-content">

               <div class="modal-header">
                   <h6 class="modal-title" id="modal-title-default">Create New Feed</h6>

               </div>
                 <form class="" action="cfeed.php" method="post">
               <div class="modal-body">
                   <div class="row">
                     <div class="col-12">
                       <label class="form-label">Feed Name</label>
                       <div class="input-group">
                         <input id="feedname" name="feedname" class="form-control"  type="text" placeholder="New Feed" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                       </div>
                     </div>
                   </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                 <button type="submit" name="createfeed" class="btn bg-gradient-primary btn-sm">Next</button>
               </div>
                </form>
           </div>
       </div>
       </div>
       <div id="alertModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
       <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h6 class="modal-title" id="modal-title-default">Alert!!</h6>
               </div>
               <div class="modal-body">
                   <div class="row">
                     <div class="col-12">
                       <h5>Your Feed Limit is exceed!</h5>
                 <p>Kindly update your package or contact to administrator</p>
                     </div>
                   </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>

               </div>

           </div>
       </div>
       </div>
     </aside>
