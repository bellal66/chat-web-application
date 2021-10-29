<?php
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$dt = $dt->format('d M Y g:i A');
$ipaddress = '';
if (getenv('HTTP_CLIENT_IP')){
  $ipaddress = getenv('HTTP_CLIENT_IP');
} else if(getenv('HTTP_X_FORWARDED_FOR')){
  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
}else if(getenv('HTTP_X_FORWARDED')){
  $ipaddress = getenv('HTTP_X_FORWARDED');
}else if(getenv('HTTP_FORWARDED_FOR')){
  $ipaddress = getenv('HTTP_FORWARDED_FOR');
}else if(getenv('HTTP_FORWARDED')){
  $ipaddress = getenv('HTTP_FORWARDED');
}else if(getenv('REMOTE_ADDR')){
  $ipaddress = getenv('REMOTE_ADDR');
}else{
  $ipaddress = 'UNKNOWN';
}

if (isset($_POST['signInSuccess'])) {

    if (($_POST['phone'] !== "") && ($_POST['password'] !== "")) {


        $userId = $_POST['phone'];
        $password = $_POST['password'];
        $query = "SELECT * from `chatoperator` where `operator`='$userId'";
        $result = $db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            if($password == $row['password']){
              //set up cookie
              setcookie("userId", $userId, time() + (86400 * 30));
              setcookie("password", $password, time() + (86400 * 30));

              $_SESSION['userId'] = $userId;

              /*$query = "SELECT * FROM `ip` WHERE user='$userId'";
              $result = $db->select($query);
              if ($result) {
                foreach ($result as $resultIp) {

                  $query = "DELETE FROM `ip` WHERE user='$userId'";
                  $result = $db->delete($query);
                }
              }
              $query = "INSERT INTO `ip`(`ip`, `user`, `date`)" . " VALUES ('$ipaddress','$userId','$dt')";
              $resultClubInsert = $db->insert($query);*/
              echo 'yesss';

            }else{
                echo 'no';
            }
        }else{
            echo 'no';
        }
    } else {
        echo 'no';
    }
} else {
    echo 'no';
}
?>