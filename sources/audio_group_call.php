<?php
if (empty($_GET['access_token']) || !isset($_GET['access_token'])) {
	header("Location: " . $wo['config']['site_url']);
	exit();
}
if (empty($_GET['room_name']) || !isset($_GET['room_name'])) {
	header("Location: " . $wo['config']['site_url']);
	exit();
}

$wo['access_token'] = $_GET['access_token'];
$wo['room_name']    = $_GET['room_name'];
$wo['title'] = 'Group Audio Call';

$page = 'audio/groupcall';

$wo['title'] = $wo['config']['siteName'] . ' | ' . $wo['title'];
$wo['content']     = Wo_LoadPage($page);