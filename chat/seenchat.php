<?php
session_start();
include '../lib/Database.php';
$db = new Database();

if(isset($_POST['seenchat'])){
    $chattouser = $_POST['chattouser'];

    $query = "UPDATE `messagechat` SET `seen`=1 WHERE `sender`='$chattouser' ORDER BY id DESC";
    $result = $db->update($query);

}
?>