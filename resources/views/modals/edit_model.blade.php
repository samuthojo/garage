<!-- Car modal -->
<div id="edit_model" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        @if(!$title)
        <h4 class="modal-title">Edit Model</h4>
        @else
        <h4 class="modal-title">Edit {{$title}} Model</h4>
        @endif
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="edit_model_form" id="edit_model_form">
          <div class="form-group">
            <label for="edit_model_name" class="control-label col-sm-2">Name:</label>
            <input type="text" name="model_name" id="edit_model_name"
              placeholder="Model Name" class="form-control">
            <span class="text-danger col-sm-offset-2" id="name_error2"></span>
          </div>
          <div class="form-group">
            <label for="edit_model_picture" class="control-label col-sm-2">Replace Picture:</label>
            <input type="file" class="large" id="edit_model_picture" name="picture"
              class="form-control">
            <span class="text-danger col-sm-offset-2" id="picture_error2"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_edit" type="button" class="btn btn-primary"
              onclick="editModel()">Save</button>
            @include('small_loader')
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
