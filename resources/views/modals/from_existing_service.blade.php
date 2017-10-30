<style>
  .form-control {
    width: auto;
  }
</style>
<!-- New Service modal -->
<div id="from_existing_service" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Service From Existing</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="new_service_form" id="form_from_existing">
            <div class="form-group">
              <label for="sel3">Service:</label>
               <select name='service_id' id="sel3" onchange="">
                 <option disabled selected value="#">Choose service</option>
                 @foreach($services as $service)
                    <option value="{{$service->service_id}}">{{$service->service}}</option>
                 @endforeach
               </select>
            </div>
          <div class="form-group">
            <label for="sel4">Car:</label>
             <select name='car_id' id="sel4" onchange="fetchModel('sel4')">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label for="sel5">Model:</label>
             <select name='car_model_id' id="sel5">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
             </select>
         </div>
          <div class="form-group">
            <label for="service_price2">Price:</label>
            <input type="text" name="price" id="service_price2"
              placeholder="Price">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add2" type="button" class="btn btn-primary"
              onclick="newService2()">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end new service modal -->
