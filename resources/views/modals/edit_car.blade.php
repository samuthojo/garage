<!-- Car modal -->
<div id="edit_car_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Car</h4>
      </div>
      <div class="modal-body">
        <form name="car_modal" id="edit_car_form" class="form-horizontal">
          <div class="container">
          <div class="form-group">
            <label for="car_name" class="control-label col-sm-2">Name:</label>
            <input type="text" name="name" id="edit_car_name"
              placeholder="Car Name" class="form-control">
            <span class="text-danger col-sm-offset-2" id="car_name_error2"></span>
          </div>
          <div class="form-group">
            <label for="car_models" class="control-label col-sm-2">No. models:</label>
            <input type="text" name="num_models" id="edit_car_models"
              placeholder="Number of models" class="form-control">
            <span class="text-danger col-sm-offset-2" id="num_models_error2"></span>
          </div>
          <div class="form-group">
            <label for="car_logo" class="control-label col-sm-2">Replace Car Logo:</label>
            <input type="file" class="large" id="edit_car_logo" name="picture"
              class="form-control">
            <span class="text-danger col-sm-offset-2" id="image_error2"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="edit_btn_add" type="button" class="btn btn-primary"
              onclick="editCar()">Save</button>
            @include('small_loader')
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
