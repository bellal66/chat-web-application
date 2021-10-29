<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition">
<div class="login-box" style="margin-top: 30%;">
  <div class="login-logo">
    Sign In
  </div>
  <div class="login-box-body" style="margin-top: 40%;">
      <div class="form-group has-feedback login-notice-box" style="display: none;">
        <span class="form-control text-center text-red text-bold login-notice"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control phone" placeholder="UserName" required>
        <span class="form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-lg btn-success btn-block btn-flat signInSuccess">Log In</button>
        </div>
      </div>
  </div>
</div>
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  });
</script>
</body>
</html>
<style>
@media only screen and (max-width: 768px) {
    .login-box{
      margin-top: 30%;
    }
    .login-box-body{
      margin-top: 40%;
    }
  }
</style>
<script>
$(document).on('click','.signInSuccess',function(){
	var phone = $('.phone').val();
	var password = $('.password').val();
	var signInSuccess = 0;
	if(phone != '' && password != ''){
	  $.ajax({
		method: 'POST',
		url: 'logindat.php',
		data: {
			signInSuccess: signInSuccess,
			phone: phone,
			password: password
		},
		success: function(data){
			if(data == 'yesss') {
				window.location = 'index.php';
			}else{
				$('.login-notice-box').show();
				$('.login-notice').text('Input Correct data!');
				setTimeout(function(){
					$('.login-notice-box').hide();
				},3000);
			}
		}
	  });
	}else{
	    $('.login-notice-box').show();
		$('.login-notice').text('Input data!');
		setTimeout(function(){
			$('.login-notice-box').hide();
		},3000);
	}
});
</script>