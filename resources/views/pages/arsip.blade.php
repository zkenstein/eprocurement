@extends('master')

@section('style')
    <link rel="stylesheet" type="text/css" href="/daterangepicker/daterangepicker.css">
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
        <li class="breadcrumb-item active">Arsip</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
			<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Data Arsip Lelang
                        </div>
                        <div class="card-block">
                            <table id="pengumuman-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Pengumuman</th>
                                        <th>Arsip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Pengumuman</th>
                                        <th>Arsip</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript">
    var table = $("#pengumuman-data").DataTable({
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('intern.pengumuman_data2')}}",
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
                "className": "mystyle-column",
                "targets": 0,
                "render": function(data, type, row, meta){
                    if(row.pemenang_info!=null){
                        var res = "<strong>Kode Pengumuman : </strong><a>"+row.kode+"</a><br><strong>Kode PIC : </strong><a>"+row.pic_info.kode+"</a><br><strong>Pemenang : </strong>"+row.pemenang_info.nama;
                    }else{
                        var res = "<strong>Kode Pengumuman : </strong><a>"+row.kode+"</a><br><strong>Kode PIC : </strong><a>"+row.pic_info.kode;
                    }
                    return res;
                }
            },
            {
                "targets": 1,
                "render": function(data, type, row, meta){
                    return "<a download class='btn btn-primary' href='{{route('intern.download_berita_acara')}}/"+row.id+"'>Download Berita Acara</a>";
                }
            }
        ],
    });
</script>
@stop