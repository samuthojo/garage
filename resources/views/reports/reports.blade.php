<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
<style>
  #report_area {
    padding-top: 20px;
  }
</style>
<script src="{{asset('js/reports.js')}}"></script>
<script src="{{asset('js/datepicker.js')}}"></script>
<script>
    $(document).ready( function() {
      $('[data-toggle="datepicker"]').datepicker({
          format: 'dd-mm-yyyy'
      });

      $("#end_date").val("{{now()->format('d-m-Y')}}");
    });
</script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Reports </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">
      <div id="my_alert_div">
        @include('alerts.alert', ['alert_class' => 'alert-danger',
                                  'alert_id' => 'report_alert',
                                  'text' => 'Please specify atleast report-type and status'])
        @include('alerts.alert', ['alert_class' => 'alert-danger',
                                  'alert_id' => 'report_alert2',
                                  'text' => 'End-date should be provided with a start-date'])
      </div>
      <form class="form-inline" name="report_form"
         id="report_form">
         <div class="form-group">
           <select id="type" name="type" class="form-control"
            onchange="fetchStatus('{{$first_order_date}}', '{{$first_request_date}}')">
              <option value="" selected disabled>Report Type</option>
              <option value="0">Orders</option>
              <option value="1">Requested Services</option>
           </select>
           <span class="help-block" style="margin-top: 32px;"></span>
         </div>
         <div class="form-group">
           <select id="status" name="status" class="form-control">
              <option value="" selected disabled>Choose status</option>
           </select>
           <span class="help-block" style="margin-top: 32px;"></span>
         </div>
         <div class="form-group" style="postion: fixed">
           <input type="text" id="start_date" name="start_date" class="form-control"
            placeholder="Start Date" data-toggle="datepicker">
           <span class="help-block">Start Date</span>
         </div>
         <div class="form-group">
           <input type="text" id="end_date" name="end_date" class="form-control"
            placeholder="End Date" data-toggle="datepicker">
           <span class="help-block">End Date</span>
         </div>
         <div class="form-group">
           <button type="button" class="btn btn-primary" onclick="fetchReport()"
            id="btn_submit">
             Submit
           </button>
           @include('small_loader')
           <span class="help-block" style="margin-top: 32px;"></span>
         </div>
      </form>
      <div id="report_area">
      </div>
    </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>
</div>
