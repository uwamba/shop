<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
//$id=1;
$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM devices JOIN user_devices ON devices.id=user_devices.device_id JOIN users ON user_devices.user_id=users.id  WHERE users.id=:id");
		$stmt->execute(['id'=>$id]);
		 foreach ($stmt as $row[]) {
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>