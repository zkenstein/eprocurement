@extends('master')

@section('style')
<link rel="stylesheet" type="text/css" href="/jquery-countdown/jquery.countdown.css">
<link rel="stylesheet" type="text/css" href="/bxslider/jquery.bxslider.min.css">
<style type="text/css">
    .bx-wrapper{
        margin-bottom: 10px;
        padding: 0px;
        box-shadow: 0px 0px white;
        margin-top: -15px;
    }
</style>
<style type="text/css">
    #barang-data{
        width: 100% !important;
    }
    .danger-input,.danger-input:focus{
        border: 1px solid red;
    }
</style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
        </li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Informasi Tender
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <ul class="bxslider">
                                    <li><img src="/img/4.png" width="100%" /></li>
                                    <li><img src="/img/7.png" width="100%" /></li>
                                    <li><img src="/img/8.png" width="100%" /></li>
                                </ul>
                                <div class="col-sm-12 padding-side">
                                	<div class="row">
                                		<div class="col-sm-6 col-md-3 padding-side">
                                			Kode
                                		</div>
                                		<div class="col-sm-6 col-md-6 padding-side">
                                			: <strong>{{$pengumuman->kode}}</strong>
                                		</div>
                                	</div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 padding-side">
                                            PIC
                                        </div>
                                        <div class="col-sm-6 col-md-6 padding-side">
                                            : <strong>{{$pengumuman->picInfo->kode.' - '.$pengumuman->picInfo->nama}}</strong>
                                        </div>
                                    </div>
                                	<div class="row">
                                 		<div class="col-sm-6 col-md-3 padding-side">
                                			Auction
                                		</div>
                                		<div class="col-sm-6 col-md-6 padding-side">
                                			: <strong>{{\Carbon\Carbon::parse($pengumuman->start_auction)->format('l d F Y h:i:s')}}</strong> selama <a href="#">{{$pengumuman->durasi}} Menit</a>
                                		</div>
                                	</div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 padding-side">
                                            Nilai HPS
                                        </div>
                                        <div class="col-sm-6 col-md-6 padding-side">
                                            :
                                            @if($pengumuman->nilai_hps>0)
                                            <span>{{number_format($pengumuman->nilai_hps,0,",",".").' ('.$pengumuman->mata_uang.')'}}</span>
                                            @else
                                            -
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    @if($allow_auction==false)
                                    <button id="auction-button" class="btn btn-primary btn-lg btn-block disabled">Auction Belum Dimulai</button>
                                    @else
                                        @if($isIWin)
                                        <div class="card card-inverse card-success">
                                            <div class="card-header">
                                                Pengumuman Pemenang Tender
                                            </div>
                                            <div class="card-block">
                                                Selamat!! Anda memenangkan tender ini. Silahkan klik link berikut untuk mengunduh kontrak. <a style="font-weight: bold;" download href="{{'/'.'download_kontrak/'.$pengumuman->id.'/1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0'}}">Download Kontrak</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="card card-inverse card-danger">
                                            <div class="card-header">
                                                Pengumuman Tender
                                            </div>
                                            <div class="card-block">
                                                Maaf anda belum memenangkan tender ini. Anda dapat mencoba pada penawaran berikutnya
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(strtotime($pengumuman->validitas_harga)>strtotime("now"))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Form Pengajuan
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12 padding-side">
                                    <div class="row">
                                        <div class="col-sm-12 padding-side">
                                            <form method="post" action="" id="form-auction">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}" class="csrf_input">
                                                @if($pengumuman->jenis=="itemize")
                                                <table id="barang-data" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="100">Kode</th>
                                                            <th>Deskripsi</th>
                                                            <th>Satuan</th>
                                                            <th>Jumlah</th>
                                                            <th width="250">Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($list_barang as $barang)
                                                    <tr>
                                                        <td>{{$barang->barangInfo->kode}}</td>
                                                        <td>{{$barang->barangInfo->deskripsi}}</td>
                                                        <td>{{$barang->barangInfo->satuan}}</td>
                                                        <td>{{$barang->quantity}}</td>
                                                        <td>
                                                            <input id="input_harga_barang{{$barang->id}}" required name="harga_barang[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                                            @if($barang->inUserAuction!=null)
                                                            value = "{{$barang->inUserAuction->harga}}"
                                                            @endif
                                                            >
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @foreach($list_barang_eksternal as $barang)
                                                    <tr>
                                                        <td>{{$barang->kode}}</td>
                                                        <td>{{$barang->deskripsi}}</td>
                                                        <td>{{$barang->satuan}}</td>
                                                        <td>{{$barang->quantity}}</td>
                                                        <td>
                                                            <input id="input_harga_barang_eksternal{{$barang->id}}" required name="harga_barang_eksternal[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                                            @if($barang->inUserAuction!=null)
                                                            value = "{{$barang->inUserAuction->harga}}"
                                                            @endif
                                                            >
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="4">
                                                            <strong>Total</strong>
                                                        </td>
                                                        <td>
                                                            <input type="text" disabled class="form-control maskmoneywithoutrp" id="total_harga_input">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td>
                                                            <button type="submit" id="btn-simpan" class="btn btn-primary btn-block">Submit</button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="form-group">
                                                    <label class="form-form-control-label">Total Penawaran</label>
                                                    <input id="add-penawaran" type="text" class="form-control input-sm maskmoneywithoutrp" placeholder="Masukkan total penawaran" name="total_harga_input"
                                                    @if(isset($total_auction))
                                                    value = "{{$total_auction}}"
                                                    @endif
                                                    >
                                                </div>
                                                <button type="submit" id="btn-simpan" class="btn btn-primary btn-block">Submit</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript" src="/jquery-countdown/jquery.plugin.min.js"></script>
