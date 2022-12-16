<?php

//use Stichoza\GoogleTranslate\GoogleTranslate;

include './vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
//use Stichoza\GoogleTranslate\TranslateClient;

// echo 'test';die;

$tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
$tr->setSource('en'); // Translate from English

$tr->setTarget('ka'); // Translate to Georgian


echo $tr->translate('Hello World!');