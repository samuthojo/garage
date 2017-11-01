<!-- Category modal-->
<div id="category_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close"
					data-dismiss="modal">&times;</button>
					<h4 class="modal-title">New Category</h4>
				</div>
				<div class="modal-body">
					<form name="new_category" id="new_category">
						<div class="container">
              @include('alerts.alert1', ['alert_id' => 'category_alert'])
						<div class="form-group">
							<label for="category_name">Name:</label></br>
							<input type="text" name="name" id="category_name"
								placeholder="Category name">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Cancel</button>
							<button id="btn_add" type="button" class="btn btn-primary"
                onclick="newCategory()">
                Create
              </button>
							@include('small_loader')
						</div>
					</div>
        </form>
      </div>
    </div>
  </div>
</div><!-- Modal end-->
