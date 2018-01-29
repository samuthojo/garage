<link rel="stylesheet" type="text/css" href="{{ asset('css/expand_rows.css') }}">
<script src="{{ asset('js/requested_services.js') }}"></script>
<script src="{{ asset('js/requested_services_expand_rows.js') }}"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Services</h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th style="display: none;"></th>
              <th>Date Requested</th>
              <th>Date Due</th>
              <th>Service</th>
              <th>Car</th>
              <th>Model</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($services as $service)
                    <tr>
                      <td class="details-control"></td>
                      <td style="display: none;">{{$service->id}}</td>
                      <td>{{ $service->created_at }}</td>
                      <td id="new_date{{$service->id}}">{{ $service->date }}</td>
                      <td>{{ $service->name }}</td>
                      <td>{{ $service->car }}</td>
                      <td>{{ $service->model }}</td>
                      <td>{{ sprintf('%s', number_format($service->price)) }}</td>
                      @php
                        $status = $service->status;
                        if(strcasecmp($status, "pending") == 0) {
                          $color = "text-warning";
                        }
                        else if(strcasecmp($status, "accepted") == 0) {
                          $color = "text-success";
                        }
                        else if(strcasecmp($status, "serviced") == 0) {
                          $color = "text-primary";
                        }
                        else if(strcasecmp($status, "rescheduled") == 0) {
                          $color = "text-info";
                        }
                        else if(strcasecmp($status, "rejected") == 0) {
                          $color = "text-danger";
                        }
                      @endphp
                      <td>
                        <span class="{{$color}}" id="status{{$service->id}}">{{ $service->status }}</span>
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
    myRequestsDataTable("",
          "The List Of Customers Requesting This Service As Per {{now()->format('d-m-Y')}}");
  </script>
