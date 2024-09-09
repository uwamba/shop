<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_SESSION['user'])){
    header('location: login.php');
	
  }
  
  else{
	  
	 include 'includes/header.php'; 
	 ?>
<body class="hold-transition register-page">
<div class="register-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
	
	<?php
  if(isset($_SESSION['user'])){
    $id=$_SESSION['user'];
	
	
	$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$name = $row['firstname'];
		$secname= $row['lastname'];
		$email= $row['email'];
		
		
		
  }
?>
	<?php
	$location='';
  if(isset($_SESSION['user'])){
    $id=$_SESSION['user'];
	
	
	$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM shipping WHERE user_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		//$name = $row['firstname'];
		//$secname= $row['lastname'];
		//$email= $row['email'];
		$phone=$row['phone'];
		$street=$row['street'];
		$location=$row['location'];
		
		
		
  }
?>

  	<div class="register-box-body">
    	<p class="login-box-msg">Fill this form to place order </p>

    	<form action="order_location.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo $name;   ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo $secname; ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		    
		            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="mobilenumber" placeholder="mobile number" value="<?php echo $phone; ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>"  required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
			<div class="form-group has-feedback">
			  <select class="form-control input-sm" id="select_category" name="region">
                      <option value="District">District</option>
                      <?php
                      if(isset($_SESSION['user'])){
                      
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM district");
                        $stmt->execute();
						foreach($stmt as $crow){
                          $selected = ($crow['id'] == $location) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
						 
                        }

                        $pdo->close();
                      }
                      ?>
                    </select>
		
		</div>
			<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="street" placeholder="Street" value="<?php echo $street; ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
	
         
          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="order"><i class="fa fa-pencil"></i> Submit</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="login.php">I already have a membership</a><br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>
<?php 
	  
	  
	  
  }

  if(isset($_SESSION['captcha'])){
    $now = time();
    if($now >= $_SESSION['captcha']){
      unset($_SESSION['captcha']);
    }
  }

?>
