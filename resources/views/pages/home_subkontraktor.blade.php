@extends('master')

@section('style')
<link rel="stylesheet" type="text/css" href="/jquery-countdown/jquery.countdown.css">
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
                                    <?php /*
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 padding-side">
                                            Harga Netto
                                        </div>
                                        <div class="col-sm-6 col-md-6 padding-side">
                                            : <span>{{number_format($pengumuman->harga_netto,0,",",".").' ('.$pengumuman->mata_uang.')'}}</span>
                                        </div>
                                    </div>
                                    */ ?>
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
                                                Selamat!! Anda memenangkan tender ini. Silahkan klik link berikut untuk mengunduh kontrak. <a style="font-weight: bold;" download href="{{env('SERVER').'/'.
        'download_kontrak/'.$pengumuman->id.'/1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0'}}">Download Kontrak</a>
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
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript" src="/jquery-countdown/jquery.plugin.min.js"></script>
<script type="text/javascript" src="/jquery-countdown/jquery.countdown.min.js"></script>
<script type="text/javascript">
@if($allow_auction==false)
$('#auction-button').countdown({until: +{{$countdown}}, format: 'yowdHMS', onExpiry: goToAuction});
function goToAuction(){
    location.reload();
}
@endif
</script>
@stop