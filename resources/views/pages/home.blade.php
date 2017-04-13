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
                                        <th colspan="<?php if(session('role')!='admin') echo '6'; else echo '5'; ?>">
                                        	<i class="icon-notebook"></i> Pengumuman Terakhir
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($list_pengumuman) < 1 )
                                        <tr>
                                            <td colspan="<?session('role')!='admin'?'6':'5'?>">
                                                Tidak ada pengumuman
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($list_pengumuman as $pengumuman)
                                        <tr>
                                            <td>
                                                <div><strong>Kode </strong>: <a>{{$pengumuman->kode}}</a></div>
                                                <div class="small">
                                                    <strong>Mulai : </strong> {{\Carbon\Carbon::parse($pengumuman->batas_awal_waktu_penawaran)->format('D d-M-Y H:i')}}
                                                </div>
                                                <div class="small">
                                                    <strong>Penutupan : </strong> {{\Carbon\Carbon::parse($pengumuman->batas_akhir_waktu_penawaran)->format('D d-M-Y H:i')}}
                                                </div>
                                                <div class="small">
                                                    @if(strtotime($pengumuman->batas_awal_waktu_penawaran) > strtotime(\Carbon\Carbon::now()))
                                                    <strong>Status : <span style="color:red;">Belum dibuka</span></strong>
                                                    @elseif(strtotime($pengumuman->batas_akhir_waktu_penawaran) < strtotime(\Carbon\Carbon::now()))
                                                    <strong>Status : <span style="color:red;">Ditutup</span></strong>
                                                    @elseif(strtotime($pengumuman->batas_awal_waktu_penawaran) < strtotime(\Carbon\Carbon::now()))
                                                        @if($pengumuman->count_register < $pengumuman->max_register || $pengumuman->max_register<=0)
                                                        <strong>Status : <span style="color:green;">Terbuka</span></strong>
                                                        @else
                                                        <strong>Status : <span style="color:red;">Penuh</span></strong>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($pengumuman->max_register!=0)
                                                    Maksimal {{$pengumuman->max_register}} Pendaftar
                                                @else
                                                    Tidak ada batasan
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
                                            @if(session('role')!='admin')
                                            <td class="text-center">
                                                @if(strtotime($pengumuman->batas_awal_waktu_penawaran) > strtotime(\Carbon\Carbon::now()))
                                                <button class="btn btn-primary disabled">
                                                    Pendaftaran Belum dibuka
                                                </button>
                                                @elseif(strtotime($pengumuman->batas_awal_waktu_penawaran) < strtotime(\Carbon\Carbon::now()) && strtotime($pengumuman->batas_akhir_waktu_penawaran) > strtotime(\Carbon\Carbon::now()))
                                                    <button data-id="{{$pengumuman->id}}" data-toggle="modal" data-target="#login-subkon-modal" class="btn btn-primary btn-register">
                                                    @if($pengumuman->count_register < $pengumuman->max_register || $pengumuman->max_register<=0)
                                                    Daftar / Login Subkontraktor
                                                    @else
                                                    Login Subkontraktor
                                                    </button>
                                                    <strong>Status : <span style="color:red;">Penuh</span></strong>
                                                    @endif
                                                @else
                                                    <button data-id="{{$pengumuman->id}}" data-toggle="modal" data-target="#login-subkon-modal" class="btn btn-primary btn-register">
                                                        Login Subkontraktor
                                                    </button>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!session()->has('logged_in'))
    <form class="modal fade" id="login-subkon-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masuk Subkontraktor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" name="pengumuman_id" id="register-pengumuman-id">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i>
                            </span>
                            <input autocomplete="false" type="email" id="email-login-register" name="email" class="form-control" placeholder="Email" autofocus="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-asterisk"></i>
                            </span>
                            <input autocomplete="false" type="password" id="kode-masuk" name="kode_masuk" class="form-control" placeholder="Kode Masuk">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="button-login-register">Masuk</button>
                </div>
            </div>
        </div>
    </form>
    @endif
@stop

@section('script')
    <script type="text/javascript">
        $(".btn-register").click(function(){
            $("#register-pengumuman-id").val($(this).data('id'));
        });

        $("#login-subkon-modal").submit(function(e){
            e.preventDefault();
            $("#button-login-register").addClass('disabled');
            $("#button-login-register").text('Mengirim');
            $.ajax({
                url:"{{route('register_check')}}",
                method:"POST",
                data:{email:$("#email-login-register").val().trim(),kode_masuk:$("#kode-masuk").val().trim(),pengumuman:$("#register-pengumuman-id").val(),_token:"{{csrf_token()}}"},
                success:function(res){
                    if(res.result==true){
                        $("#button-login-register").text('Berhasil');
                        location.reload();
                    }else if(res.result==false){
                        $("#button-login-register").removeClass('disabled');
                        $("#button-login-register").text('Masuk');
                        alert(res.message);
                    }
                },
                statusCode: {
                    500: function() {
                        alert("Token login kadaluarsa, silahkan ulangi login anda");
                        location.reload();
                    }
                }
            });
        });
    </script>
@stop

