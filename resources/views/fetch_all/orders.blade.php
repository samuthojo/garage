<script src="{{ asset('js/orders.js') }}"></script>
@include('modals.reject_modal', ['text' => 'Order', 'function' => 'rejectOrder()'])
@include('modals.accept_modal', ['text' => 'Order', 'function' => 'acceptOrder()'])
@include('modals.modal', ['id' => 'modal',
                          'title' => 'Confirmation',
                          'text' => 'Mark this order as serviced?',
                          'function' => 'markAsServiced()',])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Orders: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped display">
          <thead>
            <tr>
              <th>Date Ordered</th>
              <th>Order No.</th>
              <th>Customer</th>
              <th>Contact</th>
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
                      <td>
                        {{ $order->customer }}
                      </td>
                      <td>{{ $order->contact }}</td>
                      <td>{{ $order->num_items }}</td>
                      <td>{{ $order->amount }}</td>
                      <td>{{ $order->status }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewItems({{$order->id}})" title="View Order Items">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </button>
                          @php
                            $status = $order->status;
                          @endphp
                          @if($status == "accepted")
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @elseif($status == "rejected")
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @elseif($status == "serviced")
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'accept_modal')">
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'reject_modal')">
                              Reject
                            </button>
                          @endif
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
    myDataTable();
  </script>
