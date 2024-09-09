
<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	
	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
        $filename = $_FILES['photo']['name'];
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Category already exist';
		}
		else{
			try{
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
		$new_filename = $slug;
						
		$sourceProperties = getimagesize($_FILES['photo']['tmp_name']);
        $resizeFileName =$new_filename;
        $folderPath = "../mobile/images/";

        $imageType = $sourceProperties[2];
				
		switch ($imageType) {


           case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagejpeg($imageLayer, $folderPath .  $new_filename . '.' . $ext);
            break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagegif($imageLayer, $folderPath .  $new_filename . '.' . $ext);
            break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagepng($imageLayer, $folderPath .  $new_filename . '.' . $ext);
            break;

            case IMAGETYPE_JPG:
                $resourceType = imagecreatefromjpg($_FILES['photo']['tmp_name']);
                $imageLayer = resizeImage($resourceType, $sourceProperties[0], $sourceProperties[1], 520, 400);
                imagepng($imageLayer, $folderPath . $new_filename . '.' . $ext);
            break;

            default:
                $imageProcess = 0;
            break;
        }
				
				//move_uploaded_file($_FILES['photo']['tmp_name'], '../mobile/images/'.$new_filename . '.' . $ext);	
				
			    
				$stmt = $conn->prepare("INSERT INTO category (name,cat_slug,image) VALUES (:name,:cat_slug,:image)");
				$stmt->execute(['name'=>$name,'cat_slug'=>$name,'image'=>$new_filename . '.' . $ext]);
				$_SESSION['success'] = 'Category added successfully';
				
			
			
				
				
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
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
	header('location: category.php');

?>