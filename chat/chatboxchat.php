<?php
session_start();
include '../lib/Database.php';
$db = new Database();


if($_REQUEST['chattouser']){
    $chattouser = $_REQUEST['chattouser'];
    $totalRow = 0;

    $query1 = "SELECT count(id) as total FROM `messagechat` WHERE `sender`='$chattouser' OR (`sender`='$_COOKIE[userId]' AND `receiver`='$chattouser')";
    $result = $db->select($query1);
    $totalRow = 0;
    if($result){
          $resultRow = $result->fetch_assoc();
          $totalRow = $resultRow['total']-20;
          if($totalRow < 0){
            $totalRow = 0;
          }
    }
    $query = "SELECT * FROM `messagechat` WHERE `sender`='$chattouser' OR (`sender`='$_COOKIE[userId]' AND `receiver`='$chattouser') LIMIT ".$totalRow.",20";
    $result = $db->select($query);
    if($result){
        foreach ($result as $message) {
            $queryy = "SELECT * FROM `categorysg` WHERE `category`='$message[category]' AND (`subAdmin`='$_COOKIE[userId]' OR `subAdmin2`='$_COOKIE[userId]' OR `subAdmin3`='$_COOKIE[userId]' OR `subAdmin4`='$_COOKIE[userId]' OR `subAdmin5`='$_COOKIE[userId]') order by id asc";
            $rname = $db->select($queryy);
            if($rname){
                
                if($message['sender'] == $_COOKIE['userId']){
                    ?>
                      <div class="direct-chat-msg right">
                      	<input type="hidden" class="messagechatLastId" value="<?php echo $totalRow; ?>">
                        <div class="direct-chat-infos clearfix right-chat-user-info">
                          <span class="direct-chat-timestamp float-left"><?php echo $message['date']; ?></span>
                        </div>
                        <?php
                          if(strlen($message['message'])  >= 1 && strlen($message['image']) < 3 && strlen($message['audio']) < 3 && strlen($message['video']) < 3){
                          	?>
                          	<div class="direct-chat-text right-chat-user">
                              <?php 
                                echo htmlspecialchars(base64_decode($message['message']), ENT_QUOTES);
                              ?>
                            </div>
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) > 3 && strlen($message['audio']) < 3 && strlen($message['video']) < 3){
                          	?>
                          	<img src="../chatimg/<?php echo $message['image']; ?>" class="chatimg-position-lg image-c-big" width="100">
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) < 3 && strlen($message['audio']) > 3 && strlen($message['video']) < 3){
                          	?>
                          	<audio class="chatAudio-position-lg" style="width: 82%;" controls>
                          		<source src="../chatAudio/<?php echo $message['audio']; ?>" type="audio/ogg">
                          	</audio>
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) < 3 && strlen($message['audio']) < 3 && strlen($message['video']) > 3){
                          	?>
                          	<video class="chatVideo-position-lg" width="185" height="150" controls>
                          		<source src="../chatVideo/<?php echo $message['video']; ?>" type="video/ogg">
                          	</video>
                          	<?php
                          }
                        ?>
                      </div>
                    <?php
                }else{
                  ?>
                      <div class="direct-chat-msg">
                      	<input type="hidden" class="messagechatLastId" value="<?php echo $totalRow; ?>">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-timestamp float-right"><?php echo $message['date']; ?></span>
                        </div>
                        <img class="direct-chat-img" src="./img/user.png" width="20">
                        <?php
                          if(strlen($message['message'])  >= 1 && strlen($message['image']) < 3 && strlen($message['audio']) < 3 && strlen($message['video']) < 3){
                          	?>
                          	<div class="direct-chat-text">
                              <?php 
                                echo htmlspecialchars(base64_decode($message['message']), ENT_QUOTES);
                              ?>
                            </div>
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) > 3 && strlen($message['audio']) < 3 && strlen($message['video']) < 3){
                          	?>
                          	<img src="../chatimg/<?php echo $message['image']; ?>" class="image-c-big" width="100" style="margin-left: 2%;">
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) < 3 && strlen($message['audio']) > 3 && strlen($message['video']) < 3){
                          	?>
                          	<audio style="margin-left: 2%;" controls>
                          		<source src="../chatAudio/<?php echo $message['audio']; ?>" type="audio/ogg">
                          	</audio>
                          	<?php
                          }else if(strlen($message['message'])  == 0 && strlen($message['image']) < 3 && strlen($message['audio']) < 3 && strlen($message['video']) > 3){
                          	?>
                          	<video style="margin-left: 2%;" width="185" height="150" controls>
                          		<source src="../chatVideo/<?php echo $message['video']; ?>" type="video/ogg">
                          	</video>
                          	<?php
                          }
                        ?>
                      </div>
                  <?php
                }
            }
        }
    }
    ?>
    <div id="image-c-bigg" class="image-c-big-s"><span class="image-c-close btn btn-default">X</span><img src="" id="imgzfbfhrth"></div>
    <?php
}
?>
