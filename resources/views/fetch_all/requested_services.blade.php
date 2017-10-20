<script src="{{ asset('js/requested_services.js') }}"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Services Requested: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Service</th>
              <th>Car</th>
              <th>Model</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($service_as_products as $service)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $service->service }}</td>
                      <td>{{ $service->car }}</td>
                      <td>{{ $service->model }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewCustomers({{ $service->id }})"
                            title="View customers and Details">
                            <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
                            Customers <span class="badge">{{$service->customers}}</span>
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
    Crafted @ <a href="www.ipfsoftwares.com">iPF SOFTWARES</a>
  </div>
  </div>
  <script>
      myDataTable();
  </script>
