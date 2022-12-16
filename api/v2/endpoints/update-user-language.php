<?php
// +------------------------------------------------------------------------+
// | @author Deen Doughouz (DoughouzForest)
// | @author_url 1: http://www.wowonder.com
// | @author_url 2: http://codecanyon.net/user/doughouzforest
// | @author_email: wowondersocial@gmail.com   
// +------------------------------------------------------------------------+
// | WoWonder - The Ultimate Social Networking Platform
// | Copyright (c) 2018 WoWonder. All rights reserved.
// +------------------------------------------------------------------------+
$response_data   = array(
    'api_status' => 400
);

$user_data = array();
if (!empty($_POST)) {
	$user_data = $_POST;
}

if (isset($_POST['language']) AND !empty($_POST['language'])) {
    Wo_CleanCache();
    if ($wo['loggedin'] == true) {

        // Update User Language
        $update = Wo_UpdateUserData($wo['user']['user_id'], ['translate_language'=>$_POST['language']]);

        // Update Last Seen
        $update_last_seen = Wo_LastSeen($wo['user']['user_id']);

        if ($update) {
            $response_data['api_status'] = 200;
            $response_data['message'] = 'Your language has been updated';
        } else{
            $response_data['message'] = 'Error! Language updation failed';
        }
    }
} else{
    $response_data['message'] = 'Language field is required';
}