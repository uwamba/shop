<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT category as domain,COUNT(id) as measure FROM tickets GROUP BY category ");
		$stmt->execute();
		 foreach ($stmt as $row[]) {
		
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>