@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/bxslider/jquery.bxslider.min.css">
    <style type="text/css">
        .bx-wrapper{
            margin-bottom: 10px;
            padding: 0px;
            box-shadow: 0px 0px white;
            margin-top: -15px;
        }
    </style>
@stop

@section('content')
    <ol class="breadcrumb">
        @if(session('role')=='admin' || session('role')=='subkontraktor')
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
        </li>
        @endif
    </ol>

	<div class="container-fluid">
        <div class="animated fadeIn">
            <!-- <div class="row"> -->
                
            <!-- </div>   -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Selamat Datang di E-Procurement PT.PAL Indonesia
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <ul class="bxslider">
                                    <li><img src="/img/4.png" width="100%" /></li>
                                    <li><img src="/img/7.png" width="100%" /></li>
                                    <li><img src="/img/8.png" width="100%" /></li>
                                </ul>
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
                            <table class="table table-hover table-outline mb-0">
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
                                                    <strong>Status : <span style="color:red;">Pendaftaran Belum dibuka</span></strong>
                                                    @elseif(strtotime($pengumuman->batas_akhir_waktu_penawaran) < strtotime(\Carbon\Carbon::now()))
                                                    <strong>Status : <span style="color:red;">Pendaftaran Ditutup</span></strong>
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
    <pre>
    <?php /*
        print_r(session()->all());
    */ ?>
    </pre>  

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
                    <strong>Captcha : </strong><img src="{{$captcha_src}}" class="captcha-img" style="margin-bottom:5px;border:1px solid gray;"> &nbsp;<button title="perbarui captcha" type="button" class="btn btn-sm btn-captcha"><i class="icon-reload"></i></button><br>
                    <input class="form-control" name="captcha" placeholder="Masukkan captcha sesuai gambar" id="input-captcha-subkontraktor">
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
    <script type="text/javascript" src="/bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript">
        $(".btn-register").click(function(){
            $("#register-pengumuman-id").val($(this).data('id'));
        });
        $('.bxslider').bxSlider({
            controls:false,
            auto:true,
            speed:300,
            pager:false
        });
        $("#login-subkon-modal").submit(function(e){
            e.preventDefault();
            $("#button-login-register").addClass('disabled');
            $("#button-login-register").text('Mengirim');
            $.ajax({
                url:"{{route('register_check')}}",
                method:"POST",
                data:{email:$("#email-login-register").val().trim(),kode_masuk:$("#kode-masuk").val().trim(),pengumuman:$("#register-pengumuman-id").val(),_token:"{{csrf_token()}}",captcha:$("#input-captcha-subkontraktor").val()},
                success:function(res){
                    if(res.result==true){
                        $("#button-login-register").text('Berhasil');
                        location.reload();
                    }else if(res.result==false){
                        $("#button-login-register").removeClass('disabled');
                        $("#button-login-register").text('Masuk');
                        $(".captcha-img").attr("src",res.captcha_src);
                        alert(res.message);
                    }else if(res.result=="captcha_false"){
                        $("#button-login-register").removeClass('disabled');
                        $("#button-login-register").text('Masuk');
                        $(".captcha-img").attr("src",res.captcha_src);
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

