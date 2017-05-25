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

    <form class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Divisi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Kode</label>
                                <input id="edit-kode" type="text" required name="kode" class="form-control input-sm will-clear" placeholder="Kode Divisi">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Nama</label>
                                <input id="edit-nama" type="text" name="nama" class="form-control input-sm will-clear" placeholder="Nama Divisi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Direktur</label>
                                <input id="edit-direktur" type="text" required name="direktur" class="form-control input-sm will-clear" placeholder="Nama Direktur">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Email</label>
                                <input id="edit-email" type="email" required name="email_direktur" class="form-control input-sm will-clear" placeholder="Email Divisi/Direktur">
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
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getDivisi('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusDivisi('+row.id+')"><i class="icon-trash"></i></button></div>';
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

        function getDivisi(id) {
            $("button.edit-button[data-id='"+id+"']").prop('disabled', true);
            $.ajax({
                url:"{{route('intern.divisi_single_data')}}/"+id,
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
                        $("#edit-email").val(data.email_direktur);
                        $("#edit-direktur").val(data.direktur);
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
            var email_direktur = $("#edit-email").val().trim();
            var direktur = $("#edit-direktur").val().trim();
            var id = $(this).data('id');
            $.ajax({
                url:"{{route('intern.divisi')}}/"+id,
                method:"POST",
                data:{kode:kode,nama:nama,email_direktur:email_direktur,direktur:direktur,_token:csrf,_method:"patch"},
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

        function hapusDivisi(id) {
            $("button.delete-button[data-id='"+id+"']").prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Divisi ini ?");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.divisi')}}/"+id,
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