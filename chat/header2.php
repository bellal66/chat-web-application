<?php
include '../lib/Database.php';
$db = new Database();
session_start();
?>
<?php
session_start();
if (!isset($_SESSION['userId']) || (trim($_SESSION['password']) == '')) {
    if (!isset($_COOKIE["userId"]) AND ( !isset($_COOKIE["password"]))) {
        header('location:loginnly.php');
        exit();
    }
}
if (isset($_GET["logout"])) {
    session_start();
    session_destroy();
    if (isset($_COOKIE["userId"]) AND isset($_COOKIE["password"])) {
        setcookie('userId', '', time() - (86400 * 30));
        setcookie('password', '', time() - (86400 * 30));
    }
    header('location:loginnly.php');
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chat</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    body{
        display: none;
    }
    .its-profile{
      margin-left: 40px;
      margin-top: 10px;
    }
    .Chats{
      position: relative;
      top: 10px;
      margin-left: 5px;
      font-size: 20px;
    }
    .s-b-option{
      margin-right: 35px;
      margin-top: 15px;
      font-size: 20px; 
      color: black;
      display: none;
    }
    .fa-circle{
      position: relative;
      font-size: 10px;
      margin-left: 0px !important;
    }
    @media only screen and (max-width: 768px) {
      body{
        display: block;
      }
      .its-profile{
        margin-left: 10px;
        margin-top: 10px;
      }
      .s-b-option{
        margin-right: 20px;
        float: left;
        display: block;
        font-size: 13px;
      }
      .log-out{
        display: none;
      }
      .main-header{
          position: fixed;
          width: 100%;
          border-bottom: 1px solid #eee !important;
      }
    }

            .seenchat{
                background: #eee !important;
                font-weight: bold;
                border-radius: 20px;
            }
            .option-detail-setting .create-new-change-name,.create-new-change-phone,.create-new-change-pass{
                background: #eee !important;
            }
            .chat-file-class{
                background: #eee !important;
            }
            .chat-file-link-camera{
                background: #ff8080;
            }
            .chat-file-link-image{
                background: #dd99ff;
            }
            .chat-file-link-audio{
                background: #80bfff;
            }
            .chat-file-link-video{
                background: #ffc34d;
            }
            .optionD-tlht{
                color: black;
            }
            .header-option-ns-c, .header-option-ns-sc{
                color: #D2D6DE;
            }
            .ns-active{
                color: black;
                border-bottom: 2px solid #eee;
            }
        </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top" style="background: #FFFFFF;">
      <a href="index.php">
        <img src="../img/profile.jpg" class="its-profile img-circle" width="35" height="35">
      </a>
      <b class="Chats"> <a href="index.php" class="cateryNameShow">Chats</a></b>
      <div class="navbar-custom-menu">
        <a href="?logout"><span class="s-b-option">Logout <i class="fa fa-sign-out"></i></span></a>
      </div>
    </nav>
  </header>