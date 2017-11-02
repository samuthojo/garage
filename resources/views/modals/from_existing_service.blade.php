<style>
  .form-control {
    width: auto;
  }
</style>
<!-- New Service modal -->
<div id="from_existing_service" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Service From Existing</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="new_service_form" id="form_from_existing"
              class="form-horizontal">
            <div class="form-group">
              <label for="sel3" class="control-label col-sm-2">Service:</label>
              <div style="position:relative; display: block;">
               <select name='service_id' id="sel3" onchange=""
                class="form-control" style="display: inline;">
                 <option disabled selected value="#">Choose service</option>
                 @foreach($services as $service)
                    <option value="{{$service->service_id}}">{{$service->service}}</option>
                 @endforeach
               </select>
               <i class="fa fa-spinner fa-spin fa-2x fa-fw select_loader text-primary"
                style="display: none;"></i>
              </div>
               <span class="text-danger col-sm-offset-2" id="service_error"></span>
            </div>
          <div class="form-group">
            <label for="sel4" class="control-label col-sm-2">Car:</label>
             <select name='car_id' id="sel4" onchange="fetchModel('sel4')"
              class="form-control">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
             <span class="text-danger col-sm-offset-2" id="car_error2"></span>
          </div>
          <div class="form-group">
            <label for="sel5" class="control-label col-sm-2">Model:</label>
             <select name='car_model_id' id="sel5" class="form-control">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
             </select>
             <span  class="text-danger col-sm-offset-2" id="model_error2"></span>
         </div>
          <div class="form-group">
            <label for="service_price2" class="control-label col-sm-2">Price:</label>
            <input type="text" name="price" id="service_price2"
              placeholder="Price" class="form-control">
            <span  class="text-danger col-sm-offset-2" id="price_error2"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add2" type="button" class="btn btn-primary"
              onclick="newService2()">Add</button>
            @include('small_loader')
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end new service modal -->
