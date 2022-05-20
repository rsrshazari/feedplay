<?php
ob_start();
session_start();
$con=mysqli_connect('localhost','admin_feedplay','Manish#6706','admin_feedplay')or die('can\'t establish connection with mysqli');
$domain=$_SERVER['SERVER_NAME'];
$domainQry=mysqli_fetch_array(mysqli_query($con,"select * from customdomain where domain='$domain'"));
$userId=$domainQry['user_id'];
$brand=mysqli_fetch_array(mysqli_query($con,"select * from brand where user_id='$userId' order by id desc limit 1"));
function getFeedBrand($id) {
global $con;
	$sqlQry=mysqli_query($con,"select * from `brand` where id='$id'  ");
	$num=mysqli_fetch_row($sqlQry);
	return $num;
}
if (isset($_GET['cid'])&&$_GET['cid']!='') {
  $cid=base64_decode($_GET['cid']);
  $qry=mysqli_query($con,"SELECT * FROM `chapter` where id=$cid");
  $fetch=mysqli_fetch_array($qry);
  $link="https://feedplay.net/feed.php?cid=".$_GET['cid'];

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $domain?>| Feed</title>
    <!-- <link rel="icon" href="assets1/img/favicon.png" type="image/png"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link href="https://feedplay.net/assets1/css/feed.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<style media="screen">
.progress {
width: 0px;
height: 100%;
background: #202e38!important;
transition: width .1s linear;
}
</style>
  </head>
     <body>
      <div class="giide-outer-container">
          <div class="outer-gradient">
						<?php if ($brand['logo']!=''): ?>
							  <a href="#" class="logo"><img src="https://feedplay.net/assets1/img/logos/<?=$brand['logo']?>" alt="" style="width: 40%;"></a>
						<?php endif; ?>

            <input type="hidden" name="hidChapId" id="hidChapId" value="<?php echo $_GET['cid']?>">
            <input type="hidden" name="hidFeedId" id="hidFeedId" value="<?php echo $fetch['feed_id'];?>" >
          </div>
          <div class="giide-aspect-ratio" style="width: 371.25px; height: 660px; margin-top: 10px;">
            <div class="giide-view-content">
                <div id="shareDiv" class="share-modal-mask" style="display: none;">
                    <div class="share-modal" style=" width: 315.562px; height: 165px;">
                      <div>
                        <div class="d-flex" style="justify-content: space-between;">
                          <span>  <h1 style="font-size: 18.5625px;width:200px">Share this feeds</h1></span>
                          <span>  <button type="button" class="close-share-modal">X</button></span>
                        </div>
                      </div>
                      <div class="share-buttons">
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$link?>" target="_blank" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-linkedin-in"></i></a>
                          <a target="_blank"  href="http://twitter.com/share?url=<?=$link?>&text=Share Feed&hashtags=feedplayfeeds" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-twitter"></i></a>
                          <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$link?>" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-brands fa-facebook"></i></a>
                          <a href="mailto:?Subject=Feedplay&Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?=$link?>" class="btn avatar rounded-circle" style="color:#000;border:1px solid #000"><i style="font-size:25px" class="fa-solid fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="giide-resources">
                    <div style="width: 371.25px;">
                        <div class="graphic-modal-mask" style="display: none;">
                            <div class="graphic-modal">
                                <svg>
                                    <path d="M4 4 L20 20 M20 4 L4 20 Z"></path>
                                </svg>
                                <img alt="Graphic" style="max-height: 100%;">
                            </div>

                        </div>
                        <div id="div1" class="giide-feed-container" id="giide-feed-container" style="height: 554.4px;">
                            <div class="inner-flex-container">
                                <div name="title-giide-50dfffaa-8602-41f5-8508-c1e85d531698" class="giide-feed-child" style="padding: 20.4187px 3.7125px 3.7125px;">
                                    <div>
                                        <div class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                            <div class="title-card feed-card" style="height: 513.228px;">
                                                <div class="title-image-container" style="width: 337.34px; height: 337.34px;">
                                                    <img src="https://feedplay.net/assets1/img/<?= $fetch['image']?>" alt="<?= $fetch['name']?>" style="display: block;">
                                                    <div class="listen-time-container">
                                                        <sapn class="total-listen-time" style="font-size: 12.024px;"><span id="tDuration" ></span> minute</span>
                                                    </div>
                                                </div>
                                                <div class="title-card-content">
                                                    <h1 style="font-size: 19.372px;"><?= $fetch['name']?></h1>
                                                    <div class="author-container">
                                                        <p style="font-size: 13.36px;"><?= $fetch['author']?></p>
                                                        <p style="font-size: 12.024px;"><?= $fetch['desp']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                          <?php $chapterId=$fetch['id']; ?>
                                          <?php $urlQry=mysqli_query($con,"select * from feed_url where chapter_id='$chapterId'") ;
                                          $quoteQry=mysqli_query($con,"select * from feed_quote where chapter_id='$chapterId'");
                                          $highlightQry=mysqli_query($con,"select * from feed_highlight where chapter_id='$chapterId'");
                                          $definationQry=mysqli_query($con,"select * from feed_defination where chapter_id='$chapterId'");
                                          $imageQry=mysqli_query($con,"select * from feed_image where chapter_id='$chapterId'");
                                          $profielQry=mysqli_query($con,"select * from feed_profile where chapter_id='$chapterId'");
                                          ?>
                                          <?php $i=1; while($urlFetch=mysqli_fetch_array($urlQry)){ $i++;?>
                                              <input type="hidden" id="l_<?=$i?>" name="" class="urlHid" value="<?= $urlFetch['ctime']?>">
                                            <div id="url_<?=$i?>" style="display:none"  name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                    <div id="contentDiv" class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                            <div  class="border p-2  mb-2 bg-white">
                                            <div class="flex-shrink-0">
                                              <img  alt="Image placeholder" class="avatar rounded-circle" src="https://feedplay.net/assets1/img/feed_url/<?= $urlFetch['image']?>">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                              <h6  class="h5 mt-0"><?= $urlFetch['title']?></h6>
                                              <p  class="text-sm"><?= $urlFetch['source']?></p>
                                              <div class="d-flex">

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                          <?php } ?>
                                              <?php $i=1; while($quoteFetch=mysqli_fetch_array($quoteQry)){$i++; ?>
                                                <input type="hidden" id="e_<?=$i?>" name="" class="quoteHid" value="<?= $quoteFetch['ctime']?>">
                                                <div id="quote_<?=$i;?>" style="display:none" name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                        <div class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                            <div  class="border p-2 quote mb-2 bg-white">
                                                <p><?= $quoteFetch['quote']?></p>
                                                <p style="text-align:right"><?= $quoteFetch['author']?></p>
                                            </div>
                                          </div>
                                        </div>
                                          <?php } ?>
                                              <?php $i=0; while($highFetch=mysqli_fetch_array($highlightQry)){$i++; ?>
                                                <input type="hidden" id="h_<?=$i?>" name="" class="highHid" value="<?= $highFetch['ctime']?>">
                                                <div id="high_<?=$i;?>" style="display:none" name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                        <div id="contentDiv" class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                            <div  class="border p-2 highlight mb-2">
                                                <span><?= $highFetch['highlight']?></span>
                                            </div>
                                          </div>
                                        </div>
                                          <?php } ?>
                                            <?php $df=0; while($defFetch=mysqli_fetch_array($definationQry)){ $df++; ?>
                                                  <input type="hidden" id="f_<?=$df?>" name="" class="defHid" value="<?= $defFetch['ctime']?>">
                                              <div id="def_<?=$df?>" style="display:none"  name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                      <div id="contentDiv" class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                            <div  class="border p-2 defination mb-2 bg-white" style="background:#fff">
                                                <p><?=$defFetch['defination']?></p>
                                            </div>
                                          </div>
                                        </div>
                                            <?php } ?>
                                            <?php $i=1; while($imgFetch=mysqli_fetch_array($imageQry)){$i++; ?>
                                                <input type="hidden" id="g_<?=$i?>" name="" class="imgHid" value="<?= $imgFetch['ctime']?>">
                                              <div style="display:none" id="img_<?=$i?>"  name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                      <div id="contentDiv" class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                              <div id="<?=$urlFetch['ctime']?>"  class="image mb-2 bg-white" style="background:#fff">
                                                    <img  alt="Image placeholder" class="img-fluid shadow" src="https://feedplay.net/assets1/img/feed_image/<?=$imgFetch['image']?>">
                                                    <p id=""><?=$imgFetch['caption']?></p>
                                              </div>
                                            </div>
                                          </div>
                                            <?php } ?>
                                              <?php $i=1; while($profileFetch=mysqli_fetch_array($profielQry)){$i++; ?>
                                                  <input type="hidden" id="p_<?=$i?>" name="" class="proHid" value="<?= $profileFetch['ctime']?>">
                                                <div style="display:none" id="pp_<?=$i?>"  name="b129d5ac-fbb8-4aba-b3cb-5128c836bcaf" class="giide-feed-child" style="padding: 3.7125px;border-radius:4px;background:#fff">
                                                        <div id="contentDiv" class="feed-card-container" style="width: 334.125px; margin: 0px 11.1375px 14.85px;">
                                                <div  class="border p-2  mb-2 bg-white" >
                                                    <div class="flex-shrink-0">
                                                      <img alt="Image placeholder" class="avatar rounded-circle" src="https://feedplay.net/assets1/img/feed_profile/<?=$profileFetch['image']?>">
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
                                                </div>
                                              </div>
                                            <?php } ?>
                                        </div>
                        </div>
                        <div class="player-container" style="height: 105.6px;">
                            <div style="width: 0px; height: 0px;">
                                   <audio   style="width: 100%; height: 100%;" id="audio"   loop="false" class="w-100" controls>
                                     <source src="https://feedplay.net/audio/<?= $fetch['audio_file']?>" type="audio/mp3">
                                     </audio>

                            </div>
                            <div class="slider-container" style="height: 16.5px;">
                                <div class="rc-slider-container">
                                    <div class="rc-slider">
                                         <div class="progress" id="progress"></div>
                                    </div>
                                    <div class="player-marks-container">
                                        <div class="player-marks" style="height: 6.072px;">
                                            <!-- <div class="player-mark-outer" style="left: 33.3333%; height: 2.31px; width: 2.31px;"></div>
                                            <div class="player-mark-outer" style="left: 100%; height: 2.31px; width: 2.31px;"></div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="slider-text" style="height: 16.5px; width: 330.413px; font-size: 11.1375px;">
                                    <p  id="current-time">0:00</p>
                                    <p id="duration">0:00</p>
                                </div>

                            </div>
                            <div class="player-buttons" style="height: 72.6px;">

                                <button id="back" type="button" class="rewind-button" style="width: 37.125px; height: 37.125px;"><i class="fa-solid fa-backward-step"></i></button>
                                <button type="button" class="play-button" style="width: 37.125px; height: 37.125px;" onClick="togglePlay()" ><i id="aplay" class="fas fa-play"></i><i id="apause" style="display:none" class="fas fa-pause"></i></button>
                                <button id="fwd" type="button" class="rewind-button1" style="width: 37.125px; height: 37.125px;"><i class="fa-solid fa-forward-step"></i></button>
                                <div type="button" class="playback-rate-button dropup" style="width: 29.7px;    margin-top: -1px;"><img src='https://feedplay.net/assets1/img/993536.png' style="width:100%" class="dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2" style="min-width: 1rem !important;">
                                      <li>
                                          <a id="likes_<?=$fetch['id']?>" onclick="addReaction(this.id)" class="dropdown-item" href="#">
                                        <i  class="fa-solid fa-thumbs-up" style="color:green"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a id="love_<?=$fetch['id']?>" onclick="addReaction(this.id)" class="dropdown-item" href="#">
                                          <i class="fa-solid fa-heart" style="color:red"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a id="happy_<?=$fetch['id']?>" onclick="addReaction(this.id)" class="dropdown-item" href="#">
                                          <i class="fa-solid fa-face-laugh-beam" style="color:orange"></i>

                                          </a>
                                      </li>
                                      <li>
                                          <a id="sad_<?=$fetch['id']?>" onclick="addReaction(this.id)" class="dropdown-item" href="#">
                                        <i class="fa-solid fa-face-frown"></i>
                                          </a>
                                      </li>
                                  </ul>
                                </div>

                                <button id="shareBtn" type="button" class="open-menu-button" style="width: 37.125px; height: 37.125px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAABUCAYAAABk+NwlAAAACXBIWXMAACxLAAAsSwGlPZapAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAALNSURBVHgB7Zi9bhNBFIXPzCbIoiBLFUUKMCVCJHIKwFQ4HR32E+CUVKGlSvwEJk9g8wbxE2AkpFjQrAhCKScSIAPN0jmJ7eHeWdtx/JPsj5FS7Ffszs6uj+/Ozr17ZoHrgrjspLqfU7bRzvhaN/zQIuphLk+9OxAmS6fdkVMaBg2coayPmnqqiFJ5F0vtCl1YwuWwWFkfNmuDDmfQcO+uHNDuOa7Gpb8uuMt3/vq/vje5Q9oo1p9WAA4/CqaiHjyyv5HB4JnXiIPjVHgn1FquSuGVEBPhSCWDpxAf0zVFGhORSIRQEnOARTQSYXwW+YAk9NCQtKkhPlp/bTYkb2xOxIGmP++CgXWwhchjI/YG+XOegFmauT2852YogS8Hw1k+WQrWc7u0ezlVjG+bM5iHYFQSM+jXFTXscDL72ptdmFJSUlLmwWRlY59yq71Npwr0PlCB0TF+UMxFfdSXTBVR60/ox9gdc0jjaJxic9QtnRfqwKOEtBjCR6ezqb999oYiVJx3ggiiQEKnZoMj6pucqAKMcbGIKrckboh4LskGg7zK5l16A/aeIQnddiG5yREim9zkCLMk7URKgsGxhJENJMGaHHTfIT59k3P4aR9xfdsFk9PpFiOPDSXkIBmtiM2BTm8zdESc0U6mODgcrjL8Pz9b7spqnS64TYcz5g5HK99QBK/8lm4PeqeaHGu9usjzRIIxS3TVMT8FLGS81OikpKT8T6YXpbXHZHDkC1uUGMMVTXg4M3vjX3EmROySTdo3vcIsDK2jxz4JjZicSB7lglsKTM5arkStKqKhITMbXHMda3IWrIAbUcSF6ZzQdyV6jS5SVQ+1oJ6G2O6bHLuQjglZLmtyEn4O4gW4vMKzhhG5Ny+TIzwkwfQ8HpM6kuDcpEcsT2oJbqnMk01qz6MVhNlCdHjGvrXB8Mb//ePIXV7lFMiHF6Dc8T62+OAfxD8RzFO1LmoAAAAASUVORK5CYII=" alt="open giide menu"></button>
                                <?php if( $fetch['brand']=='0'){ ?>
                                <a href="#" target="_blank" rel="noopener noreferrer" class="player-logo-link" style="width: 44.55px; height: 37.125px;"><img src="https://feedplay.net/assets1/img/logo.png" alt="Feedplay logo"></a>
                              <?php }else{
                                $brand=getFeedBrand($fetch['brand']);
                                 ?>
                                  <a href="#" target="_blank" rel="noopener noreferrer" class="player-logo-link" style="width: 44.55px; height: 37.125px;"><img src="https://feedplay.net/assets1/img/logos/<?=$brand[2]?>" alt="<?=$brand[3]?>"></a>
                              <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

          </div>
          <div class="outer-gradient"></div>
      </div>

      <script src="https://feedplay.net/assets1/js/core/popper.min.js"></script>

      <script src="https://feedplay.net/assets1/js/core/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#shareBtn").click(function(){
    $("#shareDiv").toggle();
  });
  $(".close-share-modal").click(function(){
      $("#shareDiv").hide();
  })
});
function addReaction(id){
	var cid=document.getElementById('hidChapId').value;
  var fid=document.getElementById('hidFeedId').value;
	$.ajax({
			type: 'POST',
			dataType:'text',
			url: 'addReaction.php',
			data:{id:id,cid:cid,fid:fid},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.error(errorThrown);
         alert(textStatus+" Status: Audio formtate not supported kindly create  you own audio"+ errorThrown );
				//window.location="create-feed.php?cpid="+cid;
     },
			success: function(resp){
			alert("Thanku for you reaction");
			}
	});
