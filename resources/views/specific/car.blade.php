 <script src="{{ asset('js/cars.js')}}"></script>
<script src="{{ asset('js/models.js')}}"></script>
@include('modals.car_confirmation_modal', ['text' => 'car',
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
@include('modals.confirmation_modal2', [ 'id' => 'delete_model',
                                         'text' => 'model',
                                         'function' => 'deleteModel2()'])
<!--car-models management-->
@include('modals.model', ['title' => $car_make->name])
@include('modals.status_alert', [
'modal_id' => 'model_create_success',
'text_class' => 'text-success',
'text' => 'Model added successfully',
])
@include('modals.edit_model', ['title' => null])
@include('modals.status_alert', [
'modal_id' => 'model_edit_success',
'text_class' => 'text-success',
'text' => 'Model edited successfully',
])
@include('modals.status_alert', [
'modal_id' => 'model_delete_success',
'text_class' => 'text-success',
'text' => 'Model deleted successfully',
])
<style>
  .car-text {
    font-weight: bold;
  }
  .car-div {
    line-height: 30px;
  }
</style>
<div class="container-fluid">
  <div class="row" style="margin-top: 15px;">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 style="font-weight: bold;" class="panel-title pull-left">
          {{$car->name}}: </h3>
          <div class="btn-group pull-right">
             <button type="button" class="btn btn-primary"
               onclick="menu_links('cars')" title="Back">
               <i class="fa fa-arrow-left"></i>
             </button>
           </div>
         <div class="clearfix"></div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-2">
            <img src="{{ asset('uploads/cars/' . $car->picture)}}"
              class="img-rounded" alt="Product image" width="100%"
              height="auto" title="{{$car->name}}">
          </div>
          <div class="col-sm-6 car-div">
            <span class="car-text">Name: </span>{{ $car->name }}<br/>
            <span class="car-text"># Models: </span>{{ $car->num_models }}<br/>
            <span class="car-text">Date Added: </span>{{ $car->date_added }}<br/>
            <span class="car-text">Last Modified: </span>{{ $car->updated_at }}<br/>
            <div class="btn-group">
              <button type="button" class="btn btn-primary"
                onclick="showEditCarModal({{$car}}, 'car')"
                title="Edit Car Info">
                Edit
                <!-- <i class="fa fa-pencil"></i> -->
              </button>
              <button type="button" class="btn btn-danger"
                onclick="showCarDeleteModal({{$car->id}})" title="Delete This Car">
                <!-- <i class="fa fa-trash-o"></i> -->
                Delete
              </button>
              <button type="button" class="btn btn-success"
                onclick="showModel()" title="Add A {{$car->name}} Model">
                <!-- <i class="fa fa-trash-o"></i> -->
                Add Model
              </button>
            </div>
          </div>
        </div><!--row-->

        <div class="container-fluid">
          <div class="row" style="margin-top: 10px;">
            <h3 style="font-weight: bold;">Models:</h3>
            <div class="table-responsive">
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Date Added</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($models as $model)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$model->model_name}}</td>
                      <td>{{$model->created_at}}</td>
                      <td>{{$model->updated_at}}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary"
                            onclick="showEditModel({{$model}})"
                            title="Edit Model Details">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger"
                            onclick="showDeleteModal2({{$model->id}})"
                            title="Delete Model">
                            <i class="fa fa-trash-o"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--row -->
</div><!--container-fluid-->
<script>
    myModelsDataTable();
</script>
