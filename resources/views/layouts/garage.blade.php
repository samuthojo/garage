@include('header')
  <style>
    body, html{
        height: 100%;
    }

    .alert {
      display:inline-block;
    }
    .btn-warning {
      background-color: #ff9720 !important;
      border-color: #ff9720 !important;
    }
    .panel-default {
      border-color: #333;
    }
    .panel-heading h3 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: normal;
      width: 75%;
      padding-top: 8px;
      color: #fff;
    }
    .panel-footer {
      background-color: #333 !important;
      color: #fff;
    }
    .region {
      padding-top: 70px;
    }

    .loader {
        z-index: 9999;
        text-align: center;
        align-content: center;
        padding-bottom: 10px;
        display: none;
    }

    .navbar-default {
      background-color: #000;
    }
    .navbar-brand {
      color: #fff !important;
      /*font-weight: bold;*/
    }
    .navbar-default .navbar-nav>li>a {
      color: #fff;
      /*color: #555;*/
      /*color: #777;*/
    }
    .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
      color: #000;
      background-color: #ff9720;
      /*font-weight: bold;*/
    }
    .navbar-default .navbar-nav>li>a:hover {
      background-color: #fff;
      color: #000;
    }
    .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
      color: #000;
      background-color: #ff9720;
    }
    .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        color: #000;
        /*color: #3c763d;*/
    }
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
        background-color: #ccc;
        /*color: #3c763d;*/
    }
    .panel-heading {
      background-color: #333 !important;
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
      <a class="navbar-brand" href="{{route('dashboard')}}">Mechmasters</a>
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
      <li class="link" id="reports">
        <a href="javascript:menu_links('reports');">
        Reports
        <span style="font-size:16px;"></span></a>
      </li>
      <!-- <li class="link" id="notifications">
        <a href="javascript:menu_links('notifications');">
        Notifications
        <span style="font-size:16px;"></span></a>
      </li> -->
      <!-- <li class="link" id="promo_messages">
        <a href="javascript:menu_links('promo_messages');">
        PromoMessages
        <span style="font-size:16px;"></span></a>
      </li> -->
    </ul>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class=""></span> More
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li class="link" id="notifications">
              <a href="javascript:menu_links('notifications');">
              Notifications
              <span style="font-size:16px;"></span></a>
            </li>
            <li class="divider"></li>
            <li><a href="javascript:menu_links('promo_messages');">PromoMessages</a></li>
            <li class="divider"></li>
            <li><a href="javascript:menu_links('feedbacks');">
              Feedback
            </a></li>
          </ul>
        </a>
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
 @include('loader')
 <div class"container-fluid" id="main_content">
   @yield('panel')
 </div>
</div>

</html>
