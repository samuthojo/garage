<script src="{{ asset('js/feedbacks.js') }}"></script>
@include('modals.confirmation_modal', [
  'text' => 'feedback',
  'function' => 'deleteFeedback()',
])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Feedbacks: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">
      @if(count($feedbacks) == 0)
        <h4>No feedbacks yet</h4>
      @else
      <div class="table-responsive">
        <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Email</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($feedbacks as $feedback)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$feedback->email}}</td>
                <td>{{$feedback->title}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary"
                      title="Read" onclick="readFeedback({{$feedback->id}})">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button type="button" class="btn btn-danger"
                      title="Delete" onclick="deleteModal({{$feedback->id}})">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
    </div>
  </div>
  <div class="panel-footer">
    Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
  </div>
</div>
