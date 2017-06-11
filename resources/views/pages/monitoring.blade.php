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
        <li class="breadcrumb-item active">Monitoring</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
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
                                        <th style="min-width:165px;">Kode</th>
                                        <th style="min-width:165px;">Jumlah Pendaftar</th>
                                        <th>Selesai Penawaran</th>
                                        <th>Max Pendaftar</th>
                                        <th>Waktu</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($list_pengumuman as $pengumuman)
                                <tr>
                                	<td>
                                		<a>{{$pengumuman->kode}}</a>
                                	</td>
                                	<td>
                                	@if($pengumuman->count_register>=$pengumuman->max_register && $pengumuman->max_register!=0)
                                		<span style="color:green;">{{$pengumuman->count_register}} (maksimal)</span>
                                    @elseif($pengumuman->count_register==0)
                                        <strong style="color:red;">Belum ada pendaftar</strong>
                                	@elseif($pengumuman->count_register==1)
                                        <span style="color:red;">{{$pengumuman->count_register}} <?php if($pengumuman->picInfo->cluster==1){ ?>Vendor<?php }else{ ?> Subkontraktor <?php } ?></span>
                                    @else
                                		<span style="color:green;">{{$pengumuman->count_register}} <?php if($pengumuman->picInfo->cluster==1){ ?>Vendor<?php }else{ ?> Subkontraktor <?php } ?></span>
                                	@endif
                                	</td>
                                    <td>
                                        <a href="javascript:;" class="data-valid-user" data-value="{{$pengumuman->id}}" data-count="{{count($pengumuman->listValidUser)}}">{{count($pengumuman->listValidUser)}} <?php if($pengumuman->picInfo->cluster==1){ ?>Vendor<?php }else{ ?> Subkontraktor <?php } ?></a>
                                    </td>
                                	<td>
                                	@if($pengumuman->max_register!=0)
                                	{{$pengumuman->max_register}}
                                	@else
                                	Tidak dibatasi
                                	@endif
                                	</td>
                                	<td>
                                        <strong>Batas Waktu Pendaftaran</strong> : <br>{{\Carbon\Carbon::parse($pengumuman->batas_akhir_waktu_penawaran)->formatLocalized('%A %d %B %Y %H:%m')}}
                                        <br>
                                        <strong>Validitas Harga</strong> : <br>{{\Carbon\Carbon::parse($pengumuman->validitas_harga)->formatLocalized('%A %d %B %Y %H:%m')}}
                                        <br>
                                        <strong>Auction</strong> : <br>{{\Carbon\Carbon::parse($pengumuman->start_auction)->formatLocalized('%A %d %B %Y %H:%m').' - '.\Carbon\Carbon::parse($pengumuman->start_auction)->addMinutes($pengumuman->durasi)->formatLocalized('%H:%m').' ('.$pengumuman->durasi.' menit)'}}
                                    </td>
                                	<td>
                                		<div class="btn-group">
                                			<button onclick="lihatDetailPengumuman({{$pengumuman->id}})" class="btn btn-primary btn-sm" type="button" title="lihat detail"><i class="icon-eye"></i></button>
                                			@if(count($pengumuman->listValidUser)<2 && strtotime($pengumuman->validitas_harga) <= strtotime(\Carbon\Carbon::now()))
                                				<button data-id="{{$pengumuman->id}}" title="Extends" class="btn btn-danger btn-sm btn-extends" onclick="getDataPengumuman({{$pengumuman->id}})">Extends Waktu</button>
                                			@else
	                                			@if(strtotime($pengumuman->start_auction) >= strtotime(\Carbon\Carbon::now()))
	                                				<button title="Auction belum dimulai" class="btn btn-info btn-sm" disabled>Live Auction</button>
	                                			@else
	                                				<a class="btn btn-info btn-sm" href="{{route('intern.live_auction',['id'=>$pengumuman->id])}}">Live Auction</a>
	                                			@endif
	                                		@endif
                                		</div>
                                	</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-lg modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pengumuman</h4>
                </div>
                <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12 col-sm-12 col-xs-12 padding-side">
	                		<strong id="detail-kode-pengumuman"></strong><br>
	                		<table class="table table-bordered">
	                			<tr>
	                				<td width="30%;">Batas Waktu Penawaran</td>
	                				<td><span id="detail-batas-waktu-penawaran"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Validitas Harga</td>
	                				<td><span id="detail-validitas-harga"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Waktu Pengiriman</td>
	                				<td><span id="detail-waktu-pengiriman"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Nilai HPS</td>
	                				<td><span id="detail-nilai-hps"></span></td>
	                			</tr>
	                		</table>
	                	</div>
	                </div><br>
	                <div class="row">
	                	<div class="col-md-12 col-sm-12 col-xs-12 padding-side">
	                		<strong>PIC</strong><br>
	                		<table class="table table-bordered">
	                			<tr>
	                				<td width="30%;">Kode PIC</td>
	                				<td><span id="detail-kode-pic"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Nama PIC</td>
	                				<td><span id="detail-nama-pic"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Telp PIC</td>
	                				<td><span id="detail-telp-pic"></span></td>
	                			</tr>
	                			<tr>
	                				<td>Email PIC</td>
	                				<td><span id="detail-email-pic"></span></td>
	                			</tr>
	                		</table>                		
	                	</div>
	                </div><br>
	                <div class="row">
	                	<div class="col col-md-12 col-sm-12 padding-side">
	                		<table class="table table-bordered">
		                		<tr>
		                			<td width="30%;">
		                				<strong>Cluster</strong><br>
			                			<ul id="detail-list-cluster"></ul>
		                			</td>
		                			<td>
		                				<strong>Barang</strong><br>
			                			<ul id="detail-list-barang"></ul>
		                			</td>
		                		</tr>
		                	</table>
	                	</div>
	                </div>
	                <div class="row">
	                	<div class="col-md-12 padding-side">
	                		<a class="btn btn-block btn-primary" download href="" id="detail-download-excel">Download File Excel</a>
	                	</div>
	                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('.modal').modal('hide')" id="save-quantity-button">OK</button>
                </div>
            </div>
        </div>
    </div>

    <form class="modal fade" id="modal-extends" tabindex="-1" role="dialog" aria-hidden="true" method="post" action="{{route('intern.extends_pengumuman')}}">
        <div class="modal-dialog modal-lg modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Extends Pengumuman</h4>
                    <input type="hidden" name="id" id="extends-id">
                </div>
                <div class="modal-body">
                	{{csrf_field()}}
                    <div class="row">
                    	<div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Batas Waktu Penawaran</label>
                                <input id="extends-batas-waktu" type="text" required class="form-control input-sm will-clear daterange" placeholder="batas waktu penawaran" name="batas_waktu_penawaran">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Validitas Harga</label>
                                <input id="extends-validitas-harga" type="text" required class="form-control input-sm will-clear singledate" required placeholder="Validitas Harga" name="validitas_harga">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Waktu Pengiriman</label>
                                <input id="extends-waktu-pengiriman" type="text" required class="form-control input-sm will-clear singledate" placeholder="Waktu Pengiriman" name="waktu_pengiriman">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 padding-side">
                            <div class="form-group">
                                <label class="form-form-control-label">Waktu Auction</label>
                                <input id="extends-waktu-auction" type="text" required class="form-control input-sm will-clear singledate" placeholder="Waktu Auction" name="start_auction">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-extends">Extends</button>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal-valid-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-valid-user-modal"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 padding-side">
                            <ul id="list-valid-user-place"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript">
        var table = $("#pengumuman-data").DataTable({
        	"autoWidth": false,
            "language": {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Maaf data tidak ditemukan",
                "info": "_PAGE_ dari _PAGES_",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Cari "
            }
        });

        $("input.daterange").daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            timePicker24Hour:true,
            locale: {
                format: 'YYYY-MM-DD h:mm A',
                cancelLabel: 'Clear'
            },
            autoUpdateInput: true
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
            autoApply:true,
            autoUpdateInput: true
        });
        $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        });

        function lihatDetailPengumuman (id) {
        	$.ajax({
        		url:"{{route('intern.detail_pengumuman')}}/"+id,
        		success:function(res){
        			if(res.result===true){
        				$("#detail-kode-pengumuman").text("Pengumuman kode : "+res.data.kode);
	        			$("#detail-batas-waktu-penawaran").text(moment(res.data.batas_awal_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+" - "+moment(res.data.batas_akhir_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-validitas-harga").text(moment(res.data.validitas_harga,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-waktu-pengiriman").text(moment(res.data.waktu_pengiriman,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-nilai-hps").text(accounting.formatMoney(res.data.nilai_hps, "", 0, ".", ",")+''+" ("+res.data.mata_uang+")");

	        			$("#detail-kode-pic").text(res.data.pic_info.kode);
	        			$("#detail-nama-pic").text(res.data.pic_info.nama);
	        			$("#detail-telp-pic").text(res.data.pic_info.telp);
	        			$("#detail-email-pic").text(res.data.pic_info.email);

	        			$("#detail-list-cluster").children().remove();
	        			$.each(res.data.list_cluster,function(key,obj){
	        				$("#detail-list-cluster").append("<li>"+obj.cluster_info.nama+"</li>");
	        			});
	        			$("#detail-list-barang").children().remove();
	        			$.each(res.data.list_barang,function(key,obj){
	        				$("#detail-list-barang").append("<li>"+obj.barang_info.kode+"</li>");
	        			});
	        			if(res.data.file_excel!=null){
	        				$("#detail-download-excel").show();
	        				$("#detail-download-excel").attr("href","{{route('intern.get_file_excel')}}/"+res.data.file_excel);
	        			}else{
	        				$("#detail-download-excel").hide();
	        			}

	        			$("#modal-lihat").modal('show');
        			}else{
        				alert("data tidak ditemukan");
        			}
        		}
        	});
        }

        function getDataPengumuman (id) {
            $("input").val("");
            $.ajax({
                url:"{{route('intern.detail_pengumuman')}}/"+id,
                success:function(res){
                    $("#extends-waktu-pengiriman").val(res.data.waktu_pengiriman);
                    $("#extends-waktu-auction").val(res.data.start_auction);
                    $("#extends-validitas-harga").val(res.data.validitas_harga);
                    $("#extends-batas-waktu").val(res.data.batas_awal_waktu_penawaran+" - "+res.data.batas_akhir_waktu_penawaran);
                    $("#extends-waktu-pengiriman").val(res.data.waktu_pengiriman);
                    $("#extends-id").val(res.data.id);
                    $("#modal-extends").modal("show");

                    $("input.daterange").daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 15,
                        timePicker24Hour:true,
                        locale: {
                            format: 'YYYY-MM-DD h:mm',
                            cancelLabel: 'Clear'
                        },
                        autoUpdateInput: true
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
                        autoApply:true,
                        autoUpdateInput: true
                    });
                    $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
                    });
                }
            });
        }

        $(".data-valid-user").click(function(){
            if($(this).data('count')>0){
                var id = $(this).data('value');
                $("#list-valid-user-place").html('');
                $.ajax({
                    url:"{{route('intern.pengumuman_valid_user')}}/"+id,
                    success:function(res){
                        if(res.length>0){
                            $.each(res,function(key,obj){
                                $("#title-valid-user-modal").text('Vendor/Subkontraktor Yang Telah Melakukan Penawaran pada Pengumuman '+obj.pengumuman_info.kode);
                                $("#list-valid-user-place").append('<li><strong>'+obj.user_info.kode+'</strong> - '+obj.user_info.nama+'</li>');
                            });
                        }else{
                            $("#list-valid-user-place").append('Tidak Ada');
                        }
                        $("#modal-valid-user").modal('show');
                    }
                });
            }
        });

        $("#modal-extends").submit(function(e){
            e.preventDefault();
            $("button.btn-extends").prop('disabled', true);
            var _c = confirm("Anda yakin akan data yang diisikan telah benar ?");
            if(_c===true){
                var myForm = $(this);
                myForm.ajaxSubmit({
                    type:"POST",
                    success:function(res,status,xhr,$form){
                        $("button.btn-extends").prop('disabled', false);
                        alert("Email pemberitahuan extends akan dikirimkan ke vendor/subkontraktro");
                        if(res.result==true){
                            location.reload();
                        }else{
                            alert(res.message);
                        }
                    }
                });
            }else{
                $("#modal-extends").modal('hide');
            }
        });
    </script>
@stop