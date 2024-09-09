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
			$ext1 = pathinfo($filename, PATHINFO_EXTENSION);
			$ext2 = pathinfo($filename1, PATHINFO_EXTENSION);
			$ext3 = pathinfo($filename2, PATHINFO_EXTENSION);
			$ext4 = pathinfo($filename3, PATHINFO_EXTENSION);
				$new_filename1 = $slug.'1.'.$ext1;
				$new_filename2 = $slug.'2.'.$ext2;
				$new_filename3 = $slug.'3.'.$ext3;
				$new_filename4 = $slug.'4.'.$ext4;
				$new_filename_small = $slug.'1';
				
						
		$sourceProperties = getimagesize($_FILES['photo']['tmp_name']);
        $resizeFileName =$new_filename_small;
        $folderPath = "../images/";
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
				
		switch ($imageType) {


           case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagejpeg($imageLayer, $folderPath . "thump_" . $new_filename_small . '.' . $ext);
            break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagegif($imageLayer, $folderPath . "thump_" . $new_filename_small . '.' . $ext);
            break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagepng($imageLayer, $folderPath . "thump_" . $new_filename_small . '.' . $ext);
            break;

            case IMAGETYPE_JPG:
                $resourceType = imagecreatefromjpg($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagepng($imageLayer, $folderPath . "thump_" . $new_filename_small . '.' . $ext);
            break;

            default:
                $imageProcess = 0;
            break;
        }

				
				move_uploaded_file($_FILES['photo']['tmp_name'], $folderPath .$new_filename1);	
				move_uploaded_file($_FILES['photo1']['tmp_name'], $folderPath .$new_filename2);	
				move_uploaded_file($_FILES['photo2']['tmp_name'], $folderPath .$new_filename3);	
				move_uploaded_file($_FILES['photo3']['tmp_name'], $folderPath .$new_filename4);	
			}
			else{
				$new_filename = '';
			}

			try{
				$stmt = $conn->prepare("INSERT INTO products (category_id, name, description, slug, price, photo, photo1, photo2, photo3, brand, quantity, shop,id_user) VALUES (:category, :name, :description, :slug, :price, :photo, :photo1, :photo2, :photo3, :brand, :quantity, :shop, :id_user)");
				$stmt->execute(['category'=>$category, 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo'=>$new_filename1, 'photo1'=>$new_filename2, 'photo2'=>$new_filename3, 'photo3'=>$new_filename4, 'brand'=>$brand, 'quantity'=>$quantity, 'shop'=>$shop, 'id_user'=>$user_id]);
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
function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
{
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
    imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
    return $imageLayer;
}
	function imageResize($imageResourceId,$width,$height) {


    $targetWidth =520;
    $targetHeight =400;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}
	header('location: products.php');

?>