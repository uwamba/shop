
<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$problem = $_POST['problem'];
		$description = $_POST['description'];
		$id = $_POST['item_id'];
		$user = $_SESSION['user'];
	    $now=date("Y-m-d");
		
		$conn = $pdo->open();

		
			try{
				$stmt = $conn->prepare("INSERT INTO support (user_id,item_id,reported_date,issue,description) VALUES (:user_id,:item_id,:reported_date,:issue,:description)");
				$stmt->execute(['user_id'=>$user,'item_id'=>$id,'reported_date'=>$now,'issue'=>$problem,'description'=>$description]);
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: warranty.php');

?>