<?php

//use Stichoza\GoogleTranslate\GoogleTranslate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
//use Stichoza\GoogleTranslate\TranslateClient;

// echo 'test';die;

$tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
$tr->setSource('en'); // Translate from English

$tr->setTarget('ur'); // Translate to Georgian


echo $tr->translate('Hello World!');die;