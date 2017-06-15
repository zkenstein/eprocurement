<!DOCTYPE html>
<html>
<head>
	<title>Hasil Pengumuman Lelang</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		table tr td,th{
			border: 1px solid gray !important;
		}
	</style>
</head>
<body>
	@if($pengumuman->jenis=='group')

		<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Direktur/Pimpinan {{$pemenang->userInfo->nama}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
		<p><span style="color: #333333;">Dengan ini PT.PAL Indonesia mengumumkan bahwasanya Anda memenangkan lelang atas proyek <strong>{{$pengumuman->kode}}</strong> 
		
		dengan harga penawaran 
		<strong style="color:red;">{{number_format($pemenang->total_auction,0,",",".")}}</strong></span>
		</p>
		<p>
			<span style="color: #333333;">Silahkan Download kontrak anda dengan klik link berikut ini</span><br>
			<a href="{{env('SERVER').'/'.
			'download_kontrak/'.$pengumuman->id.'/1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0'}}">Download Kontrak</a>
		</p>
	@else
	
	<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Direktur/Pimpinan {{$pemenang->nama}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
	<p><span style="color: #333333;">Dengan ini PT.PAL Indonesia mengumumkan bahwasanya Anda memenangkan lelang atas proyek <strong>{{$pengumuman->kode}}</strong> 
	
	dengan detail : <br>
	<table>
		<tr>
			<th>Item</th>
			<th>Harga</th>
		</tr>

		@foreach($pemenang->listBarangEksternalAuction as $barangEksternalUser)
		<tr>
			<td>{{$barangEksternalUser->barangEksternalInfo->kode}}</td>
			<td>{{number_format($barangEksternalUser->harga,0,",",".")}}</td>
		</tr>
		@endforeach

	</table>
	
	@endif
	<p>Terimakasih. Demikian pengumuman pemenangan lelang ini, harap segera ditanggapi.</p>
</body>
</html>