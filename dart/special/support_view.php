<?php include 'includes/session.php'; ?>
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
        Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Category</li>
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
            
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Problem</th>
                  <th>Description</th>
                   <th>Item Name</th>
                    <th>Serial Number</th>
                  <th>Date</th>
                   <th>Item Detail</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                        $stmt_user = $conn->prepare("SELECT * FROM users WHERE id=:id");
                    	$stmt_user->execute(['id'=>$amdin['id']]);
                    	$admin = $stmt_user->fetch();
                        $site=$admin['company'];
                        
                        $stmt = $conn->prepare("SELECT *,support.description as support_decr,support.id as support_id,support.item_id as support_item,items.serial_number,items.barcode as bar, products.name as proname FROM support JOIN items ON support.item_id=items.id JOIN products ON items.name=products.id where support.user_id=:user_id Order by reported_date DESC");
                      $stmt->execute(['user_id'=>$admin['special']]);
                        
                      //$stmt = $conn->prepare("SELECT *,support.description as support_decr,support.id as support_id,support.item_id as support_item,items.serial_number,items.barcode as bar, products.name as proname FROM support JOIN items ON support.item_id=items.id JOIN products ON items.name=products.id where support.user_id=58 Order by reported_date DESC");
                      //$stmt->execute();
                      foreach($stmt as $row){
                         
                    
                    
                      
                         
                             if($row['approval']==0){  
                              
                            echo "
                          <tr>
                            <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['reported_date']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm  btn-flat' data-id='".$row['support_id']."'><i class='fa fa-edit'></i> Ticket Open </button>
                           
                              
                            </td>
                          </tr>
                        ";  
                          }
                    else if($row['approval']==1){  
                        if($row['support_type']=='replacement'){ 
                          echo "
                          <tr>
                            <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['bar']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm  btn-flat' data-id='".$row['bar']."' data-item='".$row['support_id']."'><i class='fa fa-edit'></i> Ticket Aproved </button>
                           
                              
                            </td>
                          </tr>
                        ";  
                          }
                          else{
                             echo "
                          <tr>
                            <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['reported_date']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm  btn-flat' data-id='".$row['bar']."'><i class='fa fa-edit'></i> Ticket Aproved </button>
                           
                              
                            </td>
                          </tr>
                        ";    
                          }
                          }
                          else if($row['approval']==2){  
                               echo "
                          <tr>
                            <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['reported_date']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm pending btn-flat' data-id='".$row['support_id']."'><i class='fa fa-edit'></i> Pending for Approval </button>
                           
                              
                            </td>
                          </tr>
                        ";  
                          }
                          else if($row['approval']==3){  
                               echo "
                          <tr>
                          <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['reported_date']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm pending btn-flat' data-id='".$row['support_id']."'><i class='fa fa-edit'></i> Closed </button>
                           
                              
                            </td>
                          </tr>
                        ";  
                          }
                           else if($row['approval']==4){  
                               echo "
                          <tr>
                            <td>".$row['issue']."</td>
                            <td>".$row['support_decr']."</td>
                            <td>".$row['proname']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['reported_date']."</td>
                            <td>
                              <button class='btn btn-success btn-sm item btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i> Item Details </button>
                              <button class='btn btn-success btn-sm history btn-flat' data-id='".$row['support_item']."'><i class='fa fa-edit'></i>Support History</button>
                              
                            </td>
                            <td>
                              <button class='btn btn-success btn-sm Reject btn-flat' data-id='".$row['support_id']."'><i class='fa fa-edit'></i> Rejected </button>
                           
                              
                            </td>
                          </tr>
                        ";  
                          }
                      
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
    <?php include 'includes/support_modal.php'; ?>
     <?php include 'includes/item_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#solution').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.action', function(e){
    e.preventDefault();
    $('#solution').modal('show');
    var id = $(this).data('id');
    
    getRow(id);
  });
  
$(document).on('click', '.close_ticket', function(e){
    e.preventDefault();
    $('#note').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
$(document).on('click', '.replace', function(e){
    e.preventDefault();
    $('#replace').modal('show');
    var id = $(this).data('id');
     var item = $(this).data('item');
    $('.barcode').val(id);
     $('.item').val(item);
  });


  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'support_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_name').val(response.name);
      
    }
  });
}
$(function(){
  $(document).on('click', '.item', function(e){
    e.preventDefault();
    $('#item').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'item.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
       
        $('#detail').prepend(response.list);
        
      }
    });
  });

  $("#item").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
$(function(){
  $(document).on('click', '.history', function(e){
    e.preventDefault();
    $('#history').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'history.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
       
        $('#detail2').prepend(response.list);
        
      }
    });
  });

  $("#history").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
</script>
</body>
</html>
