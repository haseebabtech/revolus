<?php
// $mobileno = '923012669664';
//             $messages = 'Hello';
//             $message = urlencode($messages);
//             $sender = 'SEDEMO'; 
//             $apikey = '6jcx935egh57w4r6c58g7i4z4xyiq8j98';
//             $baseurl = 'https://instantalerts.co/api/web/send?apikey='.$apikey;
        
//             $url = $baseurl.'&sender='.$sender.'&to='.$mobileno.'&message='.$message;    
//             $ch = curl_init();
//             $header = array("Content-Type:application/json", "Accept:application/json");
//             curl_setopt($ch, CURLOPT_POST, false);
//             curl_setopt($ch, CURLOPT_URL, $url);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             $response = curl_exec($ch);
//             $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//             curl_close($ch);
//               if ($httpCode >= 200 && $httpCode < 300) {
//                 return true;
//             }else{
//                 return $responseBody->requestError->serviceException->text;
//             }
//             function sendsms($mobileno, $message){

//     $message = urlencode($message);
//     $sender = 'SEDEMO'; 
//     $apikey = '6jcx935egh57w4r6c58g7i4z4xyiq8j98';
//     $baseurl = 'https://instantalerts.co/api/web/send?apikey='.$apikey;

//     $url = $baseurl.'&sender='.$sender.'&to='.$mobileno.'&message='.$message;    
//     $ch = curl_init();
//     $header = array("Content-Type:application/json", "Accept:application/json");
//     curl_setopt($ch, CURLOPT_POST, false);
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $response = curl_exec($ch);
//     curl_close($ch);
//     //print_r($response);
//     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//             curl_close($ch);
//               if ($httpCode >= 200 && $httpCode < 300) {
//                   $re= "success";
//                 return $re;
//             }else{
//                 //return $responseBody->requestError->serviceException->text;
//                 echo "failed";
//             }
//     // Use file get contents when CURL is not installed on server.
//     if(!$response){
//         $response = file_get_contents($url);
//         print_r($response);
//     }
    
// }

// //call function
// sendsms('03012669664', 'Hi, this is a test message');
// $curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/alerts",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"x-rapidapi-host: rapidprod-sendgrid-v1.p.rapidapi.com",
// 		"x-rapidapi-key: 5501eb4957mshcd24e3d0ff48906p14e520jsne7ad55e4306e"
// 	],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
// 	echo "cURL Error #:" . $err;
// } else {
// 	echo $response;
// }
$username = 'nomi23';
$password = 'admin123!@#';
$messages = array(
//   array('to'=>'+923232485863', 'body'=>'Alhamdu Lillah'),
  //array('to'=>'+923480320407', 'body'=>'Ajao'),
   array('to'=>'+923012669664', 'body'=>'Ajh jane ki 2'),
);
$post_body = json_encode($messages);
$url='https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30';

// $result = send_message( json_encode($messages), 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30', $username, $password );

// if ($result['http_status'] != 201) {
//   print "Error sending: " . ($result['error'] ? $result['error'] : "HTTP status ".$result['http_status']."; Response was " .$result['server_response']);
// } else {
//   print "Response " . $result['server_response'];
//   // Use json_decode($result['server_response']) to work with the response further
// }

//function send_message ( $post_body, $url, $username, $password) {
  $ch = curl_init( );
  $headers = array(
  'Content-Type:application/json',
  'Authorization:Basic '. base64_encode("$username:$password"),
  'subject' => "From Revolus",
  );
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt ( $ch, CURLOPT_URL, 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30' );
  curl_setopt ( $ch, CURLOPT_POST, 1 );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
  // Allow cUrl functions 20 seconds to execute
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // Wait 10 seconds while trying to connect
  curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
  $output = array();
  $output['server_response'] = curl_exec( $ch );
  $curl_info = curl_getinfo( $ch );
  $output['http_status'] = $curl_info[ 'http_code' ];
  $output['error'] = curl_error($ch);
  curl_close( $ch );
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
              if ($httpCode >= 200 && $httpCode < 300) {
                  $re= "success";
                  echo '<script>console.log("success")</script>';
                //return $re;
            }else{
                //return $responseBody->requestError->serviceException->text;
                echo "failed";
                echo '<script>console.log("failed")</script>';
            }
  return $output;
//} 

?>