<script type="text/javascript" src="/jquery-countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript">
$(".maskmoneywithoutrp").maskMoney('mask');
$('.bxslider').bxSlider({
    controls:false,
    auto:true,
    speed:300,
    pager:false
});
@if($pengumuman->jenis=="itemize")
var total = 0;
$(document).ready(function(){
    $("#total_harga_input").maskMoney('mask', {{$total_auction}});
    $(".input-auction-barang").keyup();
    if(total<{{$pengumuman->nilai_hps}}){
        $("#btn-simpan").addClass('disabled');
    }else{
        $("#btn-simpan").removeClass('disabled');
    }
});
$("#form-auction").submit(function(e){
    e.preventDefault();
    if(total>{{$pengumuman->nilai_hps}} && {{$pengumuman->nilai_hps}}>0){
        alert("Jumlah total lebih dari HPS");
    }else{
        $("input").removeClass('danger-input');
        $("#btn-simpan").addClass('disabled');
        $("#btn-simpan").text('Mengirim');
        var theForm = $(this);
        $(theForm).ajaxSubmit({
            url:"{{route('pengajuan')}}",
            type:"POST",
            success:function(res){
                $("#btn-simpan").removeClass("disabled");
                $("#btn-simpan").text("Submit");
                if(res.indication!=undefined){
                    $("#input_"+res.indication).addClass('danger-input');
                    $("#input_"+res.indication).focus();
                    alert(res.message);
                    if(res.value!=undefined){
                        $("#input_"+res.indication).val(res.value);
                        $("#input_"+res.indication).maskMoney('mask');
                    }
                }
            }
        });
    } 
});

$(".input-auction-barang").keyup(function(){
    total = 0;
    $.each($(".input-auction-barang"),function(key,object){
        var val = $(object).val();
        if(val!=null && val!="" && val!="0")
            total+=parseInt(val.replace(/[^\w\s]/gi, ''));
    });
    $("#total_harga_input").maskMoney('mask', total);
    if(total<{{$pengumuman->nilai_hps}}){
        $("#btn-simpan").addClass('disabled');
    }else{
        $("#btn-simpan").removeClass('disabled');
    }
});
@else
    $("#form-auction").submit(function(e){
        e.preventDefault();
        var theForm = $(this);
        $("#btn-simpan").addClass('disabled');
        $(theForm).ajaxSubmit({
            url:"{{route('pengajuan')}}",
            type:"POST",
            success:function(res){
                console.log(res);
                $("#btn-simpan").removeClass("disabled");
                $("#btn-simpan").text("Submit");
                if(res.result===false){
                    alert(res.message);
                    $("#add-penawaran").val(res.total);
                    $(".maskmoneywithoutrp").maskMoney('mask');
                }
            }
        });
    });
@endif

@if($allow_auction==false)
$('#auction-button').countdown({until: +{{$countdown}}, format: 'yowdHMS', onExpiry: goToAuction});
function goToAuction(){
    location.reload();
}
@endif
</script>
@stop