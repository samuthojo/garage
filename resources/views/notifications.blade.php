<script src="{{ asset('js/notifications.js') }}"></script>
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
         Notifications </h3>
        <div class="clearfix"></div>
     </div>
     <div class="panel-body">
       <div class="container">
         <form class="form-horizontal" name="notification_form"
            id="notification_form">
            <div id="my_alert_div">
              @include('alerts.alert', ['alert_id' => 'notification_alert',
                                        'text' => 'Please select the type of notification!'])
              @include('alerts.alert', ['alert_id' => 'notification_sent',
                                        'text' => 'Notification sent successfully!'])
              @include('alerts.alert', ['alert_id' => 'notification_failure',
                                        'text' => 'Sending failed!'])
            </div>
            <div class="form-group">
              <label for="type" class="control-label col-sm-2">Type: </label>
              <select name="type" id="notification_type" class="form-control">
                <option value="" selected disabled>Choose type</option>
                <option value="0">Application Update</option>
                <option value="1">Products Update</option>
                <option value="2">Services Update</option>
              </select>
            </div>
            <button type="button" class="btn btn-primary col-sm-offset-2"
              onclick="verifyInput()">
              Send
            </button>
         </form>
       </div>
     </div>
     <div class="panel-footer">
       Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
     </div>
  </div>
