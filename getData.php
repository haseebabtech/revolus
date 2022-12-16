<?php
error_reporting(0);
if($_SERVER['REQUEST_METHOD']=='GET'){
	$id  = $_GET['id'];
	$id2  = $_GET['id2'];
	$id3  = $_GET['id3'];
	$id4  = $_GET['id4'];
	$id5  = $_GET['id5'];
	$id6  = $_GET['id6'];
	require_once('db_config.php');
	$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	$sql = "Select value From Wo_Config WHERE name in ('".$id."', '".$id2."', '".$id3."', '".$id4."', '".$id5."', '".$id6."')";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) > 0 ){
		while ($row = mysqli_fetch_assoc($result)) {
			$test[] = $row["value"];
		}
	}
	$resultjson = array();
	array_push($resultjson,array(
		"nbottom"=>$test[0],
		"slide"=>$test[1],
		"bannerid"=>$test[2],
		"banneronoff"=>$test[3],
		"interstitialid"=>$test[4],
		"interstitialonoff"=>$test[5]
		)
	);
	echo json_encode(array("result"=>$resultjson));
	mysqli_close($con);
}