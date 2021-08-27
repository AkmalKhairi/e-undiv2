<!-- Reset -->
<div class="modal fade" id="reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Reseting...</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <p>RESET VOTES</p>
                  <h4>This will delete all votes and counting back to 0.</h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a href="votes_reset.php" class="btn btn-danger btn-flat"><i class="fa fa-refresh"></i> Reset</a>
            </div>
        </div>
    </div>
</div>

<!-- Notify Voter -->
<div class="modal fade" id="notify">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Notify Voter?</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_notify.php">
                    <input type="hidden" class="id" name="id">
                    <input type="hidden" class="phone" name="phone">
                    <div class="text-center">
                        <p>VOTER:</p>
                        <h2 class="bold fullname"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="notify"><i class="fa fa-bell"></i> Notify</button>
                </form>
            </div>
        </div>
    </div>
</div>