
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
              <h4 class="modal-title"><b>Edit item</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="transactions.php">
                <input type="hidden" class="id" name="id">
                
                <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">Serial Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_serial_number" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_serial_number" class="col-sm-3 control-label">Weight</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="weight" name="weight">
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
               <h4 class="modal-title"><b>Add New Item</b></h4>
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
                 <label for="category" class="col-sm-3 control-label">Warranty types</label>

                  <div class="col-sm-8">
                    <select class="col-sm-8 control-label" id="category" name="warranty"  required>
                      <option value="" selected>- Select -</option>
                      <option value="Vendor warranty">Vendor warranty</option>
                       <option value="Manufacturer warranty">Manufacturer warranty</option>
                    </select>
				</div>
				</div>
				<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Warrant (in months)</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="brand" name="warranty_time" required>
                    </div>
                </div>
				 <div class="form-group">
                 <label for="category" class="col-sm-3 control-label">Types</label>

                  <div class="col-sm-8">
                    <select class="col-sm-8 control-label" id="category" name="type"  required>
                      <option value="" selected>- Select -</option>
                      <option value="new">New</option>
                      <option value="return">Return</option>
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