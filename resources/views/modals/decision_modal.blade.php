<!-- Confirmation modal -->
<div id="decision_modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close"
        data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Service</h4>
      </div>
      <div class="modal-body">
        <form name='modal_form' id='modal_form'>
          <div class='container'>
            <div class="radio">
              <label><input type="radio" name="optradio" value='1'>Completely New Service</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="optradio" value='2'>From Existing Service</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Cancel
        </button>
        <button id="btn_modal" onclick="makeDecision()" type="button" class="btn btn-primary">
          Okay
        </button>
      </div>
    </div>
  </div>
</div><!-- end confirmation modal -->