// $.ajax({
// 		url:"getAudioTranscribe.php",type:"post",data:{id:id,cid:cid,fid:fid},
// 		success:function(data){
// 						$('#loader-icon').hide();
// 							console.log(data);
// 						window.location="linkcontent.php?cid="+data;
// 				},
// 				error: function(data){
// 						console.log("error");
// 						console.log(data);
// 				}
// 		});
}
</script>
<script>
var timer;
var percent = 0;
var audio = document.getElementById("audio");
 var currTimeDiv = document.getElementById('current-time');
 var durationDiv = document.getElementById('duration');
 var tDurationDiv = document.getElementById('tDuration');
var profile= document.getElementsByClassName("proHid");
var image= document.getElementsByClassName("imgHid");
var profile= document.getElementsByClassName("proHid");
var profile= document.getElementsByClassName("proHid");
var profile= document.getElementsByClassName("proHid");
let div = document.getElementById('contentDiv');
$("#back").click(backward);
 $("#fwd").click(forward);
$(".rc-slider").on("click", updateVideoProgressToNewPosition);
 function backward() {
  audio.currentTime -= parseFloat(10);
}
function forward() {
  audio.currentTime += parseFloat(20);
}
function updateVideoProgressToNewPosition(e) {
  audio.currentTime = (e.offsetX / this.offsetWidth) * audio.duration;
}
audio.onloadedmetadata = function() {
  var sec =Math.floor(audio.duration%60);
    var min =Math.floor(audio.duration/60);
    var total=min+":"+sec;
    durationDiv.innerHTML = total;
    tDurationDiv.innerHTML = total;
};
audio.addEventListener("playing", function(_event) {
  var duration = _event.target.duration;
  advance(duration, audio);
});
audio.addEventListener("pause", function(_event) {
  clearTimeout(timer);
});
var advance = function(duration, element) {
    var sec =Math.floor(element.currentTime%60);
      var min =Math.floor(element.currentTime/60);
      var total=min+":"+sec;
      currTimeDiv.innerHTML = total;
  var progress = document.getElementById("progress");
  increment = 10/duration
  percent = Math.min(increment * element.currentTime * 10, 100);
  progress.style.width = percent+'%'
  startTimer(duration, element);
  checkProfileFeed(total);
  checkImageFeed(total);
  checkDefinationFeed(total);
  checkHighlightFeed(total);
  checkQuoteFeed(total);
  checkUrlFeed(total);
}
var startTimer = function(duration, element){
  if(percent < 100) {
    timer = setTimeout(function (){advance(duration, element)}, 100);
  }else{
    audio.pause();
      $('#aplay').show();
      $('#apause').hide();
  }
}

function togglePlay (e) {
  e = e || window.event;
  var btn = e.target;
  if (!audio.paused) {
    btn.classList.remove('active');
    audio.pause();
    isPlaying = false;
    $('#apause').hide();
    $('#aplay').show();
  } else {
    btn.classList.add('active');
    audio.play();
    isPlaying = true;
    $('#apause').show();
    $('#aplay').hide();
  }
}
function checkProfileFeed(total){
  $(".proHid").each(function() {
var pid="#p"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}
function checkImageFeed(total){
$(".imgHid").each(function() {
var pid="#im"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}

function checkDefinationFeed(total){
$(".defHid").each(function() {
var pid="#de"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}
function checkHighlightFeed(total){
$(".highHid").each(function() {
var pid="#hig"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}
function checkQuoteFeed(total){
$(".quoteHid").each(function() {
var pid="#quot"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}
function checkUrlFeed(total){
$(".urlHid").each(function() {
var pid="#ur"+this.id;
var ptime=$(this).val();
var text = ptime.replace(".", ":");
if(total==text){
$(pid).show();
$("#div1").animate({scrollTop: '+=150px'}, 800);
}
});
}
</script>


    </body>
</html>
