@extends('master')

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
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:cluster,kode|alpha_num" placeholder="Kode Cluster">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Maksimal Pendaftar</label>
                                            <input id="add-nama" type="number" required class="form-control input-sm will-clear">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Mulai Pengumuman</label>
                                            <input id="add-nama" type="datetime-local" required class="form-control input-sm will-clear">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Selesai Pengumuman</label>
                                            <input id="add-nama" type="datetime-local" required class="form-control input-sm will-clear">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                    	<div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Barang</label>
                                            <select required title="Pilih Barang" data-selected-text-format="count > 2" id="add-cluster" class="form-control will-clear selectpicker" multiple name="cluster">
                                                @foreach($list_barang as $barang)
                                                <option value="{{$barang->id}}">{{$barang->kode.' | '.str_limit($barang->deskripsi,30)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                    	<div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Cluster</label>
                                            <select required title="Pilih Cluster" data-selected-text-format="count > 4" id="add-cluster" class="form-control will-clear selectpicker" multiple name="cluster">
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
                                        <th>Kode</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Max</th>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                        <th style="width:3%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                		<td>ABC</td>
                                		<td>28 Maret 2017 Pukul 11.00</td>
                                		<td>28 Maret 2017 Pukul 12.00</td>
                                		<td>5 Pendaftar</td>
                                		<td>
                                			PIPING, VALVE AND PROPULSI<br>
								            BOTTOM CLEANING DAN REPLATING<br>
								            ELECTRIKAL DAN MECANICAL<br>
								            DT AND NDT<br>
								            GENERAL SERVICE
                                		</td>
                                		<td>
                                			<img style="width:70px;border:1px solid #b7b6b6;" src="/img/barang/default.gif"><br>
                                			<label>LGS1</label><br><br>
                                			<img style="width:70px;border:1px solid #b7b6b6;" src="/img/barang/default.gif"><br>
                                			<label>LGS3</label><br><br>
                                			<img style="width:70px;border:1px solid #b7b6b6;" src="/img/barang/default.gif"><br>
                                			<label>LGS10</label><br><br>
                                		</td>
                                		<td>
                                			<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button"><i class="icon-trash"></i></button></div>
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
@stop

@section('script')
	<script type="text/javascript">
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
            }
        });
    </script>
@stop