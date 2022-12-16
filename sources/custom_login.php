<?php

// if(empty($_GET['userid']) || empty($_GET['username']) || empty($_GET['redirect_url'])){
//     return false;
// }

if(empty($_GET['token']) || empty($_GET['redirect_url'])){
    return false;
}

$mobile_app = Wo_LoggedinFromApp($_GET['token']);
//print_r($mobile_app);die;

//print_r($_GET);die;

//print_r(str_replace('|', '&', $_GET['redirect_url']));die;

if($mobile_app == true){
    header("Location: " . str_replace('|', '&', $_GET['redirect_url']));
    exit();
}
