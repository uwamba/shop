<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		

			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
			$return["error"] = true;
            $return["message"] = "Email already taken"; 
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);

				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);

				try{
					$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, created_on,status) VALUES (:email, :password, :firstname, :lastname, :code, :now,:status)");
					$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now,'status'=>'1']);
					$userid = $conn->lastInsertId();

					$message = "
						<h2>Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Password: ".$_POST['password']."</p>
						<p>Please click the link below to activate your account.</p>
						<a href='https://www.readinstore.com/activate.php?code=".$code."&user=".$userid."'>Activate Account</a>
					";
					

	                 $headers = "From: admin@readinstore.com\r\n";
	                 $to = "$email";
	                 $subject = "Active your account";
	               

	                 


					//Load phpmailer
		    		$output = '';
					require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'mail.readinstore.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'admin@readinstore.com';     
				        $mail->Password = 'Password@2021';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('admin@readinstore.com');
				        
				        //Recipients
				        $mail->addAddress($email);              
				        $mail->addReplyTo('admin@readinstore.com');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = 'LeadinTechnology';
				        $mail->Body    = $message;

				        $mail->send();
							$return["error"] = false;
                            $return["message"] = "please check your email to activate your account!"; 
					
						
			            
				        

				    } 
				    catch (Exception $e) {
				        	$return["error"] = true;
                            $return["message"] = "Message could not be sent. Mailer Error: '.$mail->ErrorInfo"; 
					
				    }
					
					


				}
				catch(PDOException $e){
				$return["error"] = true;
                 $return["message"] = $e->getMessage(); 
				}

				$pdo->close();

			}

		



	header('Content-Type: application/json');
  echo json_encode($return);

?>
