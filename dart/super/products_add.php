<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
		$category = $_POST['category'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['name'];
		$filename1 = $_FILES['photo1']['name'];
		$filename2 = $_FILES['photo2']['name'];
		$filename3 = $_FILES['photo3']['name'];
        $brand = $_POST['brand'];
		$quantity = $_POST['quantity'];
		
		$shop=$admin['company'];
		$user_id=$admin['id'];
		
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE slug=:slug");
		$stmt->execute(['slug'=>$slug]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Product already exist';
		}
		else{
			if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename1 = $slug.'1.'.$ext;
				$new_filename2 = $slug.'2.'.$ext;
				$new_filename3 = $slug.'3.'.$ext;
				$new_filename4 = $slug.'4.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename1);	
				move_uploaded_file($_FILES['photo1']['tmp_name'], '../images/'.$new_filename2);	
				move_uploaded_file($_FILES['photo2']['tmp_name'], '../images/'.$new_filename3);	
				move_uploaded_file($_FILES['photo3']['tmp_name'], '../images/'.$new_filename4);	
			}
			else{
				$new_filename = '';
			}

			try{
				$stmt = $conn->prepare("INSERT INTO products (category_id, name, description, slug, price, photo, photo1, photo2, photo3, brand, quantity, shop,user_id) VALUES (:category, :name, :description, :slug, :price, :photo, :photo1, :photo2, :photo3, :brand, :quantity, :shop, :user_id)");
				$stmt->execute(['category'=>$category, 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo'=>$new_filename1, 'photo1'=>$new_filename2, 'photo2'=>$new_filename3, 'photo3'=>$new_filename4, 'brand'=>$brand, 'quantity'=>$quantity, 'shop'=>$shop, 'user_id'=>$user_id]);
				$_SESSION['success'] = 'User added successfully';

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