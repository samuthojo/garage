<style>
.input-group .form-control {
  position: relative;
  z-index: 2;
  float: left;
  margin-bottom: 0;
}
.input-group .form-control {
  width: auto;
}
.action {
  width: 100px;
}
</style>
<script src="{{ asset('js/services.js')}}"></script>
@include('modals.confirmation_modal', ['text' => 'service',
                                       'function' => 'deleteService()'])

@include('modals.edit_service')
@include('modals.modal', ['id' => 'activate_modal',
                          'title' => 'Confirmation',
                          'text' => 'You are now offering this service?',
                          'function' => "updateServiceStatus('Active')",])
@include('modals.modal', ['id' => 'deactivate_modal',
                          'title' => 'Confirmation',
                          'text' => 'You are no longer supporting this service?',
                          'function' => "updateServiceStatus('Inactive')",])
@include('modals.status_alert', [
 'modal_id' => 'service_edit_success',
 'text_class' => 'text-success',
 'text' => 'Service edited successfully',
])
@include('modals.status_alert', [
 'modal_id' => 'service_activate_success',
 'text_class' => 'text-success',
 'text' => 'Service activated successfully',
])
@include('modals.status_alert', [
 'modal_id' => 'service_deactivate_success',
 'text_class' => 'text-success',
 'text' => 'Service deactivated',
])
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Service: {{$service->name}}</h3>
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary"
             onclick="menu_links('services')" title="Back">
              <i class="fa fa-arrow-left" style="cursor: pointer;"></i>
            </button>
            <button type="button" class="btn btn-primary"
             onclick="showEditModal({{ $service }}, 'service')" title="Edit">
             <i class="fa fa-pencil" style="cursor: pointer;"></i>
           </button>
           @if(strcasecmp($service->status,'active') == 0)
             <!-- <button type="button" class="btn btn-small btn-primary"
               onclick="showActivateModal({{$service->id}})" disabled
               id="button2{{$service->id}}">
               Activate
             </button> -->
             <button type="button" class="btn btn-primary action"
               onclick="changeStatus({{$service->id}})"
               id="button{{$service->id}}">
               Deactivate
             </button>
           @else
             <button type="button" class="btn btn-primary action"
               onclick="changeStatus({{$service->id}})" id="button{{$service->id}}">
               Activate
             </button>
             <!-- <button type="button" class="btn btn-small btn-primary"
               onclick="showDeactivateModal({{$service->id}})" disabled
               id="button2{{$service->id}}">
               Deactivate
             </button> -->
           @endif
         </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <img src="{{ asset('uploads/services/' . $service->picture)}}"
              class="img-rounded" alt="Product image" width="100%"
              height="auto" title="{{$service->name}}">
          </div>
          <div class="col-sm-6">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Service: </th>
              <td>{{ $service->name }}</td>
          </tr>
          <tr>
            <th>Description: </th>
              <td>{{ $service->description }}</td>
          </tr>
          <tr>
            <th>Car: </th>
              <td>{{ $service->car }}</td>
          </tr>
          <tr>
            <th>Model: </th>
              <td>{{ $service->model }}</td>
          </tr>
          <tr>
            <th>Price (Tshs): </th>
              <td>{{ sprintf('%s', number_format($service->price, 0)) }}</td>
          </tr>
          <tr>
            <th>Date Created: </th>
              <td>{{ $service->created_at }}</td>
          </tr>
          <tr>
            <th>Last Updated: </th>
              <td>{{ $service->updated_at }}</td>
          </tr>
          <tr>
            <th>Status: </th>
            @php
              $status = $service->status;
              $color = (strcasecmp($status, "active") == 0) ?
                                  "text-success" : "text-danger";
            @endphp
            <td>
              <span class="{{$color}}" id="status{{$service->id}}">{{ $service->status }}</span>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
 </div>
</div>
