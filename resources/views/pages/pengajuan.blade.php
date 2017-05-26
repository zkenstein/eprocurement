@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/jquery-countdown/jquery.countdown.css">
	<style type="text/css">
    #barang-data{
        width: 100% !important;
    }
    .total_auction_field{
        font-size: 200%;
        clear: both;
        width: 100%;
        padding: 0px 2px;
        text-align: center;
    }
    #win-flag{
        transition: 0.5s;
    }
    .danger-input,.danger-input:focus{
        border: 1px solid red;
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
                                            <input id="input_harga_barang{{$barang->id}}" required name="harga_barang[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
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
                                            <input id="input_harga_barang_eksternal{{$barang->id}}" required name="harga_barang_eksternal[{{$barang->id}}]" data-id="{{$barang->id}}" autocomplete="false" type="text" class="form-control input-auction-barang maskmoneywithoutrp" placeholder=""
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
    <script type="text/javascript" src="/jquery-countdown/jquery.plugin.min.js"></script>
    <script type="text/javascript" src="/jquery-countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript">
        $('#timer').countdown({until: +{{$countdown}},compact: true, format: 'yowdHMS', onExpiry: function(){location.href="{{route('logout')}}"}});

		var csrf = "{{csrf_token()}}";
        var total = 0;
        $(document).ready(function(){
            $("#total_harga_input").maskMoney('mask', {{$total_auction}});
            $(".maskmoneywithoutrp").maskMoney('mask');
        });

        $("#form-auction").submit(function(e){
            e.preventDefault();
            $("input").removeClass('danger-input');
            $("#btn-simpan").addClass('disabled');
            $("#btn-simpan").text('Mengirim');
            var theForm = $(this);
            $(theForm).ajaxSubmit({
                type:"POST",
                success:function(res){
                    $("#btn-simpan").removeClass("disabled");
                    $("#btn-simpan").text("Submit");
                    if(res.indication!=undefined){
                        $("#input_"+res.indication).addClass('danger-input');
                        $("#input_"+res.indication).focus();
                    }
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