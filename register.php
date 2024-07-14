<div class="modal fade" id="addnew">
  <br><br><br><br><br><br><br><br>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4><b>Registration Form</b></h4>
        </center>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="sign_up.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="voters_id" class="col-sm-3 control-label">Student id</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="voters_id" name="voters_id" required>
            </div>
          </div>
          <script>
    document.getElementById('voters_id').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, ''); // Remove all non-numeric characters
        if (value.length > 8) {
            value = value.slice(0, 8); // Limit to 8 digits
        }
        var formattedValue = '';
        for (var i = 0; i < value.length; i += 4) {
            if (i > 0) {
                formattedValue += '-';
            }
            formattedValue += value.substring(i, i + 4);
        }
        e.target.value = formattedValue;
    });
</script>
          <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Firstname</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">Lastname</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>
          <div class="form-group">
            <label for="photo" class="col-sm-3 control-label">Photo</label>
            <div class="col-sm-9">
              <input type="file" id="photo" accept=".jpg, .jpeg, .png" name="photo">
            </div>
          </div>
          <div class="form-group">
            <label for="course" class="col-sm-3 control-label">Course</label>
            <div class="col-sm-9">
              <select type="text" class="form-control" id="course" name="course" required>
                <option value="" selected>-Select-</option>
                <option value="BSIT">BSIT</option>
                <option value="BSBA">BSBA</option>
                <option value="BSED">BSED</option>
                <option value="BEED">BEED</option>
                <option value="BSHM">BSHM</option>
              </select>
            </div>
          </div>
          <center>
            <div class="g-recaptcha" data-sitekey="6LcczA8qAAAAAJNYfZf_E1aZ_soqqdhABAbIGAVk"></div>
          </center>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-block btn-flat" name="add"><i class="fa fa-sign-in"></i> Register</button>
        <br>
      </div>
      </form>
      <center>
        <div>
          <p>Have an account?<a href="#addnew" data-toggle="modal" class="btn">Login Here.</a></p>
        </div>
      </center>
    </div>
  </div>
</div>

<style>
  /* Custom CSS for the registration form */
  .modal-dialog {
    margin-top: 50px;
  }

  .modal-header {
    background-color: #007bff;
    color: white;
    padding: 15px;
  }

  .modal-content {
    border-radius: 10px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .control-label {
    text-align: left;
    padding-top: 7px;
  }

  .form-control {
    border-radius: 5px;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
  }

  .btn {
    margin: 0 5px;
  }

  .modal-footer {
    border-top: none;
    padding-top: 10px;
  }
</style>
