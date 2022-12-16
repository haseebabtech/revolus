<?php
session_unset();
if (!empty($_SESSION['user_id'])) {
	$_SESSION['user_id'] = '';
	$query = mysqli_query($sqlConnect, "DELETE FROM " .  T_APP_SESSIONS . " WHERE `session_id` = '" . Wo_Secure($_SESSION['user_id']) . "'");
}
session_destroy();
if (isset($_COOKIE['user_id'])) {
	$query = mysqli_query($sqlConnect, "DELETE FROM " .  T_APP_SESSIONS . " WHERE `session_id` = '" . Wo_Secure($_COOKIE['user_id']) . "'");
	$_COOKIE['user_id'] = '';
    unset($_COOKIE['user_id']);
    setcookie('user_id', null, -1);
    setcookie('user_id', null, -1,'/');
} 
$_SESSION = array();
unset($_SESSION);

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Location: " . $wo['config']['site_url']);
exit();