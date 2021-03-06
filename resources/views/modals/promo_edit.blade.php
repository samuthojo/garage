<!-- Confirmation modal -->
<div id="{{$id}}" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{$title}}</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form id="promo_form">
            <label for="{{$text_id}}">Message:</label>
            <textarea id="{{$text_id}}" class='form-control'
              placeholder="Short description" name="message">{{$text}}</textarea>
            <span class="text-danger" id="{{$error_id}}"></span>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Cancel
        </button>
        <button id="btn_modal" onclick="{{$function}}" type="button" class="btn btn-primary">
          {{$button_text}}
        </button>
        @include('small_loader')
      </div>
    </div>
  </div>
</div><!-- end confirmation modal -->
