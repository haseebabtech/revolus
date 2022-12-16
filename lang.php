<html>
    <head>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <link rel="stylesheet" href="style.css" type="text/css"> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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


<form action="http://revolus.com/lang.php" method="post">
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
                    		"x-rapidapi-key: 58e20906b8msha15301f738d8e99p17ed5ejsn94890bd519a2"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #=>" . $err;
    } else {
        $decode = json_decode($response);
        print_r($decode->data->translations[0]->translatedText);
        $get_converted_lang =  $decode->data->translations[0]->translatedText;
        // print_r($get_converted_lang);
        // print_r($response);
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

?>
