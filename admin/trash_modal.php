<!--Delete-->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Are you sure you want to delete?</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trash_delete">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>Delete Voter</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary fa fa-check pull-left" name="edit"> YES</button>
               <a href="" class="btn btn-danger fa fa-close"> NO</a>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Restore -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Are you sure you want to restore?</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trash_restore">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>Restore Voter</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary fa fa-check pull-left" name="delete"> YES</button>
              <a href="" class="btn btn-danger fa fa-close"> NO</a>
              </form>
            </div>
        </div>
    </div>
</div>
