<script src="{{ asset('js/models.js')}}"></script>
@include('modals.confirmation_modal', ['text' => 'model',
                                       'function' => 'deleteModel()'])

@include('modals.edit_model', ['title' => $model->car])
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Model Details:</h3>
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-primary"
          onclick="viewModels({{$model->car_id}})">
          <i class="fa fa-arrow-left"></i>
        </button>
        <button type="button" class="btn btn-primary" onclick="showEditModel({{$model}})">
          <i class="fa fa-pencil"></i>
        </button>
        <button type="button" class="btn btn-danger"
          onclick="showDeleteModal({{$model->id}})">
          <i class="fa fa-trash-o"></i>
        </button>
      </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Model Picture: </th>
              <td>
                <img src="{{ asset('uploads/models/' . $model->picture)}}"
                  class="img-rounded" alt="Product image" width="25%"
                  height="auto">
              </td>
          </tr>
          <tr>
            <th>Model Name: </th>
              <td>{{ $model->model_name }}</td>
          </tr>
          <tr>
            <th>Car Name: </th>
              <td>{{ $model->car }}</td>
          </tr>
          <tr>
            <th>Date added: </th>
              <td>{{ $model->created_at }}</td>
          </tr>
          <tr>
            <th>Last modified: </th>
              <td>{{ $model->updated_at }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
</div>
