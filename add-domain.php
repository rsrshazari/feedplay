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
$qry=mysqli_query($con,"select * from customdomain where user_id='$userId'");
$numRows=mysqli_num_rows($qry);
$fetch=mysqli_fetch_array($qry);
if(isset($_GET['did'])&&$_GET['did']!=''){
$did=($_GET['did']);
$pid=base64_decode($did);
$delQry=mysqli_query($con,"delete from `feeds` where `id`='$pid'");
if($delQry){
header("location:my-feeds.php?msg=dls");
}else{
header("location:my-feeds.php?msg=err");
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
  <title>Feed Play | My Feed </title>
<?php include 'include/css.php' ?>
<link rel="stylesheet" href="assets1/css/datatable.css">
</head>
<body class="g-sidenav-show   bg-gray-100">
  <?php include 'include/sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">Connect Domain</h6>
        </nav>
      <?php include 'include/loginheader.php' ?>
      </div>
    </nav>
    <div class="container-fluid py-4">
			<div class="row mt-4">
        <div class="col-lg-12 mt-lg-0 mt-4">
          <div class="card overflow-hidden">
            <div class="card-header p-5 pb-0">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
									<i class="fa-solid fa-globe text-lg opacity-10"></i>
                </div>
                <div class="ms-3">
                  <h5 class="font-weight-bolder mb-0">
                Connect Domain
                  </h5>
                </div>
                <div class="progress-wrapper ms-auto w-25">
									<?php if($numRows<1){ ?>
									<button class="btn bg-gradient-primary ms-auto float-end"  data-bs-toggle="modal" data-bs-target="#domainModal">Add Domain</button>
								<?php }else{ ?>
										<button class="btn bg-gradient-primary ms-auto float-end"  data-bs-toggle="modal" data-bs-target="#EditModal">Edit Domain</button>
								<?php } ?>
                </div>
              </div>
							<hr class="horizontal dark">
            </div>
            <div class="card-body p-1 pb-0 ">
								<?php if($numRows>0){ ?>
							<div class="row">
								<div class="col-md-9" style=" align-self:center">
									<div class="text-center">
										<h1 class="text-success font-weight-bolder mb-0 ">
									<?=$fetch['domain'] ?>
									</h1>
									</div>
								</div>
								<div class="col-md-3">
									<ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Domain</h6>
                    <p class="mb-0 text-xs"><?=$fetch['domain'] ?></p>
                  </div>
                  <a class=" pe-3 ps-0 mb-0 ms-auto text-success" ><i class="fa-solid fa-check text-sm ms-1 mt-1 text-success"></i> Verified</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">A Record</h6>
                    <p class="mb-0 text-xs"><?=$fetch['cname'] ?></p>
                  </div>
									<?php if ($fetch['cname_verify']=='1'){ ?>
										  <a class="pe-3 ps-0 mb-0 ms-auto text-success" ><i class="fa-solid fa-check text-sm ms-1 mt-1 text-success"></i> Verified</a>
									<?php }else{ ?>
                  <button onclick="verifyARecord(this.id)" id="<?=$fetch['id']?>" class="btn btn-link pe-3 ps-0 mb-0 ms-auto " ><span id="cnameLbl" >Check</span><img style="width: 30%;display:none" id="cnameLoder" src="assets1/img/Typing.gif" >  </button>
								<?php } ?>
							  </li>
								<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
									<div class="d-flex align-items-start flex-column justify-content-center">
										<h6 class="mb-0 text-sm">Date</h6>
										<p class="mb-0 text-xs"><?= date('M d, Y', strtotime($fetch['date'])) .' '.$fetch['time'] ?></p>
									</div>
								</li>
              </ul>
								</div>
							</div>
						<?php } ?>
						</div>
          </div>
        </div>
      </div>
			<?php if($numRows>0){ $time_ago=$fetch['date'].' '.$fetch['time']; ?>
			<div class="row mt-2">
			                <div class="col-lg-5 col-12">
			                  <h6 class="mb-0">DNS setting</h6>
			                  <p class="text-sm">Copy the IP address bellow and update to your DNS.</p>
			                  <div class="border-dashed border-1 border-secondary border-radius-md p-3">
			                    <p class="text-xs mb-2">Generated <?php echo timeAgo($time_ago);?>  </p>
			                    <p class="text-xs mb-3"><span class="font-weight-bolder">(Used one time)</span></p>
			                    <div class="d-flex align-items-center">
			                      <div class="form-group w-70">
			                        <div class="input-group bg-gray-200">
			                          <input id="cnameTxt" class="form-control form-control-sm" value="<?= $fetch['cname'] ?>" type="text" disabled="" onfocus="focused(this)" onfocusout="defocused(this)">
			                          <span class="input-group-text bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="" aria-label="Copy the cName"><i class="fa-solid fa-globe"></i></span>
			                        </div>
			                      </div>
			                      <button id="copybtn" class="btn btn-sm btn-outline-secondary ms-2 px-3">Copy</button>
			                    </div>
			                    <p class="text-xs mb-1">You cannot re-generate A Record.</p>
			                  </div>
			                </div>
			                <div class="col-lg-7 col-12 mt-4 mt-lg-0">
			                  <h6 class="mb-0">How to Upadte</h6>
			                  <p class="text-sm">Update your DNS in 3 easy steps.</p>
			                  <div class="row">
			                    <div class="col-md-4 col-12">
			                      <div class="card card-plain text-center">
			                        <div class="card-body">
			                          <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">

																	<i class="fa-solid fa-right-to-bracket opacity-10" aria-hidden="true"></i>
			                          </div>
			                          <p class="text-sm font-weight-bold mb-2">1. Login to your domain provider website </p>

			                        </div>
			                      </div>
			                    </div>
			                    <div class="col-md-4 col-12">
			                      <div class="card card-plain text-center">
			                        <div class="card-body">
			                          <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">
			                            <i class="fa-solid fa-globe opacity-10" aria-hidden="true"></i>
			                          </div>
			                          <p class="text-sm font-weight-bold mb-2">2. Go to DNS Managemnet and add A RECORD </p>

			                        </div>
			                      </div>
			                    </div>
			                    <div class="col-md-4 col-12">
			                      <div class="card card-plain text-center">
			                        <div class="card-body">
			                          <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">

																	<i class="fa-solid fa-circle-check opacity-10" aria-hidden="true"></i>
			                          </div>
			                          <p class="text-sm font-weight-bold mb-2">3.Add this ip to value section and update the DNS. </p>

			                        </div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			              </div>
									<?php } ?>
    </div>
  </main>
	<div id="domainModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
			<div class="modal-content">
					<div class="modal-header">
							<h6 class="modal-title" id="modal-title-default">Add Domain</h6>
					</div>
						<form class="" action="adddomain.php" method="post">
								<input type="hidden" name="hidUserId" id="hidUserId" value="<?=$userId?>">
					<div class="modal-body">
							<div class="row">
								<div id="formDiv" class="col-md-12">
									<label for="">Domain Name</label>
									<input id="domain" name="domain" type="text" class="form-control" placeholder="https://abcd.com"  onfocus="focused(this)" onfocusout="defocused(this)">
								</div>
								<div class="loderDiv">
		                <div id="loader-icon" style="text-align:center;display:none" ><img src="assets1/img/loder.gif" Height="100" /></div>
		            </div>
								<div id="result">
								</div>
								<div class="">
									<small id="instruction">Enter the exact domain name you want your projects to be accessible with. It can be a subdomain <strong>(example.yourdomain.com)</strong> or root domain <strong>(yourdomain.com)</strong>.</small>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
						<button type="button" id="verifyDomainBtn" name="verifyDomainBtn" class="btn bg-gradient-primary btn-sm" onclick="verifyDomain()">Verify</button>
					</div>
					 </form>
			</div>
	</div>
	</div>

<?php include 'include/script.php' ?>
<script src="assets1/js/plugins/datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" charset="utf-8"></script>
<script type="text/javascript">
var text = document.getElementById("cnameTxt");
var btn = document.getElementById("copybtn");
btn.onclick = function() {
text.select();
document.execCommand("copy");
}
</script>
<script type="text/javascript">
function verifyARecord(id){

	$('#cnameLbl').hide();
	$('#cnameLoder').show();
	$.ajax({
			type: 'POST',
			url: 'getVerifyDns.php',
			data:{domId:id},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.error(errorThrown);
				 alert(" Status: Network error" );
				 //window.location="create-feed.php?cpid="+cid;
		 },
			success: function(resp){
				$('#cnameLoder').hide();
			var res=resp.split('#');
			if(res[0]==1){
				$('#cnameLbl').show();
				$('#cnameLbl').html(res[1]);

			}else{
				$('#cnameLbl').show();
				$('#cnameLbl').html(res[1]);
				alert("Your DNS is not Upadted yet");
			}
			}
	});
}
function verifyDomain(){
	var domain=document.getElementById('domain').value;
		var uid=document.getElementById('hidUserId').value;
			$('#loader-icon').show();
	$.ajax({
			type: 'POST',
			dataType:'text',
			url: 'getVerifyDomain.php',
			data:{usrId:uid,domain:domain},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.error(errorThrown);
         alert(" Status: Network error" );
				 //window.location="create-feed.php?cpid="+cid;
     },
			success: function(resp){
					$('#loader-icon').hide();
			var res=resp.split('#');
			if(res[0]==1){
				$('#formDiv').hide();
				$('#result').html(res[1]);
				$('#instruction').html(res[2]);
				$('#verifyDomainBtn').hide();
			}else{
				$('#formDiv').show();
				$('#result').html(res[1]);
				$('#instruction').html(res[2]);
				$('#verifyDomainBtn').show();
			}
			}
	});
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
