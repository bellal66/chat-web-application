<?php
session_start();
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M y h:i A');

function datecheck($data,$dt){
    $current = strtotime($dt);
    $chatt = strtotime($data);
    $diff = abs($current-$chatt);
    $years = floor($diff / (365*60*60*24));  
    $months = floor(($diff - $years *365*60*60*24) / (30*60*60*24));  
    $days = floor(($diff - $years *365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    $hours = floor(($diff - $years *365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
    $minutes = floor(($diff - $years *365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
    if($years == 0 && $months == 0 && $days == 0 && $hours >= 0){
        return substr($data,10,5);
    }else{
        $data = date("d/m/y",$chatt);
        return $data;
    }
}
if(isset($_POST['start'])){
	$start = $_POST['start'];
	$limit = $_POST['limit'];

    $query = "SELECT * FROM `chatuserlist` order by id desc";
    $result = $db->select($query);
    $html = '';
    if($result){
        foreach ($result as $message) {
            
          $resultName = $message['userId'];
          $queryy = "SELECT * FROM `categorysg` WHERE `category`='$message[category]' AND (`subAdmin`='$_COOKIE[userId]' OR `subAdmin2`='$_COOKIE[userId]' OR `subAdmin3`='$_COOKIE[userId]' OR `subAdmin4`='$_COOKIE[userId]' OR `subAdmin5`='$_COOKIE[userId]') order by id asc";
          $rname = $db->select($queryy);
          if($rname){
            $resultName = $rname->fetch_assoc();
          
            $query = "SELECT * FROM `messagechat` WHERE (`sender`='$message[userId]' OR `receiver`='$message[userId]') ORDER BY id DESC LIMIT 1";
            
            $resultlast = $db->select($query);
            if($resultlast){
            	$chatlast = $resultlast->fetch_assoc();
            	$msgName = '';
            	if($chatlast['sender'] == $_COOKIE['userId']){
            	    $msgName = 'Me';
            	}else{
            	    $msgName = $chatlast['sender'];
            	}

                if($chatlast['seen'] == 0 && $chatlast['sender'] != $_COOKIE['userId']){
                    $html .= '<div class="seenchat direct-chat-msg direct-chat-list-msg" userId="'.$message['userId'].'">';
                }else{
                    $html .= '<div class="direct-chat-msg direct-chat-list-msg" userId="'.$message['userId'].'">';
                }
                $html .=    '<div class="direct-chat-infos clearfix"></div>';
            	$html .=    '<img class="direct-chat-img" src="img/user.png" alt="message user image">';
                
                $html .=    '<div class="direct-chat-textt">';
                if($chatlast['seen'] == 0 && $chatlast['sender'] != $_COOKIE['userId']){
                    $html .=       '<span class="direct-chat-name float-left">'.$message['userId'].'</span><br>';
                }else if($chatlast['seen'] == 0 && $chatlast['sender'] == $_COOKIE['userId']){
                    $html .=       '<span class="direct-chat-name float-left">'.$message['userId'].'</span><br>';
                }else if($chatlast['seen'] == 1 && $chatlast['sender'] == $_COOKIE['userId']){
                     $html .=       '<span class="direct-chat-name float-left">'.$message['userId'].'</span><br>';
                }else{
                     $html .=       '<span class="direct-chat-name float-left">'.$message['userId'].'</span><br>';
                }
                if(strlen($chatlast['message'])>=1 && strlen($chatlast['image'])<3 && strlen($chatlast['audio'])<3 && strlen($chatlast['video'])<3){
                    $html .=      $msgName.': '.substr(htmlspecialchars(base64_decode($chatlast['message']), ENT_QUOTES),0,20);
                }else if(strlen($chatlast['message'])==0 && strlen($chatlast['image'])>3 && strlen($chatlast['audio'])<3 && strlen($chatlast['video'])<3){
                    $html .=      $msgName.': '.'<i class="fa fa-file-image-o"> image</i>';
                }else if(strlen($chatlast['message'])==0 && strlen($chatlast['image'])<3 && strlen($chatlast['audio'])>3 && strlen($chatlast['video'])<3){
                    $html .=      $msgName.': '.'<i class="fa fa-file-audio-o"> audio</i>';
                }else if(strlen($chatlast['message'])==0 && strlen($chatlast['image'])<3 && strlen($chatlast['audio'])<3 && strlen($chatlast['video'])>3){
                    $html .=      $msgName.': '.'<i class="fa fa-video-camera"> video</i>';
                }
                $html .=    '</div>';
                $html .=    '<div class="direct-chat-timestampp"> '.datecheck($chatlast['date'],$dt).'</div>';
                $html .= '</div>';
            }else{
            	$html .= '<div class="direct-chat-msg direct-chat-list-msg" userId="'.$message['userId'].'" userId2="'.$message['userIdtwo'].'">';
                $html .=    '<div class="direct-chat-infos clearfix"></div>';
                if($message['groupcheck']==1){
                    $html .=    '<img class="direct-chat-img" src="img/group.jpg" alt="message group image">';
                }else{
            	    $html .=    '<img class="direct-chat-img" src="img/user.png" alt="message user image">';
                }
                $html .=    '<div class="direct-chat-textt">';
                $html .=       '<span class="direct-chat-name float-left">'.$message['userId'].'</span><br>';
                $html .=        $message['userId'].': hey brother';
                $html .=    '</div>';
                $html .=    '<div class="direct-chat-timestampp"> '.datecheck($message['date'],$dt).'</div>';
                $html .= '</div>';
            }
          }
        }
    }
    echo $html;
}
?>