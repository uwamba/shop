
<?php
   if(isset($_GET["category"])){
       $category_id=$_GET["category"];
      
   }
?>
<!-- transactions -->
<div class="modal fade" id="transactions">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit any mistake </b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="transactions.php">
                <input type="hidden" class="id" name="id">
                
                <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">First name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_company_name" name="cname">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">Last name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_company_name" name="lname">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">Current phone</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_company_name" name="cphone">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">email</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_company_name" name="email">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">Requested Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="edit_requested_date" name="date">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label"> End Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="expected_date" name="date1">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_amount" name="address">
                    </div>
                </div>
               
                   <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Passport</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_telephone" name="telephone">
                    </div>
                </div>
                
                   <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Country</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_address" name="address">
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="send"><i class="fa fa-check-square-o"></i> Send</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><b>Add New Product</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_add.php" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Serial Number</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="serial" required>
                    </div>
                </div>
                
                <div class="form-group">
                 <label for="category" class="col-sm-3 control-label">Category</label>

                  <div class="col-sm-8">
                    <select class="col-sm-8 control-label" id="category" name="category"  required>
                      <option value="" selected>- Select -</option>
                    </select>
				</div>
				</div>
				<div class="form-group">
                 <label for="category" class="col-sm-3 control-label">Product Name</label>

                  <div class="col-sm-8">
                    <select class="col-sm-8 control-label" id="product_name" name="product_name" required>
                      <option value="" selected>- Select Product Name -</option>
                     
                    </select>
				</div>
				</div>
               
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Brand</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                </div>
                 
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Supplier</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="supplier" name="supplier" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Barcode</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo uniqid(); ?>" required readonly>
                    </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>