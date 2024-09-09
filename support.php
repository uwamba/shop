<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_SESSION['user'])){
    header('location: login2.php');
	
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
		$stmt = $conn->prepare("SELECT * FROM shipping WHERE id=:id");
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
    	<p class="login-box-msg">Fill this form to request support  </p>

    	<form action="support_add.php" method="POST">
    	    <input type="hidden"  name="item_id" value="<?php echo $_GET['item_id'];  ?>">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="problem" placeholder="problem"  required>
            <span class="glyphicon glyphicon-comment form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            
            <span class="glyphicon glyphicon-comment form-control-feedback"></span>
          </div>
		    
		            
          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="add"><i class="fa fa-pencil"></i> Submit</button>
        		</div>
      		</div>
    	</form>
      <br>
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
