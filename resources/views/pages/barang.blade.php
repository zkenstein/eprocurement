@extends('master')

@section('style')
	<style type="text/css">
		#barang-data{
			width: 100% !important;
		}
        .remove-image-button{
            opacity: 0;
            transition: 0.25s;
            margin-top: -67px;
            margin-left: 1px;
            width: calc(100% - 1.8px);
            cursor: pointer;
            background-color: rgba(0,0,0,0.5);
            color: white;
            height: 40px;
        }
        .img-bundle{
            cursor: pointer;
            margin-bottom: -22px;
        }
        .img-bundle:hover > .remove-image-button{
            opacity: 1;
        }
        .img-thumbnail{
            cursor: pointer;
        }
	</style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('intern.beranda')}}">Admin</a>
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
                                <input type="hidden" name="_token" value="{{csrf_token()}}" id="add-token">
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
                                            <label class="form-form-control-label">Satuan</label>
                                            <input id="add-satuan" style="height: 42px;" type="text" required name="satuan" class="form-control will-clear needvalidate" data-rule="required|alpha_num" placeholder="Satuan Barang">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Gambar</label>
                                            <input id="add-gambar" type="file" name="gambar" class="form-control input-sm will-clear needvalidate_file file-input" data-rule="max:2000" placeholder="Gambar Barang" accept="image/*">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">PDF</label>
                                            <input id="add-pdf" type="file" name="pdf" class="form-control input-sm will-clear needvalidate_file file-input" data-rule="max:2000" placeholder="Pdf Barang" accept="application/pdf">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Deskripsi</label>
                                            <textarea id="add-deskripsi" required name="deskripsi" class="form-control will-clear needvalidate" data-rule="required|unique:barang,deskripsi" placeholder="Deskripsi Barang" rows="3"></textarea>
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
                                        <th>Satuan</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 100px;">Gambar</th>
                                        <th style="width:5%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Satuan</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 100px;">Gambar</th>
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

    <form class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-id="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Gambar</label>
                                <div class="img-bundle">
                                    <img src="" style="width:100%;;border:1px solid #b7b6b6;" id="edit-gambar-view">
                                    <button id="button-hapus-gambar" data-visibleable="" data-id="" type="button" class="btn btn-sm remove-image-button">Hapus Gambar</button>
                                </div>
                                <input id="edit-gambar" type="file" name="gambar" placeholder="Gambar Barang" accept="image/*">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">PDF</label>
                                <iframe src="" style="width: 100%;height: 300px;" id="view-pdf-edit"></iframe>
                                <button id="button-hapus-pdf" data-visibleable="" data-id="" type="button" class="btn btn-sm btn-danger remove-pdf-button">Hapus PDF</button>
                                <input id="edit-pdf" type="file" name="pdf" class="form-control input-sm will-clear needvalidate_file file-input" data-rule="max:2000" placeholder="Pdf Barang" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Kode</label>
                                <input id="edit-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Kode Barang">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Satuan</label>
                                <input id="edit-satuan" type="text" required name="satuan" class="form-control input-sm will-clear needvalidate" data-rule="" placeholder="Satuan">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Deskripsi</label>
                                <textarea rows="5" id="edit-deskripsi" required name="deskripsi" class="form-control will-clear needvalidate" data-rule="" placeholder="Deskripsi Barang"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" id="edit-token" value="{{csrf_token()}}">
                    <input type="hidden" name="_method" value="patch">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save-edit-button">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 padding-side">
                            <img src="" id="preview-gambar-barang" width="100%">
                            <iframe src="" style="width: 100%;height: 500px;" id="preview-pdf-barang"></iframe>
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
        var table = $("#barang-data").DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('intern.barang_data')}}",
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
                        var satuan = row.satuan;
                        return satuan;
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        var deskripsi = row.deskripsi;
                        return deskripsi;
                    }
                },
                {
                    "orderable":false,
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        var show = "<img class='img-thumbnail' onclick='previewImage(\""+row.gambar+"\")' src='/img/barang/"+row.gambar+"' style='width:calc(100% - 9px);border:1px solid #b7b6b6;'/>";
                        if(row.pdf!=null){
                            show += "<br>"+"<button onclick='previewPdf(\""+row.pdf+"\")' style='width:calc(100% - 17px);' class='btn btn-sm btn-info btn-pdf'>PDF</button>";
                        }
                        return show;
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getBarang('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusBarang('+row.id+')"><i class="icon-trash"></i></button></div>';
                    }
                }
            ],
            "aaSorting": [ [0,'asc'] ]
        });

        $("#form-add").submit(function(e){
            $("#add-submit").prop('disabled', true);
            e.preventDefault();
            $(this).ajaxSubmit({
                type:"POST",
                success:function(res,status,xhr,$form){
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
                    $("input[name='_token']").val(res.token);
                    csrf = res.token;
                    table.ajax.reload();
                }
            })
        });

        $("#edit-modal").submit(function(e){
            modalForm = $(this);
            $("#save-edit-button").prop('disabled', true);
            e.preventDefault();
            $(this).ajaxSubmit({
                type:"POST",
                success:function(res,status,xhr,$form){
                    $("#save-edit-button").prop('disabled', false);
                    $("#edit-modal input:not([name='_token'], [name='_method'])").val('');
                    $("#edit-modal textarea").val('');
                    $("#edit-modal input.needvalidate").parent(".form-group").removeClass('has-success');
                    $("#edit-modal input.needvalidate").parent(".form-group").removeClass('has-danger');
                    $("#edit-modal input.needvalidate").removeClass('form-control-danger');
                    $("#edit-modal input.needvalidate").removeClass('form-control-success');
                    $("#edit-modal input.needvalidate").next().removeClass('text-danger');
                    $("#edit-modal input.needvalidate").next().text('');
                    $('#edit-modal .selectpicker').selectpicker('deselectAll');
                    $("input[name='_token']").val(res.token);
                    csrf = res.token;
                    table.ajax.reload();
                    modalForm.modal('hide');
                }
            })
        });

        function getBarang(id) {
            $("button.edit-button[data-id='"+id+"']").prop('disabled', true);
            $.ajax({
                url:"{{route('intern.barang_single_data')}}/"+id,
                method:"GET",
                success:function(res){
                    var data = res.data;
                    if(res.result===true){
                        $("#edit-modal").modal('show').on('hidden.bs.modal', function () {
                            $("#edit-modal input:not([name='_token'], [name='_method'])").val('');
                            $("#edit-modal textarea").val('');
                            $("#edit-modal .selectpicker").selectpicker('deselectAll');
                            $("#edit-modal img").attr('src','/img/barang/default.gif');
                            $("#edit-modal iframe").attr('src','');
                            $("#remove-image-button").data('id','');
                            $("#remove-image-button").data('visibleable','false');
                        });
                        $("#edit-kode").val(data.kode);
                        $("#edit-kode").data('rule','required|unique:barang,kode,'+data.id+',id|alpha_num');
                        $("#edit-satuan").val(data.satuan);
                        $("#edit-satuan").data('rule','required|alpha_num');
                        $("#edit-deskripsi").val(data.deskripsi);
                        $("#edit-deskripsi").data('rule','required|unique:barang,deskripsi,'+data.id+',id');
                        if(data.gambar!='default.gif'){
                            $("#button-hapus-gambar").data('id',data.id);
                        }
                        if(data.pdf!=null){
                            $("#view-pdf-edit").show();
                            $("#view-pdf-edit").attr('src','/img/barang/'+data.pdf);
                            $("#button-hapus-pdf").data('id',data.id);
                            $("#button-hapus-pdf").prop('disabled', false);
                        }else{
                            $("#button-hapus-pdf").data('id',data.id);
                            $("#button-hapus-pdf").prop('disabled', true);
                        }
                        $("#edit-gambar-view").attr('src','/img/barang/'+data.gambar);
                        $("#remove-image-button").data('id',data.id);
                        $("button.edit-button[data-id='"+id+"']").prop('disabled', false);
                        $("form#edit-modal").attr('action',"{{route('intern.barang')}}/"+id);
                    }
                }
            })
        }

        function hapusBarang(id) {
            $("button.delete-button[data-id='"+id+"']").prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Barang ini ?\n Semua data yang berkaitan dengan barang ini akan terhapus");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.barang')}}/"+id,
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

        $(".remove-image-button").click(function(){
            var btn = $(this);
            var id = btn.data('id');
            btn.prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Gambar Barang ini ?\n Gambar akan diganti ke gambar default");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.remove_gambar_barang')}}/"+id,
                    method:"POST",
                    data:{_method:"delete",_token:csrf},
                    success:function (res) {
                        $("#edit-gambar-view").attr('src','/img/barang/default.gif');
                        btn.data('visibleable','false');
                        btn.prop('disabled', false);
                        table.ajax.reload();
                        csrf = res.token;
                    }
                });
            }else{
                btn.prop('disabled', false);
            }
        });

        $(".remove-pdf-button").click(function(){
            var btn = $(this);
            var id = btn.data('id');
            btn.prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus PDF Barang ini ?");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.remove_pdf_barang')}}/"+id,
                    method:"POST",
                    data:{_method:"delete",_token:csrf},
                    success:function (res) {
                        $("#view-pdf-edit").attr('src','');
                        btn.data('visibleable','false');
                        btn.prop('disabled', false);
                        table.ajax.reload();
                        csrf = res.token;
                    }
                });
            }else{
                btn.prop('disabled', false);
            }
        });

        function previewImage(src) {
            $("#preview-gambar-barang").show();
            $("#preview-gambar-barang").attr('src','/img/barang/'+src);
            $("#preview-pdf-barang").hide();
            $("#modal-preview").modal('show');
        }

        function previewPdf(src) {
            $("#preview-gambar-barang").hide();
            $("#preview-pdf-barang").show();
            $("#preview-pdf-barang").attr('src','/img/barang/'+src);
            $("#modal-preview").modal('show');
        }
	</script>
@stop