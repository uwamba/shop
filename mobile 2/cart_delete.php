<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';

	$conn = $pdo->open();

	$id = $_POST['id'];


		try{
			$stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
			$stmt->execute(['id'=>$id]);
			$output['message'] = 'Deleted'.$id;
			
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}

	$pdo->close();
	echo json_encode($output);

?>