<?php
if(isset($_POST['fcm_token'])){
$token = $_POST['fcm_token'];
$tokmail = $_POST['fcm_a'];

require_once 'db_config.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($tokmail == "nomail"){
} else {
$Kontrol = mysqli_query($conn, "SELECT token FROM Wo_Users WHERE token = '$token'");
if(mysqli_affected_rows($conn)){
mysqli_query($conn, "UPDATE Wo_Users SET token='' WHERE token = '$token'");
}
$query = "UPDATE Wo_Users SET token='$token' WHERE username='$tokmail'";
}
mysqli_query($conn, $query);
mysqli_close($conn);
}
?>
