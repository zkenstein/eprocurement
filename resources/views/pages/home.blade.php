@extends('master')

@section('content')
    <ol class="breadcrumb">
        @if(session('role')=='admin' || session('role')=='subkontraktor')
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
        </li>
        @endif
    </ol>

	<div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Selamat Datang di E-Procurement PT.PAL Indonesia
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12 padding-side">
                                	<p>E-Procurement PT.PAL memungkinkan Tender untuk mengunduh jadwal lelang bebas biaya dan mengajukan tawaran online melalui situs ini.</p>
                                	<p>Syarat dan ketentuan : 
                                	<ol>
                                		<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                                		<li>
                                		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
                                		<li>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</li>
                                	</ol>
                                	</p>
                                </div>
                            </div>
                            <!--/.row-->
                            <br>
                            <table class="table table-hover table-outline mb-0 hidden-sm-down">
                                <thead class="thead-default">
                                    <tr>
                                        <th colspan="5">
                                        	<i class="icon-notebook"></i> Pengumuman Terakhir
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($list_pengumuman) < 1 )
                                        <tr>
                                            <td colspan="5">
                                                Tidak ada pengumuman
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($list_pengumuman as $pengumuman)
                                        <tr>
                                            <td>
                                                <div><strong>Kode </strong>: <a>{{$pengumuman->kode}}</a></div>
                                                <div class="small">
                                                    <strong>Mulai : </strong> {{\Carbon\Carbon::parse($pengumuman->batas_awal_waktu_penawaran)->formatLocalized('%A %d %B %Y')}}
                                                </div>
                                                <div class="small">
                                                    <strong>Penutupan : </strong> {{\Carbon\Carbon::parse($pengumuman->batas_akhir_waktu_penawaran)->formatLocalized('%A %d %B %Y')}}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($pengumuman->max_register!=0)
                                                    Maksimal {{$pengumuman->max_register}} Pendaftar
                                                @else
                                                    Tidak ada batasan pendaftar
                                                @endif
                                            </td>
                                            <td>
                                               <strong>Validitas Harga</strong> : {{\Carbon\Carbon::parse($pengumuman->validitas_harga)->formatLocalized('%A %d %B %Y')}}<br>
                                               <strong>Waktu Pengiriman</strong> : {{\Carbon\Carbon::parse($pengumuman->waktu_pengiriman)->formatLocalized('%A %d %B %Y')}}
                                            </td>
                                            <td>
                                                <strong>Cluster</strong> : <br>
                                                @foreach($pengumuman->listCluster as $clusterData)
                                                    {{$clusterData->clusterInfo->kode}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($pengumuman->listBarang as $barangData)
                                                    {{$barangData->barangInfo->kode}} : {{$barangData->quantity}} {{$barangData->barangInfo->satuan}} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
        </div>
    </div>
@stop