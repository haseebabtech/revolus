<?php

 if($s = 'send_reply'){
  
        if (!file_exists('upload/photos/' . date('Y') . '/' . date('m'))) {
            @mkdir('upload/photos/' . date('Y') . '/' . date('m'), 0777, true);
        }
        $imagePath = $_SERVER["DOCUMENT_ROOT"].'/upload/photos/' . date('Y') . '/' . date('m').'/';
        $mainImage=$_GET['sendMessageFile'];
        if(isset($mainImage) && !empty($mainImage)){
            $frontImageName = 'img' .uniqid(). '.jpg';
            file_put_contents($imagePath . $frontImageName, file_get_contents($mainImage));   
        }
        $to_id = getUser($_GET['post_id']);
        $username = $wo['user']['username'];
        $text = 'Replied by @'.$username;
        $mediaFilename = 'upload/photos/' . date('Y') . '/' . date('m').'/'.$frontImageName;
        $messages = Wo_RegisterMessageV2(array(
            'from_id' => Wo_Secure($wo['user']['user_id']),
            'to_id' => Wo_Secure($to_id['user_id']),
            'text' => $text,
            'media' => Wo_Secure($mediaFilename),
            'mediaFileName' => Wo_Secure($frontImageName),
            'time' => time(),
            'stickers' => null,
        ));
        if ($messages > 0) {
            $data = ['success' => true,'publisher_id' => $to_id['user_id']];
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
        if ($invalid_file > 0 && empty($messages)) {
            $data = array(
                'status' => 500,
                'invalid_file' => $invalid_file
            );
        }
        
    }
    
?>