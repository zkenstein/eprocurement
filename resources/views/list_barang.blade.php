<!DOCTYPE html>
<html>
<head>
	<title>Berita Acara</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		#header-logo{
			width: 100%;
			height: 80px;
			border-bottom: 1px solid black;
		}
		table tr *{
			padding: 3px;
			border: 1px solid black;
		}
		table.padding-big tr *{
			padding: 10px;
			border: 0.25px solid black;
		}
		ol.margin-li *{
			margin: 15px;
		}
		table.no-margin tr *{
			margin: 0px;
		}
		table.text-up tr td{
			vertical-align: top;
		} 
		table.no-border *{
			border: 0px solid white;
			padding: 2px;
		}
		table.center-text tr td{
			text-align: center;
		}
		table.normal-table{
			width: 100%;
			border-collapse: collapse;
		}
		table.normal-table tr td{
			padding: 5px;
			border: 0.2px solid black;
		}
		.page-break {
			page-break-after: always;
		}
	</style>
</head>
<body>
<div id="header-logo">
	<div style="position: absolute;top: 0px;left: 0px;">
		<div><img src="{{env('SERVER')}}/img/logo_pal.png" style="height: 80%;margin-bottom: 5px;"></div>
	</div>
	<div style="position: absolute;top: 0px;right: 0px;">
		<table class="no-border no-margin text-up">
			<tr>
				<td>Tanggal Pengumuman</td>
				<td> : </td>
				<td>{{\Carbon\Carbon::parse($pengumuman->created_at)->format('d-m-Y')}}</td>
			</tr>
			<tr>
				<td>Kode</td>
				<td> : </td>
				<td>{{$pengumuman->kode}}</td>
			</tr>
			<tr>
				<td>Jenis</td>
				<td> : </td>
				<td>{{$pengumuman->jenis}}</td>
			</tr>
		</table>
	</div>
</div>
<br>
<div style="font-family: sans-serif;width: 100%;text-align: center;text-decoration: underline;margin-bottom: 1px solid gray;">
	<strong>List Item</strong>
</div>
<br>
<div>
	<table style="width:100%;border-collapse: collapse;">
		<thead>
			<tr>
				<th>Kode</th>
				<th>Deskripsi</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			@if($source=='master')
				@foreach($list_item as $item)
				<tr>
					<td>{{$item->barangInfo->kode}}</td>
					<td>{{$item->barangInfo->deskripsi}}</td>
					<td>{{$item->quantity}} {{$item->barangInfo->satuan}}</td>
				</tr>
				@endforeach
			@else
				@foreach($list_item as $item)
				<tr>
					<td>{{$item->kode}}</td>
					<td>{{$item->deskripsi}}</td>
					<td>{{$item->quantity}} {{$item->satuan}}</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>
</body>
</html>