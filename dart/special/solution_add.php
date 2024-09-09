<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$id = $_POST['id'];
		$solution = $_POST['solution'];
        $support_type =$_POST['type'];
		try{
			$stmt = $conn->prepare("UPDATE support SET solution=:solution, support_type=:support_type, approval=:approval  WHERE id=:id");
			$stmt->execute(['solution'=>$solution, 'id'=>$id, 'support_type'=>$support_type,'approval'=>2]);
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