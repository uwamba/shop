<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	       $catid=$_POST['id'];
	       $conn = $pdo->open();
		    $stmt = $conn->prepare("SELECT * FROM products WHERE display=:display AND category_id = :catid");
			$stmt->execute(['catid' => $catid,'display'=>'0']);
		     foreach ($stmt as $row[]) {
						  
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>