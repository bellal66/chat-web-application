  <div class="control-sidebar-bg"></div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="./bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>
<script>
var url = window.location.href.split('?')[1];
var url2 = window.location.pathname;
if(url){
    $('.box-user-chat-search-list').load('chatbox.php',{chattouser:url});
}else{
	$('.box-user-chat-search-list').load('chatlist.php');
}

  $(document).on('click', '.groupCategoryChoose', function(){
    var userId = $(this).attr('gcategoryId');
    window.location="index.php?"+userId;
  });
  $(document).on('click', '.chat-setting-button', function(){
    $('.box-user-chat-search-list').hide();
    $('.box-user-chat-setting').show();
  });
  $(document).on('click', '.back-to-chat-u-g', function(){
    $('.box-user-chat-search-list').show();
    $('.box-user-chat-setting').hide();
  });
</script>