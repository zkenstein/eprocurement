<!DOCTYPE html>
<html>
<head>
	<title>Hasil Pengumuman Lelang</title>
</head>
<body>
	<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Direktur/Pimpinan {{$pemenang->userInfo->nama}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
	<p><span style="color: #333333;">Dengan ini PT.PAL Indonesia (Persero) mengumumkan bahwasanya Anda memenangkan lelang atas proyek <strong>{{$pengumuman->kode}}</strong> dengan harga penawaran <strong style="color:red;">{{number_format($pemenang->total_auction,0,",",".")}}</strong></span>
	</p>
	<p><span style="color: #333333;">Silahkan Download kontrak anda dengan klik link berikut ini</span>
	<p>Terimakasih. Demikian pengumuman pemenangan lelang ini, harap segera ditanggapi.</p>
</body>
</html>