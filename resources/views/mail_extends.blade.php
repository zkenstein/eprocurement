<!DOCTYPE html>
<html>
<head>
    <title>Pemberitahuan Extends</title>
</head>
<body>
<h3>Kepada Yth. Direktur/Pimpinan <strong>{{$pengumuman->userInfo->nama}}</strong></h3>
<p>Dengan ini kami memberitahukan bahwa Pengumuman lelang dengan kode {{$pengumuman->pengumumanInfo->kode}} diperpanjang dikarenakan peserta lelang tidak memenuhi target</p>
<p>
    <span style="color: #333333;">Detail perpanjangan :&nbsp;</span>
</p>
<table style="height: 182px;" width="506">
    <tbody>
    <tr>
        <td>Batas waktu penawaran</td>
        <td>: {{$pengumuman->pengumumanInfo->batas_awal_waktu_penawaran}} - {{$pengumuman->pengumumanInfo->batas_akhir_waktu_penawaran}}</td>
    </tr>
    <tr>
        <td>Validity Harga</td>
        <td>: {{$pengumuman->pengumumanInfo->validitas_harga}}</td>
    </tr>
    <tr>
        <td>Delivery Time</td>
        <td>: {{$pengumuman->pengumumanInfo->waktu_pengiriman}}</td>
    </tr>
    <tr>
        <td>Waktu Auction</td>
        <td>: {{$pengumuman->pengumumanInfo->start_auctionn}} ({{$pengumuman->pengumumanInfo->durasi}} Menit)</td>
    </tr>
    </tbody>
</table>

@if($is_registered==true)
    <small style="color: red">Catatan : Anda telah melakukan penawaran dan telah terdaftar dalam pengumuman ini. Sehingga tidak perlu melakukan penawaran lagi</small>
@endif
<p>Demikian surat pemberitahuan ini. Atas perhatiannya kami sampaikan terimakasih.</p>
</body>
</html>