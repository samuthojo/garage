<style>
  .action {
    margin-right: 10px;
  }
</style>

<script src="{{ asset('js/cars.js')}}"></script>
@include('modals.confirmation_modal', ['text' => 'car',
                                       'function' => 'deleteCar()'])

@include('modals.edit_car')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Car Details:</h3>
        <span class="pull-right text-danger"
          onclick="showDeleteModal({{$car->id}})">
          <i class="fa fa-trash-o fa-2x" style="cursor: pointer;"></i>
        </span>
        <span class="pull-right text-info" onclick="showEditCarModal({{$car}})">
          <i class="fa fa-pencil fa-2x action" style="cursor: pointer;"></i>
        </span>
        <span class="pull-right text-primary"
          onclick="menu_links('cars')">
          <i class="fa fa-arrow-left fa-2x action" style="cursor: pointer;"></i>
        </span>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Logo: </th>
              <td>
                <img src="{{ asset('uploads/cars/' . $car->picture)}}"
                  class="img-rounded" alt="Product image" width="25%"
                  height="auto">
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
  <div class="panel-footer">Crafted @ <a href="{{'www.ipfsoftwares.com'}}">
    iPF SOFTWARES
    </a>
 </div>
</div>
