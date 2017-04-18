@extends('master')

@section('style')
	
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('auction')}}">Auction</a>
        </li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Form Auction
                        </div>
                        <div class="card-block">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            <br><br>
                            <table id="barang-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Satuan</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($list_barang as $barang)
                                <tr>
                                    <td>{{$barang->barangInfo->kode}}</td>
                                    <td>{{$barang->barangInfo->satuan}}</td>
                                    <td>{{$barang->barangInfo->deskripsi}}</td>
                                    <td>{{$barang->quantity}}</td>
                                    <td>
                                        <input data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder="">
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        
                                    </td>
                                    <td>
                                        <button id="btn-simpan" class="btn btn-primary btn-block">Simpan</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 padding-side">
                            <img src="" id="preview-gambar-barang" width="100%">
                            <iframe src="" style="width: 100%;height: 500px;" id="preview-pdf-barang"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
	<script type="text/javascript">
		var csrf = "{{csrf_token()}}";
        function previewImage(src) {
            $("#preview-gambar-barang").show();
            $("#preview-gambar-barang").attr('src','/img/barang/'+src);
            $("#preview-pdf-barang").hide();
            $("#modal-preview").modal('show');
        }

        function previewPdf(src) {
            $("#preview-gambar-barang").hide();
            $("#preview-pdf-barang").show();
            $("#preview-pdf-barang").attr('src','/img/barang/'+src);
            $("#modal-preview").modal('show');
        }

        $("#btn-simpan").click(function(){
            $.ajax({
                url:"{{route('auction')}}",
                method:"POST",

            });
        });
	</script>
@stop