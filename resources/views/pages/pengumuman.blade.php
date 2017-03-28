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
        <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Admin</a>
        </li>
        <li class="breadcrumb-item active">Pengumuman</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
        	<div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Buat Pengumuman
                        </div>
                        <div class="card-block">
                            <form id="form-add" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:cluster,kode|alpha_num" placeholder="Kode Pengumuman">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">PIC</label>
                                            <select class="form-control input-sm" name="pic">
                                                @foreach($list_pic as $pic)
                                                <option value="{{$pic->id}}">{{$pic->nama}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Batas Waktu Penawaran</label>
                                            <input id="add-batas-waktu" type="text" required class="form-control input-sm will-clear daterange" placeholder="batas waktu penawaran" readonly name="batas_waktu_penawaran">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Validitas Harga</label>
                                            <input id="add-validitas-harga" type="text" required class="form-control input-sm will-clear singledate" required placeholder="Validitas Harga" readonly name="validitas_harga">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Waktu Pengiriman</label>
                                            <input id="add-waktu-pengiriman" type="text" required class="form-control input-sm will-clear singledate" placeholder="Waktu Pengiriman" readonly name="waktu_pengiriman">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Maksimal Pendaftar</label>
                                            <input id="add-max-register" type="number" class="form-control input-sm will-clear" placeholder="Maksimal Pendaftar" name="max_register">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Harga Netto</label>
                                            <input id="add-harga-netto" type="number" required class="form-control input-sm will-clear needvalidate" data-rule="required|numeric|min:1" placeholder="Harga Netto" name="harga_netto">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Mata Uang</label>
                                            <input id="add-mata-uang" type="text" required class="form-control input-sm will-clear needvalidate" data-rule="required|alpha" placeholder="Mata Uang" name="mata_uang">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                    	<div class="form-group">
                                            <label class="form-form-control-label">Barang</label>
                                            <select title="Pilih Barang" data-selected-text-format="count > 1" id="add-barang" class="form-control will-clear selectpicker" multiple name="barang">
                                                @foreach($list_barang as $barang)
                                                <option value="{{$barang->id}}">{{$barang->kode.' | '.str_limit($barang->deskripsi,30)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                    	<div class="form-group">
                                            <label class="form-form-control-label">Cluster</label>
                                            <select required title="Pilih Cluster" data-selected-text-format="count > 2" id="add-cluster" class="form-control will-clear selectpicker" multiple name="cluster">
                                                @foreach($list_cluster as $cluster)
                                                <option value="{{$cluster->id}}">{{$cluster->kode.' -   '.$cluster->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <button id="add-submit" class="btn btn-primary pull-right" type="submit">Umumkan <i class="fa fa-bullhorn"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <th>Kode / PIC</th>
                                        <th>Waktu</th>
                                        <th>Batas Pendaftar</th>
                                        <th>Harga Netto</th>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                        <th style="width:3%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript">
        moment.locale("id");
        $("input.daterange").daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            timePicker24Hour:true,
            locale: {
                format: 'YYYY-MM-DD h:mm A',
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false
        });
        $("input.singledate").daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            timePicker24Hour:true,
            locale: {
                format: 'YYYY-MM-DD HH:mm',
                cancelLabel: 'Clear'
            },
            singleDatePicker: true,
            autoApply:true
        });
        $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        });
		var csrf = "{{csrf_token()}}";
        var table = $("#pengumuman-data").DataTable({
        	"autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('admin.pengumuman_data')}}",
            info:false,
            "language": {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Maaf data tidak ditemukan",
                "info": "_PAGE_ dari _PAGES_",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Cari "
            },
            "columnDefs": [
                {
                    "className": "mystyle-column",
                    "targets": 0,
                    "render": function(data, type, row, meta){
                        var res = "<strong>Kode Pengumuman : </strong><a>"+row.kode+"</a><br>Kode PIC : <a>"+row.pic_info.kode+"</a><br>Nama PIC : "+row.pic_info.nama+"<br>Telp PIC : "+row.pic_info.telp+"<br>Email PIC: "+row.pic_info.email;
                        return res;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        return "<strong>Batas waktu penawaran</strong> :<br>"+moment(row.batas_awal_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLL')+" - "+moment(row.batas_akhir_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLL');
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return 'a';
                    }
                },
                {
                    "orderable":false,
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return 'a';
                    }
                },
                {
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        return 'a';
                    }
                },
                {
                    "orderable":false,
                    "targets": 5,
                    "render": function(data, type, row, meta){
                        return 'a';
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 6,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getBarang('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusBarang('+row.id+')"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
        });
    </script>
@stop