<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
	
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM shipping  WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Record deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select Location to delete first';
	}
//	echo $id;

	header('location: shipping.php');
	
?>