@extends('master')

@section('style')
    <style type="text/css">
        div.img{
            width: 100%;
            height: 200px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Beranda</li>
    </ol>


    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-6 col-lg-3 padding-side">
                    <div class="card card-inverse card-primary">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{$count_subkontraktor}}</h4>
                            <p>Jumlah Subkontraktor</p>
                        </div>
                        <div class="chart-wrapper px-1" style="height:70px;">
                            <canvas id="card-chart1" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 padding-side">
                    <div class="card card-inverse card-info">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{$count_cluster}}</h4>
                            <p>Jumlah Cluster</p>
                        </div>
                        <div class="chart-wrapper px-1" style="height:70px;">
                            <canvas id="card-chart2" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 padding-side">
                    <div class="card card-inverse card-warning">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{$count_barang}}</h4>
                            <p>Jumlah Barang</p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 padding-side">
                    <div class="card card-inverse card-danger">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{$count_pengumuman}}</h4>
                            <p>Total Pengumuman</p>
                        </div>
                        <div class="chart-wrapper px-1" style="height:70px;">
                            <canvas id="card-chart4" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 padding-side">
                    <div class="img" style="background-image: url('/img/1.jpg')"></div>
                </div>
                <div class="col-sm-12 col-md-4 padding-side">
                    <div class="img" style="background-image: url('/img/2.jpg')"></div>
                </div>
                <div class="col-sm-12 col-md-4 padding-side">
                    <div class="img" style="background-image: url('/img/3.jpg')"></div>
                </div>
            </div>
        </div>
    </div>
@stop