@extends('master')

@section('style')
	<style type="text/css">
		#divisi-data{
			width: 100% !important;
		}
        .table-responsive{
            width: 100%;
            overflow-x: scroll;
        }
	</style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('intern.beranda')}}">Admin</a>
        </li>
        <li class="breadcrumb-item active">Divisi</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
        	<div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Tambah Data Divisi
                        </div>
                        <div class="card-block">
                        	<form id="form-add" action="" method="post" enctype="multipart/form-data">
                        		<div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:divisi,kode" placeholder="Kode Divisi">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Nama</label>
                                            <input id="add-nama" type="text" required name="nama" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:divisi,nama" placeholder="Nama Divisi">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Direktur</label>
                                            <input id="add-direktur" type="text" required name="direktur" class="form-control input-sm will-clear" placeholder="Nama Direktur">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Email Direktur</label>
                                            <input id="add-email-direktur" type="email" required name="email_direktur" class="form-control input-sm will-clear" placeholder="Email Direktur">
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
                            <i class="fa fa-align-justify"></i> Data Divisi
                        </div>
                        <div class="card-block">
                            <table id="divisi-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Direktur</th>
                                        <th>Email</th>
                                        <th style="width:3%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Direktur</th>
                                        <th>Email</th>
                                        <th style="width:3%;"></th>
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
	<script type="text/javascript">
		var csrf = "{{csrf_token()}}";
		var table = $("#divisi-data").DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('intern.divisi_data')}}",
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
                        var nama = row.nama;
                        return nama;
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return row.direktur;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return row.email_direktur;
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getCluster('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusCluster('+row.id+')"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
            "aaSorting": [ [0,'asc'] ]
        });

		$("#form-add").submit(function(e){
            $("#add-submit").prop('disabled', true);
            e.preventDefault();
            var kode = $("#add-kode").val();
            var nama = $("#add-nama").val();
            var direktur = $("#add-direktur").val();
            var email_direktur = $("#add-email-direktur").val();
            
            $.ajax({
                url:"/intern/divisi",
                method:"POST",
                data:{kode:kode,nama:nama,direktur:direktur,email_direktur:email_direktur,_token:csrf},
                success:function(res){
                    $("#add-submit").prop('disabled', false);
                    $("#form-add input").val('');
                    $("#form-add textarea").val('');
                    $("#form-add input.needvalidate").parent(".form-group").removeClass('has-success');
                    $("#form-add input.needvalidate").parent(".form-group").removeClass('has-danger');
                    $("#form-add input.needvalidate").removeClass('form-control-danger');
                    $("#form-add input.needvalidate").removeClass('form-control-success');
                    $("#form-add input.needvalidate").next().removeClass('text-danger');
                    $("#form-add input.needvalidate").next().text('');
                    $('#form-add .selectpicker').selectpicker('deselectAll');
                    csrf = res.token;
                    table.ajax.reload();
                }
            });
        });
	</script>
@stop