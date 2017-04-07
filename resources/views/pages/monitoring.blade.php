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
                                        <th>Max Pendaftar</th>
                                        <th>Auction</th>
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
                                		<span style="color:red;">{{$pengumuman->count_register}} (maksimal)</span>
                                	@else
                                		<span style="color:green;">{{$pengumuman->count_register}}</span>
                                	@endif
                                	</td>
                                	<td>
                                	@if($pengumuman->max_register!=0)
                                	{{$pengumuman->max_register}}
                                	@else
                                	Tidak dibatasi
                                	@endif
                                	</td>
                                	<td>{{\Carbon\Carbon::parse($pengumuman->start_auction)->formatLocalized('%A %d %B %Y %H:%m').' - '.\Carbon\Carbon::parse($pengumuman->start_auction)->addMinutes($pengumuman->durasi)->formatLocalized('%H:%m').' ('.$pengumuman->durasi.' minutes)'}}</td>
                                	<td>
                                		<div class="btn-group">
                                			<button onclick="lihatDetailPengumuman({{$pengumuman->id}})" class="btn btn-primary btn-sm" type="button" title="lihat detail"><i class="icon-eye"></i></button>
                                			@if($pengumuman->count_register==0 && strtotime($pengumuman->batas_akhir_waktu_penawaran) <= strtotime(\Carbon\Carbon::now()))
                                				<button title="Extends" class="btn btn-danger btn-sm" disabled>Extends Waktu</button>
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
	                		Batas Waktu Penawaran : <strong id="detail-batas-waktu-penawaran"></strong><br>
	                		Validitas Harga : <strong id="detail-validitas-harga"></strong><br>
	                		Waktu Pengiriman : <strong id="detail-waktu-pengiriman"></strong><br>
	                		Harga Netto : <strong id="detail-harga-netto"></strong>
	                	</div>
	                </div><br>
	                <div class="row">
	                	<div class="col-md-12 col-sm-12 col-xs-12 padding-side">
	                		<strong>PIC</strong><br>
							Kode PIC : <strong id="detail-kode-pic"></strong><br>
	                		Nama PIC : <strong id="detail-nama-pic"></strong><br>
	                		Telp PIC : <strong id="detail-telp-pic"></strong><br>
	                		Email PIC : <strong id="detail-email-pic"></strong>	                		
	                	</div>
	                </div><br>
	                <div class="row">
	                	<div class="col-md-6 col-sm-12 col-xs-12 padding-side">
		                	<strong>Cluster</strong><br>
		                	<ul id="detail-list-cluster"></ul>
	                	</div>
	                	<div class="col-md-6 col-sm-12 col-xs-12 padding-side">
		                	<strong>Barang</strong><br>
		                	<ul id="detail-list-barang"></ul>
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

        function lihatDetailPengumuman (id) {
        	$.ajax({
        		url:"{{route('intern.detail_pengumuman')}}/"+id,
        		success:function(res){
        			if(res.result===true){
        				$("#detail-kode-pengumuman").text("Pengumuman kode "+res.data.kode);
	        			$("#detail-batas-waktu-penawaran").text(moment(res.data.batas_awal_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL')+" - "+moment(res.data.batas_akhir_waktu_penawaran,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-validitas-harga").text(moment(res.data.validitas_harga,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-waktu-pengiriman").text(moment(res.data.waktu_pengiriman,"YYYY-MM-DD HH:mm:ss").format('LLLL'));
	        			$("#detail-harga-netto").text(res.data.harga_netto+" ("+res.data.mata_uang+")");

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
    </script>
@stop