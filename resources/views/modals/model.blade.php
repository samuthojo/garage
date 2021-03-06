<!-- Car modal -->
<div id="model_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        @if(!$title)
        <h4 class="modal-title">New Model</h4>
        @else
        <h4 class="modal-title">New {{$title}} Model</h4>
        @endif
      </div>
      <div class="modal-body">
          <div class="container">
            <form name="model_form" id="model_form">
          <div class="form-group">
            <label for="model_name" class="">Name:</label>
            <input type="text" name="model_name" id="model_name"
              placeholder="Model Name" class="form-control">
            <span class="text-danger" id="name_error"></span>
          </div>
          <!-- <div class="form-group">
            <label for="model_picture" class="">Model Picture:</label>
            <input type="file" class="large" id="model_picture" name="picture"
              class="form-control">
            <span class="text-danger" id="picture_error"></span>
          </div> -->
          <div class="form-group">
            <button type="button" class="btn btn-default"
              data-dismiss="modal">Cancel</button>
            <button id="btn_add" type="button" class="btn btn-primary"
              onclick="newModel({{$car_make->id}})">Add</button>
            @include('small_loader')
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div><!-- end add Car modal -->
