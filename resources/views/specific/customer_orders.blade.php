<script src="{{ asset('js/customer_orders.js') }}"></script>
@include('modals.loader')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Orders: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>Date Ordered</th>
              <th>Order No.</th>
              <th># items</th>
              <th>Amount (Tshs)</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->date }}</td>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->num_items }}</td>
                      <td>{{ $order->amount }}</td>
                      @php
                        $status = $order->status;
                        $color = "";
                        if(strcasecmp($status, "pending") == 0) {
                          $color = "text-warning";
                        }
                        else if(strcasecmp($status, "accepted") == 0) {
                          $color = "text-success";
                        }
                        else if(strcasecmp($status, "serviced") == 0) {
                          $color = "text-info";
                        }
                        else if(strcasecmp($status, "rejected") == 0) {
                          $color = "text-danger";
                        }
                      @endphp
                      <td>
                        <span class="{{$color}}" id="status{{$order->id}}">{{ $order->status }}</span>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-default"
                            onclick="viewItems({{$order->id}})" title="View Order Items">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </button>
                       </div>
                      </td>
                    </tr>
           @endforeach
         </tbody>
       </table>
     </div>
  </div>
  {{--<div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>--}}
  </div>
  <script>
    myOrderDataTable("Orders", "Orders Made By {{$customer->name}}");
  </script>
