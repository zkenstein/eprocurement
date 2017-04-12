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
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:pengumuman,kode|alpha_num" placeholder="Kode Pengumuman">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">PIC</label>
                                            @if(session('role')=='pic')
                                            <input type="text" name="pic" value="Anda" class="form-control" readonly placeholder="Anda">
                                            @else
                                            <select class="form-control input-sm" name="pic">
                                                @foreach($list_pic as $pic)
                                                <option value="{{$pic->id}}">{{$pic->nama}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                            @endif
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
                                            <input id="add-harga-netto" type="text" required class="form-control input-sm will-clear maskmoney" data-rule="required|numeric|min:1" placeholder="Harga Netto" name="harga_netto">
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
                                        <div class="row">
                                            <div class="form-group col-sm-6 padding-side">
                                                <label class="form-form-control-label">Barang</label>
                                                <select title="Pilih Barang" data-selected-text-format="count > 1" id="add-barang" class="form-control will-clear selectpicker" multiple name="barang[]">
                                                    @foreach($list_barang as $barang)
                                                    <option value="{{$barang->id}}">{{$barang->kode}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6 padding-side">
                                                <label class="form-form-control-label">Import CSV</label>
                                                <input type="file" name="barang_csv" class="form-control input-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            </div>
                                        </div>
                                        	
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                    	<div class="form-group">
                                            <label class="form-form-control-label">Cluster</label>
                                            <select required title="Pilih Cluster" data-selected-text-format="count > 2" id="add-cluster" class="form-control will-clear selectpicker" multiple name="cluster[]">
                                                @foreach($list_cluster as $cluster)
                                                <option value="{{$cluster->id}}">{{$cluster->kode.' -   '.$cluster->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Waktu Auction</label>
                                            <input id="add-waktu-auction" type="text" required class="form-control input-sm will-clear singledate" placeholder="Waktu Auction" name="start_auction">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Durasi (Menit)</label>
                                            <input id="add-durasi" type="number" required class="form-control input-sm will-clear" placeholder="Durasi" name="durasi">
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
                                        <th style="min-width:165px;">Kode / PIC</th>
                                        <th style="min-width:165px;">Waktu</th>
                                        <th>Max Pendaftar</th>
                                        <th>Harga Netto</th>
                                        <th>Cluster</th>
                                        <th>Barang</th>
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

    <div class="modal fade" id="modal-quantity" tabindex="-1" role="dialog" aria-hidden="true" data-id="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Quantity Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="add-quantity-div">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" onclick="resetMyModal();" id="save-quantity-button">Atur Ulang</button>
                    <button type="button" class="btn btn-primary" onclick="realSubmit()" id="save-quantity-button">OK</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
	<script type="text/javascript">
        var resetNow = false;
        $(document).ready(function(){
            $("#form-add input:not([name='_token'], [name='_method'])").val('');
        });

        var barang = [];
        @foreach($list_barang as $barang)
        barang[{{$barang->id}}] = "{{$barang->kode}}";
        @endforeach

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
                format: 'YYYY-MM-DD HH:mm:ss',
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
            "ajax": "{{route('intern.pengumuman_data')}}",
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
                        var res = "<strong>Kode Pengumuman : </strong><a>"+row.kode+"</a><br><br>Kode PIC : <a>"+row.pic_info.kode+"</a><br>Nama PIC : "+row.pic_info.nama+"<br>Telp PIC : "+row.pic_info.telp+"<br>Email PIC: "+row.pic_info.email;
                        return res;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        return "<strong>Batas waktu penawaran</strong> :<br><small>"+moment(row.batas_awal_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+" - <br>"+moment(row.batas_akhir_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small><br><strong>Validitas Harga</strong> :<br><small>"+moment(row.validitas_harga,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small><br><strong>Waktu pengriman</strong> :<br><small>"+moment(row.waktu_pengiriman,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small>";
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        if(row.max_register==0){
                            return "Tidak dibatasi";
                        }else{
                            return row.max_register+" Pendaftar";
                        }
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return toCurrency(row.harga_netto)+" ("+row.mata_uang+")";
                    }
                },
                {
                    "className":"mystyle-column",
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        var show = "";
                        $.each(row.list_cluster,function(key,val){
                            if(key==row.list_cluster.length-1)
                                show+="<a>"+val.cluster_info.nama+"</a>";
                            else
                                show+="<a>"+val.cluster_info.nama+"</a>, ";
                        });
                        return show;
                    }
                },
                {
                    "orderable":false,
                    "targets": 5,
                    "render": function(data, type, row, meta){
                        var show = "";
                        $.each(row.list_barang,function(key,val){
                            if(key==row.list_barang.length-1)
                                show+="<a>"+val.barang_info.kode+"</a>";
                            else
                                show+="<a>"+val.barang_info.kode+"</a>, ";
                        });
                        if(row.file_excel!=null) show+="<br><a href='{{route('intern.get_file_excel')}}/"+row.file_excel+"' download class='btn btn-sm btn-primary'>Download Excel Barang</a>"
                        return show;
                    }
                }
                // ,
                // {
                //     "className":"no-print",
                //     "orderable":false,
                //     "targets": 6,
                //     "render": function(data, type, row, meta){
                //         return '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm edit-button" data-id="'+row.id+'" onclick="getPengumuman('+row.id+')"><i class="icon-pencil"></i></button><button type="button" class="btn btn-danger btn-sm delete-button" data-id="'+row.id+'" onclick="hapusPengumuman('+row.id+')"><i class="icon-trash"></i></button></div>';
                //     }
                // }
            ],
        });

        $("#form-add").submit(function(e){
            e.preventDefault();
            var _c = confirm("Anda yakin data yang telah diisikan benar ?\n Sistem akan mengirimkan email ke Subkontraktor dan Pengumuman tidak akan dapat dihapus setelah email terkirim");
            if(_c===true){
                $("#add-submit").prop('disabled', true);
                var myForm = $(this);
                if($("#add-barang").val().length>0){
                    $("#modal-quantity").modal({
                        backdrop: 'static',
                        keyboard: false
                    }).on('hidden.bs.modal', function () {
                        if(resetNow==false){
                            $("#add-quantity-div").css("display","none");
                            $("#add-quantity-div").appendTo("#form-add");
                            myForm.ajaxSubmit({
                                type:"POST",
                                success:function(res,status,xhr,$form){
                                    $("#add-submit").prop('disabled', false);
                                    $("#form-add input:not([name='_token'], [name='_method'])").val('');
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
                                    location.reload();
                                }
                            });
                        }
                    }).modal('show');
                }else{
                    myForm.ajaxSubmit({
                        type:"POST",
                        success:function(res,status,xhr,$form){
                            $("#add-submit").prop('disabled', false);
                            $("#form-add input:not([name='_token'], [name='_method'])").val('');
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
                            location.reload();
                        }
                    });
                }
            }
        });

        function hapusPengumuman(id) {
            $("button.delete-button[data-id='"+id+"']").prop('disabled', true);
            var _c = confirm("Anda yakin akan menghapus Pengumuman ini ?\n Semua data yang berkaitan dengan barang ini akan terhapus");
            if(_c===true){
                $.ajax({
                    url:"{{route('intern.pengumuman')}}/"+id,
                    method:"POST",
                    data:{_method:"delete",_token:csrf},
                    success:function (res) {
                        $("button.delete-button[data-id='"+id+"']").prop('disabled', false);
                        table.ajax.reload();
                        csrf = res.token;
                    },
                    statusCode: {
                        500: function() {
                            alert("Gagal melakukan pengumuman, periksa koneksi anda");
                            $("button.delete-button[data-id='"+id+"']").prop('disabled', false);
                        }
                    }
                });
            }else{
                $("button.delete-button[data-id='"+id+"']").prop('disabled', false);
            }
        }

        function modalQuantityShow() {
            $("#add-quantity-div").html('');
            $.each($('#add-barang').val(),function(key,val){
                $("#add-quantity-div").append('<div class="col-sm-12 col-md-12 padding-side"><div class="form-group">'+barang[val]+'<label class="form-form-control-label"></label><input type="number" name="quantity['+val+']" class="form-control"></div></div>');
            });
        }

        $('#add-barang').on('hidden.bs.select', function (e) {
            modalQuantityShow();
        });

        function resetMyModal() {
            resetNow = true;
            $(".modal").modal('hide');
            $("#add-quantity-div").children().remove();
            $("#add-submit").prop('disabled', false);
            modalQuantityShow();
        }

        function realSubmit() {
            resetNow = false;
            $('.modal').modal('hide')
        }
    </script>
@stop