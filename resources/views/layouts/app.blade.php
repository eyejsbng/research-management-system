<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    {{-- <link href="../nowasset/assets/css/bootstrap.min.css" rel="stylesheet" /> --}}
    <link href="../nowasset/assets/css/now-ui-dashboard.minaa26.css?v=1.5.0" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="red">
            <div class="logo">
                <a href="http://www.creative-tim.com/" class="simple-text logo-mini">
                    CT
                </a>

                <a href="http://www.creative-tim.com/" class="simple-text logo-normal">
                    Creative Tim
                </a>

            </div>
            <div class="sidebar-wrapper" id="sidebar-wrapper">

                <div class="user">
                    <div class="photo">
                        <img src="../nowasset/assets/img/james.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample">
                            <span>
                                James Amos
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini-icon">||</span>
                                        <span class="sidebar-normal">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <span class="sidebar-mini-icon">||</span>
                                        <span class="sidebar-normal">Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="dashboard.html">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#pagesExamples">

                            <i class="now-ui-icons design_image"></i>

                            <p>
                                Pages <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="pagesExamples">
                            <ul class="nav">

                                <li>
                                    <a href="pages/pricing.html">
                                        <span class="sidebar-mini-icon">P</span>
                                        <span class="sidebar-normal"> Pricing </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/rtl.html">
                                        <span class="sidebar-mini-icon">RS</span>
                                        <span class="sidebar-normal"> RTL Support </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/invoice.html">
                                        <span class="sidebar-mini-icon">I</span>
                                        <span class="sidebar-normal"> Invoice </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/timeline.html">
                                        <span class="sidebar-mini-icon">T</span>
                                        <span class="sidebar-normal"> Timeline </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/login.html">
                                        <span class="sidebar-mini-icon">L</span>
                                        <span class="sidebar-normal"> Login </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/register.html">
                                        <span class="sidebar-mini-icon">R</span>
                                        <span class="sidebar-normal"> Register </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/lock.html">
                                        <span class="sidebar-mini-icon">LS</span>
                                        <span class="sidebar-normal"> Lock Screen </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="pages/user.html">
                                        <span class="sidebar-mini-icon">UP</span>
                                        <span class="sidebar-normal"> User Profile </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#componentsExamples">

                            <i class="now-ui-icons education_atom"></i>

                            <p>
                                Components <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="componentsExamples">
                            <ul class="nav">

                                <li>
                                    <a href="components/buttons.html">
                                        <span class="sidebar-mini-icon">B</span>
                                        <span class="sidebar-normal"> Buttons </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/grid.html">
                                        <span class="sidebar-mini-icon">G</span>
                                        <span class="sidebar-normal"> Grid System </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/panels.html">
                                        <span class="sidebar-mini-icon">P</span>
                                        <span class="sidebar-normal"> Panels </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/sweet-alert.html">
                                        <span class="sidebar-mini-icon">SA</span>
                                        <span class="sidebar-normal"> Sweet Alert </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/notifications.html">
                                        <span class="sidebar-mini-icon">N</span>
                                        <span class="sidebar-normal"> Notifications </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/icons.html">
                                        <span class="sidebar-mini-icon">I</span>
                                        <span class="sidebar-normal"> Icons </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="components/typography.html">
                                        <span class="sidebar-mini-icon">T</span>
                                        <span class="sidebar-normal"> Typography </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#formsExamples">

                            <i class="now-ui-icons files_single-copy-04"></i>

                            <p>
                                Forms <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="formsExamples">
                            <ul class="nav">

                                <li>
                                    <a href="forms/regular.html">
                                        <span class="sidebar-mini-icon">RF</span>
                                        <span class="sidebar-normal"> Regular Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="forms/extended.html">
                                        <span class="sidebar-mini-icon">EF</span>
                                        <span class="sidebar-normal"> Extended Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="forms/validation.html">
                                        <span class="sidebar-mini-icon">V</span>
                                        <span class="sidebar-normal"> Validation Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="forms/wizard.html">
                                        <span class="sidebar-mini-icon">W</span>
                                        <span class="sidebar-normal"> Wizard </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#tablesExamples">

                            <i class="now-ui-icons design_bullet-list-67"></i>

                            <p>
                                Tables <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="tablesExamples">
                            <ul class="nav">

                                <li>
                                    <a href="tables/regular.html">
                                        <span class="sidebar-mini-icon">RT</span>
                                        <span class="sidebar-normal"> Regular Tables </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="tables/extended.html">
                                        <span class="sidebar-mini-icon">ET</span>
                                        <span class="sidebar-normal"> Extended Tables </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="tables/datatables.net.html">
                                        <span class="sidebar-mini-icon">DT</span>
                                        <span class="sidebar-normal"> DataTables.net </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#mapsExamples">

                            <i class="now-ui-icons location_pin"></i>

                            <p>
                                Maps <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="mapsExamples">
                            <ul class="nav">

                                <li>
                                    <a href="maps/google.html">
                                        <span class="sidebar-mini-icon">GM</span>
                                        <span class="sidebar-normal"> Google Maps </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="maps/fullscreen.html">
                                        <span class="sidebar-mini-icon">FM</span>
                                        <span class="sidebar-normal"> Full Screen Map </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="maps/vector.html">
                                        <span class="sidebar-mini-icon">VM</span>
                                        <span class="sidebar-normal"> Vector Map </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a href="widgets.html">

                            <i class="now-ui-icons objects_diamond"></i>

                            <p>Widgets</p>
                        </a>

                    </li>

                    <li>


                        <a href="charts.html">

                            <i class="now-ui-icons business_chart-pie-36"></i>

                            <p>Charts</p>
                        </a>

                    </li>

                    <li>


                        <a href="calendar.html">

                            <i class="now-ui-icons media-1_album"></i>

                            <p>Calendar</p>
                        </a>

                    </li>



                </ul>
            </div>
        </div>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">

                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>

                        <a class="navbar-brand" href="#pablo">Dashboard</a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">


                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons location_world"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <div class="panel-header panel-header-lg">
                {{-- <canvas id="bigDashboardChart"></canvas> --}}
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="statistics">
                                            <div class="info">
                                                <div class="icon icon-primary">
                                                    <i class="now-ui-icons ui-2_chat-round"></i>
                                                </div>
                                                <h3 class="info-title">859</h3>
                                                <h6 class="stats-title">Messages</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="statistics">
                                            <div class="info">
                                                <div class="icon icon-success">
                                                    <i class="now-ui-icons business_money-coins"></i>
                                                </div>
                                                <h3 class="info-title"><small>$</small>3,521</h3>
                                                <h6 class="stats-title">Today Revenue</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="statistics">
                                            <div class="info">
                                                <div class="icon icon-info">
                                                    <i class="now-ui-icons users_single-02"></i>
                                                </div>
                                                <h3 class="info-title">562</h3>
                                                <h6 class="stats-title">Customers</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="statistics">
                                            <div class="info">
                                                <div class="icon icon-danger">
                                                    <i class="now-ui-icons objects_support-17"></i>
                                                </div>
                                                <h3 class="info-title">353</h3>
                                                <h6 class="stats-title">Support Requests</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Active Users</h5>
                                <h2 class="card-title">34,252</h2>
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn btn-round btn-icon dropdown-toggle btn-outline-default no-caret"
                                        data-toggle="dropdown">
                                        <i class="now-ui-icons loader_gear"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <a class="dropdown-item text-danger" href="#">Remove Data</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="activeUsers"></canvas>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/US.png">
                                                    </div>
                                                </td>
                                                <td>USA</td>
                                                <td class="text-right">
                                                    2.920
                                                </td>
                                                <td class="text-right">
                                                    53.23%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/DE.png">
                                                    </div>
                                                </td>
                                                <td>Germany</td>
                                                <td class="text-right">
                                                    1.300
                                                </td>
                                                <td class="text-right">
                                                    20.43%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/AU.png">
                                                    </div>
                                                </td>
                                                <td>Australia</td>
                                                <td class="text-right">
                                                    760
                                                </td>
                                                <td class="text-right">
                                                    10.35%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/GB.png">
                                                    </div>
                                                </td>
                                                <td>United Kingdom</td>
                                                <td class="text-right">
                                                    690
                                                </td>
                                                <td class="text-right">
                                                    7.87%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/RO.png">
                                                    </div>
                                                </td>
                                                <td>Romania</td>
                                                <td class="text-right">
                                                    600
                                                </td>
                                                <td class="text-right">
                                                    5.94%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../nowasset/assets/img/BR.png">
                                                    </div>
                                                </td>
                                                <td>Brasil</td>
                                                <td class="text-right">
                                                    550
                                                </td>
                                                <td class="text-right">
                                                    4.34%
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Summer Email Campaign</h5>
                                <h2 class="card-title">55,300</h2>
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn btn-round dropdown-toggle btn-outline-default btn-icon no-caret"
                                        data-toggle="dropdown">
                                        <i class="now-ui-icons loader_gear"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <a class="dropdown-item text-danger" href="#">Remove Data</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="emailsCampaignChart"></canvas>
                                </div>

                                <div class="card-progress">
                                    <div class="progress-container">
                                        <span class="progress-badge">Delivery Rate</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                                <span class="progress-value">90%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-container progress-success">
                                        <span class="progress-badge">Open Rate</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 60%;">
                                                <span class="progress-value">60%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Click Rate</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 12%;">
                                                <span class="progress-value">12%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-container progress-warning">
                                        <span class="progress-badge">Hard Bounce</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 5%;">
                                                <span class="progress-value">5%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-container progress-danger">
                                        <span class="progress-badge">Spam Report</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 0.11%;">
                                                <span class="progress-value">0.11%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Active Countries</h5>
                                <h2 class="card-title">105</h2>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="activeCountries"></canvas>
                                </div>
                                <div id="worldMap" class="map"></div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Best Selling Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-shopping">
                                        <thead class="">
                                            <th class="text-center">
                                            </th>
                                            <th>Product</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right"> Qty</th>
                                            <th class="text-right">Amount</th>
                                        </thead>
                                    <tbody>
                                            <tr>
                                                <td>
                                                    <div class="img-container">
                                                        <img src="../nowasset/assets/img/saint-laurent.jpg" alt="...">
                                                    </div>
                                                </td>
                                                <td class="td-name">
                                                    <a href="#jacket">Suede Biker Jacket</a>
                                                    <br /><small>by Saint Laurent</small>
                                                </td>
                                                <td>
                                                    Black
                                                </td>
                                                <td>
                                                    M
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>3,390
                                                </td>
                                                <td class="td-number">
                                                    1
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>549
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="img-container">
                                                        <img src="../nowasset/assets/img/balmain.jpg" alt="...">
                                                    </div>
                                                </td>
                                                <td class="td-name">
                                                    <a href="#pants">Jersey T-Shirt</a>
                                                    <br /><small>by Balmain</small>
                                                </td>
                                                <td>
                                                    Black
                                                </td>
                                                <td>
                                                    M
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>499
                                                </td>
                                                <td class="td-number">
                                                    2
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>998
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="img-container">
                                                        <img src="../nowasset/assets/img/prada.jpg" alt="...">
                                                    </div>
                                                </td>
                                                <td class="td-name">
                                                    <a href="#nothing">Slim-Fit Swim Short</a>
                                                    <br /><small>by Prada</small>
                                                </td>
                                                <td>
                                                    Red
                                                </td>
                                                <td>
                                                    M
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>200
                                                </td>
                                                <td class="td-number">
                                                    1
                                                </td>
                                                <td class="td-number">
                                                    <small>€</small>799
                                                </td>

                                            </tr>

                                            <tr>
                                                <td colspan="5">
                                                </td>
                                                <td class="td-total">
                                                    Total
                                                </td>
                                                <td class="td-price">
                                                    <small>€</small>2,346
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class=" container-fluid ">
                    <nav>
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com/">
                                    Creative Tim
                                </a>
                            </li>
                            <li>
                                <a href="http://presentation.creative-tim.com/">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com/">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy; <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date()
                                .getFullYear()))
                        </script>, Designed by <a href="https://www.invisionapp.com/" target="_blank">Invision</a>.
                        Coded by <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <script src="../nowasset/assets/js/core/jquery.min.js"></script>
    {{-- <script src="../nowasset/assets/js/core/popper.min.js"></script> --}}
    {{-- <script src="../nowasset/assets/js/core/bootstrap.min.js"></script> --}}
    <script src="../nowasset/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../nowasset/assets/js/plugins/moment.min.js"></script>
    <script src="../nowasset/assets/js/plugins/bootstrap-switch.js"></script>
    <script src="../nowasset/assets/js/plugins/sweetalert2.min.js"></script>
    <script src="../nowasset/assets/js/plugins/jquery.validate.min.js"></script>
    <script src="../nowasset/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <script src="../nowasset/assets/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="../nowasset/assets/js/plugins/bootstrap-datetimepicker.js"></script>
    <script src="../nowasset/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../nowasset/assets/js/plugins/bootstrap-tagsinput.js"></script>
    <script src="../nowasset/assets/js/plugins/jasny-bootstrap.min.js"></script>
    <script src="../nowasset/assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../nowasset/assets/js/plugins/jquery-jvectormap.js"></script>
    <script src="../nowasset/assets/js/plugins/nouislider.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
    <script src="../nowasset/assets/js/plugins/chartjs.min.js"></script>
    <script src="../nowasset/assets/js/plugins/bootstrap-notify.js"></script>
    <script src="../nowasset/assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $().ready(function () {
                $sidebar = $('.sidebar');
                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                $('.fixed-plugin a').click(function (event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function () {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function () {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function () {
                            $sidebar_img_container.css('background-image', 'url("' +
                                new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $full_page_background.fadeOut('fast', function () {
                            $full_page_background.css('background-image', 'url("' +
                                new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img")
                            .attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image +
                            '")');
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function () {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
                    }
                    var simulateWindowResize = setInterval(function () {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                 setTimeout(function () {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });
            });
        });
    </script>
</body>
</html>
