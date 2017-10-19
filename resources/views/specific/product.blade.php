<style>
  .action {
    margin-right: 10px;
  }
</style>

<script src="{{ asset('js/products.js')}}"></script>
@include('modals.confirmation_modal', ['text' => 'product',
                                       'function' => 'deleteProduct()'])

@include('modals.edit_product_modal')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Product Details:</h3>
        <span class="pull-right text-danger"
          onclick="showDeleteModal({{$product->id}})">
          <i class="fa fa-trash-o fa-2x" style="cursor: pointer;"></i>
        </span>
        <span class="pull-right text-info"
          onclick=
          "showEditProductModal({{$category}}, {{$product}}, {{$car}}, {{$car_model}})">
          <i class="fa fa-pencil fa-2x action" style="cursor: pointer;"></i>
        </span>
        <span class="pull-right text-primary"
          onclick="menu_links('products')">
          <i class="fa fa-arrow-left fa-2x action" style="cursor: pointer;"></i>
        </span>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Name: </th>
              <td>{{ $product->name }}</td>
          </tr>
          <tr>
            <th>Category: </th>
              <td>{{ $category->name }}</td>
          </tr>
          <tr>
            <th>Car: </th>
              <td>{{ $car->name }}</td>
          </tr>
          <tr>
            <th>Model: </th>
              <td>{{ $car_model->model_name }}</td>
          </tr>
          <tr>
            <th>Unit: </th>
              <td>{{ $product->unit }}</td>
          </tr>
          <tr>
            <th>Price (Tshs): </th>
              <td>{{ sprintf('%s', number_format($product->price, 0)) }}</td>
          </tr>
          <tr>
            <th>Stock: </th>
              <td>{{ $product->stock }}</td>
          </tr>
          <tr>
            <th>Warranty: </th>
              <td>{{ $product->warranty }}</td>
          </tr>
          @if($product->has_includes)
            <tr>
              <th>Has Includes: </th>
                <td>{{ $product->has_includes }}</td>
            </tr>
            <tr>
              <th>Includes: </th>
                <td>{{ $product->includes }}</td>
            </tr>
            <tr>
              <th>Includes Price (Tshs): </th>
                <td>{{ sprintf('%s', number_format($product->include_price, 0)) }}</td>
            </tr>
          @endif
          <tr>
            <th>Image: </th>
              <td>
                <img src="{{ asset('uploads/products/' . $product->image)}}" class="img-rounded"
                  alt="Product image" width="25%" height="auto">
              </td>
          </tr>
          <tr>
            <th>Date added: </th>
              <td>{{ $product->date_added }}</td>
          </tr>
          <tr>
            <th>Last modified: </th>
              <td>{{ $product->date_modified }}</td>
          </tr>
        </table>
      </div>
    </div>
  <div class="panel-footer">Crafted @ <a href="{{'www.ipfsoftwares.com'}}">
    iPF SOFTWARES
    </a>
 </div>
</div>
