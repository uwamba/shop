

  
<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Items List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
             
               
             
              <div class="pull-right">
    
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
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
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/products_modal.php'; ?>
   

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#transactions').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });



  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
    
      $('.id').val(response.id);
        $('.id').val(response.id);
      //$('#edit_email').val(response.email);
      //$('#edit_password').val(response.password);
      $('#edit_serial_number').val(response.serial_number);
      $('#weight').val(response.weight);
   
     // getCategory();
     getProduct_name();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
      
       $('.id').val(response.id);
      //$('#edit_email').val(response.email);
      //$('#edit_password').val(response.password);
      $('#edit_serial_number').val(response.serial_number);
       $('#weight').val(response.weight);
      
    }
  });
}

$(document).ready(function() {
$('.mdb-select').materialSelect();
});


 $(document).ready(function(){
            $('#category').change(function(){
                //Selected value
                var inputValue = $(this).val();

                //Ajax for calling php function
               $('#product_name').empty().append('<option selected="selected" value=""> --Select Name-- </option>');
                $.ajax({
                type: 'POST',
                url: 'product_name_fetch.php',
                data: jQuery.param({ cat_id: inputValue}) ,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'json',
                success:function(response){
                  $('#product_name').append(response);
               
                }
              });
                
            });
        });
</script>
</body>
</html>




	  
	  
