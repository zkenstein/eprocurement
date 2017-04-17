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
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 padding-side">
                                            Harga Netto
                                        </div>
                                        <div class="col-sm-6 col-md-6 padding-side">
                                            : <span>{{$pengumuman->harga_netto.' ('.$pengumuman->mata_uang.')'}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 padding-side">
                                            <strong>Auction</strong>
                                        </div>
                                    </div>
                                    @if($allow_auction==false)
                                    <button id="auction-button" class="btn btn-primary btn-lg btn-block disabled">Auction Belum Dimulai</button>
                                    @else
                                    <a class="btn btn-primary btn-lg btn-block">Auction</a>
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
    alert("Goto Auction");
}
@endif
</script>
@stop