<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$id = $_POST['id'];
		$solution = $_POST['solution'];
		try{
			$stmt = $conn->prepare("UPDATE support SET action=:action, approval=:approval WHERE id=:id");
			$stmt->execute(['action'=>$solution, 'id'=>$id, 'approval'=>3]);
			$_SESSION['success'] = 'Category updated successfully';
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