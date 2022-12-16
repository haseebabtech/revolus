<?php
function sendNotificationan($tokens, $messagean, $msgurl, $sndrimg){
$url = 'https://onesignal.com/api/v1/notifications';
$fields = array(
'app_id' => "ONESIGNAL_APP_ID",
"url" => "$msgurl",
"large_icon" => "$sndrimg",
'include_player_ids' => $tokens,
'contents' => $messagean
);
$headers = array(
'Authorization:key = REST_API_KEY',
'Content-Type: application/json'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch); 
if ($result === FALSE) {
die('Curl failed: ' . curl_error($ch));
}
curl_close($ch);
return $result;
}
?>