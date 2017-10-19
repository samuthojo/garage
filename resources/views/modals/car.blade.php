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
        <form name="car_modal" id="car_form">
          <div class="container">
            @include('alerts.alert2', ['alert_id' => 'car_alert'])
          <div class="form-group">
            <label for="car_name">Name:</label>
            <input type="text" name="name" id="car_name"
              placeholder="Car Name">
          </div>
          <div class="form-group">
            <label for="car_models">No. models:</label>
            <input type="text" name="num_models" id="car_models"
              placeholder="Number of models">
          </div>
          <div class="form-group">
            <label for="car_logo">Car Logo:</label>
            <input type="file" class="large" id="car_logo" name="picture">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newCar()">Add</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
