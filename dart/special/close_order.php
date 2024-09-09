<?php
	include 'includes/session.php';

	if(isset($_POST['approve'])){
		$id = $_POST['id'];
		//$now=date("Y-m-d");
			$user = $_SESSION['store'];
	

		try{
			
			$stmt = $conn->prepare("UPDATE sales_order SET status=:status, approver= :approver WHERE id=:id");

			$stmt->execute(['id'=>$id,'status'=>'1','approver'=>$user]);
		
			$_SESSION['success'] = ' Closed successfully';
			
			
		
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'error occared';
	}

	header('location: order_list.php');

?>