<?php

$response_data = array(
    'api_status' => 400
);

$file = fopen("logs_funding_requests.txt", "a");
fwrite($file, "\n\n". json_encode($_POST) );
fclose($file);

$required_fields =  array(
                        'create',
                        'edit',
                        'delete',
                        'funding',
                        'user_funding',
                        'pay'
                    );

$limit = (!empty($_POST['limit']) && is_numeric($_POST['limit']) && $_POST['limit'] > 0 && $_POST['limit'] <= 50 ? Wo_Secure($_POST['limit']) : 20);
$offset = (!empty($_POST['offset']) && is_numeric($_POST['offset']) && $_POST['offset'] > 0 ? Wo_Secure($_POST['offset']) : 0);

if (!empty($_POST['type']) && in_array($_POST['type'], $required_fields)) {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_POST['type'] == 'create') {


        if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_FILES['image']) && !empty($_POST['amount']) && is_numeric($_POST['amount']) && $_POST['amount'] > 0) {

            $insert_array = array();

            $fileInfo      = array(
                'file' => $_FILES["image"]["tmp_name"],
                'name' => $_FILES['image']['name'],
                'size' => $_FILES["image"]["size"],
                'type' => $_FILES["image"]["type"],
                'types' => 'jpeg,jpg,png,bmp'
            );
            $media         = Wo_ShareFile($fileInfo);

            if (!empty($media) && !empty($media['filename'])) {
                // $insert_array = array('title' => Wo_Secure($_POST['title']),
                //                       'description'   => Wo_Secure($_POST['description']),
                //                       'amount'   => Wo_Secure($_POST['amount']),
                //                       'time'   => time(),
                //                       'user_id'  => $wo['user']['id'],
                //                       'image' => $media['filename'],
                //                       'hashed_id' => Wo_GenerateKey(15,15));
                // $fund_id = $db->insert(T_FUNDING,$insert_array);


                $fund_id = mysqli_query($sqlConnect, "INSERT INTO " . T_FUNDING . " (`title`, `description`, `amount`, `time`, `user_id`, `image`, `hashed_id`) VALUES ('" . Wo_Secure($_POST['title']) . "', '".Wo_Secure($_POST['description'])."', '" . Wo_Secure($_POST['amount']) . "', '".time()."', '".$wo['user']['id']."', '".$media['filename']."', '".Wo_GenerateKey(15,15)."')");


                $post_data = array(
                    'user_id' => Wo_Secure($wo['user']['user_id']),
                    'fund_id' => $fund_id,
                    'time' => time(),
                    'multi_image_post' => 0,
                    'postPrivacy' => 0,
                );

                $id = Wo_RegisterPost($post_data);
                $post = Wo_PostData($id);
                if (!empty($post['publisher'])) {
                    foreach ($non_allowed as $key4 => $value4) {
                      unset($post['publisher'][$value4]);
                    }
                }
                else{
                    $post['publisher'] = null;
                }
                if (!empty($post['get_post_comments'])) {
                    foreach ($post['get_post_comments'] as $key3 => $comment) {

                        foreach ($non_allowed as $key5 => $value5) {
                          unset($post['get_post_comments'][$key3]['publisher'][$value5]);
                        }
                    }
                }
                $response_data = array(
                                'api_status' => 200,
                                'data' => $post
                            );
            }
            else{
                $error_code    = 5;
                $error_message = 'file not supported';
            }
        }
        else{
            $error_code    = 6;
            $error_message = 'please check details';
        }
    }

    if ($_POST['type'] == 'edit') {

        if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['amount']) && is_numeric($_POST['amount']) && $_POST['amount'] > 0 && !empty($_POST['id'])) {

            $id = Wo_Secure($_POST['id']);
            $fund = $db->where('id',$id)->getOne(T_FUNDING);
            if (!empty($fund) || ($wo['user']['user_id'] != $fund->user_id && Wo_IsAdmin() == false)) {
                $insert_array = array('title' => Wo_Secure($_POST['title']),
                                      'description'   => Wo_Secure($_POST['description']),
                                      'amount'   => Wo_Secure($_POST['amount']));
                $db->where('id',$id)->update(T_FUNDING,$insert_array);
                $response_data = array(
                                'api_status' => 200,
                                'message' => 'funding edited'
                            );
            }
            else{
                $error_code    = 7;
                $error_message = 'please check details';
            }
        }
        else{
            $error_code    = 6;
            $error_message = 'please check details';
        }

    }

    if ($_POST['type'] == 'delete') {

        if (!empty($_POST['id'])) {
            $id = Wo_Secure($_POST['id']);
            $fund = $db->where('id',$id)->getOne(T_FUNDING);
            if (!empty($fund) || ($wo['user']['user_id'] != $fund->user_id && Wo_IsAdmin() == false)) {

                //@Wo_DeleteFromToS3($fund->image);

                if (file_exists($fund->image)) {
                    try {
                        unlink($fund->image);   
                    }
                    catch (Exception $e) {
                    }
                }

                $db->where('id',$id)->delete(T_FUNDING);
                $raise = $db->where('funding_id',$id)->get(T_FUNDING_RAISE);
                $db->where('funding_id',$id)->delete(T_FUNDING_RAISE);
                $posts = $db->where('fund_id',$id)->get(T_POSTS);
                if (!empty($posts)) {
                    foreach ($posts as $key => $value) {
                        $db->where('parent_id',$value->id)->delete(T_POSTS);
                    }
                }
                    
                $db->where('fund_id',$id)->delete(T_POSTS);
                foreach ($raise as $key => $value) {
                    $raise_posts = $db->where('fund_raise_id',$value->id)->get(T_POSTS);
                    if (!empty($raise_posts)) {
                        foreach ($posts as $key => $value1) {
                            $db->where('parent_id',$value1->id)->delete(T_POSTS);
                        }
                    }
                    $db->where('fund_raise_id',$value->id)->delete(T_POSTS);
                }

                $response_data = array(
                                    'api_status' => 200,
                                    'message' => 'funding deleted'
                                );
            }
            else{
                $error_code    = 7;
                $error_message = 'please check details';
            }
        }
        else{
            $error_code    = 6;
            $error_message = 'id can not be empty';
        }

    }

    if ($_POST['type'] == 'funding') {
        $funding          = GetFunding($limit,$offset);
        foreach ($funding as $key => $value) {
            if (!empty($value['user_data'])) {
                foreach ($non_allowed as $key4 => $value4) {
                  unset($funding[$key]['user_data'][$value4]);
                }
            }
            else{
                $funding[$key]['user_data'] = null;
            }
        }
        $response_data = array(
                            'api_status' => 200,
                            'data' => $funding
                        );

    }

    if ($_POST['type'] == 'user_funding') {

        //print_r($offset);die;


        // $file = fopen("logs_funding.txt", "a");
        // fwrite($file, "\n\n". json_encode($_POST) );
        // fclose($file);


        $user_id = $wo['user']['id'];
        if (!empty($_POST['user_id']) && is_numeric($_POST['user_id']) && $_POST['user_id'] > 0) {
            $user_id = Wo_Secure($_POST['user_id']);
        }

        $funding          = GetFundingByUserId($user_id,$limit,$offset); 
        //print_r($funding);die;

        foreach ($funding as $key => $value) {
            if (!empty($value['user_data'])) {
                foreach ($non_allowed as $key4 => $value4) {
                  unset($funding[$key]['user_data'][$value4]);
                }
            }
            else{
                $funding[$key]['user_data'] = null;
            }
        }
        $response_data = array(
                            'api_status' => 200,
                            'data' => $funding
                        );

    }

    if ($_POST['type'] == 'pay') {
        $user_id = $wo['user']['id'];
        if (!empty($_POST['amount']) && is_numeric($_POST['amount']) && $_POST['amount'] > 0 && !empty($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
            
            $amount = Wo_Secure($_POST['amount']);
            $fund_id = Wo_Secure($_POST['id']);
            $fund = $db->where('id',$fund_id)->getOne(T_FUNDING);
            if (!empty($fund)) {


                $notes = "Doanted to ".mb_substr($fund->title, 0, 100, "UTF-8");

                $create_payment_log = mysqli_query($sqlConnect, "INSERT INTO " . T_PAYMENT_TRANSACTIONS . " (`userid`, `kind`, `amount`, `notes`) VALUES ({$wo['user']['user_id']}, 'DONATE', {$amount}, '{$notes}')");

                $admin_com = 0;
                if (!empty($wo['config']['donate_percentage']) && is_numeric($wo['config']['donate_percentage']) && $wo['config']['donate_percentage'] > 0) {
                    $admin_com = ($wo['config']['donate_percentage'] * $amount) / 100;
                    $amount = $amount - $admin_com;
                }
                $user_data = Wo_UserData($fund->user_id);

                

                $db->where('user_id',$fund->user_id)->update(T_USERS,array('balance' => $user_data['balance'] + $amount));

                //echo '12034';die;

                // $fund_raise_id = $db->insert(T_FUNDING_RAISE,array('user_id' => $wo['user']['user_id'],
                //                                   'funding_id' => $fund_id,
                //                                   'amount' => $amount,
                //                                   'time' => time()));


                $query = mysqli_query($sqlConnect, "INSERT INTO " . T_FUNDING_RAISE . " (`user_id`, `funding_id`, `amount`, `time`) VALUES ('".$wo['user']['user_id']."', '{$fund_id}', '{$amount}', '".time()."')");


                $fund_raise_id     = mysqli_insert_id($sqlConnect);

                

                $post_data = array(
                    'user_id' => Wo_Secure($wo['user']['user_id']),
                    'fund_raise_id' => $fund_raise_id,
                    'time' => time(),
                    'multi_image_post' => 0
                );

                $id = Wo_RegisterPost($post_data);

                $notification_data_array = array(
                    'recipient_id' => $fund->user_id,
                    'type' => 'fund_donate',
                    'url' => 'index.php?link1=show_fund&id=' . $fund->hashed_id
                );
                Wo_RegisterNotification($notification_data_array);
                $response_data = array(
                                    'api_status' => 200,
                                    'message' => 'donated'
                                );
            }
            else{
                $error_code    = 7;
                $error_message = 'fund not found';
            }
        }
        else{
            $error_code    = 6;
            $error_message = 'amount,id can not be empty';
        }
    }

}
else{
    $error_code    = 4;
    $error_message = 'type can not be empty';
}