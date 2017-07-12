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
		<?php /*
		<p>
			<span style="color: #333333;">Silahkan Download kontrak anda dengan klik link berikut ini</span><br>
			<a href="{{env('SERVER').'/'.
			'download_kontrak/'.$pengumuman->id.'/1'.sha1($pengumuman->id.'##'.$pengumuman->kode.'%%'.$pengumuman->pemenang).'0'}}">Download Kontrak</a>
		</p>
		*/ ?>
	@else
	
	<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Direktur/Pimpinan {{$pemenang->nama}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
	<p><span style="color: #333333;">Dengan ini PT.PAL Indonesia mengumumkan bahwasanya Anda memenangkan lelang atas proyek <strong>{{$pengumuman->kode}}</strong> 
	
	dengan detail : <br>
	<table style="border-collapse: collapse;width:100%;">
		<tr>
			<th style="border:1px solid black;padding:3px;">Item</th>
			<th style="border:1px solid black;padding:3px;">Harga</th>
		</tr>
		@if($pengumuman->file_excel!=null && $pengumuman->file_excel!='')
			@foreach($pemenang->listBarangEksternalAuction as $barangEksternalUser)
			<tr>
				<td style="border:1px solid black;padding:3px;">{{$barangEksternalUser->barangEksternalInfo->kode}}</td>
				<td style="border:1px solid black;padding:3px;">{{number_format($barangEksternalUser->harga,0,",",".")}}</td>
			</tr>
			@endforeach
		@else
			@foreach($pemenang->listBarangMenang as $barangMenang)
			<tr>
				<td style="border:1px solid black;padding:3px;">{{$barangMenang->pengumumanBarangInfo->barangInfo->kode}}</td>
				<td style="border:1px solid black;padding:3px;">{{number_format($barangMenang->harga,0,",",".")}}</td>
			</tr>
			@endforeach
		@endif
	</table>
	
	@endif
	<p>Terimakasih. Demikian pengumuman pemenangan lelang ini, harap segera ditanggapi.</p>
	<p>Tertanda <strong>Kepala Departemen {{$pengumuman->picInfo->departemenInfo->nama}}</strong></p><br><br>
	<p>{{$pengumuman->picInfo->departemenInfo->kadep}}</p>
</body>
</html>