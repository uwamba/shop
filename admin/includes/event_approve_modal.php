<!-- Edit -->
<div class="modal fade" id="approve">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>APPROVE</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="event_approve.php">
                <input type="hidden" id="event_id" class="event_id" name="id">
                <h3>Are you sure you want to approve this event? click on Approve button</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="approve"><i class="fa fa-check-square-o"></i> Appove</button>
              </form>
            </div>
        </div>
    </div>
</div>

