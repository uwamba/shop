<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

     	$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$conn = $pdo->open();
				try{
					$stmt = $conn->prepare("UPDATE users SET password=:password, firstname=:firstname, lastname=:lastname WHERE id=:id");
					$stmt->execute([ 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname,'id'=>$id]);
	
                 $return["error"] = true;
                 $return["message"] = "Updated Successfuly"; 

				    } 
				    
				catch(PDOException $e){
				$return["error"] = true;
                 $return["message"] = $e->getMessage(); 
				}

				$pdo->close();
             	header('Content-Type: application/json');
                echo json_encode($return);

?>
