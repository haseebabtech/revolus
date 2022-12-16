<html>
    <head>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <link rel="stylesheet" href="style.css" type="text/css"> 

    </head>
</html>


<!-- <select>
    <tr>
    <option name="lang">af</option>
    <option name="lang">am</option>
    <option name="lang">ar</option>
    <option name="lang">az</option>
    <option name="lang">en</option>
    <option name="lang">ur</option>
    </tr>
</select> -->
<script>
$(document).ready(function(){
    // Get value on button click and show alert
    $("#myBtn").change(function(){
        // var str = $("#myBtn").val();
        // var msg = $("#msg").val();
        // alert(str);
    });
});
</script>
<!-- <input type="text" id="myBtn"> -->


<form action="http://revolus.com/language.php" method="post">
    <input type="text" name="msg" Placeholder="ENTER MESSAGE">
    <select name="lang1">
    <tr>
    <option value="af">af</option>
    <option value="am">am</option>
    <option value="ar">ar</option>
    <option value="az">az</option>
    <option value="en">ENGLISH</option>
    <option value="ur">URDU</option>
    <!--  -->
    </tr>
</select>
    <input type="submit">
</form>

<?php
if(isset($_POST["lang1"]) && isset($_POST["msg"]))
{
// GET VALUES
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "q=".$_POST["msg"]."&source=en&target=".$_POST["lang1"]."",
    CURLOPT_HTTPHEADER => [
        "accept-encoding: application/gzip",
		"content-type: application/x-www-form-urlencoded",
		"x-rapidapi-host: google-translate1.p.rapidapi.com",
		"x-rapidapi-key: aff6e3c93bmsh72292844b961e95p127d57jsn4a30167de53f"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #=>" . $err;
    } else {
        echo $response;
         $decode = json_decode($response);
        $get_converted_lang =  $decode->data->translations[0]->translatedText;
        print_r($get_converted_lang);
        //json_decode(json_encode($response), true);
        
    }
}

// $ip = $_SERVER['REMOTE_ADDR']; // This will contain the ip of the request

// // You can use a more sophisticated method to retrieve the content of a webpage with php using a library or something
// // We will retrieve quickly with the file_get_contents
// $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

// var_dump($dataArray);

// // outputs something like (obviously with the data of your IP) :

// // geoplugin_countryCode => "DE",
// // geoplugin_countryName => "Germany"
// // geoplugin_continentCode => "EU"

// echo "Hello visitor from: ".$dataArray["geoplugin_countryName"];

//   $language = $_GET['lang']; 
//   if($language == 'english'){
//       $lang_code = 'en';
//       echo $lang_code;
//   }
//   else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }
//   else if($language == 'arabic'){
//       $lang_code = 'ar'; 
//       echo $lang_code;
//   }
//   else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }else if($language == 'urdu'){
//       $lang_code = 'ur'; 
//       echo $lang_code;
//   }
// $curl1 = curl_init();

// curl_setopt_array($curl1, [
// 	CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2/detect",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "POST",
// 	CURLOPT_POSTFIELDS => "q=English%20is%20hard%2C%20but%20detectably%20so",
// 	CURLOPT_HTTPHEADER => [
// 		"accept-encoding: application/gzip",
// 		"content-type: application/x-www-form-urlencoded",
// 		"x-rapidapi-host: google-translate1.p.rapidapi.com",
// 		"x-rapidapi-key: aff6e3c93bmsh72292844b961e95p127d57jsn4a30167de53f"
// 	],
// ]);

// $response = curl_exec($curl1);
// $err = curl_error($curl1);

// curl_close($curl1);

// if ($err) {
// 	echo "cURL Error #:" . $err;
// } else {
// 	//echo $response;
// 	$decode = json_decode($response);
//     $get_converted_lang =  $decode->data->detections[0][0]->language;
//     print_r($get_converted_lang);
// }
// $curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2/languages",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"accept-encoding: application/gzip",
// 		"x-rapidapi-host: google-translate1.p.rapidapi.com",
// 		"x-rapidapi-key: aff6e3c93bmsh72292844b961e95p127d57jsn4a30167de53f"
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
// $text = "hello";
// $from_lan = "english";
// $to_lan = "urdu";
// $json = json_decode(file_get_contents('https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan));
//     $translated_text = $json->responseData->translatedText;

//     return $translated_text;
?>
