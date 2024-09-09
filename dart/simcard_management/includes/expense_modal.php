
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
              <h4 class="modal-title"><b>Edit any mistake</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="transactions1.php">
                <input type="hidden" class="id" name="id">
                
                <div class="form-group">
                    <label for="edit_expense" class="col-sm-3 control-label">Expense Type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_expense" name="expense">
                    </div>
                </div>
              <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_amount" name="amount">
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
               <h4 class="modal-title"><b>Register Expense</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="expense_add.php" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Expense Type</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="expense" required>
                    </div>
                </div>
                
             
			
				<div class="form-group">
                 <label for="category" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-5">
                      <input type="number" class="form-control proname" id="name" name="amount" required>
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