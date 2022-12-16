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


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client = "AfIpboI5vapgyJdikMrEE4NYqsJib_DS_FimZ6jCwx3-Z3hvk-OmucmzJJXWyL-ZgpHBnyygcexCdUX6";
$secret = "EHpXC-Oy5Hx4Lno8gZysl144bXmF0FOojXtkKiVQ20I5Stg1aDDKkJXJ6AHyPz2rCtS6r8lfdVwHJ4OH";

$ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v2/oauth2/token");
// curl_setopt($ch, CURLOPT_HEADER, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

// $result = curl_exec($ch);
// $json = json_decode($result);

// https://api.sandbox.paypal.com/v1/oauth2/token
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);
$json = json_decode($result);
//print_r($json);die;


//Define Payment Related Test Detail    
$email= "sb-e438v216193124@personal.example.com"; //"Yourpaypalemailid@gmail.com";
$fname= "Thecodehelpers";
$lname= "programming blog";
$address= "Street no 3 usa";
$city= "Wahington";
$country= "US";

$zip="99501";
$state="Alaska";
$phone="011554454";

$ccnum= "4012888888881881";
$credit_card_type= "visa";
$ccmo= "02";
$ccyr= "2023";
$cvv2_number= "123";
$first_name= $fname;
$last_name= $lname;
$cost= "2";

$ch = curl_init();
$data = '{
"intent": "sale",
	"payer": {
	"payment_method": "credit_card",
	"payer_info": {
	"email": "'.$email.'",
	"shipping_address": {
	"recipient_name": "'.$fname.' '.$lname.'",
	"line1": "'.$address.'",
	"city": "'.$city.'",
	"country_code": "'.$country.'",
	"postal_code": "'.$zip.'",
	"state": "'.$state.'",
	"phone": "'.$phone.'"
},
"billing_address": {
"line1": "'.$address.'",
"city": "'.$city.'",
"state": "'.$state.'",
"postal_code": "'.$zip.'",
"country_code": "'.$country.'",
"phone": "'.$phone.'"
}
},
"funding_instruments": [{
"credit_card": {
"number": "'. $ccnum.'",
"type": "'.$credit_card_type.'",
"expire_month": "'.$ccmo.'",
"expire_year": "'.$ccyr.'",
"cvv2": "'.$cvv2_number.'",
"first_name": "'.$first_name.'",
"last_name": "'.$last_name.'",
"billing_address": {
"line1": "'.$address.'",
"city": "'.$city.'",
"country_code": "'.$country.'",
"postal_code": "'.$zip.'",
"state": "'.$state.'",
"phone": "'.$phone.'"
			}
		}
	}]
},
"transactions": [{
"amount": {
"total": "'.$cost.'",
"currency": "GBP"
},
"description": "This is member subscription payment at Thecodehelpers.",
"item_list": {
"shipping_address": {
"recipient_name": "'.$fname.' '.$lname.'",
"line1": "'.$address.'",
"city": "'.$city.'",
"country_code": "'.$country.'",
"postal_code": "'.$zip.'",
"state": "'.$state.'",
"phone": "'.$phone.'"
			}
		}
	}]
}';

//print_r($data);die;

try{

curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/payments/payment");
/*curl_setopt($ch, CURLOPT_URL, “https://api.paypal.com/v1/payments/payment”);*/
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$json->access_token));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
//curl_close($ch);
$json_res = json_decode($result);

//$state=$json_res->state;
//echo "<pre>";
var_dump($json_res);
die;
	//
}catch(Exception $ex){
	print_r($ex->getMessage());die;
}


// -------------------------------------------------------------------------------------------
$ch = curl_init();
$clientId = "AfIpboI5vapgyJdikMrEE4NYqsJib_DS_FimZ6jCwx3-Z3hvk-OmucmzJJXWyL-ZgpHBnyygcexCdUX6";
$secret = "EHpXC-Oy5Hx4Lno8gZysl144bXmF0FOojXtkKiVQ20I5Stg1aDDKkJXJ6AHyPz2rCtS6r8lfdVwHJ4OH";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);
$json = json_decode($result);
print_r($json->access_token);die;

// if(empty($result)){
// 	die("Error: No response.");
// } else {
//     $json = json_decode($result);
//     print_r($json->access_token);
// }
curl_close($ch);


$data = [];
$data["intent"] = ["CAPTURE"];
$data["purchase_units"]["items"] = [
	"name"=>"T-Shirt",
	"description"=>"Green XL",
	"quantity"=>"1",
	"unit_amount"=>[
		"currency_code"=>"USD",
		"value"=>"44.00"
	]
];
$data["purchase_units"]["amount"] = [
	"currency_code"=>"USD",
	"value"=>"44.00",
	"breakdown"=>[
		"item_total"=>[
			"currency_code"=>"USD",
			"value"=>"44.00"
		]
	]
];
$data["application_context"] = [
	"return_url"=>"https://example.com/return",
    "cancel_url"=>"https://example.com/cancel"
];

$ch2 = curl_init();
$clientId = "AfIpboI5vapgyJdikMrEE4NYqsJib_DS_FimZ6jCwx3-Z3hvk-OmucmzJJXWyL-ZgpHBnyygcexCdUX6";
$secret = "EHpXC-Oy5Hx4Lno8gZysl144bXmF0FOojXtkKiVQ20I5Stg1aDDKkJXJ6AHyPz2rCtS6r8lfdVwHJ4OH";

$authorization = "Authorization: Bearer ".$json->access_token;
//print_r($authorization);die;

curl_setopt($ch2, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
//curl_setopt($ch2, CURLOPT_HEADER, false);
//curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch2);
print_r($result);
die;

if(empty($result)){
	die("Error: No response.");
} else {
    $json = json_decode($result);
    print_r($json->access_token);
}
curl_close($ch2);


die;


$response_data['family'] = '';