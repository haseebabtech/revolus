<?php

define('TELEGRAM_API_KEY', '5022906641:AAESbA5ecpCUpOaeZaeGPHApnVGg3_Ct0N8');
define('TELEGRAM_CHAT_ID', '-796907663');

function sendMessage($msg)
{
    $token = TELEGRAM_API_KEY;
    $chatID = TELEGRAM_CHAT_ID;
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&parse_mode=HTML&text=" . urlencode($msg);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
