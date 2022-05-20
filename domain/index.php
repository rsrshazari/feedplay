<?php
ob_start();
session_start();
$con=mysqli_connect('localhost','admin_feedplay','Manish#6706','admin_feedplay')or die('can\'t establish connection with mysqli');
$domain=$_SERVER['SERVER_NAME'];
$domainQry=mysqli_fetch_array(mysqli_query($con,"select * from customdomain where domain='$domain'"));
$userId=$domainQry['user_id'];
$brand=mysqli_fetch_array(mysqli_query($con,"select * from brand where user_id='$userId'"));
function getChapterStatus($value){
	if($value==1){
		return '<span class="badge badge-pill badge-success"> Published</span>';
	}
	if($value==0){
		return '<span class="badge badge-pill badge-warning">In Draft</span>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$domain?> </title>
  <!-- <link rel="icon" href="https://feedplay.net/assets1/img/favicon.png" type="image/png"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="https://feedplay.net/assets1/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="https://feedplay.net/assets1/css/nuceloicon.css" type="text/css">
  <link rel="stylesheet" href="https://feedplay.net/assets1/css/gofeed.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="g-sidenav-show   bg-gray-100">
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
					<?php if($brand['logo']!='') {?>
          <img src="https://feedplay.net/assets1/img/logos/<?=$brand['logo']?>" alt=" " style="max-width: 25%;min-width: 25%;">
				<?php } ?>
        </nav>

      </div>
    </nav>
    <div class="container">
      <div class="row mt-4">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                    <div class="d-lg-flex">
                    <div>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                      <div class="ms-auto my-auto">
                    </div>
                    </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                    <div class="row">
                      <?php $sl=0;
                      $cqry=mysqli_query($con,"select * from chapter where status='1' and user_id='$userId'  order by id desc ");
                        $num=mysqli_num_rows($cqry);
                        if($num>0){
                          while ($chapter=mysqli_fetch_array($cqry)) {
                            $sl++;
                            $cid=base64_encode($chapter['id']);
                              $fid=base64_encode($chapter['feed_id']);
                            if($chapter['image']==''){
                              $image='c1.png';
                            }else{
                              $image=$chapter['image'];
                            }
                            ?>
                      <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100 card-blog card-plain border">
                          <div class="position-relative">
                            <div><a class="d-block shadow-xl border-radius-xl">

                              <img src="https://feedplay.net/assets1/img/<?= $image?>" alt="<?= $chapter['name']?>" class="img-fluid shadow border-radius-xl">
                            </a></div>
                            <div>
                            </div>
                          </div>
                          <div class="card-body px-1 pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="">
                                <p class="text-gradient text-dark mb-2 text-sm">#<?= $sl?> <?= $chapter['name']?></p>
                              </div>
                              <div class="mt-2 pr-2">
                                <a href="feed.php?cid=<?=$cid?>&fid=<?=base64_encode($fid)?>" ><i class="fa-solid fa-volume-high"></i></a>
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
                    <?php    }  }else{?>
											<div class="col-md-12" style="align-self:center">
												--No Feed Found--
											</div>
											<?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
  </main>
</body>
</html>
