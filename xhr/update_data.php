<?php 
if ($f == 'update_data') {
    if (Wo_CheckMainSession($hash_id) === true) {

        if(Wo_IsMobile() == true){
            // GROUP VIDEO MODALBOX STARTS
            $data['gp_from_id'] = 0;
            $data['gp_to_id'] = 0;
            $data['gp_group_id'] = 0;
            $data['gp_group_name'] = 0;
            $data['gp_room_name'] = 0;
            $data['gp_active'] = 0;
            $data['gp_called'] = 0;
            $data['gp_time'] = 0;
            $data['gp_declined'] = 0;
            
            $data['gp_user_id'] = Wo_Secure($wo['user']['user_id']);
            
            // For Video
            $ag = Wo_GetCurrentUserActiveGroups($data['gp_user_id']);
            
            // For Audio
            $audio = Wo_GetCurrentUserActiveAudioGroups($data['gp_user_id']);
        }

        $sql_query             = mysqli_query($sqlConnect, "UPDATE " . T_APP_SESSIONS . " SET `time` = " . time() . " WHERE `session_id` = '{$session_id}'");
        $data['pop']           = 0;
        $data['status']        = 200;
        $data['notifications'] = Wo_CountNotifications(array(
            'unread' => true
        ));

        $data['data'] = '';
        $data['exists'] = '';
        $data['audio_data'] = '';
        $data['audio_exists'] = '';
        $data['call_type'] = '';
        if(Wo_IsMobile() == true){
            // For Video
            $data['data'] = $ag['data'];
            $data['exists'] = $ag['exists'];
            
            // For Audio
            $data['audio_data'] = $audio['data'];
            $data['audio_exists'] = $audio['exists'];
            $data['call_type'] = $audio['call_type'];
        }
        

        $data['html']          = '';
        $notifications         = Wo_GetNotifications(array(
            'type_2' => 'popunder',
            'unread' => true,
            'limit' => 1
        ));
        foreach ($notifications as $wo['notification']) {
            $data['html']              = Wo_LoadPage('header/notifecation');
            $data['icon']              = $wo['notification']['notifier']['avatar'];
            $data['title']             = $wo['notification']['notifier']['name'];
            $data['notification_text'] = $wo['notification']['type_text'];
            $data['url']               = $wo['notification']['url'];
            $data['pop']               = 200;
            if ($wo['notification']['seen'] == 0) {
                $query     = "UPDATE " . T_NOTIFICATION . " SET `seen_pop` = " . time() . " WHERE `id` = " . $wo['notification']['id'];
                $sql_query = mysqli_query($sqlConnect, $query);
            }
        }
        $data['messages'] = Wo_CountMessages(array(
            'new' => true
        ), 'interval');
        $chat_groups = Wo_CheckLastGroupUnread();
        $data['messages'] = $data['messages'] + count($chat_groups);
        $data['calls']    = 0;
        $data['is_call']  = 0;
        $check_calles     = Wo_CheckFroInCalls();
        if ($check_calles !== false && is_array($check_calles)) {
            $wo['incall']                 = $check_calles;
            $wo['incall']['in_call_user'] = Wo_UserData($check_calles['from_id']);
            $data['calls']                = 200;
            $data['is_call']              = 1;
            $data['calls_html']           = Wo_LoadPage('modals/in_call');
        }
        $data['audio_calls']   = 0;
        $data['is_audio_call'] = 0;
        $check_calles          = Wo_CheckFroInCalls('audio');
        if ($check_calles !== false && is_array($check_calles)) {
            $wo['incall']                 = $check_calles;
            $wo['incall']['in_call_user'] = Wo_UserData($check_calles['from_id']);
            $data['audio_calls']          = 200;
            $data['is_audio_call']        = 1;
            $data['audio_calls_html']     = Wo_LoadPage('modals/in_audio_call');
        }
        $data['followRequests']      = Wo_CountFollowRequests();
        $data['followRequests']      = $data['followRequests'] + Wo_CountGroupChatRequests();
        $data['notifications_sound'] = $wo['user']['notifications_sound'];
    }
    $data['count_num'] = 0;
    if ($_GET['check_posts'] == 'true') {
        if (!empty($_GET['before_post_id']) && isset($_GET['user_id'])) {
            $html              = '';
            $postsData         = array(
                'before_post_id' => $_GET['before_post_id'],
                'publisher_id' => $_GET['user_id'],
                'limit' => 20,
                'ad-id' => 0,
                'placement' => 'multi_image_post'
            );
            $posts             = Wo_GetPosts($postsData);
            $count             = count($posts);
            if ($count == 1) {
                $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_post']);
            }
            else{
                $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_posts']);
            }
            
            $data['count_num'] = $count;
        }
    } else if ($_GET['hash_posts'] == 'true') {
        if (!empty($_GET['before_post_id']) && isset($_GET['user_id'])) {
            $html              = '';
            $posts             = Wo_GetHashtagPosts($_GET['hashtagName'], 0, 20, $_GET['before_post_id']);
            $count             = count($posts);
            if ($count == 1) {
                $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_post']);
            }
            else{
                $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_posts']);
            }
            
            $data['count_num'] = $count;
        }
    }
    $send_messages_to_phones = Wo_MessagesPushNotifier();
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
