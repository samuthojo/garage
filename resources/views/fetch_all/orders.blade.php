<link rel="stylesheet" type="text/css" href="{{ asset('css/expand_rows.css') }}">
<script src="{{ asset('js/orders.js') }}"></script>
<script src="{{ asset('js/order_expand_rows.js') }}"></script>
@include('modals.reject_modal', ['text' => 'Order', 'function' => 'rejectOrder()'])
@include('modals.accept_modal', ['text' => 'Order', 'function' => 'acceptOrder()'])
@include('modals.modal', ['id' => 'modal',
                          'title' => 'Confirmation',
                          'text' => 'Mark this order as serviced?',
                          'function' => 'markAsServiced()',])

@include('modals.loader')
@include('modals.status_alert', [ 'text_class' => 'text-success',
                                  'modal_id' => 'notification_sent',
                                  'text' => 'Notification sent successfully!'])
@include('modals.status_alert', [ 'text_class' => 'text-warning',
                                  'modal_id' => 'notification_failure',
                                  'text' => 'Sending failed, network error!'])
@include('modals.status_alert', [ 'text_class' => 'text-success',
                                  'modal_id' => 'order_alert',
                                  'text' => 'Order Marked as serviced!'])
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
              <th></th>
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
                      <td class="details-control"></td>
                      <td>{{ $order->date }}</td>
                      <td>{{ $order->id }}</td>
                      <td>
                        {{ $order->customer }}
                      </td>
                      <td>{{ $order->contact }}</td>
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
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewItems({{$order->id}})" title="View Order Items">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </button>
                          @if(strcasecmp($status, "accepted") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              id="accept{{$order->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'modal')"
                              id="service{{$order->id}}">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="reject{{$order->id}}" disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status, "rejected") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              id="accept{{$order->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="service{{$order->id}}" disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="reject{{$order->id}}" disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status, "serviced") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              id="accept{{$order->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="service{{$order->id}}" disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="reject{{$order->id}}" disabled>
                              Reject
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'accept_modal')"
                              id="accept{{$order->id}}">
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'modal')"
                              id="service{{$order->id}}">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$order->id}}, 'reject_modal')"
                              id="reject{{$order->id}}">
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
    myDataTable("Orders", "Orders List As Per {{now()->format('d-m-Y')}}");
  </script>
