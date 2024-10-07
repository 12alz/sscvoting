<!-- Modal for CSV Upload -->
<div class="modal fade" id="csvUploadModal" tabindex="-1" role="dialog" aria-labelledby="csvUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="csvUploadModalLabel">Upload CSV File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- CSV Upload Form inside the modal -->
        <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="csv_file">Select CSV File:</label>
            <input type="file" name="csv_file" accept=".csv" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-upload"></i> Upload CSV
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
