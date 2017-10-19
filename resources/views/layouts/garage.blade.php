@include('header')
  <style>
    body, html{
        height: 100%;
    }

    .alert {
      display:inline-block;
    }

    .panel-heading h3 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: normal;
      width: 75%;
      padding-top: 8px;
    }

    .region {
      padding-top: 70px;
    }
  </style>
</head>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Mechmaster</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" id="link_section">
      <li class="active link" id="categories">
        <a href="javascript:menu_links('categories');">
        Categories
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="products">
        <a href="javascript:menu_links('products');">
        Products
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="cars"><a href="javascript:menu_links('cars');">
        Cars
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="cars"><a href="javascript:menu_links('models');">
        Models
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="customers">
        <a href="javascript:menu_links('customers');">
        Customers
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="orders"><a href="javascript:menu_links('orders');">
        Orders
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="services"><a href="javascript:menu_links('services');">
        Services
        <span style="font-size:16px;"></span></a>
      </li>
      <li class="link" id="requested_services">
        <a href="javascript:menu_links('requested_services');">
        Requested Services
        <span style="font-size:16px;"></span></a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> Account
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li><a href="{{ route('logout') }}">Logout</a></li>
            <li class="divider"></li>
            <li><a href="javascript:menu_links('change_password');">
              Change password
            </a></li>
          </ul>
        </a>
      </li>
    </ul>
  </div>
  </div>
</nav>

<div class="container-fluid region">
 <div class"container-fluid" id="main_content">
   @yield('panel')
 </div>
</div>

</html>
