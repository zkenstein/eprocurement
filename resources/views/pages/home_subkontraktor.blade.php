@extends('master')

@section('style')

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
                                			Auction
                                		</div>
                                		<div class="col-sm-6 col-md-6 padding-side">
                                			: <strong>{{$pengumuman->start_auction}}</strong> selama <a href="#">{{$pengumuman->durasi}} Menit</a>
                                		</div>
                                	</div>
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

@stop