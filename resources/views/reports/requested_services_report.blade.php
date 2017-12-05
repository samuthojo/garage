<div class="table-responsive">
  <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Service</th>
        <th>Car</th>
        <th>Model</th>
        <th>Customers</th>
      </tr>
    </thead>
    <tbody>
      @foreach($service_as_products as $service)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $service->service }}</td>
          <td>{{ $service->car }}</td>
          <td>{{ $service->model }}</td>
          <td>{{ $service->customers }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<script>
  myReportDataTable(reportString(), niceTitle())
</script>
