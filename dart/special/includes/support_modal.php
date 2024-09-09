<!-- solution -->
<div class="modal fade" id="solution">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Ticket Resolution</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="solution_add.php">
                  <input type="hidden" class="id" name="id">
                   <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Solution</label>

                    <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="type">
                          <option selected>Type of Support</option>
                          <option value="replacement">Replacement</option>
                          <option value="repair">Repair</option>
                        </select>
                    </div>
                 </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="solution" name="solution"  rows="4" cols="50" required> </textarea>
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
<!-- solution -->

<div class="modal fade" id="note">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Ticket Resolution</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="support_note.php">
                  <input type="hidden" class="id" name="id">
                  
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Solution</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="solution" name="solution"  rows="4" cols="50" required> </textarea>
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

<div class="modal fade" id="replace">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Ticket Resolution</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="replacement.php">
                  <input type="hidden" class="barcode" name="barcode">
                  <input type="hidden" class="item" name="item">
                
                 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Serial Number Of New Item</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="serial" name="serial" required>
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
<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="category_delete.php">
                <input type="hidden" class="catid" name="id">
                <div class="text-center">
                    <p>DELETE CATEGORY</p>
                    <h2 class="bold catname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>
