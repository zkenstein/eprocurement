@extends('master')

@section('style')
	<style type="text/css">
		#barang-data{
			width: 100% !important;
		}
	</style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Admin</a>
        </li>
        <li class="breadcrumb-item active">Barang</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Tambah Barang
                        </div>
                        <div class="card-block">
                            <form id="form-add" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" style="height: 42px;" type="text" required name="kode" class="form-control will-clear needvalidate" data-rule="required|unique:barang,kode|alpha_num" placeholder="Kode Barang">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Gambar</label>
                                            <input id="add-gambar" type="file" name="gambar" class="form-control input-sm will-clear needvalidate_file file-input" data-rule="max:1000|image" placeholder="Gambar Barang" accept="image/*">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Deskripsi</label>
                                            <textarea id="add-deskripsi" required name="deskripsi" class="form-control will-clear needvalidate" data-rule="required|unique:barang,deskripsi" placeholder="Deskripsi Barang"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <button id="add-submit" class="btn btn-primary pull-right" type="submit">Simpan</button>
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
                            <i class="fa fa-align-justify"></i> Data barang
                        </div>
                        <div class="card-block">
                            <table id="barang-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th></th>
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
	<script type="text/javascript">
        $("#button-file").click(function() {
            $.FileDialog({
                accept:"image/*",
                cancelButton: "Batal",
                dropheight: 100,
                multiple: false,
                title: ""
            }).on('files.bs.filedialog', function(ev) {
                var file = ev.files;
                console.log(file);
            });
        });


		var csrf = "{{csrf_token()}}";
        var table = $("#barang-data").DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('admin.barang_data')}}",
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
                    "targets": 0,
                    "render": function(data, type, row, meta){
                        var kode = row.kode;
                        return kode;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        var nama = row.deskripsi;
                        return nama;
                    }
                },
                {
                    "orderable":false,
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return "<img src='/img/barang/default.gif' style='width:100px;'>";
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getBarang('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusBarang('+row.id+')"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
            "aaSorting": [ [0,'asc'] ]
        });
	</script>
@stop