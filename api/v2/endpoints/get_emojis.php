<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response_data = array(
    'api_status' => 400
);

$scan = scandir("upload/animated-gif/");

$files = [];
foreach($scan as $file){
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if(!empty($ext) && $ext == "gif"){
		$file_expl = explode('.', $file);
		$files[] = ['name'=>!empty($file_expl[0])?$file_expl[0]:'', 'url'=>$wo['config']['site_url'] . "/upload/animated-gif/" . $file];
	}
}

if(count($files) > 0){
	$response_data = array(
		'api_status' => 200,
		'message' => $files
	);
} else{
	$error_code    = 1;
	$error_message = 'Emojis not found in directory';
}