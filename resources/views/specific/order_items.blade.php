<script src="{{ asset('js/orders.js') }}"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Order_No: {{ '# '  . $order->id}} </h3>
      <button class="btn btn-primary pull-right" onclick="menu_links('orders')">
        <i class="fa fa-arrow-left" style="cursor: pointerpx; font-size: 15px;"></i>
      </button>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Price (Tshs)</th>
              <th>Quantity</th>
              <th>Includes</th>
              <th>IncludePrice (Tshs)</th>
              <th>TotalPrice (Tshs)</th>
            </tr>
          </thead>
          <tbody>
            @foreach($purchases as $purchase)
                    <tr>
                      <td>{{ $purchase->product }}</td>
                      <td>{{ $purchase->price }}</td>
                      <td>{{ $purchase->quantity }}</td>
                      <td>{{ $purchase->includes }}</td>
                      <td>{{ sprintf("%s", number_format($purchase->include_price)) }}</td>
                      <td>{{ sprintf("%s", number_format($purchase->total_price)) }}</td>
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
    myDataTable("Order_No: {{ '# ' . $order->id}}}}", "The List Of Items In This Order");
  </script>
