@extends('master')

@section('style')
	<style type="text/css">
		#subkontraktor-data{
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
        <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Admin</a>
        </li>
        <li class="breadcrumb-item active">Sub Kontraktor</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Tambah Data Subkontraktor
                        </div>
                        <div class="card-block">
                            <form id="form-add" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,kode" placeholder="Kode Sub Kontraktor">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Nama</label>
                                            <input id="add-nama" type="text" required name="nama" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,nama" placeholder="Nama Sub Kontraktor">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Email</label>
                                            <input id="add-email" type="email" required name="email" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,email|email" placeholder="Email Sub Kontraktor">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label" for="inputSuccess1">Telp</label>
                                            <input id="add-telp" type="text" required name="telp" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,telp|min:11" placeholder="Telp Sub Kontraktor">
                                            <span class="help-block"></span>
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
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Bidang Usaha</label>
                                            <textarea id="add-bidang-usaha" class="form-control will-clear" rows="2" required name="bidang_usaha"></textarea>
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
                            <i class="fa fa-align-justify"></i> Data Subkontraktor
                        </div>
                        <div class="card-block">
                            <table id="subkontraktor-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Cluster</th>
                                        <th style="width:5%;"></th>
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
        var csrf = "{{csrf_token()}}";
		var table = $("#subkontraktor-data").DataTable({
            "autoWidth": false,
			"processing": true,
	        "serverSide": true,
	        "ajax": "{{route('admin.subkontraktor_data')}}",
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
                        var nama = row.nama;
                        return nama;
                    }
                },
                { 
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        var email = row.email;
                        return email;
                    }
                },
                { 
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return row.telp;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return row.cluster;
                    }
                },
                {
                	"className":"no-print",
                    "orderable":false,
                	"targets": 4,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
            aaSorting: [[0, 'desc']],
        });
        // $( document ).ajaxError(function( event, request, settings ) {
        //     alert("Koneksi tidak stabil");
        //     $("#add-submit").removeClass('disabled');
        // });
        $("#form-add").submit(function(e){
            $("#add-submit").addClass('disabled');
            e.preventDefault();
            var kode = $("#add-kode").val();
            var nama = $("#add-nama").val();
            var email = $("#add-email").val();
            var telp = $("#add-telp").val();
            var cluster = $("#add-cluster").val();
            var bidang_usaha = $("#add-bidang-usaha").val();
            $.ajax({
                url:"",
                method:"POST",
                data:{kode:kode,nama:nama,email:email,telp:telp,cluster:cluster,bidang_usaha:bidang_usaha,_token:csrf},
                success:function(res){
                    $("#add-submit").removeClass('disabled');
                    $("input").val('');
                    $("input.needvalidate").parent(".form-group").removeClass('has-success');
                    $("input.needvalidate").parent(".form-group").removeClass('has-danger');
                    $("input.needvalidate").removeClass('form-control-danger');
                    $("input.needvalidate").removeClass('form-control-success');
                    $("input.needvalidate").next().removeClass('text-danger');
                    $("input.needvalidate").next().text('');
                    $('.selectpicker').selectpicker('deselectAll');
                    csrf = res.token;
                    table.ajax.reload();
                }
            });
        })
	</script>
@stop