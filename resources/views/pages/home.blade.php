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
                                        <th colspan="4">
                                        	<i class="icon-notebook"></i> Pengumuman Terakhir
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($list_pengumuman) < 1 )
                                        <tr>
                                            <td colspan="4">
                                                Tidak ada pengumuman
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($list_pengumuman as $pengumuman)
                                        <tr>
                                            <td>
                                                <div><strong>Kode </strong>: <a>{{$pengumuman->kode}}</a></div>
                                                <div class="small text-muted">
                                                    <strong>Mulai : </strong> {{$pengumuman->mulai_pengumuman}}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                5 Pendaftar Maksimal
                                            </td>
                                            <td>
                                                Cluster 1, Cluster 2, Cluster 3
                                            </td>
                                            <td>
                                                Barang 1, Barang 2, Barang 3, Barang 4
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