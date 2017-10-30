<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        Order-Promo Message: </h3>
       <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="container">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>Message</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order_promos as $order_promo)
                <tr>
                  <td>{{$order_promo->message}}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        Service-Promo Message: </h3>
       <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="container">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>Message</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($service_promos as $service_promo)
                <tr>
                  <td>{{$service_promo->message}}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
    </div>
  </div>
</div>
