<?php
require 'assets/libraries/anet-sdk-php/autoload.php';
$authorize = array(
  "authorize_login_id"      =>  $wo['config']['authorize_login_id'],
  "authorize_key_secret" =>  $wo['config']['authorize_key_secret']
);
// use net\authorize\api\contract\v1 as AnetAPI;
// use net\authorize\api\controller as AnetController;