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
if (isset($_GET['fid'])&& $_GET['fid']!='') {
  $fid=base64_decode($_GET['fid']);
  $feed=mysqli_fetch_array(mysqli_query($con,"select * from feeds where id='$fid'"));
}
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$pid=base64_decode($did);
$fid=($_GET['fid']);
$delQry=mysqli_query($con,"delete from `chapter` where `id`='$pid'");
if($delQry){
header("location:viewfeed.php?msg=dls&fid=$fid");
}else{
header("location:viewfeed.php?msg=err&fid=$fid");
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
  <title>Feed Play | View Feed </title>
<?php include 'include/css.php' ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0"><?= $feed['name']."'s"?> Chapter</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row mt-4">
              <div class="col-12">
                <?php if(isset($_GET['msg'])) {?>
                 <div class="alert alert-<?= $class?> alert-dismissible fade show" role="alert"><?=$msgText?></span>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
               <?php }?>
                <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                    <div class="d-lg-flex">
                    <div>
                      <h5 class="mb-0"><?= $feed['name']?></h5>
                      <p class="text-sm mb-0">
                        All chapter created by user form <?= $feed['name']?> feed.
                      </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                      <div class="ms-auto my-auto">
                        <a  href="#" data-bs-toggle="modal" data-bs-target="#createChapterModal" class="btn bg-gradient-danger btn-sm mb-0" >Create New Chapter</a>
                    </div>
                    </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                    <div class="row">
                      <?php $fid=$feed['id'];$sl=0;
                      $cqry=mysqli_query($con,"select * from chapter where feed_id='$fid' order by id desc ");
                        $num=mysqli_num_rows($cqry);
                        if($num>0){
                          while ($chapter=mysqli_fetch_array($cqry)) {
                            $sl++;
                            $cid=base64_encode($chapter['id']);
                            if($chapter['image']==''){
                              $image='c1.png';
                            }else{
                              $image=$chapter['image'];
                            }
                            ?>
                      <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card h-100 card-blog card-plain border">
                          <div class="position-relative">
                            <div><a class="d-block shadow-xl border-radius-xl">

                              <img src="assets1/img/<?= $image?>" alt="<?= $chapter['name']?>" class="img-fluid shadow border-radius-xl">
                            </a></div>
                            <div>
                            </div>
                          </div>
                          <div class="card-body px-1 pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="">
                                <p class="text-gradient text-dark mb-2 text-sm">#<?= $sl?> <?= $chapter['name']?></p>
                              </div>
                              <div class="avatar-group mt-2 pr-2">
                                <div class="dropdown" style="padding-right:10px;cursor:pointer">
                                  <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php if ($chapter['audio_id']!=''&& $chapter['audio_file']!==''&& $chapter['content']!='') {?>
                                        <li><a href="linkcontent.php?cid=<?= $cid?> " class="dropdown-item" href="#">Edit</a></li>
                                    <?php }else{ ?>
                                        <li><a target="_blank" href="create-feed.php?cpid=<?= $cid?> " class="dropdown-item" href="#">Edit</a></li>
                                      <?php } ?>
                                    <?php  if($chapter['status']=='1'){ ?>
                                      <li><a href="feed.php?cid=<?=$cid?>&fid=<?=base64_encode($fid)?>" class="dropdown-item" >Listen</a></li>
                                      <?php } ?>
                                    <li><a href="viewfeed.php?did=<?=$cid?>&fid=<?=base64_encode($fid)?>" class="dropdown-item" >Delete</a></li>
                                  </ul>
                                  </div>
                              </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-1">
                              <div>
                                <!-- <p class="text-xs mb-0 text-secondary font-weight-bold">Sanjeev Hazari</p> -->
                                <?= getChapterStatus($chapter['status'])?>
                              </div>
                              <div class="avatar-group mt-2">
                                <span class="text-dark text-xs"><?= date('M d, Y', strtotime($chapter['date'])) ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php    }  }?>
                      <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card h-100 card-plain border">
                          <div class="card-body d-flex flex-column justify-content-center text-center">
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#createChapterModal">
                              <i class="fa fa-plus text-secondary mb-3"></i>
                              <h5 class=" text-secondary"> Create New Chapter </h5>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
  </main>
<?php include 'include/script.php' ?>
<div id="createChapterModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Create New Chapter</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
          <form class="" action="createchapter.php" method="post">
        <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <label class="form-label">Chapter Name</label>
                <div class="input-group">
                  <input type="hidden" name="hidFeedId" value="<?= $fid?>">
                  <input id="chaptername" name="chaptername" class="form-control"  type="text" placeholder="New Feed" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
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
</body>
</html>
