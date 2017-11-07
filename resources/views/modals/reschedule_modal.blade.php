<link  href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
    $('[data-toggle="datepicker"]').datepicker({
        format: 'dd-mm-yyyy',
        zIndex: 99999999999999,
    });
</script>
<!-- Category modal-->
<div id="reschedule_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close"
					data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Reschedule {{$text}}</h4>
				</div>
				<div class="modal-body">
					<form name="reject_form" id="reject_form">
						<div class="container">
              @include('alerts.alert5', ['alert_id' => 'reschedule_alert'])
            <div class="form-group">
							<label for="date">Date:</label></br>
  							<input type="text" name="date" id="date" data-toggle="datepicker"
  								placeholder="Date" class="form-control">
						</div>
						<div class="form-group">
							<label for="reason">Reason:</label></br>
							<input type="text" name="reason" id="reason2"
								placeholder="Reason (optional)" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Cancel</button>
							<button id="btn_reject" type="button" class="btn btn-primary"
                onclick="{{$function}}">
                Confirm
              </button>
						</div>
					</div>
        </form>
      </div>
    </div>
  </div>
</div><!-- Modal end-->
