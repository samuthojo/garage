<script src="{{ asset('js/customers.js')}}"></script>
@include('modals.verification', ['text' => 'Customer',
                                       'function' => 'verifyCustomer()'])
@include('modals.status_alert', [
'modal_id' => 'verification_success',
'text_class' => 'text-success',
'text' => 'Customer verified successfully',
])
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
                onclick="showVerificationModal({{$customer->id}})" id="verify{{$customer->id}}">
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
    {{--<div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>--}}
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#customerOrders">Orders</a></li>
  <li><a data-toggle="tab" href="#customerServices">Services</a></li>
</ul>
@include('tab_loader')
<div class="tab-content" style="margin-top: 20px;">
  <div id="customerOrders" class="tab-pane fade in active">
    @include('specific.customer_orders')
  </div>
  <div id="customerServices" class="tab-pane fade">
    @include('specific.customer_services')
  </div>
</div>
