//Load phpmailer
<?php
include 'sendEmail.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';
		    		function sendEmail($email,$message){
							$output = '';
					

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'uwambadodo@gmail.com';     
				        $mail->Password = '125dodosss';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('uwambadodo@gmail.com');
				        
				        //Recipients
				        $mail->addAddress($email);              
				        $mail->addReplyTo('uwambadodo@gmail.com');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = 'Plan';
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
					?>
					
					
				