<!-- Category modal-->
<div id="reject_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close"
					data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Reject {{$text}}</h4>
				</div>
				<div class="modal-body">
					<form name="reject_form" id="reject_form">
						<div class="container">
              @include('alerts.alert4', ['alert_id' => 'reject_alert'])
						<div class="form-group">
							<label for="reason">Reason:</label></br>
							<textarea name="reason" id="reason"
								placeholder="Reason" class="form-control"></textarea>
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
