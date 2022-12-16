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
$response_data = array(
    'api_status' => 400,
);
if (empty($_POST['page_id'])) {
    $error_code    = 3;
    $error_message = 'page_id (POST) is missing';
}

if (empty($error_code)) {
    $page_id   = Wo_Secure($_POST['page_id']);
    $page_data = Wo_PageData($page_id);
    if (empty($page_data)) {
        $error_code    = 6;
        $error_message = 'Page not found';
    } else {
        $response_data = array('api_status' => 200);
        
        foreach ($non_allowed as $key => $value) {
            unset($page_data[$value]);
        }

        $page_data['post_count'] = Wo_CountPagePosts($page_data['page_id']);
        $page_data['is_liked'] = Wo_IsPageLiked($page_data['page_id'], $user_id);
        $page_data['likes_count'] = Wo_CountPageLikes($page_data['page_id']);
        $page_data['call_action_type_text'] = '';
        if (!empty($page_data['call_action_type'])) {
            $page_data['call_action_type_text'] = $wo['call_action'][$page_data['call_action_type']];
        }
        $page_data['is_rated'] = false;
        if (Wo_IsPageRatingExists($page_id, $wo['user']['id'])) {
            $page_data['is_rated'] = true;
        }
        $page_data['admin_info'] = array();
        if ($wo['user']['id'] != $page_data['user_id'] && Wo_IsPageAdminExists($wo['user']['id'],$page_id)) {
            $page_data['admin_info'] = Wo_GetPageAdminInfo($wo['user']['id'],$page_id);
        }

        // Translate Language Starts
        $detect_language = !empty($_POST['detect_language']) ? $_POST['detect_language'] : '';
        $translate_language = !empty($_POST['translate_language']) ? $_POST['translate_language'] : '';
        if(isset($page_data['username'])){
            $page_data['username'] = Wo_LanguageTranslate($page_data['username'], $detect_language, $translate_language);
        }
        if(isset($page_data['page_name'])){
            $page_data['page_name'] = Wo_LanguageTranslate($page_data['page_name'], $detect_language, $translate_language);
        }
        if(isset($page_data['page_title'])){
            $page_data['page_title'] = Wo_LanguageTranslate($page_data['page_title'], $detect_language, $translate_language);
        }
        if(isset($page_data['page_description'])){
            $page_data['page_description'] = Wo_LanguageTranslate($page_data['page_description'], $detect_language, $translate_language);
        }
        if(isset($page_data['about'])){
            $page_data['about'] = Wo_LanguageTranslate($page_data['about'], $detect_language, $translate_language);
        }
        if(isset($page_data['name'])){
            $page_data['name'] = Wo_LanguageTranslate($page_data['name'], $detect_language, $translate_language);
        }
        if(isset($page_data['category'])){
            $page_data['category'] = Wo_LanguageTranslate($page_data['category'], $detect_language, $translate_language);
        }
        if(isset($page_data['call_action_type_text'])){
            $page_data['call_action_type_text'] = Wo_LanguageTranslate($page_data['call_action_type_text'], $detect_language, $translate_language);
        }
        // Translate Language Ends

        $response_data['page_data'] = $page_data;
    }
}