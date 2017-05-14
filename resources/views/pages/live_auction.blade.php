@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/jquery-countdown/jquery.countdown.css">
    <style type="text/css">
        .mystyle-column > a{
            color: #2b609e !important;
        }
    </style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('intern.beranda')}}">{{studly_case(session('role'))}}</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('intern.monitoring')}}">Monitoring</a></li>
        <li class="breadcrumb-item active">Live Auction <span style="color:aqua;">{{$pengumuman->kode}}</span></li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
			<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Data Live Auction
                        </div>
                        <div class="card-block">
                            <table id="data-auction" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Subkontraktor</th>
                                        <th>Total Auction</th>
                                        <th>Peringkat</th>
                                        <th width="2%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript">
        var status = 1;
        var rank = 1;
        var recordsTotal = 0;
        var table = $("#data-auction").DataTable({
            "ordering":false,
            "paging":false,
            "autoWidth": false,
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url":"{{route('intern.live_auction_data',['id'=>$pengumuman->id])}}",
                "dataSrc":function(json){
                    recordsTotal = json.recordsTotal;
                    return json.data;
                }
            },
            info:false,
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
                        var info = "Kode : <a style='color:blue;'>"+row.user_info.kode+"</a><br>";
                        info+="Nama : "+row.user_info.nama;
                        return info;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        var total_auction = accounting.formatMoney(row.total_auction, "", 0, ".", ",")+'';
                        return total_auction;
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return rank++;
                    }
                },
                {
                    "className":"no-print",
                    "orderable":false,
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return '<button class="btn btn-primary btn-sm" onclick="reloadTable();" type="button" title="lihat detail"><i class="icon-eye"></i></button>';
                    }
                }
            ]
        });

        setInterval(reloadTable,1000);

        function reloadTable () {
            rank=recordsTotal+1;
            if(status==1){
                table.ajax.reload();
            }
            else{
                return false;
            }
        }
    </script>
@stop