<!-- New Service modal -->
<div id="edit_service_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Service</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="edit_service_form" id="edit_service_form"
              class="form-horizontal">
            <div class="form-group">
              <label for="sel6" class="control-label col-sm-2">Service:</label>
               <select name='service_id' id="sel6" onchange=""
                class="form-control">
                 <option disabled selected value="#">Choose service</option>
                 @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                 @endforeach
               </select>
               <span  class="text-danger col-sm-offset-2" id="service_error3"></span>
            </div>
          <div class="form-group">
            <label for="sel7" class="control-label col-sm-2">Car:</label>
             <select name='car_id' id="sel7" onchange="fetchModel('sel7')"
              class="form-control">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
             <span  class="text-danger col-sm-offset-2" id="car_error3"></span>
          </div>
          <div class="form-group">
            <label for="sel8" class="control-label col-sm-2">Model:</label>
            <div style="position:relative; display: block;">
             <select name='car_model_id' id="sel8" class="form-control" style="display: inline;">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
               @if(!is_null($models))
                 @foreach($models as $model)
                  <option value="{{$model->id}}">{{$model->model_name}}</<option>
                 @endforeach
               @endif
             </select>
             <i class="fa fa-spinner fa-spin fa-2x fa-fw select_loader text-primary"
              style="display: none;"></i>
           </div>
           <span  class="text-danger col-sm-offset-2" id="model_error3"></span>
         </div>
          <div class="form-group">
            <label for="service_price2" class="control-label col-sm-2">Price:</label>
            <input type="text" name="price" id="edit_service_price"
              placeholder="Price" class="form-control">
            <span  class="text-danger col-sm-offset-2" id="price_error3"></span>
          </div>
          <div class="form-group">
            <label for="service_description" class="control-label col-sm-2">Description:</label>
            <textarea class='form-control' id="edit_service_description" name="description"
              placeholder="Short description" class="form-control"></textarea>
            <span class="text-danger col-sm-offset-2" id="description_error3"></span>
          </div>
          <div class="form-group">
            <label for="picture" class="control-label col-sm-2">Replace Service Picture:</label>
            <input type="file" class="large" id="edit_picture" name="picture"
              class="form-control">
            <span class="text-danger col-sm-offset-2" id="picture_error3"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_edit" type="button" class="btn btn-primary"
              onclick="editService()">Save</button>
            @include('small_loader')
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end new service modal -->
