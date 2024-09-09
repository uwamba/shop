<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
    include 'includes/barcode.php';
    include('qrcode/qrlib.php');
    
	if(isset($_POST['add'])){
	    
	    
        $barcode=uniqid();
       
        $uppercase = strtoupper($barcode);
         $filepath="barcodes/".$barcode.".png";
         $text=$barcode;
         $size="80";
         $orientation="horizontal";
         $code_type="code128";
         $errorCorrectionLevel="L";
         $matrixPointSize="2";
       // barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );
        QRcode::png($text, $filepath, $errorCorrectionLevel, $matrixPointSize, 40);
       
        //$bc = new Barcode39($uppercase); 
       // $bc->barcode_text_size = 5; 
        //$bc->barcode_bar_thick = 4; 
        //$bc->barcode_bar_thin = 2; 
        //$bc->draw("barcodes/".$barcode.".png");
	    
	    
		$name = $_POST['product_name'];
		$serial_number = $_POST['serial'];
		$category = $_POST['category'];
		$warranty = $_POST['warranty'];
		$type = $_POST['type'];
		$price = $_POST['price'];
        $brand = $_POST['brand'];
        $supplier = $_POST['supplier'];
         $warranty_time = $_POST['warranty_time'];
       $date = date('Y-m-d');
       $user_id=$_SESSION['store'];
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM items WHERE serial_number=:serial_number");
		$stmt->execute(['serial_number'=>$serial_number]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Product already exist';
		}
		else{
			

			try{
				$stmt = $conn->prepare("INSERT INTO items (serial_number, name, brand, barcode, purchase_date, supplier, price, user_id, type, warranty_type, warranty) VALUES (:serial_number, :name, :brand, :barcode, :purchase_date, :supplier, :price, :user_id, :type, :warranty_type, :warranty)");
				$stmt->execute(['serial_number'=>$serial_number, 'name'=>$name, 'brand'=>$brand, 'barcode'=>$barcode, 'price'=>$price, 'purchase_date'=>$date, 'supplier'=>$supplier, 'user_id'=>$user_id, 'type'=>$type, 'warranty_type'=>$warranty, 'warranty'=>$warranty_time]);
				$_SESSION['success'] = 'Item added successfuly';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: products.php');

?>