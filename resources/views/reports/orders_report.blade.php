<div class="table-responsive">
  <table id="myTable" class="table table-striped display">
    <thead>
      <tr>
        <th>Date Ordered</th>
        <th>Order No.</th>
        <th>Customer</th>
        <th>Contact</th>
        <th># items</th>
        <th>Amount (Tshs)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->date }}</td>
          <td>{{ $order->id }}</td>
          <td>
            {{ $order->customer }}
          </td>
          <td>{{ $order->contact }}</td>
          <td>{{ $order->num_items }}</td>
          <td>{{ $order->amount }}</td>
        </tr>
      @endforeach
    <!-- </tbody> -->
    <!-- <tfoot> -->
      @if($total_amount > 0)
       <tr>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th>Total Amount:</th>
         <th>{{sprintf("%s/=", number_format($total_amount))}}</th>
       </tr>
      @endif
     </tbody>
  </table>
</div>
<script>
  myReportDataTable(reportString(), niceTitle())
</script>
