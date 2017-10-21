<script src="{{ asset('js/requested_services.js') }}"></script>
@include('modals.reject_modal', ['text' => 'Request', 'function' => 'rejectRequest()'])
@include('modals.accept_modal', ['text' => 'Request', 'function' => 'updateRequestStatus(1)'])
@include('modals.reschedule_modal', ['text' => 'Request', 'function' => 'rescheduleRequest()'])
@include('modals.modal', ['id' => 'modal',
                          'title' => 'Confirmation',
                          'text' => 'Mark this request as serviced?',
                          'function' => 'updateRequestStatus(2)',])
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
                      <td>{{ $detail->created_at }}</td>
                      <td>{{ $detail->date }}</td>
                      <td>{{ $detail->customer }}</td>
                      <td>{{ $detail->phonenumber }}</td>
                      <td>{{ sprintf('%s', number_format($detail->price)) }}</td>
                      <td>{{ $detail->status }}</td>
                      <td>
                        <div class="btn-group">
                          @php
                            $status = $detail->status;
                          @endphp
                          @if(strcasecmp($status,"accepted") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"rejected") == 0)
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
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"serviced") == 0)
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
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @elseif(strcasecmp($status,"rescheduled") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'accept_modal')">
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'reschedule_modal')">
                              Reschedule
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$detail->id}}, 'reject_modal')">
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
