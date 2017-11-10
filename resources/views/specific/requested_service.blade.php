<link rel="stylesheet" type="text/css" href="{{ asset('css/expand_rows.css') }}">
<script src="{{ asset('js/requested_services.js') }}"></script>
<script src="{{ asset('js/requested_services_expand_rows.js') }}"></script>
@include('modals.reject_modal', ['text' => 'Request', 'function' => 'rejectRequest()'])
@include('modals.accept_modal', ['text' => 'Request', 'function' => 'updateRequestStatus(1)'])
@include('modals.reschedule_modal', ['text' => 'Request', 'function' => 'rescheduleRequest()'])
@include('modals.modal', ['id' => 'modal',
                          'title' => 'Confirmation',
                          'text' => 'Mark this request as serviced?',
                          'function' => 'updateRequestStatus(2)',])
@include('modals.status_alert', ['modal_id' => 'notification_sent',
                                 'text_class' => 'text-success',
                                 'text' => 'Notification sent successfully!'])
@include('modals.status_alert', ['modal_id' => 'notification_failure',
                                 'text_class' => 'text-warning',
                                 'text' => 'Sending failed, network error!'])
@include('modals.status_alert', ['modal_id' => 'requested_service_alert',
                                 'text_class' => 'text-success',
                                 'text' => 'Request Marked as serviced!'])
@include('modals.loader')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Service:{{$serv}} | Car:{{$car}} | Model:{{$model}} </h3>
      <button type="button" class="btn btn-primary pull-right"
        onclick="menu_links('requested_services')">
        <i class="fa fa-arrow-left"></i>
      </button>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th style="display: none;"></th>
              <th>Date Requested</th>
              <th>Date Due</th>
              <th>Customer</th>
              <th>Contact</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($details as $detail)
                    <tr>
                      <td class="details-control"></td>
                      <td style="display: none;">{{$detail->id}}</td>
                      <td>{{ $detail->created_at }}</td>
                      <td>{{ $detail->date }}</td>
                      <td>{{ $detail->customer }}</td>
                      <td>{{ $detail->phonenumber }}</td>
                      <td>{{ sprintf('%s', number_format($detail->price)) }}</td>
                      @php
                        $status = $detail->status;
                        if(strcasecmp($status, "pending") == 0) {
                          $color = "text-warning";
                        }
                        else if(strcasecmp($status, "accepted") == 0) {
                          $color = "text-success";
                        }
                        else if(strcasecmp($status, "serviced") == 0) {
                          $color = "text-primary";
                        }
                        else if(strcasecmp($status, "rescheduled") == 0) {
                          $color = "text-info";
                        }
                        else if(strcasecmp($status, "rejected") == 0) {
                          $color = "text-danger";
                        }
                      @endphp
                      <td>
                        <span class="{{$color}}" id="status{{$detail->id}}">{{ $detail->status }}</span>
                      </td>
                      <td>
                        <div class="btn-group">
                          @if(strcasecmp($status,"accepted") == 0)
                            <button type="button" class="btn btn-small btn-success"
                              id="accept{{$detail->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'modal')"
                              id="service{{$detail->id}}">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-warning"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')"
                              id="reschedule{{$detail->id}}">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-danger"
                              id="reject{{$detail->id}}" disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"rejected") == 0)
                            <button type="button" class="btn btn-small btn-success"
                              id="accept{{$detail->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="service{{$detail->id}}" disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-warning"
                             id="reschedule{{$detail->id}}" disabled>
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-danger"
                              id="reject{{$detail->id}}" disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"serviced") == 0)
                            <button type="button" class="btn btn-small btn-success"
                              id="accept{{$detail->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="service{{$detail->id}}" disabled>
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-warning"
                             id="reschedule{{$detail->id}}" disabled>
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-danger"
                              id="reject{{$detail->id}}" disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"rescheduled") == 0)
                            <button type="button" class="btn btn-small btn-success"
                              id="accept{{$detail->id}}" disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              id="service{{$detail->id}}"
                              onclick="openModal({{$detail->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-warning"
                              id="reschedule{{$detail->id}}"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-danger"
                              id="reject{{$detail->id}}" disabled>
                              Reject
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-success"
                              onclick="openModal({{$detail->id}}, 'accept_modal')"
                              id="accept{{$detail->id}}">
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'modal')"
                              id="service{{$detail->id}}">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-warning"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')"
                              id="reschedule{{$detail->id}}">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-danger"
                              onclick="openModal({{$detail->id}}, 'reject_modal')"
                              id="reject{{$detail->id}}">
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
    myRequestsDataTable("Service: {{$serv}} | Car: {{$car}} | Model: {{$model}}",
          "The List Of Customers Requesting This Service As Per {{now()->format('d-m-Y')}}");
  </script>
