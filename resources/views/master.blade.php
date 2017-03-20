<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="/img/e_.png">

    <title>E-Procurement PT.PALL</title>

    <!-- Icons -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="/css/style.css" rel="stylesheet">
    <style type="text/css">
        header.navbar .navbar-brand{
            background-image:url("/img/logo_pal_.png") !important;
        }
        li.nav-item.active{
            background-color: #20a8d1 !important;
            color: white !important;
        }
        @if(session('role')!='admin')
        .sidebar-fixed .main, .sidebar-fixed .app-footer {
            margin-left: 0px !important;
        }
        @endif
        .breadcrumb, .modal-primary .modal-header, .btn-primary{
            background-color: #2b609e;
        }
        .modal-primary .modal-content, .btn-primary{
            border-color: #2b609e;
        }
        a.login{
            color: #2b609e !important;
        }
    </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav hidden-md-down">
            @if(session('role')=='admin')
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>
            @endif
            <li class="nav-item px-1">
                <a class="nav-link <?=$TAG=='home'?'active':''?>" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link <?=$TAG=='tentang'?'active':''?>" href="{{route('tentang')}}">Tentang</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link <?=$TAG=='kontak'?'active':''?>" href="{{route('kontak')}}">Kontak</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link login" href="#" data-toggle="modal" data-target="#login-modal"><i class="icon-login"></i> Masuk</a>
            </li>
        </ul>
        @if(session('role')=='admin')
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item hidden-md-down">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <!--<img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">-->
                    <span class="hidden-md-down">admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>

                    <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
            <li class="nav-item hidden-md-down">
                <a class="nav-link navbar-toggler aside-menu-toggler" href="#">☰</a>
            </li>
        </ul>
        @endif
    </header>

    <div class="app-body">
        @if(session('role')=='admin')
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item <?=$TAG=='beranda'?'active':''?>">
                        <a class="nav-link" href="{{route('home')}}"><i class="icon-speedometer"></i> Beranda</a>
                    </li>
                    <li class="nav-title">
                        Data Master
                    </li>
                    <li class="nav-item <?=$TAG=='subkontraktor'?'active':''?>">
                        <a class="nav-link" href="{{route('admin.subkontraktor')}}"><i class="icon-user-follow"></i> Sub Kontraktor</a>
                    </li>
                    <li class="nav-item <?=$TAG=='cluster'?'active':''?>">
                        <a class="nav-link" href="{{route('admin.cluster')}}"><i class="icon-layers"></i> Cluster</a>
                    </li>
                    <li class="nav-item <?=$TAG=='barang'?'active':''?>">
                        <a class="nav-link" href="{{route('admin.barang')}}"><i class="icon-grid"></i> Barang</a>
                    </li>
                    <li class="divider"></li>
                    <li class="nav-title">
                        Transaksional
                    </li>
                    <li class="nav-item <?=$TAG=='pengumuman'?'active':''?>">
                        <a class="nav-link" href="{{route('admin.pengumuman')}}"><i class="icon-volume-2"></i> Pengumuman</a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
        <main class="main">
            @yield('content')
        </main>
        @if(session('role')=='admin')
        <aside class="aside-menu">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="timeline" role="tabpanel">
                    <div class="callout m-0 py-h text-muted text-center bg-faded text-uppercase">
                        <small><b>Today</b>
                        </small>
                    </div>
                    <hr class="transparent mx-1 my-0">
                    <div class="callout callout-warning m-0 py-1">
                        <div class="avatar float-right">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div>Meeting with
                            <strong>Lucas</strong>
                        </div>
                        <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                        <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                    </div>
                    <hr class="mx-1 my-0">
                    <div class="callout callout-info m-0 py-1">
                        <div class="avatar float-right">
                            <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div>Skype with
                            <strong>Megan</strong>
                        </div>
                        <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                        <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line</small>
                    </div>
                    <hr class="transparent mx-1 my-0">
                    <div class="callout m-0 py-h text-muted text-center bg-faded text-uppercase">
                        <small><b>Tomorrow</b>
                        </small>
                    </div>
                    <hr class="transparent mx-1 my-0">
                    <div class="callout callout-danger m-0 py-1">
                        <div>New UI Project -
                            <strong>deadline</strong>
                        </div>
                        <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                        <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                        <div class="avatars-stack mt-h">
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                        </div>
                    </div>
                    <hr class="mx-1 my-0">
                    <div class="callout callout-success m-0 py-1">
                        <div>
                            <strong>#10 Startups.Garden</strong>Meetup</div>
                        <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                        <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                    </div>
                    <hr class="mx-1 my-0">
                    <div class="callout callout-primary m-0 py-1">
                        <div>
                            <strong>Team meeting</strong>
                        </div>
                        <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                        <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                        <div class="avatars-stack mt-h">
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                        </div>
                    </div>
                    <hr class="mx-1 my-0">
                </div>
                <div class="tab-pane p-1" id="messages" role="tabpanel">
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted">Lukasz Holeczek</small>
                            <small class="text-muted float-right mt-q">1:52 PM</small>
                        </div>
                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                    </div>
                    <hr>
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted">Lukasz Holeczek</small>
                            <small class="text-muted float-right mt-q">1:52 PM</small>
                        </div>
                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                    </div>
                    <hr>
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted">Lukasz Holeczek</small>
                            <small class="text-muted float-right mt-q">1:52 PM</small>
                        </div>
                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                    </div>
                    <hr>
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted">Lukasz Holeczek</small>
                            <small class="text-muted float-right mt-q">1:52 PM</small>
                        </div>
                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                    </div>
                    <hr>
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted">Lukasz Holeczek</small>
                            <small class="text-muted float-right mt-q">1:52 PM</small>
                        </div>
                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                    </div>
                </div>
                <div class="tab-pane p-1" id="settings" role="tabpanel">
                    <h6>Settings</h6>

                    <div class="aside-options">
                        <div class="clearfix mt-2">
                            <small><b>Option 1</b>
                            </small>
                            <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                                <input type="checkbox" class="switch-input" checked="">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div>
                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                        </div>
                    </div>

                    <div class="aside-options">
                        <div class="clearfix mt-1">
                            <small><b>Option 2</b>
                            </small>
                            <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                                <input type="checkbox" class="switch-input">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div>
                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                        </div>
                    </div>

                    <div class="aside-options">
                        <div class="clearfix mt-1">
                            <small><b>Option 3</b>
                            </small>
                            <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                                <input type="checkbox" class="switch-input">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="aside-options">
                        <div class="clearfix mt-1">
                            <small><b>Option 4</b>
                            </small>
                            <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                                <input type="checkbox" class="switch-input" checked="">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>

                    <hr>
                    <h6>System Utilization</h6>

                    <div class="text-uppercase mb-q mt-2">
                        <small><b>CPU Usage</b>
                        </small>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">348 Processes. 1/4 Cores.</small>

                    <div class="text-uppercase mb-q mt-h">
                        <small><b>Memory Usage</b>
                        </small>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">11444GB/16384MB</small>

                    <div class="text-uppercase mb-q mt-h">
                        <small><b>SSD 1 Usage</b>
                        </small>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">243GB/256GB</small>

                    <div class="text-uppercase mb-q mt-h">
                        <small><b>SSD 2 Usage</b>
                        </small>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">25GB/256GB</small>
                </div>
            </div>
        </aside>
        @endif
    </div>

    @if(session('role')!='admin')
    <form class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i>
                            </span>
                            <input autocomplete="false" type="email" id="email-login" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input autocomplete="false" type="password" id="password-login" name="password" class="form-control" placeholder="Kode">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="button-login">Masuk</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
    @endif

    <footer class="app-footer">
        <a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.
        <span class="float-right">Powered by <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/pace/pace.min.js"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="/bower_components/chart.js/dist/Chart.min.js"></script>

    <script type="text/javascript">
        $.navigation = $('nav > ul.nav');
        $.panelIconOpened = 'icon-arrow-up';
        $.panelIconClosed = 'icon-arrow-down';
        //Default colours
        $.brandPrimary =  '#20a8d8';
        $.brandSuccess =  '#4dbd74';
        $.brandInfo =     '#63c2de';
        $.brandWarning =  '#f8cb00';
        $.brandDanger =   '#f86c6b';
        $.grayDark =      '#2a2c36';
        $.gray =          '#55595c';
        $.grayLight =     '#818a91';
        $.grayLighter =   '#d1d4d7';
        $.grayLightest =  '#f8f9fa';
        'use strict';
        /****
        * MAIN NAVIGATION
        */

        function resizeBroadcast() {

            var timesRun = 0;
            var interval = setInterval(function(){
                timesRun += 1;
                if(timesRun === 5){
                    clearInterval(interval);
                }
                window.dispatchEvent(new Event('resize'));
            }, 62.5);
        }
        //$("main.main ol.breadcrumb li.breadcrumb-menu.hidden-md-down").remove();
        $(document).ready(function($){
            
            // Add class .active to current link
            $.navigation.find('a').each(function(){

                var cUrl = String(window.location).split('?')[0];

                if (cUrl.substr(cUrl.length - 1) == '#') {
                    cUrl = cUrl.slice(0,-1);
                }

                if ($($(this))[0].href==cUrl) {
                    $(this).addClass('active');

                    $(this).parents('ul').add(this).each(function(){
                        $(this).parent().addClass('open');
                    });
                }
            });

            // Dropdown Menu
            $.navigation.on('click', 'a', function(e){

                if ($.ajaxLoad) {
                 e.preventDefault();
                }

                if ($(this).hasClass('nav-dropdown-toggle')) {
                    $(this).parent().toggleClass('open');
                    resizeBroadcast();
                }

            });
          

            /* ---------- Disable moving to top ---------- */
            $('a[href="#"][data-top!=true]').click(function(e){
                e.preventDefault();
            });

        });

        /****
        * CARDS ACTIONS
        */

        $(document).on('click', '.card-actions a', function(e){
            e.preventDefault();

            if ($(this).hasClass('btn-close')) {
                $(this).parent().parent().parent().fadeOut();
            } else if ($(this).hasClass('btn-minimize')) {
                var $target = $(this).parent().parent().next('.card-block');
                if (!$(this).hasClass('collapsed')) {
                    $('i',$(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
                } else {
                    $('i',$(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
                }
            } else if ($(this).hasClass('btn-setting')) {
                $('#myModal').modal('show');
            }
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function init(url) {
            /* ---------- Tooltip ---------- */
            $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
            /* ---------- Popover ---------- */
            $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();
        }
        /* ---------- Main Menu Open/Close, Min/Full ---------- */
        $('.navbar-toggler').click(function(){

            if ($(this).hasClass('sidebar-toggler')) {
                $('body').toggleClass('sidebar-hidden');
                resizeBroadcast();
            }

            if ($(this).hasClass('aside-menu-toggler')) {
                $('body').toggleClass('aside-menu-hidden');
                resizeBroadcast();
            }

            if ($(this).hasClass('mobile-sidebar-toggler')) {
                $('body').toggleClass('sidebar-mobile-show');
                resizeBroadcast();
            }

        });

        $('.sidebar-close').click(function(){
            $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
        });
    </script>

    <script type="text/javascript">
        $("#login-modal").submit(function(e){
            e.preventDefault();
            $("#button-login").addClass('disabled');
        });
    </script>
    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <!-- <script src="js/views/main.js"></script> -->

</body>

</html>