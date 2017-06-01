@extends('master')

@section('style')
	<style type="text/css">
		#departemen-data{
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
        <li class="breadcrumb-item active">Departemen</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
        	<div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Tambah Data Departemen
                        </div>
                        <div class="card-block">
                        	<form id="form-add" action="" method="post" enctype="multipart/form-data">
                        		<div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:departemen,kode" placeholder="Kode Departemen">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Nama</label>
                                            <input id="add-nama" type="text" required name="nama" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:departemen,nama" placeholder="Nama Departemen">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Kadep</label>
                                            <input id="add-kadep" type="text" required name="kadep" class="form-control input-sm will-clear" placeholder="Nama Kadep">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Email Kadep</label>
                                            <input id="add-email-kadep" type="email" required name="email_kadep" class="form-control input-sm will-clear" placeholder="Email Kadep">
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
                            <i class="fa fa-align-justify"></i> Data Departemen
                        </div>
                        <div class="card-block">
                            <table id="departemen-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kadep</th>
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
                                        <th>Kadep</th>
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

    <form class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Departemen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Kode</label>
                                <input id="edit-kode" type="text" required name="kode" class="form-control input-sm will-clear" placeholder="Kode Departemen">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Nama</label>
                                <input id="edit-nama" type="text" name="nama" class="form-control input-sm will-clear" placeholder="Nama Departemen">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Kadep</label>
                                <input id="edit-kadep" type="text" required name="kadep" class="form-control input-sm will-clear" placeholder="Nama Kadep">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Email</label>
                                <input id="edit-email" type="email" required name="email_kadep" class="form-control input-sm will-clear" placeholder="Email Kadep">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save-edit-button">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('script')
	<script type="text/javascript">
		var csrf = "{{csrf_token()}}";
		var table = $("#departemen-data").DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('intern.departemen_data')}}",
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
                        return row.kadep;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return row.email_kadep;
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getDepartemen('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusDepartemen('+row.id+')"><i class="icon-trash"></i></button></div>';
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
            var kadep = $("#add-kadep").val();
            var email_kadep = $("#add-email-kadep").val();
            
            $.ajax({
                url:"/intern/departemen",
                method:"POST",
                data:{kode:kode,nama:nama,kadep:kdep,email_kadep:email_kadep,_token:csrf},
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

        function getDepartemen(id) {
            $("button.edit-button[data-id='"+id+"']").prop('disabled', true);
            $.ajax({
                url:"{{route('intern.departemen_single_data')}}/"+id,
                method:"GET",
                success:function(res){
                    var data = res.data;
                    if(res.result===true){
                        $("#edit-modal").modal('show').on('hidden.bs.modal', function () {
                            $("#edit-modal input:not([name='_token'], [name='_method'])").val('');
                            $("#edit-modal textarea").val('');
                            $('#edit-modal .selectpicker').selectpicker('deselectAll');
                        });
                        $("#edit-kode").val(data.kode);
                        $("#edit-kode").data('rule','required|unique:user,kode,'+data.id+',id|alpha_num');
                        $("#edit-nama").val(data.nama);
                        $("#edit-email").val(data.email_kadep);
                        $("#edit-kadep").val(data.kadep);
                        $("button.edit-button[data-id='"+id+"']").prop('disabled', false);
                        $("form#edit-modal").data('id',data.id);
                    }
                }
            });
        }

        $("form#edit-modal").submit(function(e){
            $("#save-edit-button").prop('disabled', true);
            e.preventDefault();
            var kode = $("#edit-kode").val().trim();
            var nama = $("#edit-nama").val().trim();
            var email_kadep = $("#edit-email").val().trim();
            var kadep = $("#edit-kadep").val().trim();
            var id = $(this).data('id');
            $.ajax({
                url:"{{route('intern.departemen')}}/"+id,
                method:"POST",
                data:{kode:kode,nama:nama,email_kadep:email_kadep,kadep:kadep,_token:csrf,_method:"patch"},
                success:function(res){
                    $("#save-edit-button").prop('disabled', false);
                    $("form#edit-modal input").val('');
                    $("form#edit-modal textarea").val('');
                    $("form#edit-modal input.needvalidate").parent(".form-group").removeClass('has-success');
                    $("form#edit-modal input.needvalidate").parent(".form-group").removeClass('has-danger');
                    $("form#edit-modal input.needvalidate").removeClass('form-control-danger');
                    $("form#edit-modal input.needvalidate").removeClass('form-control-success');
                    $("form#edit-modal input.needvalidate").next().removeClass('text-danger');
                    $("form#edit-modal input.needvalidate").next().text('');
                    $('form#edit-modal .selectpicker').selectpicker('deselectAll');
                    csrf = res.token;
                    table.ajax.reload();
                    $('form#edit-modal').modal('hide');
                }
            });
        });

        function hapusDepartemen(id) {
            $("button.delete-button[data-id='"+id+"']").prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Departemen ini ?");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.departemen')}}/"+id,
                    method:"POST",
                    data:{_method:"delete",_token:csrf},
                    success:function (res) {
                        $("button.delete-button[data-id='"+id+"']").prop('disabled', false);
                        table.ajax.reload();
                        csrf = res.token;
                    }
                });
            }else{
                $("button.delete-button[data-id='"+id+"']").prop('disabled', false);
            }
        }
	</script>
@stop