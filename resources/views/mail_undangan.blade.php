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
	
	@if($list_barang!=null)<!-- JIKA LIST BARANG ADA -->
	<div>
		List Item :
	</div>

	<table style="border:1px solid gray;border-collapse: collapse;">
		<thead style="border:1px solid gray;">
			<tr style="border:1px solid gray;">
				<th style="border:1px solid gray;">Kode</th>
				<th style="border:1px solid gray;">Deskripsi</th>
				<th style="border:1px solid gray;">Jumlah</th>
				<th style="border:1px solid gray;">Ket</th>
			</tr>
		</thead>
		<tbody style="border:1px solid gray;">
			@foreach($list_barang as $b)
			<tr style="border:1px solid gray;">
				<td style="border:1px solid gray;">{{$b['barang_info']['kode']}}</td>
				<td style="border:1px solid gray;">{{$b['barang_info']['deskripsi']}}</td>
				<td style="border:1px solid gray;">{{$b['quantity']}}{{$b['barang_info']['satuan']}}</td>
				<td style="border:1px solid gray;">
					<img style="width: 100px;" src="{{env('SERVER')}}/img/barang/{{$b['barang_info']['gambar']}}"/>
					<br>
					@if(!is_null($b['barang_info']['pdf']))
					<a download href="{{env('SERVER')}}/img/barang/{{$b['barang_info']['pdf']}}">Download PDF</a>
					@endif
				</td>
			</tr>
			
			@endforeach
		</tbody>
	</table>
	@endif

	@if($pengumuman->syarat_dan_ketentuan!=null && $pengumuman->syarat_dan_ketentuan!="")
	<p>
		<strong>Syarat & Kondisi Penawaran :</strong><br>
		{!!nl2br($pengumuman->syarat_dan_ketentuan)!!}
	</p>
	@endif
	<p><span style="color: #333333;"><br />Untuk melakukan pendaftaran silahkan klik menu register di halaman&nbsp;<a href="{{route('home')}}" target="_blank">Home E-Procurement PT. PAL</a>&nbsp;sesuai dengan kode proyek di atas dan masukkan email anda beserta kode_registrasi yang kami kirimkan di atas.&nbsp;</span>
	</p>
	<p>Demikian surat undangan ini. Atas perhatiannya kami sampaikan terimakasih.</p>
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