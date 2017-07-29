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
    table{
        border-collapse: collapse;
    }
    table tr td,th{
        padding: 10px;
        border: 1px solid white;
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
                                        @if($pengumuman->jenis=='group')
                                            @if($isIWin)
                                            <div class="card card-inverse card-success">
                                                <div class="card-header">
                                                    Pengumuman Pemenang Tender
                                                </div>
                                                <div class="card-block">
                                                    Selamat!! Anda memenangkan tender ini. Silahkan menghubungi PT.PAL Indonesia untuk menindak lanjuti.
                                                    <?php /*
                                                    klik link berikut untuk mengunduh kontrak. <a style="font-weight: bold;" download href="{{'/'.'download_kontrak/'.$pengumuman->id.'/1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0'}}">Download Kontrak</a>
                                                    */ ?>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card-inverse card-danger">
                                                <div class="card-header">
                                                    Pengumuman Tender
                                                </div>
                                                <div class="card-block">
                                                    Maaf anda belum memenangkan tender ini. Anda dapat mencoba pada penawaran berikutnya<br>
                                                    Tender ini dimenangkan oleh Subkon/Vendor dengan nilai penawaran 
                                                    @if(isset($harga_yang_menang))
                                                    {{number_format($harga_yang_menang,0,",",".")}}
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        @else
                                            @if($isIWin)
                                            <div class="card card-inverse card-success">
                                                <div class="card-header">
                                                    Pengumuman Pemenang Tender
                                                </div>
                                                <div class="card-block">
                                                    Selamat!! Anda memenangkan tender ini. Silahkan cek email anda untuk melihat detail pengumuman pemenang
                                                    <br>
                                                    Detail Item yang anda menangkan pada tender ini :
                                                    <br>
                                                    <table>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                        @if(is_null($pengumuman->file_excel) || $pengumuman->file_excel=='')
                                                            @foreach($list_barang_menang as $barangMenang)
                                                            <tr>
                                                                <td>{{$barangMenang->pengumumanBarangInfo->barangInfo->kode}} ({{$barangMenang->pengumumanBarangInfo->quantity}} {{$barangMenang->pengumumanBarangInfo->barangInfo->satuan}})</td>
                                                                <td>
                                                                    {{number_format($barangMenang->harga,0,",",".")}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            @foreach($list_barang_menang as $barangMenang)
                                                            <tr>
                                                                <td>{{$barangMenang->barangEksternalInfo->kode}} ({{$barangMenang->barangEksternalInfo->quantity}} {{$barangMenang->barangEksternalInfo->satuan}})</td>
                                                                <td>
                                                                    {{number_format($barangMenang->harga,0,",",".")}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </table>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(strtotime($pengumuman->validitas_harga)>strtotime("now"))<?php /* JIKA MASIH BISA MEMASUKKAN PENAWARAN */ ?>
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
                                                                <th width="100">Jumlah</th>
                                                                <th width="200">Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($list_barang as $barangInPengumuman)
                                                        <tr>
                                                            <td>{{$barangInPengumuman->barangInfo->kode}}</td>
                                                            <td>{{$barangInPengumuman->barangInfo->deskripsi}}</td>
                                                            <td>{{$barangInPengumuman->quantity}} {{$barangInPengumuman->barangInfo->satuan}}</td>
                                                            <td>
                                                                <input id="input_harga_barang{{$barangInPengumuman->id}}" required name="harga_barang[{{$barangInPengumuman->id}}]" data-id="{{$barangInPengumuman->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                                                @if($barangInPengumuman->inUserAuction!=null)
                                                                value = "{{$barangInPengumuman->inUserAuction->harga}}"
                                                                @endif
                                                                >
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @foreach($list_barang_eksternal as $barang)
                                                        <tr>
                                                            <td>{{$barang->kode}}</td>
                                                            <td>{{$barang->deskripsi}}</td>
                                                            <td>{{$barang->quantity}} {{$barang->satuan}}</td>
                                                            <td>
                                                                <input id="input_harga_barang_eksternal{{$barang->id}}" required name="harga_barang_eksternal[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                                                @if($barang->inUserAuction!=null)
                                                                value = "{{$barang->inUserAuction->harga}}"
                                                                @endif
                                                                >
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <?php /*
                                                        <tr>
                                                            <td colspan="3">
                                                                <strong>Total</strong>
                                                            </td>
                                                            <td>
                                                                <input type="text" disabled class="form-control maskmoneywithoutrp" id="total_harga_input">
                                                            </td>
                                                        </tr>
                                                        */ ?>
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td>
                                                                <button type="submit" id="btn-simpan" class="btn btn-primary btn-block">Submit</button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    @else
                                                    <div id="form-group-total" class="form-group <?php if($total_auction>0) { ?>has-success <?php } ?>">
                                                        <label class="form-form-control-label">Total Penawaran</label>
                                                        <input id="add-penawaran" type="text" class="form-control input-sm maskmoneywithoutrp <?php if($total_auction>0) { ?>form-control-success<?php } ?>" placeholder="Masukkan total penawaran" name="total_harga_input"
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

            @if(isset($waiting_for_extends))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12 padding-side">
                                        <p>Mohon maaf, jumlah pendaftar untuk pengumuman lelang ini belum memenuhi target. Kami akan melakukan extends waktu untuk pengumuman ini hingga dapat memenuhi target peserta</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="modal-response" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <p>Penawaran anda berhasil disimpan</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
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
    /*
    if(total<{{$pengumuman->nilai_hps}}){
        $("#btn-simpan").addClass('disabled');
    }else{
        $("#btn-simpan").removeClass('disabled');
    }
    */
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
                if(res.result==false){
                    alert(res.message);
                } else{
                    $("#modal-response").modal('show');
                    @if($pengumuman->jenis=='group')
                    $("#form-group-total").addClass('has-success');
                    $("#add-penawaran").addClass('form-control-success');
                    @endif
                }
                $("#btn-simpan").removeClass("disabled");
                $("#btn-simpan").text("Submit");

                if(res.indication!=undefined){
                    $("#input_"+res.indication).addClass('danger-input');
                    $("#input_"+res.indication).focus();
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
    /*
    if(total<{{$pengumuman->nilai_hps}}){
        $("#btn-simpan").addClass('disabled');
    }else{
        $("#btn-simpan").removeClass('disabled');
    }
    */
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
                $("#btn-simpan").removeClass("disabled");
                $("#btn-simpan").text("Submit");
                if(res.result===false){
                    alert(res.message);
                    $("#add-penawaran").val(res.total);
                    $(".maskmoneywithoutrp").maskMoney('mask');
                }else{
                    $("#modal-response").modal('show');
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