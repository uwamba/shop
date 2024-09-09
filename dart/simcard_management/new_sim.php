<?php include 'includes/session.php'; ?>

               
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; 
include('header.php');?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
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
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><b>Sim Card Registration form</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="simcard_add.php" enctype="multipart/form-data" >
                   <div class="form-group">
                      <label for="email" class="col-sm-3 control-label"></label>

               
                  
                  
                </div>
               
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">First Name</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="pro_code" name="fname" required >
                    </div>
                </div>
                     <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Last Name</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="pro_code" name="lname" required >
                    </div>
                </div>
                     <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Current Phone</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="pro_code" name="cphone" required >
                    </div>
                </div>
                     <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">email</label>

                    <div class="col-sm-5">
                      <input type="email" class="form-control" id="pro_code" name="email" required >
                    </div>
                </div>
                 <div class="form-group">
                    <label for="number" class="col-sm-3 control-label">Passport</label>

                    <div class="col-sm-5">
                      <input type="file" class="form-control" id="myfile" name="myfile" required >
                    </div>
                </div>
             
			
				<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Requested Date</label>

                    <div class="col-sm-5">
                    
                      <input type='date' id='datepicker' name="date" class="form-control" />
                    </div>
                </div>
				<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Due Date</label>

                    <div class="col-sm-5">
                      
                      <input type='date' id='datepicker' name="date1" class="form-control" />
                    </div>
                </div>
			
			       <div class="form-group">
                    <label for="number" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="address" required >
                    </div>
               </div>
                     <div class="form-group">
                    <label for="number" class="col-sm-3 control-label">House</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="house" required >
                    </div>
               </div>
                     <div class="form-group">
                    <label for="number" class="col-sm-3 control-label">Street</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="street" required >
                    </div>
               </div>
                <div class="form-group">
                    <label for="number" class="col-sm-3 control-label">Country</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="country" required >
                    </div>
                </div>
       
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"></button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- ./wrapper -->

<!-- ./wrapper -->
<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="../bower_components/ckeditor/ckeditor.js"></script>
<script>
$('#toggle').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {
              $('#pro_code').attr('disabled', true); //disable input


        } else {
    
           $('#pro_code').removeAttr('disabled'); //enable input
        }
    });
$('.row').on('click', '.proname', function() {
    $(this).autocomplete({
       source: function( request, response ) {
               
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
 
           select: function (event, ui) {
                //var id = $(this).attr('id');
              $(this).val( ui.item.label );
                return false;
            },
            focus: function(event, ui){
                   $(this).val( ui.item.label );
                return false;
            },
    });
});


 
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#transactions').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
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
      CKEDITOR.instances["editor2"].setData(response.description);
      getCategory();
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
    }
  });
}

$(document).ready(function() {
$('.mdb-select').materialSelect();
});


 $(document).ready(function(){
     getCategory();
     getProduct_name();
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
        
function printimage(img){
    var URL = img;

    var W = window.open(URL);

    W.window.print();
}
function generateBarcode() {
    
    // Reterive the entered barcode
    var u = document.getElementById('upcnumber').value;
    // Split it into an array
    var upc = u.split('');
    // Break up the barcode. Used for writing the numbers underneath the bar code.
    var ns = u.substring(0, 1); //Number System
    var mc = u.substring(1, 6); //Manufactures Code
    var pc = u.substring(6, 11); //Product Code
    var cd = u.substring(11, 12); //Check Digit

    // Modules for barcodes
    var sg = ["101"]; //Start and End Guards are 3 modules
    var mg = ["01010"]; //Middle Guard is 5 modules
    // Each number, 0 through 9, is 7 modules.
    // Left side of the Middle Guard (manufactures code) is odd parity
    var op = ["0001101", "0011001", "0010011", "0111101", "0100011", "0110001", "0101111", "0111011", "0110111", "0001011"];
    // Right side of Middle Guard (product code) is even parity
    var ep = ["1110010", "1100110", "1101100", "1000010", "1011100", "1001110", "1010000", "1000100", "1001000", "1110100"];

    // Loop through the first 6 digits of the barcode and find their corresponding modules in the odd parity array
    upcOP = "";
    var i = 0;
    while (i <= 5) {
        upcOP += op[upc[i]];
        i++;
    }

    // Loop through the last 6 digits of the barcode and find their corresponding modules in the even parity array
    upcEP = "";
    var i = 6;
    while (i <= 11) {
        upcEP += ep[upc[i]];
        i++;
    }

    // Create a string of all the modules including the guards
    var data = sg + upcOP + mg + upcEP + sg;

    // Set height and width of the barcode modules
    var height = 100,
        barWidth = 2;

    // Sets scale range for barcode
    var x = d3.scale.linear()
        .domain([0, d3.max(data)]) // length
    .range([0, height]); // height

    d3.select("#upcCode").remove(); //Clear the SVG container if a new upc code has been entered

    // Select container div and create new holder for the upc
    var chart = d3.select("#container")
        .append("svg:svg")
        .attr("id", "upcCode")

    // Set the size of the upc holder
    var chart = d3.select("#upcCode")
        .attr("height", "130px")
        .attr("width", barWidth * data.length + 40);

    // Draw the barcode
    var bar = chart.selectAll("g")
        .data(data)
        .enter().append("g")
        .attr("transform", function (d, i) {
        return "translate(" + i * barWidth + ")";
    })
        ;

    bar.append("rect")
        .attr("x",20)
        .attr("height",function(d, i) { 
          // Adjusts the height of the guard bars by looking at their index
          if (i==0||i==2||i==46||i==48||i==92||i==94){return (d*100)} else {return(d*80)};
        }) 
        .attr("width", barWidth);

    // Write human readable numbers under the barcode
    chart.append("g")
        .append("text")
        .attr("x", "1px")
        .attr("y", "100px")
        .style("font-size", "24px")
        .style("font-family", "sans-serif")
        .text(ns);

    chart.append("g")
        .append("text")
        .attr("x", "38px")
        .attr("y", "100px")
        .style("font-size", "24px")
        .style("font-family", "sans-serif")
        .text(mc);

    chart.append("g")
        .append("text")
        .attr("x", "128px")
        .attr("y", "100px")
        .style("font-size", "24px")
        .style("font-family", "sans-serif")
        .text(pc);

    chart.append("g")
        .append("text")
        .attr("x", "215px")
        .attr("y", "100px")
        .style("font-size", "24px")
        .style("font-family", "sans-serif")
        .text(cd);
};

function download(){
	var svg = document.getElementsByTagName("svg")[0];
	var svg_xml = (new XMLSerializer).serializeToString(svg);
	var blob = new Blob([svg_xml]);
	var url = window.URL || window.webkitURL;
	var blobURL = url.createObjectURL(blob);
	var a = document.createElement('a');
	a.download = "Barcode.svg";
	a.href = blobURL;
	document.body.appendChild(a);
	a.click();
}
</script>
</body>
</html>
