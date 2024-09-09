<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
	    
	     $barcode=uniqid();
       
        $today=date("Y-m-d");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $cphone = $_POST['cphone'];
		$email = $_POST['email'];
		//$myfile = $_POST['myfile'];
		$myfile = $_FILES['myfile']['name'];
		$address = $_POST['address'];
		$house = $_POST['house'];
		$street = $_POST['street'];
		$country = $_POST['country'];
		//$status = "Pending For Payment";
		//$tel = $_POST['tel'];
	//	$barcode = $_POST['barcode'];	
		$date = $_POST['date'];
		$date1 = $_POST['date1'];
        //$brand = $_POST['brand'];
        //$supplier = $_POST['supplier'];
       //$date = date('Y-m-d');
       $user_id=$_SESSION['admin_plus'];
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM simcard WHERE first_name=:first_name");
		$stmt->execute(['first_name'=>$fname]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Simcard already exist';
		}
		else{
			

			try{
				$stmt = $conn->prepare("INSERT INTO simcard (first_name, last_name, current_phone, email, passport,  requested_date, end_date, address, house, street, country) VALUES (:first_name, :last_name, :current_phone, :email, :passport,  :requested_date, :end_date, :address, :house, :street,:country)");
				$stmt->execute(['first_name'=>$fname, 'last_name'=>$lname, 'current_phone'=>$cphone, 'email'=>$email, 'passport'=>$myfile,  'requested_date'=>$date, 'end_date'=>$date1, 'address'=>$address, 'house'=>$house, 'street'=>$street,'country'=>$country]);
				$_SESSION['success'] = 'Sim card registered successfuly';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up credit form first';
	}

	header('location: simcard_list.php');

?>