<script src="{{ asset('js/cars.js')}}"></script>
@include('modals.confirmation_modal', ['text' => 'car',
                                       'function' => 'deleteCar()'])

@include('modals.edit_car')
@include('modals.status_alert', [
'modal_id' => 'car_edit_success',
'text_class' => 'text-success',
'text' => 'Car edited successfully',
])
@include('modals.status_alert', [
'modal_id' => 'car_delete_success',
'text_class' => 'text-success',
'text' => 'Car deleted successfully',
])
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Car Details:</h3>
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-primary"
          onclick="menu_links('cars')" title="Back">
          <i class="fa fa-arrow-left"></i>
        </button>
        <button type="button" class="btn btn-primary" onclick="showEditCarModal({{$car}})"
          title="Edit">
          <i class="fa fa-pencil"></i>
        </button>
        <button type="button" class="btn btn-danger"
          onclick="showDeleteModal({{$car->id}})" title="Delete">
          <i class="fa fa-trash-o"></i>
        </button>
      </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Logo: </th>
              <td>
                <a href="{{asset('uploads/cars/' . $car->picture)}}"
                   target="_blank">
                  <img src="{{ asset('uploads/cars/' . $car->picture)}}"
                    class="img-rounded" alt="Product image" width="25%"
                    height="auto">
                </a>
              </td>
          </tr>
          <tr>
            <th>Name: </th>
              <td>{{ $car->name }}</td>
          </tr>
          <tr>
            <th># models: </th>
              <td>{{ $car->num_models }}</td>
          </tr>
          <tr>
            <th>Date added: </th>
              <td>{{ $car->date_added }}</td>
          </tr>
          <tr>
            <th>Last modified: </th>
              <td>{{ $car->updated_at }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
</div>
