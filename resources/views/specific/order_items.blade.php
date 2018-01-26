<script src="{{ asset('js/orders.js') }}"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">Order Details:</h3>
      <button class="btn btn-warning pull-right" onclick="menu_links('orders')">
        <i class="fa fa-arrow-left" style="cursor: pointerpx; font-size: 15px;"></i>
      </button>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div style="line-height: 30px;">
      <span style="font-weight: bold;">Order_No: </span>{{ '# '  . $order->id}}<br/>
      <span style="font-weight: bold;">Date Ordered: </span>{{$order->date}}<br/>
      <span style="font-weight: bold;">Customer: </span>{{$customer_name}}<br/>
      <span style="font-weight: bold;">Contact: </span>{{$contact}}<br/>
      <span style="font-weight: bold;"># Items: </span>{{$order->num_items}}<br/>
      <span style="font-weight: bold;">Amount: </span>{{$order->amount}}<br/>
    </div>
    <span style="margin-top: 30px;" >
      <h3 style="font-weight: bold;" class="text-primary">Order Items:</h3>
    </span>
    <div class="table-responsive" style="margin-top: 20px;">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <!-- <th>No.</th> -->
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
                      <!-- <td>{{ $loop->iteration }}</td> -->
                      <td>{{ $purchase->product }}</td>
                      <td>{{ sprintf("%s", number_format($purchase->price)) }}</td>
                      <td>{{ $purchase->quantity }}</td>
                      @if($purchase->has_includes)
                        <td>{{ $purchase->includes }}</td>
                        <td>{{ sprintf("%s", number_format($purchase->include_price)) }}</td>
                      @else
                        <td>Null</td>
                        <td>Null</td>
                      @endif
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
