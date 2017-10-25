<script src="{{asset('js/reports.js')}}"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Reports </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">
      <form class="form-inline" name="report_form"
         id="report_form">
         <div id="my_alert_div">
           @include('alerts.alert', ['alert_class' => 'alert-danger',
                                     'alert_id' => 'notification_alert',
                                     'text' => 'Please select the type of notification!'])
           @include('alerts.alert', ['alert_class' => 'alert-success',
                                     'alert_id' => 'notification_sent',
                                     'text' => 'Notification sent successfully!'])
           @include('alerts.alert', ['alert_class' => 'alert-warning',
                                     'alert_id' => 'notification_failure',
                                     'text' => 'Sending failed, network error!'])
         </div>
         <div class="form-group">
           <select id="type" name="type" class="form-control"
            onchange="fetchStatus()">
              <option value="" selected disabled>Report type</option>
              <option value="0">Orders</option>
              <option value="1">Requested Services</option>
           </select>
         </div>
         <div class="form-group">
           <select id="status" name="status" class="form-control">
              <option value="" selected disabled>Choose status</option>
           </select>
         </div>
         <div class="form-group">
           <input type="text" id="start_date" name="start_date" class="form-control">
         </div>
         <div class="form-group">
           <input type="text" id="end_date" name="end_date" class="form-control">
         </div>
         <div class="form-group">
           <button type="button" class="btn btn-primary" onclick="fetchReport()">
             Submit
           </button>
         </div>
      </form>
    </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>
</div>
