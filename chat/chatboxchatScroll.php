<?php
session_start();
include './libch/Database.php';
$db = new Database();


if(isset($_POST['messagechatLastId'])){
    $messagechatLastId = $_POST['messagechatLastId'];
    $chattouser = $_POST['chattouser'];
    
    $totalRow = 0;
    $limit = 0;
    if($messagechatLastId >= 5){
      $totalRow = $messagechatLastId-5;
      $limit = 5;
    }if($messagechatLastId == 4){
      $totalRow = $messagechatLastId-4;
      $limit = 4;
    }if($messagechatLastId == 3){
      $totalRow = $messagechatLastId-3;
      $limit = 3;
    }if($messagechatLastId == 2){
      $totalRow = $messagechatLastId-2;
      $limit = 2;
    }if($messagechatLastId == 1){
      $totalRow = $messagechatLastId-1;
      $limit = 1;
    }

    $query = "SELECT * FROM `messagechat` WHERE (`sender`='$_COOKIE[user0r1Id]' AND `receiver`='$chattouser') OR (`receiver`='$_COOKIE[user0r1Id]' AND `sender`='$chattouser') LIMIT ".$totalRow.",5";
    $result = $db->select($query);
    $html = '';
    if($result){
      foreach ($result as $message) {
        if($message['sender'] == $_COOKIE['user0r1Id']){
          
          $html .='<div class="direct-chat-msg right">';
          $html .=  '<input type="hidden" class="messagechatLastId" value="'.$totalRow.'">';
          $html .=  '<div class="direct-chat-infos clearfix right-chat-user-info">';
          $html .=    '<span class="direct-chat-timestamp float-left">'.$message['date'].'</span>';
          $html .=    '<span class="direct-chat-name float-right">Me</span>';
          $html .=  '</div>';
          $html .=  '<img class="direct-chat-img" src="img/user.png" alt="message user image">';
          $html .=  '<div class="direct-chat-text right-chat-user">';
          $html .=    $message['message'];
          $html .=  '</div>';
          $html .='</div>';
                      	
        }else{

          $html .='<div class="direct-chat-msg">';
          $html .=  '<input type="hidden" class="messagechatLastId" value="'.$totalRow.'">';
          $html .=  '<div class="direct-chat-infos clearfix">';
          $html .=    '<span class="direct-chat-name float-left">'.substr($message['sender'],0,7).'</span>';
          $html .=    '<span class="direct-chat-timestamp float-right">'.$message['date'].'</span>';
          $html .=  '</div>';
          $html .=  '<img class="direct-chat-img" src="img/user.png" alt="message user image">';
          $html .=  '<div class="direct-chat-text">';
          $html .=    $message['message'];
          $html .=  '</div>';
          $html .='</div>';
                  
        }
    }
  }
  echo $html;
}
?>
