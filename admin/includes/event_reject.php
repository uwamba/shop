<!-- Edit -->
<div class="modal fade" id="reject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>REJECT</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="event_reject.php">
                <input type="hidden" id="event_id_2" class="event_id" name="id_2">
                <h3>Are you sure you want to reject this event? click on Approve button</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="reject"><i class="fa fa-check-square-o"></i> Reject</button>
              </form>
            </div>
        </div>
    </div>
</div>

