<?php
	include 'includes/session.php';

	if(isset($_POST['approve'])){
		$id = $_POST['id'];
		

		try{
			$stmt = $conn->prepare("UPDATE events SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>"confirmed", 'id'=>$id]);
			$_SESSION['success'] = 'Event approved successfully';
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