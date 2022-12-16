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

if (empty($_GET['message_id'])) {
	$response_data['api_status'] = 500;
	$response_data['message'] = 'Message ID is missing';
} else if (empty($_GET['message_text'])) {
	$response_data['api_status'] = 500;
	$response_data['message'] = 'Message Text is missing';
} else{
    $message_id = $_GET['message_id'];
    $message_text = $_GET['message_text'];
    if (!empty($message_id) || is_numeric($message_id) || $message_id > 0) {
        if (!empty($message_text)) {
            
            $status = Wo_UpdateMessage($message_id, $message_text);
            if($status === true){
                $response_data['api_status'] = 200;
                $response_data['message'] = 'updated';
            } else{
                $response_data['api_status'] = 500;
                $response_data['message'] = 'Error found '.$status;
            }
        } else{
            $response_data['api_status'] = 500;
            $response_data['message'] = 'Message Text cannot be empty';
        }
    } else{
        $response_data['api_status'] = 500;
        $response_data['message'] = 'Message ID should be a numeric';
    }
}

// print_r(json_encode($response_data));
// exit();
