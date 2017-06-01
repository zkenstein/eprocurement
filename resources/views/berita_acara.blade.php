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
		table.no-border *{
			border: 0px solid white;
			padding: 10px;
		}
		.page-break {
			page-break-after: always;
		}
	</style>
</head>
<body>
<div id="header-logo">
	<img src="{{env('SERVER')}}/img/logo_pal.png" style="height: 90%;">
</div>
<br>
<div style="font-family: sans-serif;width: 100%;text-align: center;text-decoration: underline;margin-bottom: 1px solid gray;">
	<strong>BERITA ACARA E-AUCTION</strong>
</div>
<div style="width: 100%;text-align: center;">
	No. {{$pengumuman->kode}}/BA/84200/III/{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}
</div>
<br>
<div>
	<p>Pada tanggal <strong>{{\Carbon\Carbon::parse($pengumuman->start_auction)->day}}</strong> bulan <strong>{{\Carbon\Carbon::parse($pengumuman->start_auction)->month}}</strong> tahun <strong>{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}</strong> telah diadakan proses pemasukan harga dengan menggunakan E-Auction dengan:</p>
</div>
<div>
	<ol>
		@foreach($pengumuman->listRegisteredUser as $registeredUser)
		<li>Rekanan : {{$registeredUser->userInfo->nama}}</li>
		@endforeach
	</ol>
	<ul>
		<?php /*
		<li>Deskripsi dan spesifikasi : <br><strong>Union Fittings & Bushing Boss untuk Proyek W000297 Fasilitas Apung, sesuai SPPH No. 63/SPPH/83200/III/2017</strong></li>
		*/ ?>
		<li>Hasil Auction Terlampir</li>
		<li>Kondisi Penawaran Franco PT PAL Indonesia</li>
		<li>Subject to appproval management</li>
		<li>Peserta tender harus mentaati peraturan E-Auction yang berlaku</li>
		<li>Hasil tender tidak bisa dibatalkan</li>
		<li>Delivery : </li>
		<li>Payment : </li>
	</ul>
</div>
<div>
	<strong style="width:100%;text-decoration: underline;">Hasil Akhir Proses E-Auction</strong>
	<table class="padding-big" style="width:100%;border-collapse: collapse;">
		<tr>
			<th>Kode</th>
			<th>Rekanan</th>
			<th>Harga Terendah</th>
		</tr>
		<tr>
			<td>{{$pengumuman->kode}}</td>
			<td>{{$pemenang->userInfo->nama}}</td>
			<td>
			{{number_format($pemenang->total_auction,0,",",".").' ('.$pengumuman->mata_uang.')'}}
			</td>
		</tr>
	</table>
</div>
<div>
	<br>
	<span style="width: 100%;padding-top: 10px;">Surabaya, {{\Carbon\Carbon::parse($pengumuman->start_auction)->day}}/{{\Carbon\Carbon::parse($pengumuman->start_auction)->month}}/{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}</span>
</div>
<?php /*
<div>
	<div>
		<strong>Rekanan:</strong>
	</div>
	<br>
	<ol class="margin-li">
		<li>CV.Rizky Karya</li>
		<li>CV.Rizky Abadi</li>
		<li>CV.Budi Karya</li>
	</ol>
</div>
<br>
<div>
	<div>
		<strong>PT.PAL INDONESIA:</strong>
	</div> 
	<br>
	<ol class="margin-li">
		<li>Muhadi</li>
	</ol>
</div>
*/ ?>
<div class="page-break"></div>
<div style="font-family:sans-serif;background: #65a7d7;padding: 8px;display: inline-block;">Auction Bid History</div>
<br>
<br>
<table style="border-collapse: collapse;width: 100%;">
	<tr style="background-color: #f7cb4d;">
		<th>Bidder</th>
		<th>Bid Amount {{' ('.$pengumuman->mata_uang.')'}}</th>
		<th>Bid Time</th>
	</tr>
	@foreach($pengumuman->listAuction as $auction)
	@if($auction->status==1)
	<tr style="background-color: aqua;">
	@else
	<tr>
	@endif
		<td>{{$auction->userInfo->nama}}</td>
		<td>
		{{number_format($auction->total,0,",",".")}}
		</td>
		<td>{{\Carbon\Carbon::parse($auction->created_at)->toTimeString()}}</td>
	</tr>
	@endforeach
</table>
<div>
	<p>catatan : Dokumen berita acara e-auction ini tidak dibutuhkan tanda tangan para pihak karena sudah dalam bentuk elektronik file</p>
</div>
<?php /*
<div class="page-break"></div>
<div style="font-family:sans-serif;background: #65a7d7;padding: 8px;display: inline-block;">Auction Bid Summary</div>
<br>
<br>
<table style="border-collapse: collapse;width: 100%;">
	<tr style="background-color: #f7cb4d;">
		<th>Bidder</th>
		<th>Bid Amount</th>
		<th>Bid Time</th>
	</tr>
	<tr>
		<td>Biddder2</td>
		<td>34.500.000 IDR</td>
		<td>14:18:20</td>
	</tr>
	<tr>
		<td>Biddder1</td>
		<td>34.400.000 IDR</td>
		<td>14:19:20</td>
	</tr>
</table>
*/ ?>
</body>
</html>