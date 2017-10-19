<!-- Product modal -->
<div id="product_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Product</h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <form name="product_modal" id="product_form" class="form-horizontal col-sm-10">
            @include('alerts.alert2', ['alert_id' => 'product_alert'])
          <div class="form-group">
              <label class="control-label col-sm-2" for="sel2">Category:</label>
               <select id="sel2" class="form-control">
                 <option disabled selected value="#">Choose category</option>
                 @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
               </select>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_name">Name:</label>
            <input type="text" name="name" id="product_name"
              placeholder="Product Name" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="sel2">Car:</label>
             <select id="sel2" onchange="fetchModels('sel2')" class="form-control">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="sel3">Model:</label>
             <select id="sel3" class="form-control">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
             </select>
        </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_unit">Unit:</label>
            <input type="text" name="unit" id="product_unit" class="form-control"
              placeholder="Unit">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_stock">Stock:</label>
            <input type="text" name="stock" id="product_stock" class="form-control"
              placeholder="Stock">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_price">Price:</label>
            <input type="text" name="price" id="product_price" class="form-control"
              placeholder="Price">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_warranty">Warranty:</label>
            <input type="text" name="warranty" id="product_warranty" class="form-control"
              placeholder="Warranty">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="sel4">Has includes:</label>
             <select id="sel4" class="form-control">
               <option disabled selected value="">specify</option>
                  <option>Yes</option>
                  <option>No</option>
             </select>
        </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_includes">Includes:</label>
            <input type="text" name="includes" id="product_includes"
              placeholder="Includes" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="include_price">Include Price:</label>
            <input type="text" name="include_price" id="include_price"
              placeholder="Includes price" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="product_file">Product Picture:</label>
            <input type="file" class="large" id="product_file" name="image"
              class="form-control">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newProduct()">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end add product modal -->
