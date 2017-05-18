@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/daterangepicker/daterangepicker.css">
    <style type="text/css">
        .mystyle-column > a{
            color: #2b609e !important;
        }
    </style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('intern.beranda')}}">{{studly_case(session('role'))}}</a>
        </li>
        <li class="breadcrumb-item active">Arsip</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
			<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Data Pengumuman
                        </div>
                        <div class="card-block">
                            <table id="pengumuman-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="min-width:165px;">Kode / PIC</th>
                                        <th style="min-width:165px;">Waktu</th>
                                        <th>Max Pendaftar</th>
                                        <?php /*
                                        <th>Harga Netto</th>
                                        */ ?>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="min-width:165px;">Kode / PIC</th>
                                        <th style="min-width:165px;">Waktu</th>
                                        <th>Max Pendaftar</th>
                                        <?php /*
                                        <th>Harga Netto</th>
                                        */ ?>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
@stop