<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';


	
     
	
		$id = $_REQUEST['id'];
		$priority = $_REQUEST['priority'];
		$category = $_REQUEST['category'];
		$admin = $_REQUEST['admin'];
	    $resolution = $_REQUEST['resolution'];
        $status = 'resolved';
		$date=date("Y/m/d");
		
			$conn = $pdo->open();


				try{
					$stmt = $conn->prepare("UPDATE  tickets SET priority=:priority, status=:status, resolved_on=:date,assigned=:assigned ,category=:category,resolution=:resolution WHERE id=:id");
					$stmt->execute([ 'priority'=>$priority, 'status'=>$status, 'date'=>$date, 'assigned'=>$admin, 'category'=>$category,'resolution'=>$resolution,'id'=>$id]);
					
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
