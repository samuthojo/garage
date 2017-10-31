<style>
  .form-control {
    width: auto;
  }
</style>
<!-- New Service modal -->
<div id="new_service" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Service</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="new_service_form" id="new_service_form"
            class="form-horizontal">
          <div class="form-group">
            <label for="service_name" class="control-label col-sm-2">Service:</label>
            <input type="text" name="name" id="service_name"
              placeholder="New Service Name" class="form-control">
            <span class="text-danger col-sm-offset-2" id="name_error"></span>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-sm-2">Car:</label>
             <select name='car_id' id="sel1" onchange="fetchModel('sel1')"
              class="form-control">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
             <span class="text-danger col-sm-offset-2" id="car_error"></span>
          </div>
          <div class="form-group">
            <label for="sel2" class="control-label col-sm-2">Model:</label>
             <select name='car_model_id' id="sel2" class="form-control">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
             </select>
             <span class="text-danger col-sm-offset-2" id="model_error"></span>
         </div>
          <div class="form-group">
            <label for="service_price" class="control-label col-sm-2">Price:</label>
            <input type="text" name="price" id="service_price"
              placeholder="Price" class="form-control">
            <span class="text-danger col-sm-offset-2" id="price_error"></span>
          </div>
          <div class="form-group">
            <label for="service_description" class="control-label col-sm-2">Description:</label>
            <textarea class='form-control' id="service_description" name="description"
              placeholder="Short description" class="form-control"></textarea>
            <span class="text-danger col-sm-offset-2" id="description_error"></span>
          </div>
          <div class="form-group">
            <label for="picture" class="control-label col-sm-2">Service Picture:</label>
            <input type="file" class="large" id="picture" name="picture"
              class="form-control">
            <span class="text-danger col-sm-offset-2" id="picture_error"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newService1()">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end new service modal -->
