<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	$conn = $pdo->open();

		
		$email = $_POST['email'];
		$password = $_POST['password'];

		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				if($row['status']){
					if(password_verify($password, $row['password'])){
					    if($row['type']=='0'){
						$return["success"] = true;
						$return["error"] = false;
                        $return["uid"] = $row['id'];
                        $return["firstname"] = $row['firstname'];
                        $return["lastname"] = $row['lastname'];
                         $return["email"] = $row['email'];
                         $return["id"] = $row['id'];
                        $return["contact_info"] = $row['contact_info'];
						}
						else{
						  $return["error"] = true;
                          $return["message"] = "You are not allowed to login here";  
						}
					
					}
					else{
					$return["error"] = true;
                    $return["message"] = "Incorrect Password";  
					}
				}
				else{
				    $return["error"] = true;
                    $return["message"] = "Account not activated."; 

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
	
 header('Content-Type: application/json');
  echo json_encode($return);

?>