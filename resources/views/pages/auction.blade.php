@extends('master')

@section('style')
	<style type="text/css">
    #barang-data{
        width: 100% !important;
    }   
    </style>
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
                            <form method="post" action="" id="form-auction">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" class="csrf_input">
                                <table id="barang-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">Kode</th>
                                            <th>Deskripsi</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                            <th width="250">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list_barang as $barang)
                                    <tr>
                                        <td>{{$barang->barangInfo->kode}}</td>
                                        <td>{{$barang->barangInfo->deskripsi}}</td>
                                        <td>{{$barang->barangInfo->satuan}}</td>
                                        <td>{{$barang->quantity}}</td>
                                        <td>
                                            <input required name="harga_barang[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                            @if($barang->inUserAuction!=null)
                                            value = "{{$barang->inUserAuction->harga}}"
                                            @endif
                                            >
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach($list_barang_eksternal as $barang)
                                    <tr>
                                        <td>{{$barang->kode}}</td>
                                        <td>{{$barang->deskripsi}}</td>
                                        <td>{{$barang->satuan}}</td>
                                        <td>{{$barang->quantity}}</td>
                                        <td>
                                            <input required name="harga_barang_eksternal[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
                                            @if($barang->inUserAuction!=null)
                                            value = "{{$barang->inUserAuction->harga}}"
                                            @endif
                                            >
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            <strong>Total</strong>
                                        </td>
                                        <td>
                                            <input type="text" disabled class="form-control maskmoneywithoutrp" id="total_harga_input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            <button type="submit" id="btn-simpan" class="btn btn-primary btn-block">Submit</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
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
        var total = 0;
        $(document).ready(function(){
            $("#total_harga_input").maskMoney('mask', {{$total_auction}});
            $(".maskmoneywithoutrp").maskMoney('mask');
        });
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

        $("#form-auction").submit(function(e){
            e.preventDefault();
            $("#btn-simpan").addClass('disabled');
            $("#btn-simpan").text('Mengirim');
            var theForm = $(this);
            $(theForm).ajaxSubmit({
                type:"POST",
                success:function(res){
                    $("#btn-simpan").removeClass("disabled");
                    $("#btn-simpan").text("Submit");
                    console.log(res);
                }
            })
        });

        $(".input-auction-barang").keyup(function(){
            total = 0;
            $.each($(".input-auction-barang"),function(key,object){
                var val = $(object).val();
                if(val!=null && val!="" && val!="0")
                    total+=parseInt(val.replace(/[^\w\s]/gi, ''));
            });
            $("#total_harga_input").maskMoney('mask', total);
        });

        <?php
        /*
        $("#barang-data").DataTable({
            "autoWidth":false,
            "info":false,
            "paging": false,
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "/auction_barang_data",
            "language": {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Maaf data tidak ditemukan",
                "info": "_PAGE_ dari _PAGES_",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Cari "
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "render": function(data, type, row, meta){
                        var kode = row.kode;
                        return kode;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        var satuan = row.satuan;
                        return satuan;
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        var deskripsi = row.deskripsi;
                        return deskripsi;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        var quantity = row.quantity;
                        return quantity;
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 4,
                    "render": function(data, type, row, meta){
                        return '<input required name="harga['+row.id+']" data-id="'+row.id+'" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder="">';
                    }
                }
            ]
        });
        */
        ?>
	</script>
@stop