<?php

if($s = 'send_forward'){
     
    if(strpos($_GET['sendMessageFile'], 'https://revolus.com/upload/videos') !== false){
        $frontImageName = str_replace("https://revolus.com/upload/videos","upload/videos/",$_GET['sendMessageFile']);
        $mediaFilename = $frontImageName;
    } else{
       if (!file_exists('upload/photos/' . date('Y') . '/' . date('m'))) {
            @mkdir('upload/photos/' . date('Y') . '/' . date('m'), 0777, true);
        }
        $imagePath = $_SERVER["DOCUMENT_ROOT"].'/upload/photos/' . date('Y') . '/' . date('m').'/';
        $mainImage=$_GET['sendMessageFile'];
      ;
        if(isset($mainImage) && !empty($mainImage)){
            $frontImageName = 'img' .uniqid(). '.jpg';
            file_put_contents($imagePath . $frontImageName, file_get_contents($mainImage));   
        }
        $mediaFilename = 'upload/photos/' . date('Y') . '/' . date('m').'/'.$frontImageName;
    }
        
        $to_id = getUser($_GET['post_id']);
        $username = $wo['user']['username'];
        $text = 'Forwarded by @'.$username;
        
        
        $messages = Wo_RegisterMessageV2(array(
            'from_id' => Wo_Secure($wo['user']['user_id']),
            'to_id' => Wo_Secure($_GET['user_id']),
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