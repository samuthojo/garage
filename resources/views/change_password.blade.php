<script src="{{asset('js/change_password.js')}}"></script>
<style>
@media screen and (min-width: 768px) {
     #my_alert_div {
        margin-left: 125px;
    }
}
@media screen and (min-width: 992px) {
     #my_alert_div {
        margin-left: 195px;
    }
}
</style>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Change Password </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">
      <form class="form-horizontal" name="change_password" id="change_password">
        <div id="my_alert_div">
          @include('alerts.change_password', ['alert_class' => 'alert-success',
                                              'alert_id' => 'reset_success',
                                              'text' => 'Password reset successful!'])
          @include('alerts.change_password', ['alert_class' => 'alert-danger',
                                              'alert_id' => 'wrong_old_password',
                                              'text' => 'Old Password Incorrect!'])
          @include('alerts.change_password', ['alert_class' => 'alert-danger',
                                              'alert_id' => 'do_not_match',
                                              'text'=> 'New Passwords do not match!'])
          @include('alerts.alert1', ['alert_id' => 'empty_fields'])
        </div>
        <div class="form-group">
          <label for="old_password" class="control-label col-sm-2">
            Old Password:
          </label>
          <input type="password" name="old_password" id="old_password"
            placeholder="Old Password" class="form-control">
        </div>
        <div class="form-group">
          <label for="new_password" class="control-label col-sm-2">
            New Password:
          </label>
          <input type="password" name="new_password" id="new_password"
            placeholder="New Password" class="form-control">
        </div>
        <div class="form-group">
          <label for="confirm_password" class="control-label col-sm-2">
            Confirm Password:
          </label>
          <input type="password" name="confirm_password" id="confirm_password"
            placeholder="Confirm Password" class="form-control">
        </div>
        <button type="button" class="btn btn-primary col-sm-offset-2"
          onclick="validateInput()">Save</button>
      </form>
    </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>
</div>
