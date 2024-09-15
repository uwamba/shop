<?php
	include 'includes/session.php';

	if(isset($_POST['reject'])){
		$id = $_POST['id_2'];
		
		try{
			$stmt = $conn->prepare("UPDATE events SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>"cancelled", 'id'=>$id]);
			$_SESSION['success'] = 'Event rejected successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Unkown error';
	}

	header('location: event_list.php');

?>