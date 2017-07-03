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
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="/bower_components/datatables/media/css/dataTables.bootstrap4.min.css">
    <!-- Main styles for this application -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- Multiple Select -->
    {{--<link href="/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">--}}
    <style type="text/css">
        header.navbar .navbar-brand{
            background-image:url("/img/logo_pal_.png") !important;
        }
        li.nav-item.active{
            background-color: #20a8d1 !important;
            color: white !important;
        }
        @if(session('role')!='admin' && session('role')!='pic')
        .sidebar-fixed .main, .sidebar-fixed .app-footer {
            margin-left: 0px !important;
        }
        @endif
        .breadcrumb, .modal-primary .modal-header, .btn-primary{
            background-color: #2b609e;
        }
        .breadcrumb li, .breadcrumb li a{
            color: white !important;
        }
        .modal-primary .modal-content, .btn-primary{
            border-color: #2b609e;
        }
        a.login{
            color: #2b609e !important;
        }
        a.logout{
            color: #f86c6b !important;
        }
        table.dataTable{
            border-collapse: collapse !important;
        }
        @media (min-width: 1200px){
           .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl{
                padding-left: 0px;
                padding-right: 0px;
            }
            .padding-side{
                padding-left: 15px;
                padding-right: 15px;
            }
        }
        .wide-only{
            font-size: 22px;
        }
        @media(min-width: 991px){
            .wide-only{
                display: none;
            }
        }
        @media(max-width: 991px){
            .wide-only{
                display: inherit;
            }
        }
        .input-sm{
            height: 35px;
        }
        .form-group label{
            font-weight: bold;
        }
        .text-danger{
            color: #f86c6b;;
        }
        .text-normal{
            color: #263238;
        }
        .bootstrap-select.btn-group .dropdown-menu li{
            padding: 5px 15px;
        }
        .bootstrap-select>.dropdown-toggle{
            background-color: white;
            border: 1px solid #d9d9d9;
            color: gray;
            font-weight: bold;
        }
        .bootstrap-select.btn-group .dropdown-menu li a{
            width: inherit;
        }
        .bootstrap-select.btn-group .dropdown-menu li.selected a span.text{
            color: gray;
            font-weight: bold;
        }
        .bootstrap-select.btn-group .dropdown-menu li.selected a span.check-mark{
            margin-right: 50px;
        }
        .file-input{
            height: 100%;
        }
        .form-control:disabled, .form-control[readonly]{
            background-color: white;
        }
        .btn{
            cursor: pointer;
        }
        .btn-black{
            background-color: black;
            color: white;
        }
    </style>
    @yield('style')

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        @if(session('role')=='admin' || session('role')=='pic')
        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        @endif
        <a class="navbar-brand" href="/"></a>
        <ul class="nav navbar-nav hidden-md-down">
            @if(session('role')=='admin' || session('role')=='pic')
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
            @if(session('role')=='admin' || session('role')=='pic')
            <li class="nav-item px-1" data-toggle="modal" data-target="#password-modal">
                <a class="nav-link" href="#">Ganti Password</a>
            </li>
            @endif
            @if(session('role')=='subkontraktor')
            <!--
            <li class="nav-item px-1">
                <a class="nav-link login" href="#" >Pemenang</a>
            </li>
            -->
            @endif
            @if(session('role')!='admin' && session('role')!='subkontraktor' && session('role')!='pic')
            <li class="nav-item px-1">
                <a class="nav-link login" href="#" data-toggle="modal" data-target="#login-modal"><i class="icon-login"></i> Masuk</a>
            </li>
            @else
            <li class="nav-item px-1">
                <a class="nav-link logout" href="{{route('logout')}}"><i class="icon-logout"></i> Keluar</a>
            </li>
            @endif
        </ul>
        
        <ul class="nav navbar-nav ml-auto wide-only">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    ☰
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>Menu</strong>
                    </div>

                    <a class="dropdown-item <?=$TAG=='home'?'active':''?>" href="{{route('home')}}">Home</a>
                    <a class="dropdown-item <?=$TAG=='tentang'?'active':''?>" href="{{route('tentang')}}">Tentang</a>
                    <a class="dropdown-item <?=$TAG=='kontak'?'active':''?>" href="{{route('kontak')}}">Kontak</a>
                    @if(session('role')!='admin' && session('role')!='subkontraktor' && session('role')!='pic')
                        <a class="dropdown-item login" data-toggle="modal" data-target="#login-modal" href="#"><i class="icon-login"></i> Masuk</a>

                    @else
                        <a class="dropdown-item logout" href="{{route('logout')}}"><i class="icon-logout"></i> Keluar</a>
                    @endif
                        
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            @if(isset($auctionNow))
            <li class="nav-item d-md-down-none">
                <span>Sisa Waktu : </span> &nbsp;
            </li>
            <li class="nav-item d-md-down-none">
                <span id="timer" class="nav-link" href="#"></span>
            </li>
            @if(isset($group_auction))
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" id="win-flag" style="font-size: 23px;"><i class="icon-trophy"></i></a>
            </li>
            @endif
            @endif
        </ul>
    </header>

    <div class="app-body">
        @if(session('role')=='admin' || session('role')=='pic')
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item <?=$TAG=='beranda'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.beranda')}}"><i class="icon-speedometer"></i> Beranda</a>
                    </li>
                    @if(session('role')=='admin')
                    <li class="nav-title">
                        Data Master
                    </li>
                    <li class="nav-item <?=$TAG=='departemen'?'active':''?>">
                        <a class="nav-link" href="/intern/departemen"><i class="icon-user-follow"></i> Departemen</a>
                    </li>
                    <li class="nav-item <?=$TAG=='subkontraktor'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.subkontraktor')}}"><i class="icon-user-follow"></i> Sub Kontraktor</a>
                    </li>
                    <li class="nav-item <?=$TAG=='vendor'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.vendor')}}"><i class="icon-user-follow"></i> Vendor</a>
                    </li>
                    <li class="nav-item <?=$TAG=='pic'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.pic')}}"><i class="icon-user-follow"></i> PIC</a>
                    </li>
                    <li class="nav-item <?=$TAG=='cluster_barang'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.cluster_barang')}}"><i class="icon-layers"></i> Cluster Barang</a>
                    </li>
                    <li class="nav-item <?=$TAG=='cluster_jasa'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.cluster_jasa')}}"><i class="icon-layers"></i> Cluster Jasa</a>
                    </li>
                    <li class="nav-item <?=$TAG=='barang'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.barang')}}"><i class="icon-grid"></i> Barang</a>
                    </li>
                    @endif
                    <li class="divider"></li>
                    <li class="nav-title">
                        Transaksional
                    </li>
                    
                    <li class="nav-item <?=$TAG=='pengumuman'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.pengumuman')}}"><i class="icon-volume-2"></i> Pengumuman</a>
                    </li>
                    
                    <li class="nav-item <?=$TAG=='monitoring'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.monitoring')}}"><i class="icon-eye"></i> Monitoring</a>
                    </li>
                    <li class="nav-item <?=$TAG=='arsip'?'active':''?>">
                        <a class="nav-link" href="{{route('intern.arsip')}}"><i class="icon-docs"></i> Arsip</a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
        <main class="main">
            @yield('content')
        </main>
        @if(session('role')=='admin')
        <?php /*
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
                            <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                            <img src="/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                            <div class="avatar avatar-xs">
                                <img src="/img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            </div>
                        </div>
                    </div>
                    <hr class="mx-1 my-0">
                </div>
                <div class="tab-pane p-1" id="messages" role="tabpanel">
                    <div class="message">
                        <div class="py-1 pb-3 mr-1 float-left">
                            <div class="avatar">
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
                                <img src="/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
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
        */ ?>
        @endif
    </div>

    @if(session('role')!='admin' && session('role')!='subkontraktor' && session('role')!='pic')
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
                            <input autocomplete="false" type="email" id="email-login" name="email" class="form-control" placeholder="Email" autofocus="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input autocomplete="false" type="password" id="password-login" name="password" class="form-control" placeholder="Kode">
                        </div>
                    </div>
                    <strong>Captcha : </strong><img src="{{$captcha_src}}" class="captcha-img" style="margin-bottom:5px;border:1px solid gray;"> &nbsp;<button title="perbarui captcha" type="button" class="btn btn-sm btn-captcha"><i class="icon-reload"></i></button><br>
                    <input class="form-control" name="captcha" placeholder="Masukkan captcha sesuai gambar" id="input-captcha-admin">
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
    @endif

    @if(session('role')=='admin' || session('role')=='pic')
    <form class="modal fade" action="" method="post" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Ganti Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input required autocomplete="false" type="password" id="password-lama" name="password_lama" class="form-control" placeholder="Password Sebelumnya">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input required autocomplete="false" type="password" id="password-baru" name="password_baru" class="form-control" placeholder="Password Baru">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input required autocomplete="false" type="password" id="password-baru-confirm" name="password_baru_confirm" class="form-control" placeholder="Konfirmasi Password Baru">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="button-submit-password">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    @endif

    <footer class="app-footer">
        <a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.
        <span class="float-right">Powered by <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/tether/dist/js/tether.min.js"></script>
    <!-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="/original-bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="/bower_components/pace/pace.min.js"></script> -->
    <script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables/media/js/DataTablesBS4.js"></script>


    <!-- Plugins and scripts required by all views -->
    <!-- <script src="/bower_components/chart.js/dist/Chart.min.js"></script> -->

    <!-- Accounting -->
    <script type="text/javascript" src="/js/accounting.min.js"></script>

    <!-- Multiple Select -->
    {{--<script src="/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>--}}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/js/jquery.maskMoney.min.js"></script>
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
            // $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
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
    @if(session('role')!='admin' && session('role')!='subkontraktor' && session('role')!='pic')
    <script type="text/javascript">
        $("#login-modal").submit(function(e){
            e.preventDefault();
            $("#button-login").addClass('disabled');
            $("#button-login").text('Mengirim');
            $.ajax({
                url:"{{route('login')}}",
                method:"POST",
                data:{email:$("#email-login").val().trim(),password:$("#password-login").val().trim(),_token:"{{csrf_token()}}",captcha:$("#input-captcha-admin").val()},
                success:function(res){
                    if(res.result==true){
                        if(res.data.role=='admin'){
                            window.location.href = "{{route('intern.beranda')}}";
                        }else{
                            location.reload();
                        }
                    }else{
                        $(".captcha-img").attr("src",res.captcha_src);
                        alert(res.message);
                    }
                    $("#button-login").removeClass('disabled');
                    $("#button-login").text('Masuk');
                },
                statusCode: {
                    500: function() {
                        alert("Token login kadaluarsa, silahkan ulangi login anda");
                        location.reload();
                    }
                }
            })
        });
    </script>
    @endif

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        function validate(element) {
            var name = element.attr('name');
            if(element.attr('type')=='file'){
                var form = new FormData();
                form.append('gambar',element);
                $.ajax({
                    url: "{{route('intern.validate')}}/"+name+"?_rule="+element.data('rule'),
                    type: "POST",
                    data: form,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(res){
                        console.log(res);
                    }
                });
            }else{
                if(element.val().length>=1){
                    $.ajax({
                        url:"{{route('intern.validate')}}/"+name+"?"+name+"="+element.val()+"&_rule="+element.data('rule'),
                        method:"GET",
                        success:function(res){
                            element.parent(".form-group").removeClass('has-danger');
                            element.parent(".form-group").addClass('has-success');
                            element.removeClass('form-control-danger');
                            element.addClass('form-control-success');
                            element.next().text('');
                            element.next().removeClass('text-danger');
                        },
                        statusCode:{
                            422:function(res){
                                element.parent(".form-group").removeClass('has-success');
                                element.parent(".form-group").addClass('has-danger');
                                element.removeClass('form-control-success');
                                element.addClass('form-control-danger');
                                element.next().text(res.responseJSON[name][0]);
                                element.next().removeClass('text-normal');
                                element.next().addClass('text-danger');
                            }
                        }
                    });
                }else{
                    element.parent(".form-group").removeClass('has-success');
                    element.parent(".form-group").addClass('has-danger');
                    element.removeClass('form-control-success');
                    element.addClass('form-control-danger');
                    element.next().text('minimal 1 karakter');
                    element.next().removeClass('text-normal');
                    element.next().addClass('text-danger');
                }
            }
        }
        $("input.needvalidate").change(function(){
            var element = $(this);
            validate(element);
        });
        $("input.needvalidate_file").on('change',function(){
            var element = $(this);
            validate(element);
        });
        $(".maskmoney").maskMoney({prefix:'Rp. ', allowNegative: false, thousands:'.', decimal:',',precision:0,affixesStay:true});
        $(".maskmoneywithoutrp").maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',',precision:0,affixesStay:true});
        function toCurrency(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script> 
    @yield('script')
    <script type="text/javascript">
        moment.locale("id");
        $(".btn-captcha").click(function(){
            $.ajax({
                url:"/renew_captcha",
                success: function(src){
                    $(".captcha-img").attr('src',src);
                }
            });
        });
        @if(session()->has('error'))
        alert("{{session()->pull('error')}}");
        @endif
        @if(session('role')=='admin' || session('role')=='pic')
        $("#password-modal").submit(function(e){
            e.preventDefault();
            var password_lama = $("#password-lama").val().trim();
            var password_baru = $("#password-baru").val().trim();
            var password_baru_confirm = $("#password-baru-confirm").val().trim();
            if(password_baru_confirm==password_baru){
                $.ajax({
                    url:"{{route('intern.change_password')}}",
                    method:"POST",
                    data:{password:password_lama,password_baru:password_baru},
                    success:function(res){
                        if(res.hasil===true){
                            alert("Password berhasil diganti");
                            $("#password-lama").val('');
                            $("#password-baru").val('');
                            $("#password-baru-confirm").val('');
                            $("#password-modal").modal('hide');
                        }else{
                            alert(res.message);
                            location.reload();
                        }
                    }
                });
            }else{
                alert("Password baru dan password konrimasi harus sama");
            }
        });
        @endif
    </script>
</body>

</html>