<style>
.input-group .form-control {
  position: relative;
  z-index: 2;
  float: left;
  margin-bottom: 0;
}
.input-group .form-control {
  width: auto;
}
</style>
<script src="{{ asset('js/products.js') }}"></script>
@include('modals.product_modal')
@include('modals.confirmation_modal', ['text' => 'product',
                                       'function' => 'deleteProduct()'])
@include('modals.edit_product_modal')
@include('modals.status_alert', [
 'modal_id' => 'product_success',
 'text_class' => 'text-success',
 'text' => 'Product added successfully',
])
@include('modals.status_alert', [
 'modal_id' => 'product_edit_success',
 'text_class' => 'text-success',
 'text' => 'Product edited successfully',
])
@include('modals.status_alert', [
 'modal_id' => 'product_delete_success',
 'text_class' => 'text-success',
 'text' => 'Product deleted successfully',
])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Products: </h3>
       <span onclick="showProductModal()" class="pull-right text-primary"
        title="Add New Product">
         <i class="fa fa-plus-circle fa-2x"
           style="cursor: pointer; color: #ff9720;"></i>
       </span>
       <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Category</th>
              <th>Car</th>
              <th>Model</th>
              <th>Unit</th>
              <th>Price (Tshs)</th>
              <th>Stock</th>
              <th>View</th>
              <!-- <th>Edit</th>
              <th>Delete</th> -->
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->product_category }}</td>
                      <td>{{ $product->car }}</td>
                      <td>{{ $product->car_model }}</td>
                      <td>{{ $product->unit }}</td>
                      <td>{{ sprintf('%s', number_format($product->price, 0)) }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>
                        <div class="btn-group">
  												<button id="btn_eye_open" type="button" class="btn btn-default"
  													onclick="viewProduct({{ $product->id }})"
                            title="Product Details">
  	          							<span class="glyphicon glyphicon-eye-open"></span>
  	        							</button>
                          <button type="button" class="btn btn-warning"
                            onclick="fetchParticulars({{$product->id}})" title="Edit Product">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger"
                            onclick="showDeleteModal({{$product->id}})" title="Delete Product">
                            <i class="fa fa-trash-o"></i>
                          </button>
                        </div>
											</td>
                    </tr>
           @endforeach
         </tbody>
       </table>
     </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>
  </div>
  <script>
      myDataTable("Products", "Products List As Per {{now()->format('d-m-Y')}}");
  </script>
