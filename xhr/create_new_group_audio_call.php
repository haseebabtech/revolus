<?php 
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

if ($f == 'create_new_group_audio_call') {
    include_once('assets/libraries/twilio/vendor/autoload.php');
    if (empty($_GET['user_id1']) || $_GET['user_id1'] != $wo['user']['user_id']) {
        exit();
    }
    if (empty($_GET['group_id'])) {
        exit();
    }
    if (empty($_GET['group_name'])) {
        exit();
    }
    
    // User Declined Groupd Audio Call
    if(isset($_GET['is_attended']) && $_GET['is_attended'] == 'declined'){
        Wo_UpdateUserAudioCallAttend(Wo_Secure($wo['user']['user_id']), $_GET['group_id'], 'declined');
        $data = array(
            'status' => 200,
            'msg' => 'declined'
        );
        //print_r($data);die;
        
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }

    $room_name  = $_GET['group_id'].$_GET['group_name']; //"Froom 222"; //sha1(rand(1111111, 9999999999));
    
    // $accountSid = "ACdc829274e0eb25add5f5c8054e6b0df7";
    // $token      = "bb47a74c20dfa6e9fb5f8d1fa9a4cf67";
    // $key        = "SK8205fcdd6dfb0c84bd0573c569a6c2f2";
    // $secret     = "7Ys9NjnyNgzjwIVH30iCD7XjSlKS6Hzo";
    
    $accountSid = $wo['config']['TWILIO_ACCOUNT_SID'];
    $token      = $wo['config']['TWILIO_ACCOUNT_TOKEN'];
    $key        = $wo['config']['TWILIO_API_KEY'];
    $secret     = $wo['config']['TWILIO_API_SECRET'];
    
    try {
        // Create Group Room Starts
        $client = new Client($accountSid, $token);
        $exists = $client->video->rooms->read([ 'uniqueName' => $room_name]);
        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $room_name,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);
        }
        //print_r($client);die;
        // Create Group Room Ends
        
        // Join Group Room Starts
        //$identity = rand(3,9999999999);
        $identity = $wo['user']['user_id'].'|'.$wo['user']['name'];
        
        $access_token = new AccessToken($accountSid, $key, $secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($room_name);

        $access_token->addGrant($videoGrant);
        // Join Group Room Ends
        
        $group_members = Wo_GroupGetAudioMembers($_GET['group_id']);
        
        $inserted_ids = [];
        if(count($group_members) > 0){
            foreach($group_members as $gm){
                $insertData = Wo_CreateNewGroupAudioCall(array(
                    'access_token' => Wo_Secure($access_token),
                    'from_id' => Wo_Secure($gm['user_id']),
                    'to_id' => Wo_Secure($wo['user']['user_id']),
                    'access_token_2' => Wo_Secure($access_token),
                    'group_id' => $_GET['group_id'],
                    'group_name' => $_GET['group_name'],
                    'room_name' => $room_name
                ));
                $inserted_ids[] = $insertData;
                
                // PUSH NOTIFICATION STARTS
                $wo['calling_user'] = Wo_UserData($gm['user_id']);
                if (!empty($wo['calling_user']['ios_m_device_id']) && $wo['config']['ios_push_messages'] == 1) {
                    $send_array = array(
                        'send_to' => array(
                            $wo['calling_user']['ios_m_device_id']
                        ),
                        'notification' => array(
                            'notification_content' => 'is calling you',
                            'notification_title' => $wo['calling_user']['name'],
                            'notification_image' => $wo['calling_user']['avatar'],
                            'notification_data' => array(
                                'call_type' => 'video',
                                'access_token_2' => $access_token,
                                'room_name' => $room_name,
                                'call_id' => $insertData
                            )
                        )
                    );
                    Wo_SendPushNotification($send_array,'ios_messenger');
                }
                if (!empty($wo['calling_user']['android_m_device_id']) && $wo['config']['android_push_messages'] == 1) {
                    $send_array = array(
                        'send_to' => array(
                            $wo['calling_user']['android_m_device_id']
                        ),
                        'notification' => array(
                            'notification_content' => 'is calling you',
                            'notification_title' => $wo['calling_user']['name'],
                            'notification_image' => $wo['calling_user']['avatar'],
                            'notification_data' => array(
                                'call_type' => 'video',
                                'access_token_2' => $access_token,
                                'room_name' => $room_name,
                                'call_id' => $insertData
                            )
                        )
                    );
                    Wo_SendPushNotification($send_array,'android_messenger');
                }
                // PUSH NOTIFICATION ENDS
            }
        }
        
        // if attend call then update
        if(isset($_GET['is_attended']) && $_GET['is_attended'] == 'attended'){
            Wo_UpdateUserAudioCallAttend(Wo_Secure($wo['user']['user_id']), $_GET['group_id']);
        }
        
        $data = array(
            'status' => 200,
            'accessToken' => $access_token->toJWT(),
            'roomName' => $room_name,
            'id' => $inserted_ids, //$insertData,
            'url' => $wo['config']['site_url'],// . '/group-video-call/' . $room_name, //$insertData,
            'html' => Wo_LoadPage('modals/audio_group_calling'),
            'text_no_answer' => $wo['lang']['no_answer'],
            'text_please_try_again_later' => $wo['lang']['please_try_again_later']
        );
        //print_r($data);die;
        
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    } catch(Exception $e) {
        $data = 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage();
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}