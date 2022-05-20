$.ajax({
    type: 'POST',
    dataType:'text',
    url:'getVerifyDns.php',
    data:{domId:id},
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    console.error(errorThrown);
       alert(" Status: Network error" );
       //window.location="create-feed.php?cpid="+cid;
   },
    success: function(resp){
      $('#cnameLbl').show();
      $('#cnameLoder').hide();
    var res=resp.split('#');
    if(res[0]==1)
      $('#cnameLbl').html(res[1]);
    }else{
        $('#cnameLbl').html(res[1]);
        alert('Your DNS is not updated yet!!');
    }
  });
