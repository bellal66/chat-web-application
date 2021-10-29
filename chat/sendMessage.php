<?php
session_start();
include '../lib/Database.php';
$db = new Database();
date_default_timezone_set("Asia/Dhaka");
$dt = new DateTime('now');
$imgdt = $dt->format('dMyh:i');
$dt = $dt->format('d M y h:i A');

if(isset($_POST['sendMessageSubmit'])){
	$chattouser = $_POST['chattouser'];
	$message = base64_encode($_POST['message']);

	if ($message !== '' && $chattouser !== '') {
        
        $query = "SELECT * FROM `chatuserlist` WHERE `userId`='$chattouser'";
		$result = $db->select($query);
		if($result){

			$chatuserlist = $result->fetch_assoc();
			$query = "INSERT INTO `messagechat`(`sender`, `receiver`, `category`, `message`, `date`) VALUES ('$_COOKIE[userId]','$chattouser','$chatuserlist[category]','$message','$dt')";
            $result = $db->insert($query);
            $query = "INSERT INTO `chatuserlist`(`userId`, `category`, `date`) VALUES('$chattouser','$chatuserlist[category]','$dt')";
            $result = $db->insert($query);
            $query = "DELETE FROM `chatuserlist` WHERE `id`='$chatuserlist[id]'";
		    $result = $db->delete($query);
		    
		}
		    
	}
}elseif(isset($_FILES['image']['name'])){
	$chattouser = $_POST['chattouser'];
	$message = $_FILES['image']['name'];
	$message1 = $imgdt.$message;
	$target_file = '../chatimg/'.$message;
	$message2 = $_FILES['image']['tmp_name'];

	if ($message !== '' && $chattouser !== '') {
		
		$query = "SELECT * FROM `chatuserlist` WHERE `userId`='$chattouser'";
		$result = $db->select($query);
		if($result){

			$chatuserlist = $result->fetch_assoc();
			
			if(move_uploaded_file($message2, $target_file)){
				$query = "INSERT INTO `messagechat`(`sender`, `receiver`, `category`, `image`, `date`) VALUES ('$_COOKIE[userId]','$chattouser','$chatuserlist[category]','$message','$dt')";
                $result = $db->insert($query);
                
                $query = "INSERT INTO `chatuserlist`(`userId`, `category`, `date`) VALUES('$chattouser','$chatuserlist[category]','$dt')";
                $result = $db->insert($query);
                $query = "DELETE FROM `chatuserlist` WHERE `id`='$chatuserlist[id]'";
		        $result = $db->delete($query);
		    }else{
			    echo 'Try Later!';
		    }
		    
		}
	}
}
?>