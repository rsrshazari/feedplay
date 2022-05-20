<?php $page=basename($_SERVER['PHP_SELF']); ?>
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
         <a class="navbar-brand m-0" href="dashboard.php" >
           <img src="../assets1/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
         </a>
       </div>
       <hr class="horizontal dark mt-0">
       <div class="collapse navbar-collapse  w-auto h-auto ps " id="sidenav-collapse-main">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link <?php if($page=='dashboard.php'){?>active <?php } ?> " href="dashboard.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-home text-success text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Dashboard</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='package.php'||$page=='addpackage.php'){?>active <?php } ?>" href="package.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-crown text-danger text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Packege</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='users.php'||$page=='edituser.php'||$page=='viewuser.php'){?>active <?php } ?> " href="users.php" >
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-users text-warning text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Users</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link  <?php if($page=='all-feeds.php'){?>active <?php } ?>" href="all-feeds.php" >
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fas fa-list-squares text-info text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">All Feeds</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='audios.php'){?>active <?php } ?>" href="audios.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-note-03 text-danger text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">All Audio</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='workspace.php'){?>active <?php } ?>" href="workspace.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="ni ni-planet text-primary text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Workspace</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='brands.php'){?>active <?php } ?>" href="brands.php">
               <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="fa-solid fa-copyright text-secondary text-sm opacity-10"></i>
               </div>
               <span class="nav-link-text ms-1">Brands</span>
             </a>
           </li>
         </ul>
       </div>
     </aside>
