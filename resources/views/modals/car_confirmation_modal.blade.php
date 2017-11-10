<!-- Confirmation modal -->
<div id="car_confirmation_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          You are about to delete this {{$text}}!
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Cancel
        </button>
        <button id="btn_delete" onclick="{{$function}}" type="button" class="btn btn-primary">
          Confirm
        </button>
        @include('small_loader')
      </div>
    </div>
  </div>
</div><!-- end confirmation modal -->
