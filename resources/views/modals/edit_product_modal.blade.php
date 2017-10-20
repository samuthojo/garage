<!-- Edit Product modal -->
<div id="edit_product_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <form name="product_modal" id="edit_product_form">
          <div class="container">
            @include('alerts.alert3', ['alert_id' => 'edit_product_alert'])
            <div class="form-group">
              <label for="sel5">Category:</label>
               <select id="sel5" name="category_id">
                 <option disabled selected value="#">Choose category</option>
                 @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
               </select>
          </div>
          <div class="form-group">
            <label for="edit_product_name">Name:</label>
            <input type="text" name="name" id="edit_product_name"
              placeholder="Product Name">
          </div>
          <div class="form-group">
            <label for="sel6">Car:</label>
             <select id="sel6" name="car_id" onchange="fetchModels('sel6')">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label for="sel7">Model:</label>
             <select id="sel7" name="car_model_id">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
               @foreach($models as $model)
                  <option value="{{$model->id}}">{{$model->model_name}}</option>
               @endforeach
             </select>
        </div>
          <div class="form-group">
            <label for="edit_product_unit">Unit:</label>
            <input type="text" name="unit" id="edit_product_unit"
              placeholder="Unit">
          </div>
          <div class="form-group">
            <label for="edit_product_stock">Stock:</label>
            <input type="text" name="stock" id="edit_product_stock"
              placeholder="Stock">
          </div>
          <div class="form-group">
            <label for="edit_product_price">Price:</label>
            <input type="text" name="price" id="edit_product_price"
              placeholder="Price">
          </div>
          <div class="form-group">
            <label for="edit_product_warranty">Warranty:</label>
            <input type="text" name="warranty" id="edit_product_warranty"
              placeholder="Warranty">
          </div>
          <div class="form-group">
            <label for="sel8">Has includes:</label>
             <select id="sel8" name="has_includes">
               <option disabled selected value="">specify</option>
                  <option value="{{1}}">Yes</option>
                  <option value="{{0}}">No</option>
             </select>
        </div>
          <div class="form-group">
            <label for="edit_product_includes">Includes:</label>
            <input type="text" name="includes" id="edit_product_includes"
              placeholder="Includes">
          </div>
          <div class="form-group">
            <label for="edit_include_price">Include Price:</label>
            <input type="text" name="include_price" id="edit_include_price"
              placeholder="Includes Price">
          </div>
          <div class="form-group">
            <label for="edit_product_file">Upload To Replace Picture:</label>
            <input type="file" class="large" id="edit_product_file" name="image">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_save" type="button" class="btn btn-primary"
              onclick="editProduct()">
              Save
            </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- end edit product modal -->
