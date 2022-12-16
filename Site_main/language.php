<?php

// Google Translate API

// $curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://rapidapi.p.rapidapi.com/language/translate/v2/languages",
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
// 		"x-rapidapi-key: 326749edaamshf99ce55cb6bb6c1p1cd317jsn87e4728d2e88"
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
?>
<?php
    $apiKey = 'AIzaSyA7PgEKeZwYZ9Rq0J1VWJvALJ-yagUDasE';
    $text = 'Hello world!';
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target=fr';

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    echo 'Source: ' . $text . '<br>';
    echo 'Translation: ' . $responseDecoded['data']['translations'][0]['translatedText'];
?>
<?php
    $apiKey = 'AIzaSyA7PgEKeZwYZ9Rq0J1VWJvALJ-yagUDasE';
    $url = 'https://www.googleapis.com/language/translate/v2/languages?key=' . $apiKey;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);     //We want the result to be saved into variable, not printed out
    $response = curl_exec($handle);                         
    curl_close($handle);

    print_r(json_decode($response, true));
?>

