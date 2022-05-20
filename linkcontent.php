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
if (isset($_GET['cid'])&&$_GET['cid']!='') {
  $cid=base64_decode($_GET['cid']);
  $qry=mysqli_query($con,"SELECT * FROM `chapter` where id=$cid");
  $fetch=mysqli_fetch_array($qry);
}
if(isset($_POST['publishBtn'])){
  $cname=$_POST['chaptername'];
  $authorname=$_POST['authorname'];
    $desp=$_POST['desp'];
      $cover=$_POST['cover'];
      $brand=$_POST['brand'];
      $uname=$_POST['username'];
      $password=$_POST['password'];
  $cid=$_POST['hidChapId'];
  $fid=$_POST['hidFeedId'];
  $qry="UPDATE `chapter` SET `name`='$cname',`image`='$cover',`color`='',`brand`='$brand',`desp`='$desp',`author`='$authorname',`status`='1',`username`='$uname',`password`='$password' WHERE id='$cid'";
  $qry1="update feeds set status='1' where id='$fid'";
  $exec=mysqli_query($con,$qry);
  $exec1=mysqli_query($con,$qry1);
  $chapid=base64_encode($cid);
  header("location:finished.php?cid=$chapid");

}
if (isset($_POST['highlight_Btn'])) {
$txt=$_POST['highlight_txt'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$qry="INSERT INTO `feed_highlight`(`ctime`, `content_id`, `chapter_id`, `feed_id`, `highlight`, `user_id`)
VALUES ('$ctime','$contentId','$chapterId','$feedId','$txt','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}

if (isset($_POST['quote_Btn'])) {
$quote=$_POST['quote'];
$author=$_POST['author'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$qry="INSERT INTO `feed_quote`(`ctime`,`content_id`, `chapter_id`, `feed_id`, `quote`,`author`, `user_id`)
VALUES ('$ctime','$contentId','$chapterId','$feedId','$quote','$author','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}
if (isset($_POST['defination_Btn'])) {
$defination=$_POST['defination_txt'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$qry="INSERT INTO `feed_defination`(`ctime`,`content_id`, `chapter_id`, `feed_id`, `defination`, `user_id`)
VALUES ('$ctime','$contentId','$chapterId','$feedId','$defination','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}
if (isset($_POST['image_Btn'])) {
$caption=$_POST['caption'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$image=$_FILES['image']['tmp_name'];
  $imageName=$_FILES['image']['name'];
if($imageName==''){
  $filename='worksapce.png';
}else{
  $filename=$imageName;
  $location="assets1/img/feed_image/".$imageName;
  move_uploaded_file($image,$location);
}
$qry="INSERT INTO `feed_image`(`ctime`,`content_id`, `chapter_id`, `feed_id`, `image`,`caption`, `user_id`)
VALUES ('$citme','$contentId','$chapterId','$feedId','$filename','$caption','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}
if (isset($_POST['profileBtn'])) {
$name=$_POST['name'];
$title=$_POST['title'];
$twitter=$_POST['twitter'];
$linkedIn=$_POST['linkedIn'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$image=$_FILES['proimage']['tmp_name'];
  $imageName=$_FILES['proimage']['name'];
if($imageName==''){
  $filename='worksapce.png';
}else{
  $filename=$imageName;
  $location="assets1/img/feed_profile/".$imageName;
  move_uploaded_file($image,$location);
}
$qry="INSERT INTO `feed_profile`(`ctime`, `content_id`, `chapter_id`, `feed_id`, `name`,`title`,`twitter`,`linkedin`,`image`, `user_id`)
VALUES ('$ctime','$contentId','$chapterId','$feedId','$name','$title','$twitter','$linkedIn','$filename','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}
if (isset($_POST['urlBtn'])) {
$source=$_POST['source'];
$urltitle=$_POST['urltitle'];
$url=$_POST['url'];
$chapterId=$_POST['hidChapId'];
$cId=explode('#',$_POST['hidContentId']);
$contentId=$cId[0];
$ctime=$cId[1];
$feedId=$_POST['hidFeedId'];
$image=$_FILES['image']['tmp_name'];
  $imageName=$_FILES['image']['name'];
if($imageName==''){
  $filename='worksapce.png';
}else{
  $filename=$imageName;
  $location="assets1/img/feed_url/".$imageName;
  move_uploaded_file($image,$location);
}
$qry="INSERT INTO `feed_url`(`ctime`, `content_id`, `chapter_id`, `feed_id`, `url`,`title`,`source`,`image`, `user_id`)
VALUES ('$ctime','$contentId','$chapterId','$feedId','$url','$urltitle','$source','$filename','$userId')";
mysqli_query($con,$qry);
$cid=base64_encode($chapterId);
header("location:linkcontent.php?cid=$cid");
}
?>
<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GoFeeds Chapter Link Content </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="assets1/css/custom.css">

</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Chapter Content </h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row mb-5">
              <div class="col-lg-8">
                <div class="card position-sticky top-1">
                  <div class="card-header pb-0">
                    <div class="d-lg-flex">
                      <div>
                        <h5 class="mb-0"><?=$fetch['name'] ?></h5>
                        <p class="text-sm mb-0">
                          Audio content after transcribing.
                        </p>
                      </div>
                          <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                               <span id="aplay" onclick="audio_hit()" class="btn btn-floating btn-large pulse" style="cursor:pointer"><i class="ni ni-button-play "></i></span>
                               <span id="apause" onclick="audio_hit2()" class="btn btn-floating btn-large pulse" style="display:none;cursor:pointer" ><i class="ni ni-button-pause "></i></span>
                               <audio id="amp" style="display:none;" preload="auto" loop="false" class="w-100" controls><source src="audio/<?= $fetch['audio_file']?>" type="audio/mp3"></audio>
                          </div>
                          </div>
                        </div>
                      </div>
                  <div class="card-body p-3 ">
                    <div class="text-area">
                      <div class="text-area-select">
                        <?php
                            $data=json_decode($fetch['content'], true);
                            foreach ($data  as  $value) {
                              $url=checkUrl($value['i'],$fetch['id']);
                              $quote=checkQuote($value['i'],$fetch['id']);
                              $high=checkHighlightTxt($value['i'],$fetch['id']);
                              $def=checkDefination($value['i'],$fetch['id']);
                              $image=checkImage($value['i'],$fetch['id']);
                              $profile=checkProfile($value['i'],$fetch['id']);
                              $id=$value['i'].'#'.$value['s'];
                              ?>
                            <?php if ($url==0&&$quote==0&&$high==0&&$def==0&&$image==0&&$profile==0){ ?>
                              <span id="<?=$id?>" onclick="feedPopup(this.id)" class="inner-text " data-backdrop="static" data-keyboard="false"  style="width:auto;" draggable="false"><?=$value['t']?></span>
                              <div style="display:inline;"></div>
                            <?php }else{ ?>
                           <span id="<?=$id?>"  class="inner-text activeText" data-backdrop="static" data-keyboard="false"  style="cursor:pointers;width:auto;" draggable="false"><?=$value['t']?></span>
                           <div style="display:inline;"></div>
                         <?php }} ?>

                      </div>
                    </div>
                      <div class="row">
                        <div class="button-row d-flex mt-4 col-12">
                          <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                          <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" data-bs-toggle="modal" data-bs-target="#PublishApp" data-backdrop="static" data-keyboard="false" type="button" title="Next">Next</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 preview">
                <p  id="pa1"></p>
                <?php $chapterId=$fetch['id']; ?>
                <?php $urlQry=mysqli_query($con,"select * from feed_url where chapter_id='$chapterId'") ;
                $quoteQry=mysqli_query($con,"select * from feed_quote where chapter_id='$chapterId'");
                $highlightQry=mysqli_query($con,"select * from feed_highlight where chapter_id='$chapterId'");
                $definationQry=mysqli_query($con,"select * from feed_defination where chapter_id='$chapterId'");
                $imageQry=mysqli_query($con,"select * from feed_image where chapter_id='$chapterId'");
                $profielQry=mysqli_query($con,"select * from feed_profile where chapter_id='$chapterId'");
                ?>
                <?php while($urlFetch=mysqli_fetch_array($urlQry)){ ?>
                  <div class="border p-2 d-flex mb-2 bg-white">
                  <div class="flex-shrink-0">
                    <img  alt="Image placeholder" class="avatar rounded-circle" src="assets1/img/feed_url/<?= $urlFetch['image']?>">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h6  class="h5 mt-0"><?= $urlFetch['title']?></h6>
                    <p  class="text-sm"><?= $urlFetch['source']?></p>
                    <div class="d-flex">

                    </div>
                  </div>
                </div>
                <?php } ?>
                    <?php while($quoteFetch=mysqli_fetch_array($quoteQry)){ ?>
                  <div class="border p-2 quote mb-2">
                      <p><?= $quoteFetch['quote']?></p>
                      <p style="text-align:right"><?= $quoteFetch['author']?></p>
                  </div>
                <?php } ?>
                    <?php while($highFetch=mysqli_fetch_array($highlightQry)){ ?>
                  <div class="border p-2 highlight mb-2">
                      <span><?= $highFetch['highlight']?></span>
                  </div>
                <?php } ?>
                  <?php while($defFetch=mysqli_fetch_array($definationQry)){ ?>
                  <div class="border p-2 defination mb-2">
                      <p><?=$defFetch['defination']?></p>
                  </div>
                  <?php } ?>
                  <?php while($imgFetch=mysqli_fetch_array($imageQry)){ ?>
                    <div class="image mb-2">
                          <img  alt="Image placeholder" class="img-fluid shadow" src="assets1/img/feed_image/<?=$imgFetch['image']?>">
                          <p id=""><?=$imgFetch['caption']?></p>
                    </div>
                  <?php } ?>
                    <?php while($profileFetch=mysqli_fetch_array($profielQry)){ ?>
                      <div class="border p-2 d-flex mb-2 bg-white">
                          <div class="flex-shrink-0">
                            <img alt="Image placeholder" class="avatar rounded-circle" src="assets1/img/feed_profile/<?=$profileFetch['image']?>">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h6 class="h5 mt-0"><?=$profileFetch['name']?></h6>
                            <p  class="text-sm"><?=$profileFetch['title']?></p>
                            <div class="d-flex">
                              <?php if ($profileFetch['twitter']!=='') {?>
                                <div>
                                  <a href="<?=$profileFetch['twitter']?>"><i  class="fa-brands fa-twitter cursor-pointer opacity-6"></i></a>
                                </div>
                                <?php   } ?>
                                <?php if ($profileFetch['linkedin']!=='') {?>
                                  <div  class="ml-2">
                                    <a href="<?=$profileFetch['linkedin']?>"><i  class="fa-brands fa-linkedin cursor-pointer opacity-6"></i></a>
                                  </div>
                                  <?php   } ?>
                            </div>
                          </div>
                        </div>
                  <?php } ?>
                  </div>
       </div>
     </div>
    </main>
  <?php include 'include/script.php' ?>
  <script src="assets1/js/multistep-form.js" charset="utf-8"></script>
<script src="assets1/js/choices.min.js"></script>
<script src="assets1/js/popper.min.js"></script>
  <div id="PublishApp" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Publish your feed</h6>
              <button type="button" class="close" data-bs-dismiss="modal">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
          <form class="" action="" method="post">
            <input type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
            <input type="hidden" name="hidChapId" value="<?=$fetch['id']?>"/>
            <div class="row">
              <div class="col-md-6">
                <label>Chapter Name</label>
                <input class=" form-control mb-3" name="chaptername" type="text" placeholder="" value="<?=$fetch['name'] ?>" required />
                <label>Author</label>
                <input class="form-control mb-3" type="text" name="authorname" placeholder="Eg. Tomson" />
                <label>Summary</label>
                <textarea name="desp" rows="3" cols="80" class="form-control"></textarea>
                <label for="">Select Brand</label>
                <select class="form-control" name="brand" id="brand">
                  <?php $brand=mysqli_query($con,"select * from brand where user_id='$userId'");
                      while($brandfetch=mysqli_fetch_array($brand)){
                   ?>
                   <option value="<?=$brandfetch['id']?>"><?=$brandfetch['name']?></option>
                   <?php } ?>
                   <option value="0">Default</option>
                </select>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <label for="">Cover Image</label>
                  <div class="col-sm-4 ">
                    <input type="radio" class="btn-check" name="cover" id="btncheck1" value="c1.png" checked>
                    <label class="btn  btn-outline-secondary border-2" for="btncheck1"><img class="avatar avatar-xl" src="assets1/img/c1.png" alt=""></label>
                  </div>
                  <div class="col-sm-4">
                    <input type="radio" name="cover" class="btn-check" id="btncheck2" value="c2.png">
                    <label class="btn  btn-outline-secondary border-2 " for="btncheck2"><img class="avatar avatar-xl" src="assets1/img/c2.png" alt=""></label>
                  </div>
                  <div class="col-sm-4 ">
                    <input type="radio" name="cover" class="btn-check" id="btncheck3" value="c3.png">
                    <label class="btn  btn-outline-secondary border-2" for="btncheck3"><img class="avatar avatar-xl" src="assets1/img/c3.png" alt=""></label>
                  </div>
                  <div class="col-sm-4 ">
                    <input type="radio" name="cover" class="btn-check" id="btncheck4" value="c4.png">
                    <label class="btn  btn-outline-secondary border-2" for="btncheck4"><img class="avatar avatar-xl" src="assets1/img/c4.png" alt=""></label>
                  </div>
                  <div class="col-sm-4 ">
                    <input type="radio" name="cover" class="btn-check" id="btncheck5" value="c5.png">
                    <label class="btn  btn-outline-secondary border-2" for="btncheck5"><img class="avatar avatar-xl" src="assets1/img/c5.png" alt=""></label>
                  </div>
                  <div class="col-sm-4 ">
                    <input type="radio" name="cover" class="btn-check" id="btncheck6" value="c6.png">
                    <label class="btn  btn-outline-secondary border-2" for="btncheck6"><img class="avatar avatar-xl" src="assets1/img/c6.png" alt=""></label>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                  <label>User Name</label>
                  <input class=" form-control mb-1" name="uname" type="text" required placeholder="" />
                  <label>Password</label>
                  <input class="form-control mb-1" type="password" name="password" placeholder="" required/>
                </div>
                </div>

              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="publishBtn" class="btn bg-gradient-primary btn-sm">Publish</button>
          </div>
            </form>
        </div>
          </div>
      </div>
    </div>
  </div>
  <div id="RecordApp" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Add Feed Card</h6>
              <button type="button" class="close" data-bs-dismiss="modal">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-2  " style="">
                <ul class="nav  border-radius-lg pt-1">
                  <li class="nav-item">
                    <a class="nav-link text-body d-flex align-items-center active" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#url">
                      <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                      <span class="text-sm">URL</span>
                    </a>
                  </li>
                  <li class="nav-item pt-2">
                    <a class="nav-link text-body d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#quote">
                      <i class="ni ni-books me-2 text-dark opacity-6"></i>
                      <span class="text-sm">Quote</span>
                    </a>
                  </li>
                  <li class="nav-item pt-2">
                    <a class="nav-link text-body d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#highlight">
                      <i class="ni ni-caps-small me-2 text-dark opacity-6"></i>
                      <span class="text-sm">Highlight</span>
                    </a>
                  </li>

                  <li class="nav-item pt-2 ">
                    <a class="nav-link text-body d-flex align-items-center " data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#defination">
                      <i class="ni ni-badge me-2 text-dark opacity-6"></i>
                      <span class="text-sm">Defination</span>
                    </a>
                  </li>
                  <li class="nav-item pt-2">
                    <a class="nav-link text-body d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#imagecard">
                      <i class="ni ni-image me-2 text-dark opacity-6"></i>
                      <span class="text-sm">Image</span>
                    </a>
                  </li>

                  <li class="nav-item pt-2">
                    <a class="nav-link text-body d-flex align-items-center" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="preview" aria-selected="true">
                      <i class="ni ni-circle-08 me-2 text-dark opacity-6"></i>
                      <span class="text-sm">Profile</span>
                    </a>
                  </li>
                  <!-- <li class="nav-item pt-2">
                    <a class="nav-link text-body d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="preview" aria-selected="true" href="#list">
                      <i class="ni ni-bullet-list-67 me-2 text-dark opacity-6"></i>
                      <span class="text-sm">List</span>
                    </a>
                  </li> -->
                </ul>
              </div>
              <div class="col-10 tab-content" id="myTabContent">
                <div class="bg-gray-100 p-2 border br-radius tab-pane fade show active" role="tabpanel" aria-labelledby="url-tab"   id="url">
                    <h6>Add Url</h6>
                    <form class="" id="urlForm" name="urlForm"  method="post" enctype="multipart/form-data">
                      <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                      <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                      <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId" value="">
                      <div class="row  ">
                        <div class="col-6 ">
                          <label class="form-label">Url</label>
                          <div class="input-group">
                            <input id="url" name="url" class="form-control" value="" type="text" placeholder="http://google.com" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                          </div>
                          <label class="form-label">Title</label>
                          <div class="input-group">
                            <input id="urltitle" name="urltitle" class="form-control" value="" type="text" placeholder="Google" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                          </div>
                          <label class="form-label">Source</label>
                          <div class="input-group">
                            <input id="source" name="source" class="form-control" value="" type="text" placeholder="Alec" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                          </div>
                          <label class="form-label">Custom Image</label>
                          <div class="input-group">
                            <input id="image" name="image" class="form-control" value="" type="file" onchange="loadUrlFile(event)">
                          </div>
                        </div>
                        <div class="col-6 ">
                          <div class="border p-2 d-flex mb-2 bg-white">
                              <div class="flex-shrink-0">
                                <img id="imgUrlHolder" alt="Image placeholder" class="avatar rounded-circle" src="assets1/img/team-1.jpg">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                <h6 id="uTitle" class="h5 mt-0"></h6>
                                <p id="uSource" class="text-sm"></p>
                                <div class="d-flex">

                                </div>
                              </div>
                            </div>
                            <button id="urlBtn" name="urlBtn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>
                        </div>
                      </div>
                  </form>
                </div>
                <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="quote-tab"  id="quote">
                    <h6>Add Quote Card</h6>
                    <form class="" name="quoteForm" id="quoteForm" method="post">
                      <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                      <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                      <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId"  value="">

                      <div class="row  ">
                        <div class="col-6 ">

                      <label class="form-label">Quote</label>
                      <div class="input-group">
                        <textarea name="quote" id="quote"  class="form-control" rows="4" cols="80"></textarea>
                      </div>
                      <label class="form-label">Author(Optional)</label>
                      <div class="input-group">
                        <input id="author" name="author" class="form-control" value="" type="text" placeholder="Alex" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>

                    </div>
                    <div class="col-6 p-3 ">
                      <div class="border p-2 quote mb-2">
                          <p id="qot"></p>
                          <p id="aut" style="text-align:right"></p>
                      </div>
                        <button name="quote_Btn" id="quote_Btn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="highlight-tab"  id="highlight">
                    <h6>Add Highlight Card</h6>
                    <form class="" id="highlightForm" name="highlightForm" method="post">
                      <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                      <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                      <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId"  value="">
                  <div class="row  ">
                    <div class="col-6 ">
                      <label class="form-label">Highlight Text</label>
                      <div class="input-group">
                        <textarea name="highlight_txt" id="highlight_txt" class="form-control" rows="4" cols="80"></textarea>
                      </div>
                    </div>
                    <div class="col-6 p-3 ">
                      <div class="border p-2 highlight mb-2">
                          <span id="high"></span>
                      </div>
                        <button name="highlight_Btn" id="highlight_Btn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>
                    </div>
                  </div>
                </form>
                </div>
                <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="defination-tab"  id="defination">
                    <h6>Add Defination Card</h6>
                    <form class="" id="defForm" name="defForm" method="post">
                      <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                      <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                      <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId"  value="">

                  <div class="row  ">
                    <div class="col-6 ">
                      <label class="form-label">Defination Text</label>
                      <div class="input-group">
                        <textarea name="defination_txt" id="defination_txt" class="form-control" rows="4" cols="80"></textarea>
                      </div>
                    </div>
                    <div class="col-6 p-3 ">
                      <div class="border p-2 defination mb-2">
                          <span id="def">hidden</span>
                      </div>
                        <button id="defination_Btn" name="defination_Btn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="image-tab"  id="imagecard">
                    <h6>Add Image Card</h6>
                      <form class="" name="imageForm" id="imageForm"  method="post" enctype="multipart/form-data">
                        <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                        <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                        <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId"  value="">
                          <div class="row  ">
                            <div class="col-6 ">
                            <label class="form-label">Custom Image</label>
                            <div class="input-group">
                              <input id="image" name="image" class="form-control" value="" type="file" onchange="loadFile(event)" >
                            </div>
                            <label class="form-label">Caption(Optional)</label>
                            <div class="input-group">
                              <input id="caption" name="caption" class="form-control" value="" type="text" placeholder="Alex" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                            </div>
                            <div class="col-6 p-3 ">
                              <div class="border p-2 image mb-2">
                                    <img id="imgHolder" alt="Image placeholder" class="avatar avatar-xl shadow" src="assets1/img/feed_image/team-1.jpg">
                                    <p id="imgCaption"></p>
                              </div>
                                <button id="image_Btn" name="image_Btn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>

                              </div>
                      </form>
                  </div>
                </div>
                <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="profile-tab"  id="profile">
                    <h6>Add Profile Card</h6>
                    <form name="profileForm" id="profileForm" enctype="multipart/form-data" method="post">
                      <input id="hidChapId" type="hidden" name="hidChapId" value="<?=$fetch['id']?>">
                      <input id="hidFeedId" type="hidden" name="hidFeedId" value="<?=$fetch['feed_id']?>">
                      <input id="hidContentId" type="hidden" name="hidContentId" class="hidContentId" value="">

                  <div class="row  ">
                    <div class="col-6 ">
                      <label class="form-label">Custom Image</label>
                      <div class="input-group">
                        <input id="proimage" name="proimage" class="form-control" value="" type="file" onchange="loadProFile(event)" >
                      </div>
                      <label class="form-label">Name</label>
                      <div class="input-group">
                        <input id="name" name="name" class="form-control" value="" type="text" placeholder="Alex" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                      <label class="form-label">Expertise Or Title</label>
                      <div class="input-group">
                        <input id="title" name="title" class="form-control" value="" type="text" placeholder="Google" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                      <label class="form-label">Twitter</label>
                      <div class="input-group">
                        <input id="twitter" name="twitter" class="form-control" value="" type="text" placeholder="Alec" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                      </div><label class="form-label">LinkedIn</label>
                      <div class="input-group">
                        <input id="linkedIn" name="linkedIn" class="form-control" value="" type="text" placeholder="Alec" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                    </div>
                    <div class="col-6 ">

                      <div class="border p-2 d-flex mb-2 bg-white">
                          <div class="flex-shrink-0">
                            <img id="imgProfileHolder" alt="Image placeholder" class="avatar rounded-circle" src="assets1/img/feed_profile/team-1.jpg">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h6 id="pName" class="h5 mt-0"></h6>
                            <p id="pTitle" class="text-sm"></p>
                            <div class="d-flex">
                              <div>
                                <i id="tid" style="display:none" class="fa-brands fa-twitter cursor-pointer opacity-6"></i>
                              </div>

                              <div class="ml-2">
                                <i id="lid" style="display:none" class="fa-brands fa-linkedin  cursor-pointer opacity-6"></i>
                              </div>

                            </div>
                          </div>
                        </div>
                        <button id="profileBtn" name="profileBtn" class="btn bg-gradient-dark right-bottom" type="submit" title="Next">Next</button>

                    </div>
                    </div>
                  </form>
                </div>
                <!-- <div class="tab-pane fade bg-gray-100 p-2 border br-radius" role="tabpanel" aria-labelledby="list-tab"  id="list">
                    <h6>Add List Card</h6>
                  <div class="row  ">
                    <div class="col-6 ">
                      <label class="form-label">List Text</label>
                      <div class="input-group">
                        <input type="text" name="lis_txt" id="list_txt" class="form-control" />
                      </div>
                    </div>
                    <div class="col-6 p-3 ">
                      <div class="border p-2 defination mb-2">
                          <span id="high">Sanjeev Kumar</span>
                      </div>
                        <button class="btn bg-gradient-dark right-bottom" type="button" title="Next">Next</button>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
 var pDiv = document.getElementById('pa1');
// $(document).ready(function(){
//   var a=33;
//   $.ajax({url:"getTranscriptFile.php",type:"GET",data: { id: a},success:function(b){
//   console.log(b);
//    console.log(b.subtitle[0]['s']);
//   $("#amp").on(
//     "timeupdate",
//     function(event){
//       var ct=this.currentTime.toString().split('.')[0];
//       var ctime=this.currentTime.toFixed(1);
//       //console.log(this.currentTime.toFixed(1)+" "+b.subtitle['s']);
//       //  pDiv.innerHTML =this.currentTime;
//       onTrackedVideoFrame(ctime, this.currentTime,b);
//   });
// }});
// });
// function onTrackedVideoFrame(currentTime, duration,b){
//   for (var i = 0; i < b.subtitle.length; i++) {
//     var sid="#"+i;
//      //$(sid).addClass("activeText");
//     var ttime=b.subtitle[i]['s'];
//     var x=parseFloat(ttime);
//   //   console.log(x+" "+currentTime);
//    if (x==currentTime) {
//      $(sid).addClass("activeText");
//   }else{
//     $('.inner-text').removeClass("activeText");
//   }
// }
// }
// function GetSubtitle(rtime,txtary){
//   var res;
//     pDiv.innerHTML =txtary.subtitle[i]['s'];
//     res=txtary.subtitle[i]['t'];
//   if (txtary.subtitle[i]['s']==rtime) {
//
//     //   $('.inner-text').removeClass("activeSub");
//     // var sid="#"+txtary.subtitle[i]['id']+"_"+txtary.subtitle[i]['st']
//      res=txtary.subtitle[i]['t'];
//     //   $(sid).addClass("activeSub");
//     // break;
//   }else{
//        res=txtary.subtitle[i]['t'];
//   }
// }
// return res;
// }
function audio_hit() {
$('#apause').show();
$('#aplay').hide();
document.getElementById('amp').play();
}
function audio_hit2() {
$('#apause').hide();
$('#aplay').show();
document.getElementById('amp').pause();
}
</script>
<script>
var loadFile = function(event) {
var image = document.getElementById('imgHolder');
image.src = URL.createObjectURL(event.target.files[0]);
};
var loadProFile = function(event) {
var image = document.getElementById('imgProfileHolder');
image.src = URL.createObjectURL(event.target.files[0]);
};
var loadUrlFile = function(event) {
var image = document.getElementById('imgUrlHolder');
image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('.modal').modal({
  backdrop: 'static',
  keyboard: false
});
  $("#urltitle").keyup(function(){
    var v=$('#urltitle').val();
    $("#uTitle").html(v);
  });
  $("#source").keyup(function(){
    var v=$('#source').val();
    $("#uSource").html(v);
  });
$("textarea#quote").keyup(function(){
  var v=$('textarea#quote').val();
  $("#qot").html(v);
});
$("#author").keyup(function(){
  var v=$('#author').val();
  $("#aut").html(v);
});
$("#highlight_txt").keyup(function(){
  var v=$('#highlight_txt').val();
  $("#high").html(v);
});
$("#defination_txt").keyup(function(){
  var v=$('#defination_txt').val();
  $("#def").html(v);
});
$("#caption").keyup(function(){
  var v=$('#caption').val();
  $("#imgCaption").html(v);
});
$("#name").keyup(function(){
  var v=$('#name').val();
  $("#pName").html(v);
});
$("#title").keyup(function(){
  var v=$('#title').val();
  $("#pTitle").html(v);
});
$("#twitter").keyup(function(){
  var v=$('#twitter').val();
  if (v!='') {
    $('#tid').show();
  }else{
        $('#tid').hide();
  }
});
$("#linkedIn").keyup(function(){
  var v=$('#linkedIn').val();
  if (v!='') {
    $('#lid').show();
  }else{
        $('#lid').hide();
  }
});
});
function feedPopup(id){
  $('.hidContentId').val(id);
  $("#RecordApp").modal('show');
}
</script>
  </body>
  </html>
