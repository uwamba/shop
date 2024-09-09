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
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Serial Number</th>
                  <th>Brand</th>
                  <th>Date</th>
			
                   <th>Action</th>
                   
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      
                      
                       //$stmt = $conn->prepare("SELECT *, products.name as name FROM items JOIN products on items.name=products.id WHERE instore='Yes' ");
                      $stmt = $conn->prepare("SELECT * FROM items WHERE instore='No' ");
                      $stmt->execute();
                      foreach($stmt as $row){
                      
                      	$stmt_user_item = $conn->prepare("SELECT * FROM users WHERE id=:id ");
                    	$stmt_user_item->execute(['id'=>$row['user_id']]);
                    	$user_id = $stmt_user_item->fetch();
                        $site_item=$user_id['company'];
                        
                       
                        
                       
                         
                        $counter = ($row['date_view'] == $now) ? $row['counter'] : 0;
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['brand']."</td>
                            <td>".$row['purchase_date']."</td>
                            
                            <td>
                             
                          <a href='search_warranty.php?serial_number=".$row['serial_number']."' >New Ticket</a>
                             
                          <form class='form-horizontal' method='POST' action='products_delete.php'> 
                           <input type='hidden' value='".$row['id']."' name='id'>
                           <input type='hidden' value='".$row['name']."' name='name'>
                            <input type='hidden' value='".$row['user_id']."' name='user_id'>
                           
                           
                           </form>
                           </td>
                          </tr>
                        ";   
                        }
                       
                      
                      
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
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
