<script src="{{ asset('js/customers.js') }}"></script>
@include('modals.verification', ['text' => 'Customer',
                                       'function' => 'verifyCustomer()'])
@include('modals.status_alert', [
'modal_id' => 'verification_success',
'text_class' => 'text-success',
'text' => 'Customer verified successfully',
])
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Customers: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Phone-number</th>
              <th>Email</th>
              <th>Verified</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $customer->name }}</td>
                      <td>{{ $customer->phonenumber }}</td>
                      <td>{{ $customer->email }}</td>
                      @php
                        $status = $customer->verified;
                        $color = (strcasecmp($status, "yes") == 0) ?
                                              "text-success" : "text-danger";
                      @endphp
                      <td>
                        <span class="{{$color}}" id="status{{$customer->id}}">
                          {{ $customer->verified }}
                        </span>
                      </td>
                      <td>
                        <div class="btn-group">
                          @if(strcasecmp($customer->verified, "yes") == 0)
                            <button type="button" class="btn btn-small btn-primary"
                              disabled="true">
                              Verify
                            </button>
                          @else
                            <button type="button" class="btn btn-small btn-primary"
                              onclick="showVerificationModal({{$customer->id}})"
                              id="verify{{$customer->id}}">
                              Verify
                            </button>
                          @endif
                          <button type="button" class="btn btn-small btn-primary"
                            onclick="viewCustomer({{ $customer->id }})" title="More Details">
                            More
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
      myDataTable("Customers", "The List Of Customers As Per {{now()->format('d-m-Y')}}");
  </script>
