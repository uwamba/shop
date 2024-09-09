
<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$price = $_POST['price'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM district WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Location already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO district (name, price) VALUES (:name, :price)");
				$stmt->execute(['name'=>$name, 'price'=>$price]);
				$_SESSION['success'] = 'Location added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up Location form first';
	}

	header('location: Location.php');

?>