<!-- Car modal -->
<div id="edit_car_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Car Info</h4>
      </div>
      <div class="modal-body">
        <form name="car_modal" id="edit_car_form" class="">
          <div class="container">
          <div class="form-group">
            <label for="car_name" class="">Name:</label>
            <input type="text" name="name" id="edit_car_name"
              placeholder="Car Name" class="form-control">
            <span class="text-danger" id="car_name_error2"></span>
          </div>
          <div class="form-group">
            <label for="car_logo" class="">Replace Car Logo:</label>
            <input type="file" class="large" id="edit_car_logo" name="picture"
              class="form-control">
            <span class="text-danger" id="image_error2"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
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
