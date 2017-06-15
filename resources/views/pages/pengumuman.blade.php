@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/select2/css/select2.min.css">
    <style type="text/css">
        .mystyle-column > a{
            color: #2b609e !important;
        }
        .select2-selection.select2-selection--multiple{
            border-radius: 0;
            border-color: #d9d9d9 !important;
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
                                <?php /*
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Deskripsi</label>
                                            <input id="add-deskripsi" type="text" class="form-control input-sm will-clear" placeholder="Deskripsi Pengumuman" name="deskripsi">
                                        </div>
                                    </div>
                                </div>
                                */ ?>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <?php /*
                                            <label class="form-form-control-label">Kode</label>
                                            <input id="add-kode" type="text" required name="kode" class="form-control input-sm will-clear needvalidate" data-rule="required|unique:pengumuman,kode|alpha_num" placeholder="Kode Pengumuman">
                                            */ ?>
                                            <div class="form-group">
                                            <label class="form-form-control-label">Deskripsi</label>
                                            <input id="add-deskripsi" type="text" class="form-control input-sm will-clear" placeholder="Deskripsi Pengumuman" name="deskripsi">
                                        </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">PIC</label>
                                            @if(session('role')=='pic')
                                            <input type="text" name="pic" value="Anda" class="form-control" readonly placeholder="Anda">
                                            @else
                                            <select onchange="refreshCluster()" class="form-control input-sm" name="pic" id="add-pic">
                                                @foreach($list_pic as $pic)
                                                <option data-jenis="{{$pic->cluster}}" value="{{$pic->id}}">{{$pic->nama}}</option>
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
                                            <label class="form-form-control-label">HPS</label>
                                            <input id="add-hps" type="text" class="form-control input-sm will-clear maskmoney" placeholder="HPS" name="nilai_hps">
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
                                                <select title="Pilih Barang" data-selected-text-format="count > 1" id="add-barang" class="form-control will-clear selectpicker select2" multiple name="barang[]">
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
                                        <div class="row">
                                            <div class="form-group col-sm-6 padding-side">
                                                <label class="form-form-control-label">Cluster</label> <small style="color: red;" id="keterangan_cluster"></small>
                                                <select required placeholder="Pilih Cluster" data-selected-text-format="count > 2" id="add-cluster" class="form-control will-clear select2" multiple name="cluster[]">
                                                    @if($list_pic[0]->cluster==1)
                                                        @if(isset($list_cluster['barang']))
                                                            @foreach($list_cluster['barang'] as $cluster)
                                                            <option value="{{$cluster->id}}">{{$cluster->kode.' -   '.$cluster->nama}}</option>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        @if(isset($list_cluster['jasa']))
                                                            @foreach($list_cluster['jasa'] as $cluster)
                                                            <option value="{{$cluster->id}}">{{$cluster->kode.' -   '.$cluster->nama}}</option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6 padding-side">
                                                <label class="form-form-control-label">Jenis Auction</label>
                                                <select required id="add-jenis" class="form-control will-clear" name="jenis">
                                                    <option value="group">Group</option>
                                                    <option value="itemize">Itemize</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 padding-side">
                                        <div class="form-group">
                                            <label class="form-form-control-label">Syarat dan Ketentuan</label>
                                            <textarea id="add-syarat_dan_ketentuan" required name="syarat_dan_ketentuan" class="form-control will-clear"  placeholder="Syarat dan Ketentuan" rows="3"></textarea>
                                            <!--
                                            <textarea rows="9" class="form-control input-sm will-clear" placeholder="Syarat dan Ketentuan" name="syarat_dan_ketentuan" id="add-syarat_dan_ketentuan"></textarea>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 padding-side">
                                        <div class="checkbox">
                                            <label for="checkbox3">
                                                <input type="checkbox" name="cc_kadep" value="1"> Kirim email ke Kadep
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-8 padding-side">
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
                                        <?php /*
                                        <th>Harga Netto</th>
                                        */ ?>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="min-width:165px;">Kode / PIC</th>
                                        <th style="min-width:165px;">Waktu</th>
                                        <th>Max Pendaftar</th>
                                        <?php /*
                                        <th>Harga Netto</th>
                                        */ ?>
                                        <th>Cluster</th>
                                        <th>Barang</th>
                                    </tr>
                                </tfoot> 
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
    {{--<script type="text/javascript" src="/js/bootstrap-typeahead.min.js"></script>--}}
    <script src="/select2/js/select2.min.js"></script>
	<script type="text/javascript">
        var resetNow = false;
        var pic_jenis = $("option:selected", this).data('jenis');
        function refreshCluster() {
            var data = $("#add-pic").find(":selected").data('jenis');

        }
        var cluster_barang = null, cluster_jasa = null;
        @if(isset($list_cluster['barang']))
        cluster_barang = [
            @foreach($list_cluster['barang'] as $cluster)
                {id:{{$cluster->id}} , text:"{{$cluster->kode.' - '.$cluster->nama}}"},
            @endforeach
        ];
        @endif
        @if(isset($list_cluster['jasa']))
        cluster_jasa = [
            @foreach($list_cluster['jasa'] as $cluster)
                {id:{{$cluster->id}} , text:"{{$cluster->kode.' - '.$cluster->nama}}"},
            @endforeach
        ];
        @endif

        $(document).ready(function(){
            initSelect2();
            $("#form-add input:not([name='_token'], [name='_method'])").val('');
            $("#add-pic").change(function(){
                var s = $(this);
                pic_jenis = $("option:selected", this).data('jenis');
                $("#add-cluster").children().remove();
                if(pic_jenis==1){
                    if(cluster_barang!=null){
                        $.each(cluster_barang,function(key,obj){
                            $("#add-cluster").append("<option value='"+obj.id+"'>"+obj.text+"</option>");
                        });
                    }
                }else{
                    if(cluster_jasa!=null){
                        $.each(cluster_jasa,function(key,obj){
                            $("#add-cluster").append("<option value='"+obj.id+"'>"+obj.text+"</option>");
                        });
                    }
                }
                $("#add-cluster").select2().trigger("change");
                initSelect2();
            });
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
            timePickerIncrement: 10,
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
                        var res = "<strong>Kode Pengumuman : </strong><a>"+row.kode+"</a><br><strong>Deskripsi </strong>: "+row.deskripsi+" <br><br>Kode PIC : <a>"+row.pic_info.kode+"</a><br>Nama PIC : "+row.pic_info.nama+"<br><br>Jenis Auction : <strong>"+row.jenis+"</strong>";
                        return res;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        return "<strong>Batas waktu penawaran</strong> :<br><small>"+moment(row.batas_awal_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+" - <br>"+moment(row.batas_akhir_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small><br><strong>Waktu Auction</strong> :<br><small>"+moment(row.start_auction,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"<br><strong>Validitas Harga</strong> :<br><small>"+moment(row.validitas_harga,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small><br><strong>Waktu pengriman</strong> :<br><small>"+moment(row.waktu_pengiriman,"YYYY-MM-DD HH:mm:ss").format('LLLL')+"</small>";
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
                <?php /*
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return toCurrency(row.harga_netto)+" ("+row.mata_uang+")";
                    }
                },
                */ ?>
                {
                    "className":"mystyle-column",
                    "orderable":false,
                    "targets": 3,
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
                    "targets": 4,
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
                                    if(res.result==true){
                                        $("#form-add input:not([name='_token'], [name='_method'])").val('');
                                        $("#form-add textarea").val('');
                                        $("#form-add input.needvalidate").parent(".form-group").removeClass('has-success');
                                        $("#form-add input.needvalidate").parent(".form-group").removeClass('has-danger');
                                        $("#form-add input.needvalidate").removeClass('form-control-danger');
                                        $("#form-add input.needvalidate").removeClass('form-control-success');
                                        $("#form-add input.needvalidate").next().removeClass('text-danger');
                                        $("#form-add input.needvalidate").next().text('');
                                        // $('#form-add .selectpicker').selectpicker('deselectAll');
                                        $("input[name='_token']").val(res.token);
                                        csrf = res.token;
                                        location.reload();
                                    }else{
                                        alert(res.message);
                                    }
                                }
                            });
                        }
                    }).modal('show');
                }else{
                    myForm.ajaxSubmit({
                        type:"POST",
                        success:function(res,status,xhr,$form){
                            $("#add-submit").prop('disabled', false);
                            if(res.result==true){
                                $("#form-add input:not([name='_token'], [name='_method'])").val('');
                                $("#form-add textarea").val('');
                                $("#form-add input.needvalidate").parent(".form-group").removeClass('has-success');
                                $("#form-add input.needvalidate").parent(".form-group").removeClass('has-danger');
                                $("#form-add input.needvalidate").removeClass('form-control-danger');
                                $("#form-add input.needvalidate").removeClass('form-control-success');
                                $("#form-add input.needvalidate").next().removeClass('text-danger');
                                $("#form-add input.needvalidate").next().text('');
                                // $('#form-add .selectpicker').selectpicker('deselectAll');
                                $("input[name='_token']").val(res.token);
                                csrf = res.token;
                                location.reload();
                            }else{
                                alert(res.message);
                            }
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
        function initSelect2() {
            $("#keterangan_cluster").text("");
            $(".select2").select2({
                placeholder: 'Pilih',
                allowClear: true,
                templateSelection:function(data,container){
                    console.log(data);
                    var text = data.text.split(" - ");
                    return text[0];
                }
            }).on('select2:closing', function (evt) {
                var data = $(this).val();
                $.ajax({
                    url:"{{route('intern.count_user_cluster')}}",
                    method:"POST",
                    data:{data:data},
                    success:function(res){
                        $("#keterangan_cluster").text("Terpilih "+res+" Subkon/vendor");
                    }
                });
            });
        }

    </script>
@stop


