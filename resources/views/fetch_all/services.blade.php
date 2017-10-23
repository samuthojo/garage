<script src="{{ asset('js/services.js') }}"></script>
@include('modals.decision_modal')
@include('modals.new_service')
@include('modals.from_existing_service')
@include('modals.modal', ['id' => 'activate_modal',
                          'title' => 'Confirmation',
                          'text' => 'You are now offering this service?',
                          'function' => "updateServiceStatus('Active')",])
@include('modals.modal', ['id' => 'deactivate_modal',
                          'title' => 'Confirmation',
                          'text' => 'You are no longer supporting this service?',
                          'function' => "updateServiceStatus('Inactive')",])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Services: </h3>
      <span onclick="showServiceModal('decision_modal')" class="pull-right text-primary"
        title="Add Service">
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
              <th>Service</th>
              <th>Car</th>
              <th>Model</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($services as $service)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $service->service }}</td>
                      <td>{{ $service->car }}</td>
                      <td>{{ $service->model }}</td>
                      <td>{{ sprintf('%s', number_format($service->price, 0)) }}</td>
                      @php
                        $status = $service->status;
                        $color = (strcasecmp($status, "active") == 0) ?
                                            "text-success" : "text-danger";
                      @endphp
                      <td>
                        <span class="{{$color}}">{{ $service->status }}</span>
                      </td>
                      <td>
                        <div class="btn-group">
                          @if(strcasecmp($service->status,'active') == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="viewService({{ $service->id }})"
                              title="View Details">
                              <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="showActivateModal({{$service->id}})" disabled>
                              Activate
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="showDeactivateModal({{$service->id}})">
                              Deactivate
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="viewService({{ $service->id }})" title="View Details">
                              <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="showActivateModal({{$service->id}})">
                              Activate
                            </button>
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="showDeactivateModal({{$service->id}})" disabled>
                              Deactivate
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
      myDataTable("Services", "The List Of Services As Per {{now()->format('Y-m-d')}}");
  </script>
