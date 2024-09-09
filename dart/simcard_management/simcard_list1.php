
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
        Credit List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Sim card List</li>
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
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Current Phone</th>
                  <th>Email</th>
                
                   <th>Requested Date</th>
                  <th>End date</th>
                  <th>address</th>
                  <th>country</th>
                    <th>Passport</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                   try{
                        $stmt_user = $conn->prepare("SELECT * FROM users WHERE id=:id");
                    	$stmt_user->execute(['id'=>$admin['id']]);
                    	$adm = $stmt_user->fetch();
                        $site=$adm['company'];
                      $now = date('Y-m-d');
                        $stmt = $conn->prepare("SELECT * FROM simcard ");
                      //$stmt = $conn->prepare("SELECT *,delivery_note_items.date as date,delivery_note_items.name as name,items.id as id, delivery_note_items.id as item_id, items.price as item_price FROM delivery_note_items  JOIN items on delivery_note_items.item_code=items.barcode JOIN delivery_note ON delivery_note.id=delivery_note_items.delivery_id WHERE items.instore='No' ");
                      $stmt->execute(['user_id'=>$admin['id']]);
                      $today=date("Y-m-d");
                      foreach($stmt as $row){
                       $status="No";
                       if($row['expected_date'] < $today) {
                         $status="Yes";  
                       }
                         
                        echo "
                          <tr>
                            <td>".$row['first_name']."</td>
                            <td>".$row['last_name']."</td>
                            <td>".$row['current_phone']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['requested_date']."</td>
                            <td>".$row['end_date']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['country']."</td>
                           
                            <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='".$row['passport']."'><i class='fa fa-search'></i> View</a></td>
                     
                           
                            <td>
                             
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                              
                             
                            
                             
                          <form class='form-horizontal' method='POST' action='products_delete.php'> 
                           <input type='hidden' value='".$row['id']."' name='id'>
                           <input type='hidden' value='".$row['company_name']."' name='name'>
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
    <?php include 'includes/simcard_modal.php'; ?>
   

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
    url: 'simcard_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
          $('#desc').html(response.passport);
        $('.id').val(response.id);
        $('.id').val(response.id);
      //$('#edit_email').val(response.email);
      //$('#edit_password').val(response.password);
      $('#edit_company_name').val(response.company_name);
      $('#edit_requested_date').val(response.requested_date);
      $('#edit_expected_date').val(response.expected_date);
       $('#edit_amount').val(response.amount);
       $('#edit_telephone').val(response.telephone);
        $('#edit_address').val(response.address);
         $('#edit_status').val(response.status);
      //$('#weight').val(response.weight);
   
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
