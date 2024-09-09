<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$id = $_POST['id'];
		$type = $_POST['type'];

		try{
			$stmt = $conn->prepare("UPDATE support SET type=:type WHERE id=:id");
			$stmt->execute(['type'=>$type, 'id'=>$id]);
			$_SESSION['success'] = ' updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up   form first';
	}

	header('location: support_view.php');

?>