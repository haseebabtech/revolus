<?php 
if ($f == 'android_notification') {
    if ($s == 'send') {
        $data  = array(
            'status' => 304,
            'message' => $error_icon . $wo['lang']['please_check_details']
        );
        $error = false;
        $users = array();
        if (!isset($_POST['url']) || !isset($_POST['description'])) {
            $error = true;
        } else {
            if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                $error = true;
            }
            if (strlen($_POST['description']) < 2 || strlen($_POST['description']) > 300) {
                $error = true;
            }
        }
        if (!$error) {
			$queryno = mysqli_query($sqlConnect, "SELECT token FROM Wo_Users WHERE token != ''");
			if($queryno->num_rows > 0) {
				while($row = $queryno->fetch_assoc()) {
					$tokens[] = $row["token"];
				}
			}
			require_once('mobileapp/snd.php');
			$sndrimg = "";
			$msg = Wo_Secure($_POST['description']);
			$msgurl = Wo_Secure($_POST['url']);
			$messagean = array("en" => "$msg");
			$message_statusan = sendNotificationan($tokens, $messagean, $msgurl, $sndrimg);
			$data = array(
				'status' => 200,
				'message' => $success_icon . $wo['lang']['notification_sent']
			);
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}