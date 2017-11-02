<script src="{{ asset('js/cars.js') }}"></script>
@include('modals.car')
@include('modals.confirmation_modal', ['text' => 'car',
                                       'function' => 'deleteCar()'])
@include('modals.status_alert', [
'modal_id' => 'car_create_success',
'text_class' => 'text-success',
'text' => 'Car added successfully',
])
@include('modals.status_alert', [
'modal_id' => 'car_delete_success',
'text_class' => 'text-success',
'text' => 'Car deleted successfully',
])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Cars: </h3>
      <span onclick="showCarModal()" class="pull-right text-primary"
        title="Add New Car">
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
              <th>Name</th>
              <th># models</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cars as $car)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $car->name }}</td>
                      <td>{{ $car->num_models }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewCar({{ $car->id }})">
                            <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
                            Car Details
                          </button>
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewModels({{ $car->id }})">
                            <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
                            View Models
                          </button>
                          <button type="button" class="btn btn-danger"
                           onclick="showDeleteModal({{ $car->id }})">
                            <!-- <span class="glyphicon glyphicon-trash"></span> -->
                            Delete Car
                          </button>
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
      myDataTable("Cars", "Car List As Per {{now()->format('d-m-Y')}}");
  </script>
