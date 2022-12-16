<?php
$logged_in_user = Wo_Secure($wo['user']['user_id']);
$u = getUser($_GET['id']);
$user = $u['user_id'];
if ($f == 'validate_follow' && $wo['loggedin'] === true) {
    if (isset($user)) {
        $user_followers = Wo_CountFollowing($wo['user']['id'], true);
        $friends_limit  = $wo['config']['connectivitySystemLimit'];
        if (Wo_IsFollowing($user, $wo['user']['user_id']) === true || Wo_IsFollowRequested($user, $wo['user']['user_id']) === true) {
            if (Wo_DeleteFollow($user, $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'can_send' => 0,
                    'html' => ''
                );
            }
        } else if ($wo['config']['connectivitySystem'] == 1 && $user_followers >= $friends_limit) {
            $data = array(
                'status' => 400,
                'can_send' => 0
            );
        } else {
            if (Wo_RegisterFollow($user, $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'can_send' => 0,
                    'html' => ''
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    if ($wo['loggedin'] == true) {
        Wo_CleanCache();
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}




?>