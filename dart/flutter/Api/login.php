<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
	$conn = $pdo->open();
	
	$options = array("cost"=>4);

	$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

	$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';


		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				
					if(password_verify($_REQUEST['password'],$row['password'])){
					
						$return["success"] = true;
						$return["error"] = false;
                        $return["uid"] = $row['id'];
                        $return["names"] = $row['names'];
                        $return["email"] = $row['email'];
                        $return["id"] = $row['id'];
                        $return["phone"] = $row['phone'];
						$return["reset"] = $row['reset'];
						$return["role"] = $row['role'];
						
					
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