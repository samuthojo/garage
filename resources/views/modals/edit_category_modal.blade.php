<!-- Edit Category modal-->
<div id="edit_category_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close"
					data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Category</h4>
				</div>
				<div class="modal-body">
					<form name="edit_category" id="edit_category">
						<div class="container">
            	@include('alerts.alert1', ['alert_id' => 'edit_category_alert'])
						<div class="form-group">
							<label for="new_name">Name:</label></br>
							<input type="text" name="name" id="new_name"
								placeholder="New category name">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Cancel</button>
							<button id="btn_save" type="button"
                onclick="editCategory()" class="btn btn-primary">Save</button>
							@include('small_loader')
						</div>
					</div>
        </form>
      </div>
    </div>
  </div>
</div><!-- Edit Category Modal End-->
