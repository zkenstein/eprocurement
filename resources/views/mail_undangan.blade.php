<!DOCTYPE html>
<html>
<head>
	<title>Pengumuman Lelang</title>
</head>
<body>
	<h3 style="color: #5e9ca0;"><span style="color: #333333;">Kepada Yth. Direktur/Pimpinan {{$nama_perusahaan}}</span><br /><span style="color: #333333;">di Tempat</span></h3>
	<p><span style="color: #333333;">Dengan ini PT.PAL Indonesia mengumumkan pembukaan lelang untuk Proyek dengan kode <strong>{{$pengumuman->kode}}</strong>&nbsp;</span>
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
			<?php /*
			<tr>
				<td>Waktu Auction</td>
				<td>: {{$pengumuman->start_auctionn}} ({{$pengumuman->durasi}} Menit)</td>
			</tr>
			*/ ?>
	        <tr>
	            <td>Nilai HPS</td>
				@if($pengumuman->nilai_hps > 0)
	            	<td>: {{number_format($pengumuman->nilai_hps,0,",",".").' ('.$pengumuman->mata_uang.')'}}</td>
				@else
					<td>: -</td>
				@endif
	        </tr>
	        <tr>
	            <td>No SPPH</td>
	            <td>: {{$pengumuman->kode}}</td>
	        </tr>
	        <tr>
	            <td>Batasan peserta</td>
	            <td>: 
	            	@if($pengumuman->max_register>0)
	            		{{$pengumuman->max_register}}
            		@else
            			Tidak dibatasi
            		@endif
	            </td>
	        </tr>
	    </tbody>
	</table>
	@if($pengumuman->syarat_dan_ketentuan!=null && $pengumuman->syarat_dan_ketentuan!="")
	<p>
		<strong>Syarat & Kondisi Penawaran :</strong><br>
		{!!nl2br($pengumuman->syarat_dan_ketentuan)!!}
		<!--
		<ol>
			<li>Harga berlaku 1 (satu) minggu</li>
			<li>Belum termasuk PPN 10%</li>
			<li>Tempat Pengiriman PT. PAL Indonesia, Surabaya</li>
		</ol>
		-->
	</p>
	@endif
	<p><span style="color: #333333;"><br />Untuk melakukan pendaftaran silahkan klik menu register di halaman&nbsp;<a href="{{route('home')}}" target="_blank">Home E-Procurement PT. PAL</a>&nbsp;sesuai dengan kode proyek di atas dan masukkan email anda beserta kode_registrasi yang kami kirimkan di atas.&nbsp;</span>
	</p>
	<p>Demikian surat penawaran ini. Atas perhatiannya kami sampaikan terimakasih.</p>
	<br>
	@if($departemen!=null)
	<p>Tertanda <strong>Kepala Departemen {{$departemen->nama}}</strong></p><br><br>
	<p>{{$departemen->kadep}}</p>
	@else
	<p>Tertanda <strong>Kepala Departemen {{$departemen_id}}</strong></p><br><br>
	<p>{{$departemen_id}}</p>
	@endif
</body>
</html>