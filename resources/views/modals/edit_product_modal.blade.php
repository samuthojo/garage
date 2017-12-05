<style>
  .form-control {
    width: auto;
  }
</style>
<!-- Edit Product modal -->
<div id="edit_product_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <form name="product_modal" id="edit_product_form" class="">
          <div class="container">
            <div class="row">
              <fieldset>
              <div class="row">
                <div class="col-sm-6">
                  <legend>Product Identification</legend>
                </div>
              </div>
              <div class="col-sm-2">
            <div class="form-group">
              <label class="" for="sel5">Category:</label>
               <select id="sel5" name="category_id" class="form-control">
                 <option disabled selected value="#">Choose category</option>
                 @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
               </select>
               <span class="text-danger " id="category_error2"></span>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_product_name">Name:</label>
            <input type="text" name="name" id="edit_product_name"
              placeholder="Product Name" class="form-control">
            <span class="text-danger " id="name_error2"></span>
          </div>
        </div>
      </div><!--row-->
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="sel6">Car:</label>
             <select id="sel6" name="car_id" onchange="fetchModels('sel6')"
              class="form-control">
               <option disabled selected value="#">Choose car</option>
               <option value="">all</option>
               @foreach($cars as $car)
                  <option value="{{$car->id}}">{{$car->name}}</option>
               @endforeach
             </select>
             <span class="text-danger " id="car_error2"></span>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="sel7">Model:</label>
            <div style="position:relative; display: block;">
             <select id="sel7" name="car_model_id" class="form-control"
              style="display: inline;">
               <option disabled selected value="#">Choose model</option>
               <option value="">all</option>
               @if(!is_null($models))
                 @foreach($models as $model)
                    <option value="{{$model->id}}">{{$model->model_name}}</option>
                 @endforeach
               @endif
             </select>
             <i class="fa fa-spinner fa-spin fa-2x fa-fw select_loader text-primary"
              style="display: none;"></i>
            </div>
             <span class="text-danger " id="model_error2"></span>
        </div>
      </div>
      </div><!--row-->
    </fieldset>
    <fieldset>
    <div class="row">
      <div class="col-sm-6">
        <legend>Product quantity & price</legend>
      </div>
    </div>
    <div class="row" style="margin-right: 15px;">
      <div class="row" style="margin-left: 4px;">
      <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_product_unit">Unit:</label>
            <input type="text" name="unit" id="edit_product_unit"
              placeholder="Unit eg. 5 litres" class="form-control">
            <span class="text-danger " id="unit_error2"></span>
          </div>
        </div>
        <div class="col-sm-2" style="margin-left: 16px;">
          <div class="form-group">
            <label class="" for="edit_product_stock">Stock:</label>
            <input type="text" name="stock" id="edit_product_stock"
              placeholder="Stock" class="form-control">
            <span class="text-danger " id="stock_error2"></span>
          </div>
        </div>
      </div>
      <div class="row" style="margin-left: 4px;">
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_product_price">Price:</label>
            <input type="text" name="price" id="edit_product_price"
              placeholder="Price" class="form-control">
            <span class="text-danger " id="price_error2"></span>
          </div>
        </div>
      </div>
        </div><!--row-->
        <fieldset>
        <div class="row">
          <div class="col-sm-6">
            <legend>Warranty & Includes</legend>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_product_warranty">Warranty:</label>
            <input type="text" name="warranty" id="edit_product_warranty"
              placeholder="eg. 1 month" class="form-control">
            <span class="text-danger " id="warranty_error2"></span>
          </div>
        </div>
        <div class="col-sm-2" style="margin-left: 16px;">
          <div class="form-group">
            <label class="" for="sel8">Has includes:</label>
             <select id="sel8" name="has_includes" class="form-control"
              onchange="bringIncludes('sel8')">
               <option disabled selected value="">specify</option>
                  <option value="{{1}}">Yes</option>
                  <option value="{{0}}">No</option>
             </select>
             <span class="text-danger " id="has_includes_error2"></span>
        </div>
      </div>
      </div><!--row-->
      <div class="row" id="my_includes2" style="display: none;">
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_product_includes">Includes:</label>
            <input type="text" name="includes" id="edit_product_includes"
              placeholder="eg. oil, petrol" class="form-control">
            <span class="text-danger " id="includes_error2"></span>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label class="" for="edit_include_price">Include Price:</label>
            <input type="text" name="include_price" id="edit_include_price"
              placeholder="Includes Price" class="form-control">
            <span class="text-danger " id="include_price_error2"></span>
          </div>
        </div>
        </div><!--row-->
        <fieldset>
        <div class="row">
          <div class="col-sm-6">
            <legend>Replace picture</legend>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
          <div class="form-group">
            <label class="" for="edit_product_file">Upload:</label>
            <input type="file" class="large" id="edit_product_file" name="image"
              class="form-control">
            <span class="text-danger " id="image_error2"></span>
          </div>
        </div>
        </div><!--row-->
      </fieldset>
          <div class="form-group">
            <button type="button" class="btn btn-default col-sm-offset-2"
              data-dismiss="modal">Cancel</button>
            <button id="btn_save" type="button" class="btn btn-primary"
              onclick="editProduct()">
              Save
            </button>
            @include('small_loader')
            <span class="text-danger" id="error_notifier2"></span>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- end edit product modal -->
