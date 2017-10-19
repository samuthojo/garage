<script src="{{ asset('js/customers.js')}}"></script>
@include('modals.verification', ['text' => 'Customer',
                                       'function' => 'verifyCustomer()'])

<div class="panel panel-default">
    <div class="panel-heading">
        <input type="hidden" id="my_id" value="{{$customer->id}}">
        <h3 class="panel-title pull-left"
          style="font-weight: bold;">Customer Details:</h3>
          <div class="btn-group pull-right">
            <button class="btn btn-primary" onclick="menu_links('customers')">
              <i class="fa fa-arrow-left action" style="cursor: pointer;
              font-size: 15px;"></i>
            </button>
            @if(strcasecmp($customer->verified, "yes") == 0)
              <button class="btn btn-primary" disabled="true">
                <span style="font-weight: bold;">Verify</span>
              </button>
            @else
              <button class="btn btn-primary"
                onclick="showVerificationModal({{$customer->id}})">
                <span style="font-weight: bold;">Verify</span>
              </button>
            @endif
          </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>Name: </th>
              <td>{{ $customer->name }}</td>
          </tr>
          <tr>
            <th>Phone-number: </th>
              <td>{{ $customer->phonenumber }}</td>
          </tr>
          <tr>
            <th>Email: </th>
              <td>{{ $customer->email }}</td>
          </tr>
          <tr>
            <th>Verified: </th>
              <td>{{ $customer->verified }}</td>
          </tr>
          <tr>
            <th>Date Joined: </th>
              <td>{{ $customer->created_at }}</td>
          </tr>
          <tr>
            <th>Last Updated: </th>
              <td>{{ $customer->updated_at }}</td>
          </tr>
        </table>
      </div>
    </div>
  <div class="panel-footer">Crafted @ <a href="{{'www.ipfsoftwares.com'}}">
    iPF SOFTWARES
    </a>
 </div>
</div>
