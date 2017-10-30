<script src="{{ asset('js/products.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
@include('modals.product_modal')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Products: </h3>
       <span onclick="showProductModal()" class="pull-right text-primary"
        title="Add New Product">
         <i class="fa fa-plus-circle fa-2x" style="cursor: pointer;"></i>
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
                      <td>{{ $product->unit }}</td>
                      <td>{{ sprintf('%s', number_format($product->price, 0)) }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>
												<button id="btn_eye_open" type="button" class="btn btn-primary"
													onclick="viewProduct({{ $product->id }})"
                          title="Product Details">
	          							<span class="glyphicon glyphicon-eye-open"></span>
	        							</button>
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
