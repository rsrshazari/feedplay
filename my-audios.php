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
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$pid=base64_decode($did);
$delQry=mysqli_query($con,"delete from `audio` where `id`='$pid'");
if($delQry){
header("location:my-audios.php?msg=dls");
}else{
header("location:my-audios.php?msg=err");
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
  <title>GoFeeds My Audios </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="assets1/css/datatable.css">
<style media="screen">
	.list-wrapper{
		display:flex;
		flex-direction: column;
		border: 1px dashed red;
		text-align: center;
	}
</style>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">My Audios</h6>
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">All Audio</h5>
                <p class="text-sm mb-0">
                  All Audios bye uploading,recording and createing.
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <!-- <a href="create-feed.php" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">Create Audio</a> -->
              </div>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pb-0">
            <div class="table-responsive">
              <table class="table table-flush" id="products-list">
                <thead class="thead-light">
                  <tr>
                    <th>Sl.No</th>
                    <th>Audio</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $qry=mysqli_query($con,"select * from audio where user_id='$userId' order by id desc");
                    $sl=0;
                    $num_rows=mysqli_num_rows($qry);
                    if($num_rows>0) {
                    while ($fetch=mysqli_fetch_array($qry)) {
                    $sl++;
                   ?>
                  <tr>
                      <td class="text-sm"><?= $sl?></td>
                    <td>
                      <div class="d-flex px-2 py-1 pl-6">
                        <div class="iconDiv">
                          <span id="aplay<?= $fetch['id']?>" onclick="audio_hit('<?= $fetch['id']?>')" style="cursor:pointer"><i class="ni ni-button-play iconBtn"></i></span>
                          <span id="apause<?= $fetch['id']?>" onclick="audio_hit2('<?= $fetch['id']?>')" style="display:none;cursor:pointer" ><i class="ni ni-button-pause iconBtn"></i></span>
                          <audio id="amp<?= $fetch['id']?>" style="display:none;" preload="auto" loop="false" class="w-100" controls><source src="audio/<?= $fetch['file']?>" type="audio/mp3"></audio>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 ml-2 text-sm pl-5">    <?= $fetch['name']?></h6>
                        </div>
                      </div>
                    </td>
                    <td class="text-sm"><?= getAudioType($fetch['type'])?>  </td>
                    <td class="text-sm"><?= date('M d, Y', strtotime($fetch['date'])) ?></td>
                    <td class="text-sm">

                    <div class="badge badge-sm bg-gradient-primary  dropdown" >
                    	 <a style="color:#fff;text-decoration:none;cursor:pointer" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2" class="dropdown-toggle"><span class=""><i class="fa-solid fa-download"></i> Download</span></a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">

			<div class="row">
				<div class="col-md-6 m-1">
					<a class="list-wrapper" href="#">
					<i class="fa-solid fa-music"></i> Audio
					</a>
				</div>
				<div class="col-md-6 m-1 ">
					<a class="" href="#">
					<i class="fa-solid fa-file-code"></i> Json
					</a>
				</div>
				<div class="col-md-6 m-1 ">
					<a class="" href="#">
					<i class="fa-brands fa-html5"></i> HTML
				</a>
				</div>
				<div class="col-md-6 m-1 ">
					<a class="" href="#">
					<i class="fa-solid fa-file-lines"></i> TXT
					</a>
				</div>
				<div class="col-md-6 m-1 ">
					<a class="" href="#">
					<i class="fa-solid fa-file-word"></i> DOC
					</a>
				</div>
				<div class="col-md-6 m-1 ">
					<a class="" href="#">
					<i class="fa-solid fa-file"></i> SRT
					</a>
				</div>
			</div>


</div>

                    </div>
                      <a href="my-audios.php?did=<?=base64_encode($fetch['id'])?>" onClick="return confirm(' Are you sure you want to delete !!')" class="collection-item"><span class="badge badge-sm bg-gradient-danger" ><i class="fa-solid fa-trash"></i> Delete</span></a>
                    </td>
                  </tr>
                <?php }}else{  ?>
                <tr><td colspan="5" align="center">--No audio found--</td></tr>
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
  <script src="assets1/js/plugins/datatables.js"></script>
  <script type="text/javascript">
  function audio_hit(x) {
  $('#apause' + x).show();
  $('#aplay' + x).hide();
  document.getElementById('amp'+ x).play();
  }
  function audio_hit2(x) {
  $('#apause' + x).hide();
  $('#aplay' + x).show();
  document.getElementById('amp' + x).pause();
  }
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
  </script>
</body>
</html>
