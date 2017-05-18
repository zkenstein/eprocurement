<!DOCTYPE html>
<html>
<head>
	<title>Berita Acara</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		.header-logo{
			width: 100%;
			height: 80px;
		}
		table.no-margin tr *{
			margin: 0px;
		}
		table.text-up tr td{
			vertical-align: top;
		} 
		.wrapper{
			border:1px solid #070948;
			padding: 8px;
		}
		.text-justify{
			text-align: justify;
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
		/*
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
		*/
		.page-break {
			page-break-after: always;
		}
	</style>
</head>
<body>
<div class="header-logo">
	<div style="position: absolute;top: 0px;left: 0px;">
		<div><img src="{{env('SERVER')}}/img/logo_pal.png" style="height: 80%;margin-bottom: 5px;"></div>
		<div><strong>PURCHASE CONTRACT</strong></div>
	</div>
	<div style="position: absolute;top: 0px;right: 0px;">
		<table class="no-border no-margin text-up">
			<tr>
				<td>Number</td>
				<td> : </td>
				<td>PC, 17 MHD 1231</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td> : </td>
				<td>Kapal Cepat Rudal</td>
			</tr>
			<tr>
				<td>Project Code</td>
				<td> : </td>
				<td>{{$pengumuman->kode}}</td>
			</tr>
			<tr>
				<td>Quotation No</td>
				<td> : </td>
				<td>039/RJ/PNW-PAL/III/{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}</td>
			</tr>
		</table>
	</div>
</div>
<br>
<hr>
<br>
<div class="wrapper">
	<table style="width: 100%;" class="text-up">
		<tr>
			<td>1. Place and date of order</td>
			<td> : </td>
			<td>Surabaya, {{\Carbon\Carbon::parse($pengumuman->start_auction)->format('j F Y')}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>2. Company's name, address, contact details</td>
			<td> : </td>
			<td>PT. PAL INDONESIA (PERSERO)</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Name
			</td>
			<td> : </td>
			<td>Yuniarto Leksana</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Address
			</td>
			<td> : </td>
			<td>Ujung Surabaya, 60155 Indonesia <strong>("Company")</strong></td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Contact person
			</td>
			<td> : </td>
			<td>Wiyono Kumojoyo</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Phone
			</td>
			<td> : </td>
			<td>+62 031 3292275 ext.4003</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Fax
			</td>
			<td> : </td>
			<td>+62 031 3292426</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - E-mail
			</td>
			<td> : </td>
			<td><a style="color:blue;">jurubeli@pal.co.id</a></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>3. Vendor's name, address, contact person</td>
			<td> : </td>
			<td>
				<strong>{{$pemenang->userInfo->nama}}</strong>
				<br>
				<span>  Dusun Pasinan RT.002 RW.001 Desa Kesamben Kec. Driyorejo - Gresik <strong>("Vendor")</strong></span>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp; Contact person :
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Name
			</td>
			<td> : </td>
			<td>Moch. Yusuf Afandi</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Phone / Fax
			</td>
			<td> : </td>
			<td>+62 31 7580 551</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - E-mail
			</td>
			<td> : </td>
			<td><a style="color:blue;">rizkijaya@gmail.com</a></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>4. Description of the Goods</td>
			<td> : </td>
			<td><strong>BRACKET, PIPE, ETC.</strong></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="white-space: nowrap;">5. Scope of supply shall include :</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Quantity</td>
			<td> : </td>
			<td>Detail Scope of Supply, Dimension, Quantity and Specification to be detailed as <strong>Annex I</strong></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Comissioning</td>
			<td> : </td>
			<td>Not Required</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Inspection and Testing</td>
			<td> : </td>
			<td>Not Required</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>6. Price of the Goods (Order Price)</td>
			<td> : </td>
			<td><strong>{{$pengumuman->mata_uang}}. {{number_format($pemenang->total_auction,0,",",".")}},-</strong> Franco PT. PAL Indonesia, Excluded Tax (PPN & PPH-22)</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>15. Additional Terms</td>
			<td> : </td>
			<td>Vendor agree does not disturb the delivery schedule of Goods related to other outstanding project in PT PAL Indonesia</td>
		</tr>
	</table>
</div>
<div class="page-break"></div>
<div class="header-logo">
	<div style="position: absolute;top: 0px;left: 0px;">
		<div><img src="{{env('SERVER')}}/img/logo_pal.png" style="height: 80%;margin-bottom: 5px;"></div>
		<div><strong>PURCHASE CONTRACT</strong></div>
	</div>
	<div style="position: absolute;top: 0px;right: 0px;">
		<table class="no-border no-margin text-up">
			<tr>
				<td>Number</td>
				<td> : </td>
				<td>PC, 17 MHD 1231</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td> : </td>
				<td>Kapal Cepat Rudal</td>
			</tr>
			<tr>
				<td>Project Code</td>
				<td> : </td>
				<td>{{$pengumuman->kode}}</td>
			</tr>
			<tr>
				<td>Quotation No</td>
				<td> : </td>
				<td>039/RJ/PNW-PAL/III/{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}</td>
			</tr>
		</table>
	</div>
</div>
<br>
<hr>
<br>
<div class="wrapper">
	<br>
	<p>Shipping Mark, Tags/Identification and Packing shall be as mentioned as follows :</p>
	<table>
		<tr>
			<td>PROJECT NAME</td>
			<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</td>
			<td>Kapal Cepat Rudal</td>
		</tr>
		<tr>
			<td>PROJECT CODE</td>
			<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</td>
			<td>{{$pengumuman->kode}}</td>
		</tr>
		<tr>
			<td>PC No.</td>
			<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</td>
			<td>PC. 17 MHD 12381</td>
		</tr>
		<tr>
			<td>PACKAGE No.</td>
			<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</td>
			<td>.......of.......</td>
		</tr>
	</table>
	<br>
	<p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
	<p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	<br>
	<table style="width:100%;" class="center-text">
		<tr>
			<td><strong>{{$pemenang->userInfo->nama}}</strong></td>
			<td><strong>PT PAL INDONESIA (PERSERO)</strong></td>
		</tr>
		<tr>
			<td>Director</td>
			<td>General Manager Logistic</td>
		</tr>
		<tr>
			<td>
				<br><br><br><br><br>
			</td>
			<td></td>
		</tr>
		<tr>
			<td style="text-decoration: underline;">(Moch. yusuf Afandi)</td>
			<td style="text-decoration: underline;">(Yuniarto Leksana)</td>
		</tr>
	</table>
</div>
<div class="page-break"></div>
<div class="header-logo">
	<div style="position: absolute;top: 0px;left: 0px;">
		<div><img src="{{env('SERVER')}}/img/logo_pal.png" style="height: 80%;margin-bottom: 5px;"></div>
		<div><strong>PURCHASE CONTRACT</strong></div>
	</div>
	<div style="position: absolute;top: 0px;right: 0px;">
		<table class="no-border no-margin text-up">
			<tr>
				<td>Number</td>
				<td> : </td>
				<td>PC, 17 MHD 1231</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td> : </td>
				<td>Kapal Cepat Rudal</td>
			</tr>
			<tr>
				<td>Project Code</td>
				<td> : </td>
				<td>{{$pengumuman->kode}}</td>
			</tr>
			<tr>
				<td>Quotation No</td>
				<td> : </td>
				<td>039/RJ/PNW-PAL/III/{{\Carbon\Carbon::parse($pengumuman->start_auction)->year}}</td>
			</tr>
		</table>
	</div>
</div>
<br>
<hr>
<br>
<div style="text-align: center;font-weight: bold;">
	Annex-I
</div>
<div style="font-style: italic;text-align: right;font-size: 12px;">Unit: {{$pengumuman->mata_uang}}</div>
<table class="normal-table">
	<tr class="text-center">
		<td>No</td>
		<td>Code</td>
		<td>Description</td>
		<td>Qty</td>
		<td>U/price</td>
		<td>Amount</td>
	</tr>
	<?php $no=1; ?>
	@foreach($list_harga_eksternal as $harga)
		<tr>
			<td style="text-align: center;">{{$no++}}</td>
			<td>
				{{$harga->barangEksternalInfo->kode}}
			</td>
			<td>
				{{$harga->barangEksternalInfo->deskripsi}}
			</td>
			<td>
				{{$harga->barangEksternalInfo->quantity}}
			</td>
			<td>
				{{$harga->barangEksternalInfo->satuan}}
			</td>
			<td>
				{{number_format($harga->harga,0,",",".")}}
			</td>
		</tr>
	@endforeach
	<tr>
		<td style="border-right: 0px solid white;"></td>
		<td colspan="4" style="border-left: 0px solid white; border-right: 0px solid white;">
			<span>TOTAL HARGA NETTO EXCLUDE TAX (PPN & PPH-22)</span>
		</td>
		<td style="border-left: 0px solid white;">
			{{number_format($pemenang->total_auction,0,",",".")}}
		</td>
	</tr>
</table>
<br>
<table style="width:100%;" class="center-text">
	<tr>
		<td><strong>{{$pemenang->userInfo->nama}}</strong></td>
		<td><strong>PT PAL INDONESIA (PERSERO)</strong></td>
	</tr>
	<tr>
		<td>Director</td>
		<td>General Manager Logistic</td>
	</tr>
	<tr>
		<td>
			<br><br><br><br><br>
		</td>
		<td></td>
	</tr>
	<tr>
		<td style="text-decoration: underline;">(Moch. yusuf Afandi)</td>
		<td style="text-decoration: underline;">(Yuniarto Leksana)</td>
	</tr>
</table>
</body>
</html>