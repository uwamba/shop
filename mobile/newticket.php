<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
	

		$problem = $_POST['problem'];
		$description = $_POST['description'];
		$id = $_POST['item_id'];
		$user = $_POST['user'];
	    $now=date("Y-m-d");
		
		$conn = $pdo->open();

		
			try{
				$stmt = $conn->prepare("INSERT INTO support (user_id,item_id,reported_date,issue,description) VALUES (:user_id,:item_id,:reported_date,:issue,:description)");
				$stmt->execute(['user_id'=>$user,'item_id'=>$id,'reported_date'=>$now,'issue'=>$problem,'description'=>$description]);
				$return["message"] =  'Ticket created successfully';
				$return["error"] =  'false';
			}
			catch(PDOException $e){
				$return["error"] =  'true';
				$return["message"] =  'something went wrong';
			}
		

		$pdo->close();
    echo json_encode($return);

	
	     
?>
