<script src="{{ asset('js/requested_services.js') }}"></script>
@include('modals.reject_modal', ['text' => 'Order', 'function' => 'rejectOrder()'])
@include('modals.accept_modal', ['text' => 'Order', 'function' => 'acceptOrder()'])
@include('modals.modal', ['id' => 'modal',
                          'title' => 'Confirmation',
                          'text' => 'Mark this order as serviced?',
                          'function' => 'markAsServiced()',])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Requested Services: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>Service</th>
              <th>Car</th>
              <th>Model</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($requests as $request)
                    <tr>
                      <td>{{ $request->created_at }}</td>
                      <td>{{ $request->date }}</td>
                      <td>{{ $request->service }}</td>
                      <td>{{ $request->car }}</td>
                      <td>{{ $request->model }}</td>
                      <td>{{ $request->price }}</td>
                      <td>{{ $request->status }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewItems({{$request->id}})" title="View Items">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </button>
                          <!-- @php
                            $status = $request->status;
                          @endphp
                          @if($status == "accepted")
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$request->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reject
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                             onclick="openModal({{$request->id}}, 'reschedule_modal')">
                              Reschedule
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
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reschedule
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
                            <button type="button" class="btn btn-small btn-primary"
                              disabled>
                              Reschedule
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$request->id}}, 'accept_modal')">
                              Accept
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$request->id}}, 'modal')">
                              Serviced
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$request->id}}, 'reject_modal')">
                              Reject
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="openModal({{$request->id}}, 'reschedule_modal')">
                              Reschedule
                            </button>
                          @endif -->
                       </div>
                      </td>
                    </tr>
           @endforeach
         </tbody>
       </table>
     </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="www.ipfsoftwares.com">iPF SOFTWARES</a>
  </div>
  </div>
  <script>
    myDataTable();
  </script>
