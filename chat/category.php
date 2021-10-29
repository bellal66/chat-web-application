<?php
session_start();
include '../lib/Database.php';
$db = new Database();

    $query = "SELECT * FROM `categorysg` WHERE `subAdmin`='$_COOKIE[userId]' OR `subAdmin2`='$_COOKIE[userId]' OR `subAdmin3`='$_COOKIE[userId]' OR `subAdmin4`='$_COOKIE[userId]' OR `subAdmin5`='$_COOKIE[userId]' order by id asc";
    $result = $db->select($query);
    if($result){
    ?>
    <div style="margin-left: 15%; margin-top: 10%;">
        <?php
            foreach ($result as $message) {
                ?>
                    <div style="width: 80%; margin-top: 5%; background: white;" class="btn btn-default groupCategoryChoose" gcategoryId="<?php echo $message['category']; ?>">
                        <?php echo $message['category']; ?>
                    </div>
                <?php
            }
        ?>
    </div>    
    <?php
    }
         
?>