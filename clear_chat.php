<?php
require_once('assets/init.php');
$userid=$_POST['user_id'];
$recipt_id=$_POST['reciptid'];
$query="UPDATE Wo_Messages SET deleted_one = 1 WHERE from_id = $userid AND to_id = $recipt_id";
$result=mysqli_query($sqlConnect,$query);
$query="UPDATE Wo_Messages SET deleted_two = 1 WHERE from_id = $recipt_id AND to_id = $userid";
$result=mysqli_query($sqlConnect,$query);
if($result){
    echo "Chat Deleted Succefully";
}