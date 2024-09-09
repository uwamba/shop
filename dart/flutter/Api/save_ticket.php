<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';


	
     
	
		$ticket = $_REQUEST['ticket'];
		$location = $_REQUEST['location'];
		$priority = $_REQUEST['priority'];
		$category = $_REQUEST['category'];
		$user_id = $_REQUEST['priority'];
		$ext = $_REQUEST['ext'];
        $logged = 'logged';
		$date=date("Y/m/d");
		
		$targetDir = "images/";
		$fileName = basename($_FILES["photo"]["name"]);
		$targetFilePath = $targetDir . $fileName;
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
			$conn = $pdo->open();


				try{
					$stmt = $conn->prepare("INSERT INTO tickets (issue, location, priority, status, created_on, logged_by,category,photo) VALUES (:issue, :location, :priority, :status, :created_on, :logged_by,:category,:photo)");
					$stmt->execute(['issue'=>$ticket, 'location'=>$location, 'priority'=>$priority, 'status'=>$logged, 'created_on'=>$date, 'logged_by'=>$user_id, 'category'=>$category,'photo'=>$fileName]);
					$userid = $conn->lastInsertId();

		            $return["error"] = false;
	                   
					 $return["message"] = "Ticket Created Succesuly";

				}
				
				catch(PDOException $e){
				$return["error"] = true;
                 $return["message"] = $e->getMessage(); 
				}

				$pdo->close();


	header('Content-Type: application/json');
    echo json_encode($return);

?>
