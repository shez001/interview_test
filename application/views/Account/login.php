<?php echo validation_errors(); ?>
   <?php echo form_open('Account/login/'); ?>
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name='username' id="username" placeholder="Enter username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <div class="col-sm-2">
      <input type="password" class="form-control" name='password' id="password" placeholder="Enter password">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Login</button>
    </div>
  </div>
</form>