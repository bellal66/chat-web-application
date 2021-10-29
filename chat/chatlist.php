<style type="text/css">
  .chat-list-div-sec{
    overflow-y: scroll;
  }
  .chat-list-search{
    width: 98%;
    height: 40px;
    border-radius: 14px;
    border: 1px solid white;
    background: #D2D6DE;
    outline: none;
  }
  .chat-list-search:hover{
    border: 1px solid white;
    color: green;
  }
  ::-webkit-input-placeholder {
    color: red;
  }
  ::placeholder {
    color: green;
    padding-left: 15px;
  }
  .direct-chat-list-msg{
    width: 95%;
    margin-left: 1%;
    cursor: pointer;
  }
  .direct-chat-img{
    width: 55px;
    height: 55px;
  }
  .direct-chat-textt{
    position: relative;
    left: 10px;
    top: 10px;
  }
  .direct-chat-timestampp{
    margin-left: 85%;
    margin-top: -20px;
  }
  .direct-chat-timestamppsg{
    margin-left: 85%;
    position: relative;
    top: -30px;
  }
  /*.seenchat{
      background: #eee !important;
      font-weight: bold;
      border-radius: 20px;
  }*/
  .seenUn{
      color: green;
      font-size: 10px;
  }
  .header-option-ns{
      display: none;
      margin-top: 5px;
  }
  .direct-special-chat-message-list{
      display: none;
  }
  @media only screen and (max-width: 768px) {
    .box-user-chat-search-list{
        background: white;
    }
    .chat-list-div-sec{
      margin-top: 3%;
      height: auto;
      overflow-y: scroll;
    }
    .header-option-ns{
        display: block;
    }
    .chat-list-search{
        display: none;
    }
  }
  .header-option-ns-c, .header-option-ns-sc{
      float: left;
      width: 50%;
      text-align: center;
      text-transform: uppercase;
      font-weight: bold;
  }
</style>
<?php
$operatorCheck = 'none';
if (!isset($_COOKIE["userId"]) AND ( !isset($_COOKIE["password"]))) {
        header('location:login.php');
        exit();
}else{

  ?>
  
  <div class="box-body no-padding chat-list-div">
    <div class="user-to-user-con chat-list-div-sec">
      <div class="direct-chat-message direct-chat-message-list">
      <!-- chat list/search -->
      </div>
      <div class="direct-chat-message direct-special-chat-message-list">
      <!-- chat list/search -->sdv
      </div>
    </div>
  </div>

  <?php
}
?>

<script type="text/javascript">
  $(document).on('click', '.s-b-option-sshow', function(){
      $('.chat-list-search').show();
      $('.header-option-ns').hide();
  });
  $(document).on('click', '.header-option-ns-c', function(){
      $(this).addClass('ns-active');
      $('.header-option-ns-sc').removeClass('ns-active');
      $('.direct-chat-message-list').show();
      $('.direct-special-chat-message-list').hide();
  });
  $(document).on('click', '.header-option-ns-sc', function(){
      $(this).addClass('ns-active');
      $('.header-option-ns-c').removeClass('ns-active');
      $('.direct-chat-message-list').hide();
      $('.direct-special-chat-message-list').show();
  });
  $(document).ready(function(){
    var start = 0;
    var limit = 10;
    var action = 'active';
    var action2 = 'active';
    var operatorCheck = "<?php echo $operatorCheck; ?>";
    function load_chat_list(start,limit){
        if(operatorCheck === 'none'){
            $.ajax({
                method: 'POST',
                url: 'chatlistfetch.php',
                data: {
                    start: start,
                    limit: limit
                },
                success:function(data){
                    if(data == ''){
                        $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Start new conversion.</div>');
                    }else{
                        $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Please wait...</div>');
                    }
                    $('.direct-chat-message-list').html(data);
                }
            });
        }else{
            $.ajax({
                method: 'POST',
                url: 'chatlistfetch.php',
                data: {
                    start: start,
                    limit: limit
                },
                success:function(data){
                    if(data == ''){
                        $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Start new conversion.</div>');
                    }else{
                        $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Please wait...</div>');
                    }
                    $('.direct-chat-message-list').html(data);
                }
            });
        }
    }
    if(action == 'active'){
      action = 'inactive';
      load_chat_list(start,limit);
    }
    function load_special_chat_list(start,limit){
        if(operatorCheck === 'none'){
            $.ajax({
                method: 'POST',
                url: 'chatlistfetch.php',
                data: {
                    start2: start,
                    limit2: limit
                },
                success:function(data){
                    if(data == ''){
                        $('.direct-special-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Start new conversion.</div>');
                    }else{
                        $('.direct-special-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Please wait...</div>');
                    }
                    $('.direct-special-chat-message-list').html(data);
                }
            });
        }else{
            $.ajax({
                method: 'POST',
                url: 'chatlistfetchop.php',
                data: {
                    start2: start,
                    limit2: limit
                },
                success:function(data){
                    if(data == ''){
                        $('.direct-special-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Start new conversion.</div>');
                    }else{
                        $('.direct-special-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Please wait...</div>');
                    }
                    $('.direct-special-chat-message-list').html(data);
                }
            });
        }
    }
    if(action2 == 'active'){
      action2 = 'inactive';
      load_special_chat_list(start,limit);
    }
    $('.chat-list-search').keyup(function(){
      $('.direct-chat-message-list').html('');
      var search = $(this).val();
      if(search !== ''){
        $.ajax({
          method: 'POST',
          url: 'chatlistfetch.php',
          data: {
            search: search
          },
          success:function(data){
            if (data == '') {
              $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">No more chat!</div>');
            }else{
              $('.direct-chat-message-list').html('<div class="direct-chat-msg direct-chat-list-msg">Please wait...</div>');
              $('.direct-chat-message-list').html(data);
            }
          }
        });
      }else{
        setTimeout(function(){
          load_chat_list(8, 0);
        }, 100);
      }
    });
  });
  $(document).on('click', '.direct-chat-list-msg', function(){
    var userId = $(this).attr('userId');
    window.location="?"+userId;
  });
</script>