<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
$conn = $pdo->open();
	$password=$_REQUEST['password'];
	$options = array("cost"=>4);
	$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
	$return="";
	echo hashPassword;
	//$password="admin";

		try{
			$stmt = $conn->prepare("UPDATE users SET  password = :password");
			$stmt->execute(['password'=>$hashPassword]);
			$row = $stmt->fetch();
			
		}
		catch(PDOException $e){
		    $return["error"] = true;
            $return["message"] = $e->getMessage(); 
		}
	



?>