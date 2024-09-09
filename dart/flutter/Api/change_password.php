<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
	$conn = $pdo->open();
	
	$options = array("cost"=>4);

	$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

	$old_password = isset($_REQUEST['old_password']) ? $_REQUEST['old_password'] : '';
	$new_password = isset($_REQUEST['new_password']) ? $_REQUEST['new_password'] : '';


		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				
					if(password_verify($_REQUEST['old_password'],$row['password'])){
						$hashPassword = password_hash($new_password,PASSWORD_BCRYPT,$options);
						
						$stmt = $conn->prepare("UPDATE users SET password=:password, reset='0' WHERE email = :email");
			            $stmt->execute(['password'=>$hashPassword,'email'=>$email]);			
					
						$return["success"] = true;
						$return["error"] = false;
						 $return["message"] = "Password Cahnged";  
					
					}
					else{
					$return["error"] = true;
                    $return["message"] = "Incorrect Password";  
					}
				
			}
			else{
				$return["error"] = true;
                $return["message"] = "Email not found"; 
			}
		}
		catch(PDOException $e){
		    $return["error"] = true;
            $return["message"] = $e->getMessage(); 
		}
	

  echo json_encode($return);

?>