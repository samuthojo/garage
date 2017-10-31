<script src="{{asset('js/promo_messages.js')}}"></script>
@include('modals.promo_edit', [
  'id' => 'order_promo_modal',
  'title' => 'Edit Order-Promo',
  'text' => $order_promo->message,
  'text_id' => 'order_text',
  'error_id' => 'error_order',
  'function' => "savePromo($order_promo->id)",
  'button_text' => 'Save',
])
@include('modals.promo_edit', [
  'id' => 'service_promo_modal',
  'title' => 'Edit Service-Promo',
  'text_id' => 'service_text',
  'error_id' => 'error_service',
  'text' => $service_promo->message,
  'function' => "savePromo($service_promo->id)",
  'button_text' => 'Save',
])
<ul class="nav nav-tabs" id="promo">
  <li class="active my_link" id="order_promo">
    <a onclick="orderPromo()">OrderPromoMessage</a>
  </li>
  <li class="my_link" id="service_promo">
    <a onclick="servicePromo()">ServicePromoMessage</a>
  </li>
</ul>
<div class="container-fluid my_content">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Message</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><span id="promo_text">{{$order_promo->message}}</span></td>
          <td>
            <button type="button" class="btn btn-primary"
              title="Edit This Promo" onclick="openModal()">
              <i class="fa fa-pencil"></i>
            </button>
          </td>
        </tr>
      </tbody>
</div>
