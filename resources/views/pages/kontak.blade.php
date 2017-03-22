@extends('master')

@section('content')
    <ol class="breadcrumb">
        @if(session('role')=='admin' || session('role')=='subkontraktor')
        <li class="breadcrumb-item"><a href="{{route('kontak')}}">Kontak</a>
        </li>
        @endif
    </ol>

	<div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Hubungi Kami
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 padding-side">
                                	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.310268091754!2d112.73933681429958!3d-7.205399572735866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f92b8fee968d%3A0xaa4b64bc612f6608!2sPT.+PAL+Indonesia!5e0!3m2!1sen!2sid!4v1490025818275" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                <div class="col-sm-12 col-md-6 padding-side">
                                    <h6><strong>Alamat</strong></h6>
                                    <p>
                                        <i class="icon-location-pin"></i> Ujung, Semampir<br>
                                        <i class="icon-map"></i> Surabaya, Jawa Timur 60155<br>
                                        <i class="icon-globe"></i> Indonesia
                                    </p>
                                    <h6><strong>Kontak</strong></h6>
                                    <p>
                                        <i class="icon-envelope"></i> Email : admin@pal.co.id<br>
                                        <i class="icon-phone"></i> Telp : 085749465253
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop