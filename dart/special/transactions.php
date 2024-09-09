<?php
	include 'includes/session.php';

	if(isset($_POST['send'])){

		$date = date("Y-m-d");
		$id = $_POST['id'];
		$warranty = $_POST['warranty'];
		$user = $_SESSION['store'];
		$comp = $_SESSION['company'];
		$purpose = $_POST['purpose'];
		
		$conn = $pdo->open();

	
			try{
				$stmt = $conn->prepare("INSERT INTO issuing (item_id, date, user, company, purpose, approval,warranty) VALUES (:item_id, :date, :user, :company, :purpose, :approval, :warranty)");
				$stmt->execute(['item_id'=>$id, 'date'=>$date, 'user'=>$user, 'company'=>$comp,'purpose'=>$purpose, 'approval'=>'0', 'warranty'=>$warranty]);
				
				$update = $conn->prepare("UPDATE items SET instore='No' WHERE id=:id");
	            $update->execute(['id'=>$id]);
	
				
				$_SESSION['success'] = 'Record  successfully Recorded';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
	}

	header('location: products.php');

?>