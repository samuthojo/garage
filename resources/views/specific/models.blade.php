<script src="{{ asset('js/models.js') }}"></script>
@include('modals.model', ['title' => $car_make->name])
@include('modals.confirmation_modal', ['text' => 'model',
                                       'function' => 'deleteModel()'])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      {{$car_make->name}} Models:</h3>
      <div class="btn-group pull-right">
        <button onclick="menu_links('cars')" class="btn btn-primary"
          title="Back To Cars">
          <i class="fa fa-arrow-left" style="font-size: 18px;"></i>
        </button>
        <button onclick="showModel()" class="btn btn-primary"
          title="Add New Model">
          <i class="fa fa-plus-circle" style="font-size: 18px;"></i>
        </button>
      </div>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($models as $model)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $model->model_name }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewModel({{ $model->id }})"
                            title="Model Details">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </button>
                          <button type="button" class="btn btn-danger"
                           onclick="showDeleteModal({{ $model->id }})"
                           title="Delete Model">
                            <span class="glyphicon glyphicon-trash"></span>
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
      myDataTable();
  </script>
