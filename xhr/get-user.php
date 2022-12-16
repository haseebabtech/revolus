<?php
$user_id = Wo_Secure($wo['user']['user_id']);
$res = [
        'user_id' => getUser($_GET['id']),
        'logged_in_user' => $user_id,
    ];
 echo json_encode($res);
?>