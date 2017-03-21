@extends('master')

@section('style')
	<style type="text/css">
		#subkontraktor-data{
			width: 100% !important;
		}
	</style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.beranda')}}">Admin</a>
        </li>
        <li class="breadcrumb-item active">Sub Kontraktor</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Data Subkontraktor
                        </div>
                        <div class="card-block">
                            <table id="subkontraktor-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Cluster</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!--
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            -->
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
            <!--/.row-->
        </div>

    </div>
@stop

@section('script')
	<script type="text/javascript">
		$("#subkontraktor-data").DataTable({
			"processing": true,
	        "serverSide": true,
	        "ajax": "{{route('admin.subkontraktor_data')}}",
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
                        var nama = row.nama;
                        return nama;
                    }
                },
                { 
                    "targets": 1,
                    "render": function(data, type, row, meta){
                        var email = row.email;
                        return email;
                    }
                },
                { 
                    "targets": 2,
                    "render": function(data, type, row, meta){
                        return row.telp;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta){
                        return row.cluster;
                    }
                },
                {
                	"className":"no-print",
                    "orderable":false,
                	"targets": 4,
                    "render": function(data, type, row, meta){
                        return "0";
                    }	
                }
            ],
            aaSorting: [[0, 'desc']],
        });
	</script>
@stop