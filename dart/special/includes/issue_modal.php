
<!-- ADD -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Issuing</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="transctions.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="date" name="date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="add_user" class="col-sm-3 control-label">user</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="add_user" name="user">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Purpose</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="add_name" name="purpose">
                    </div>
                </div>
              
               
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Send</button>
              </form>
            </div>
        </div>
    </div>
</div>



     