<?php
  if(!isset($_SESSION['user'])){
    header('location: login.php');
	
  }
  
  else{
	  
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
		
		
		
  }
?>

  	<div class="register-box-body">
    	<p class="login-box-msg">Fill Shiping information here and click submit </p>

    	<form action="sales.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo $name;   ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo $secname; ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="plotnumber" placeholder="Plot number" value="<?php echo (isset($_SESSION['house'])) ? $_SESSION['house'] : '' ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="mobilenumber" placeholder="mobile number" value="<?php echo (isset($_SESSION['phone'])) ? $_SESSION['phone'] : '' ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
			
			<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="region" placeholder="Region" value="<?php echo (isset($_SESSION['region'])) ? $_SESSION['region'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
			<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="street" placeholder="Street" value="<?php echo (isset($_SESSION['Street'])) ? $_SESSION['Street'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
	
         
          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Submit</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="login.php">I already have a membership</a><br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
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
