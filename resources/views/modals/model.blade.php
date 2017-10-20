<!-- Car modal -->
<div id="model_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        @if(!$title)
        <h4 class="modal-title">New Model</h4>
        @else
        <h4 class="modal-title">New {{$title}} Model</h4>
        @endif
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="model_form" id="model_form">
            @include('alerts.alert2', ['alert_id' => 'model_alert'])
          <div class="form-group">
            <label for="car_id">Car:</label>
            <select id="car_id" name="car_id">
              <option value="">Choose Car</option>
              @foreach($cars as $car)
                <option value="{{$car->id}}">{{$car->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="model_name">Name:</label>
            <input type="text" name="model_name" id="model_name"
              placeholder="Model Name">
          </div>
          <div class="form-group">
            <label for="model_picture">Model Picture:</label>
            <input type="file" class="large" id="model_picture" name="picture">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newModel()">Add</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
