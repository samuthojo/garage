<script src="{{ asset('js/feedbacks.js') }}"></script>
@include('modals.confirmation_modal', [
  'text' => 'feedback',
  'function' => 'deleteFeedback()',
])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title pull-left"
      style="font-weight: bold;">Feedback</h3>
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-warning"
       onclick="menu_links('feedbacks')" title="Back">
        <i class="fa fa-arrow-left" style="cursor: pointer;"></i>
      </button>
      <button type="button" class="btn btn-danger"
       onclick="deleteModal({{$feedback->id}})" title="Delete">
       <i class="fa fa-trash-o" style="cursor: pointer;"></i>
     </button>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th>Title: </th>
            <td>{{ $feedback->title }}</td>
        </tr>
        <tr>
          <th>Message: </th>
            <td>{{ $feedback->message }}</td>
        </tr>
        <tr>
          <th>Email: </th>
            <td>{{ $feedback->email }}</td>
        </tr>
      </table>
    </div>
  </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
</div>
