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
        <li class="breadcrumb-item"><a href="{{route('intern.beranda')}}">Admin</a>
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
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,kode|alpha_num" placeholder="Kode Sub Kontraktor">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                            <label class="form-form-control-label">Telp</label>
                                            <input id="add-telp" type="text" required name="telp" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:user,telp|min:11|numeric" placeholder="Telp Sub Kontraktor">
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
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Cluster</th>
                                        <th style="width:5%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Cluster</th>
                                        <th style="width:5%;"></th>
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
                    <h4 class="modal-title">Edit Data Subkontraktor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Kode</label>
                                <input id="edit-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Kode Sub Kontraktor">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Nama</label>
                                <input id="edit-nama" type="text" required name="nama" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Nama Sub Kontraktor">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Email</label>
                                <input id="edit-email" type="email" required name="email" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Email Sub Kontraktor">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label" for="inputSuccess1">Telp</label>
                                <input id="edit-telp" type="text" required name="telp" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Telp Sub Kontraktor">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Cluster</label>
                                <select required title="Pilih Cluster" data-selected-text-format="count > 2" id="edit-cluster" class="form-control will-clear selectpicker" multiple name="cluster">
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
                                <textarea id="edit-bidang-usaha" class="form-control will-clear" rows="2" required name="bidang_usaha"></textarea>
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
		var table = $("#subkontraktor-data").DataTable({
            "autoWidth": false,
			"processing": true,
	        "serverSide": true,
	        "ajax": "{{route('intern.subkontraktor_data',['jenis'=>$jenis])}}",
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
                        var email = row.email;
                        return email;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return row.telp;
                    }
                },
                {
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        var d = "";
                        if(row.list_cluster.length>0){
                            $.each(row.list_cluster,function (key,val) {
                                d+=val.cluster_info.nama + "<br>";
                            })    
                        }
                        return d;
                    }
                },
                {
                	"className":"no-print",
                    "orderable":false,
                	"targets": 5,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getSubkontraktor('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusSubkontraktor('+row.id+')"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
            "aaSorting": [ [1,'desc'] ]
        });
        
        $("#form-add").submit(function(e){
            $("#add-submit").prop('disabled', true);
            e.preventDefault();
            var kode = $("#add-kode").val().trim();
            var nama = $("#add-nama").val().trim();
            var email = $("#add-email").val().trim();
            var telp = $("#add-telp").val().trim();
            var cluster = $("#add-cluster").val();
            var bidang_usaha = $("#add-bidang-usaha").val().trim();
            $.ajax({
                url:"",
                method:"POST",
                data:{kode:kode,nama:nama,email:email,telp:telp,bidang_usaha:bidang_usaha,role:2,cluster:cluster,_token:csrf},
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

        function hapusSubkontraktor(id) {
            $("button.delete-button[data-id='"+id+"']").prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Subkontraktor ini ?");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.subkontraktor')}}/"+id,
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

        function getSubkontraktor(id) {
            $("button.edit-button[data-id='"+id+"']").prop('disabled', true);
            var listCluster = [];
            $.ajax({
                url:"{{route('intern.subkontraktor_single_data')}}/"+id,
                method:"GET",
                success:function(res){
                    var data = res.data;
                    if(res.result===true){
                        $("#edit-modal").modal('show').on('hidden.bs.modal', function () {
                            $("#edit-modal input").val('');
                            $("#edit-modal textarea").val('');
                            $('#edit-modal .selectpicker').selectpicker('deselectAll');
                            listCluster = [];
                        });
                        $("#edit-kode").val(data.kode);
                        $("#edit-kode").data('rule','required|unique:user,kode,'+data.id+',id|alpha_num');
                        $("#edit-nama").val(data.nama);
                        $("#edit-nama").data('rule','required|unique:user,nama,'+data.id+',id');
                        $("#edit-email").val(data.email);
                        $("#edit-email").data('rule','required|unique:user,email,'+data.id+',id|email');
                        $("#edit-telp").val(data.telp);
                        $("#edit-telp").data('rule','required|unique:user,telp,'+data.id+',id'+'|min:11|numeric');
                        $.each(data.list_cluster,function(key,val){
                            listCluster[key] = val.cluster_id;
                        });
                        $("#edit-cluster").selectpicker('val', listCluster);
                        $("#edit-bidang-usaha").val(data.bidang_usaha);
                        $("button.edit-button[data-id='"+id+"']").prop('disabled', false);
                        $("form#edit-modal").data('id',data.id);
                    }
                }
            })
        }

        $("form#edit-modal").submit(function(e){
            $("#save-edit-button").prop('disabled', true);
            e.preventDefault();
            var kode = $("#edit-kode").val().trim();
            var nama = $("#edit-nama").val().trim();
            var email = $("#edit-email").val().trim();
            var telp = $("#edit-telp").val().trim();
            var cluster = $("#edit-cluster").val();
            var bidang_usaha = $("#edit-bidang-usaha").val().trim();
            var id = $(this).data('id');
            $.ajax({
                url:"{{route('intern.subkontraktor')}}/"+id,
                method:"POST",
                data:{kode:kode,nama:nama,email:email,telp:telp,bidang_usaha:bidang_usaha,role:2,cluster:cluster,_token:csrf,_method:"patch"},
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
        })
	</script>
@stop