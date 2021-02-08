<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/img/icon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>

    <link href="/css/app.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
   
    <!-- <link href="/nowasset/assets/css/now-ui-dashboard.minaa26.css?v=1.5.0" rel="stylesheet" /> -->
    <link rel="stylesheet" href="/NewUI/css/main.d810cf0ae7f39f28f336.css">
   
    <script src="https://kit.fontawesome.com/2c38c92347.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
</head>
<style>
    input[data-v-4bd11526] {
        border-radius: 30px;
    }

</style>

<body>
    <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

        @if(!(Auth::user()->typ_id == 3 && Auth::user()->grp_id == 1))
        <div class="app-header header-shadow">
            <div class="app-header__logo">
              <div><img src="/img/logo.png" height="30" width="120"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="dropdown">
                        <router-link to="messenger" class="mt-1 mb-2 mr-2 btn-pill btn-transition btn btn-primary">
                            <i class="fas fa-comment-alt"></i>
                            Chat
                        </router-link>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-dots">
                        <div class="dropdown">

                        </div>
                        <div class="dropdown">

                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading"><strong>{{ Auth::user()->name}} </strong></div>
                                @if(Auth::user()->typ_id == 1)
                                <div class="widget-subheading">Research Coordinator </div>

                                @endif
                            </div>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="rm-pointers dropdown-menu dropdown-menu-right"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-198px, 46px, 0px);"
                                x-placement="bottom-end">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                                        <div class="menu-header-image opacity-05"
                                            style="background-image: url('assets/images/dropdown-header/city2.jpg');">
                                        </div>
                                        <div class="menu-header-content text-center text-white">
                                            <h6 class="menu-header-subtitle mt-0"> Account</h6>
                                        </div>
                                    </div>
                                </div>
                                <h6 tabindex="-1" class="dropdown-header"> Account Settingss</h6>
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-user"></i> Profile
                                </button>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>

                            </div>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="ml-2 mb-2 mr-2 btn-pill btn-transition btn btn-outline-focus">Logout</button>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
        <keep-alive>
            <router-view :user="{{ Auth::user()}}"></router-view>
        </keep-alive>

    </div>

</body>
<script src="/NewUI/scripts/main.d810cf0ae7f39f28f336.js"></script>
<script src="/nowasset/assets/js/core/jquery.min.js"></script>
{{-- <script src="../nowasset/assets/js/core/popper.min.js"></script>
    <script src="../nowasset/assets/js/core/bootstrap.min.js"></script> --}}
<script src="/nowasset/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
{{-- <script src="/nowasset/assets/js/plugins/moment.min.js"></script> --}}
<script src="/nowasset/assets/js/plugins/bootstrap-switch.js"></script>
<script src="/nowasset/assets/js/plugins/sweetalert2.min.js"></script>
<script src="/nowasset/assets/js/plugins/jquery.validate.min.js"></script>
<script src="/nowasset/assets/js/plugins/bootstrap-selectpicker.js"></script>
<script src="/nowasset/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="/nowasset/assets/js/plugins/bootstrap-tagsinput.js"></script>
<script src="/nowasset/assets/js/plugins/jasny-bootstrap.min.js"></script>
<script src="/nowasset/assets/js/plugins/fullcalendar.min.js"></script>
<script src="/nowasset/assets/js/plugins/jquery-jvectormap.js"></script>
<script src="/nowasset/assets/js/plugins/nouislider.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
<script src="/nowasset/assets/js/plugins/chartjs.min.js"></script>
<script src="/nowasset/assets/js/plugins/bootstrap-notify.js"></script>
<script src="/nowasset/assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script>
<script src="https://smtpjs.com/v3/smtp.js">
</script>
{{-- <script>
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
    </script> --}}

</html>
