<!-- Car modal -->
<div id="car_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Car</h4>
      </div>
      <div class="modal-body">
        <form name="car_modal" id="car_form" class="">
          <div class="container">
          <div class="form-group">
            <label for="car_name" class="">Name:</label>
            <input type="text" name="name" id="car_name"
              placeholder="Car Name" class="form-control">
            <span class="text-danger" id="car_name_error"></span>
          </div>
          <div class="form-group">
            <label for="car_logo" class="">Car Logo:</label>
            <input type="file" class="large" id="car_logo" name="picture"
              class="form-control">
            <span class="text-danger" id="image_error"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newCar()">Add</button>
            @include('small_loader')
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
