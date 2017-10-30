<style>
  .form-control {
    width: auto;
  }
</style>
<!-- New Service modal -->
<div id="new_service" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Service</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="new_service_form" id="new_service_form">
          <div class="form-group">
            <label for="service_name">Service:</label>
            <input type="text" name="name" id="service_name"
              placeholder="New Service Name">
          </div>
          <div class="form-group">
            <label for="sel1">Car:</label>
             <select name='car_id' id="sel1" onchange="fetchModel('sel1')">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label for="sel2">Model:</label>
             <select name='car_model_id' id="sel2">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
             </select>
         </div>
          <div class="form-group">
            <label for="service_price">Price:</label>
            <input type="text" name="price" id="service_price"
              placeholder="Price">
          </div>
          <div class="form-group">
            <label for="service_description">Description:</label><br/>
            <textarea class='form-control' id="service_description" name="description"
              placeholder="Short description"></textarea>
          </div>
          <div class="form-group">
            <label for="picture">Service Picture:</label>
            <input type="file" class="large" id="picture" name="picture">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
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
