<!DOCTYPE html>
<html>
<head>
	<title>Pengumuman Lelang</title>
</head>
<body>
	<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Kepala {{$nama_perusahaan}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
	<p><span style="color: #333333;">Dengan ini PT.PAL Surabaya mengumumkan pembukaan lelang untuk Proyek dengan kode <strong>{{$pengumuman->kode}}</strong>&nbsp;</span>
	</p>
	<p><span style="color: #333333;">Kode registrasi anda untuk proyek ini adalah : {{$kode_registrasi}}</span>
	</p>
	<p><span style="color: #333333;">Informasi proyek :&nbsp;</span>
	</p>
	<table style="height: 182px;" width="506">
	    <tbody>
	        <tr>
	            <td>PIC</td>
	            <td>: {{$pengumuman->picInfo->nama}}</td>
	        </tr>
	        <tr>
	            <td>Batas waktu penawaran</td>
	            <td>: {{$pengumuman->batas_awal_waktu_penawaran}} - {{$pengumuman->batas_akhir_waktu_penawaran}}</td>
	        </tr>
	        <tr>
	            <td>Validity Harga</td>
	            <td>: {{$pengumuman->validitas_harga}}</td>
	        </tr>
	        <tr>
	            <td>Delivery Time</td>
	            <td>: {{$pengumuman->waktu_pengiriman}}</td>
	        </tr>
	        <tr>
	            <td>Harga Netto</td>
	            <td>: {{$pengumuman->harga_netto}} ({{$pengumuman->mata_uang}})</td>
	        </tr>
	        <tr>
	            <td>No SPPH</td>
	            <td>: {{$pengumuman->kode}}</td>
	        </tr>
	        <tr>
	            <td>Batasan peserta</td>
	            <td>: {{$pengumuman->max_register}}</td>
	        </tr>
	        <tr>
	            <td>&nbsp;</td>
	            <td>&nbsp;</td>
	        </tr>
	    </tbody>
	</table>
	<p><span style="color: #333333;"><br />Untuk melakukan pendaftaran silahkan klik menu register di halaman&nbsp;<a href="{{route('home')}}" target="_blank">Home E-Procurement PT. PAL</a>&nbsp;sesuai dengan kode proyek di atas dan masukkan email anda beserta kode_registrasi yang kami kirimkan di atas.&nbsp;</span>
	</p>
	<p>Terimakasih. Demikian undangan lelang ini agar kemudian ditanggapi.</p>
</body>
</html>