<?php
	include 'includes/session.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	if(isset($_POST['edit'])){
		$id = $_POST['ship_id'];
		$status = $_POST['status'];
       $email = $_POST['email'];
       echo 'email------'. $id;
		try{
			$stmt = $conn->prepare("UPDATE shipping SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>$status, 'id'=>$id]);
			$_SESSION['success'] = 'Status changed  successfully';
			
			
			
			$message = "
						<h2>Thank you for shopping with us.</h2>
						<p>Your order is in  :".$status."</p>
						<p>Email: ".$email."</p>
						<p>Please click the link below to activate your account.</p>
						
					";
					

	                    $headers = "From: admin@readinstore.com\r\n";
	                   $to = "$email";
	                 $subject = "Sending a basic email with php";
	               

	                 


					//Load phpmailer
		    		$output = '';
		    		require('../vendor/autoload.php');
					//require 'vendor/autoload.php';

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
						
						$output .= '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> we have sent the link in your email, please check your email to activate your account!</h4>
			            </div>
			            
					';
			            
				        

				    } 
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: shipping.php');
				    }
					
			
			
			
			
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit Location form first';
	}

	header('location: shipping.php');

?>