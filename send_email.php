<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
function send_email($email,$message,$subject){
    
    
					

	                 $headers = "From: admin@elmax.rw\r\n";
	                 $to = "$email";
	                
	                 


					//Load phpmailer
		    		$output = '';
					require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'mail.elamx.rw';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'admin@elmax.rw';     
				        $mail->Password = 'Password@2022';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('admin@elmax.rw');
				        
				        //Recipients
				        $mail->addAddress($email);              
				        $mail->addReplyTo('admin@elmax.rw');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = 'LeadinTechnology';
				        $mail->Body    = $message;

				        $mail->send();
						
						
						
			            
				        

				    } 
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: signup.php');
				    }
					
}

?>