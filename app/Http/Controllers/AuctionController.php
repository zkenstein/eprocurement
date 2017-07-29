<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Auction;
use App\Barang;
use App\Pengumuman;
use App\PengumumanUser;
use App\BarangEksternal;
use App\BarangEksternalUser;
use App\PengumumanBarang;
use App\PengumumanBarangUser;
use App\User;

class AuctionController extends Controller
{
    public function pengajuan(Request $request)
    {
        $pengumuman = Pengumuman::find(session('pengumuman'));
        // CEK WAKTU PENGAJUAN
        if(strtotime("now")>strtotime($pengumuman->validitas_harga)){return response()->json(['result'=>false,'message'=>'Waktu pengajuan telah selesai']);}
        $total = 0;
        if($pengumuman->jenis=='itemize'){
            // INISIALISASI VARIABEL
            $hargaBarang = [];
            $hargaBarangEksternal = [];
            $grup = strtotime("now");
            
            // MANIPULASI INPUTAN, MENGHAPUS (.)(,)
            $request->merge(array('harga_barang'=>str_replace(["Rp","."," "], "", $request->input('harga_barang'))));
            $request->merge(array('harga_barang_eksternal'=>str_replace(["Rp","."," "], "", $request->input('harga_barang_eksternal'))));

            // PERSIAPAN INSERT + COUNTING TOTAL UNTUK PENGECEKAN. DATA BELUM DIINSERT DAN DIRUBAH SEBELUM TERVERIFIKASI
            if($request->input('harga_barang')!=""){
                foreach ($request->input('harga_barang') as $key => $value) {
                    if($value>0){
                        #CEK HARAGA BARANG SAMA
                        $pengumumanBarangUserSama = PengumumanBarangUser::where('user_id','<>',session('id'))->where('pengumuman_barang_id',$key)->where('harga',$value)->where('status',1)->first();
                        if($pengumumanBarangUserSama!=null){
                            return response()->json(['result'=>false,'message'=>'Pengajuan anda belum tersimpan. Ada subkon/vendor lain yang melakukan penawaran item dengan harga yang sama','indication'=>'harga_barang'.$key]);
                        }
                        #CEK HARGA HARUS LEBIH KECIL DARI SEBELUMNYA
                        $pengumumanBarangUserBawah = PengumumanBarangUser::where('user_id',session('id'))->where('pengumuman_barang_id',$key)->where('status',1)->first();
                        if($pengumumanBarangUserBawah!=null){
                            if($pengumumanBarangUserBawah->harga < $value){
                                return response()->json(['result'=>false,'message'=>'Pengajuan harga item harus lebih kecil dari sebelumnya','indication'=>'harga_barang'.$key]);
                            }
                        }
                        #SIMPAN KE MEMORY DULU SEBELUM DI INSERT, JIKA LOLOS PENGECEKAN
                        $hargaBarang[$key] = new PengumumanBarangUser([
                            'pengumuman_barang_id'=>$key,
                            'user_id'=>session('id'),
                            'harga'=>$value
                        ]);
                        $total+=$value;
                    }else{
                        return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih dari 0','indication'=>'harga_barang'.$key]);
                    }
                }
                #JIKA SEMUA PENGECEKAN LOLOS, HAPUS DATA SEBELUMNYA, LALU TAMBAHKAN DATA TERBARU
                foreach ($hargaBarang as $key => $obj) {
                    PengumumanBarangUser::where('pengumuman_barang_id',$key)->where('user_id',session('id'))->delete();
                    $obj->save();
                }
            }

            if ($request->input('harga_barang_eksternal')!="") {
                foreach ($request->input('harga_barang_eksternal') as $key => $value) {
                    if($value>0){
                        $barangSebelumnya = BarangEksternalUser::where('user_id',session('id'))->where('barang_eksternal_id',$key)->orderBy('grup','desc')->first();
                        if($barangSebelumnya!=null){
                            if($barangSebelumnya->harga >= $value){
                                $hargaBarangEksternal[$key] = new BarangEksternalUser([
                                    'barang_eksternal_id'=>$key,
                                    'user_id'=>session('id'),
                                    'harga'=>$value,
                                    'grup'=>$grup
                                ]);
                                // SET CEK HARGA MINIMAL
                                $minHarga = BarangEksternalUser::where('barang_eksternal_id',$key)->where('status',1)->orderBy('harga')->first();
                                if($minHarga->id==$hargaBarangEksternal[$key]->id){
                                    $hargaBarangEksternal[$key]->is_win = 1;
                                    $hargaBarangEksternal[$key]->save();
                                }
                                $total+=$value;
                            }else{
                                return response()->json(['value'=>$barangSebelumnya->harga,'result'=>false,'message'=>'Harga setiap barang harus lebih kecil dari sebelumnya','indication'=>'harga_barang_eksternal'.$key]);
                            }
                        }else{
                            $hargaBarangEksternal[$key] = new BarangEksternalUser([
                                'barang_eksternal_id'=>$key,
                                'user_id'=>session('id'),
                                'harga'=>$value,
                                'grup'=>$grup
                            ]);
                            $total+=$value;
                        }
                    }else{
                        return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih dari 0','indication'=>'harga_barang_eksternal'.$key]);
                    }
                } 
                foreach ($hargaBarangEksternal as $key => $obj) {
                    BarangEksternalUser::where('barang_eksternal_id',$key)->where('user_id',session('id'))->delete();
                    $obj->save();
                }
            }
        }
        else{
            $total = str_replace(["Rp","."," "], "", $request->input('total_harga_input'));
            // CEK JIKA TOTAL LEBIH BESAR DARI SEBELUMNYA
            $pengumumanUser = PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->first();
            if($total==0){
                return response()->json(['result'=>false,'message'=>'Tawaran harus lebih dari 0']);
            }
            else if($pengumumanUser->total_auction<$total && $pengumumanUser->total_auction > 0){
                return response()->json(['result'=>false,'message'=>'Tawaran harus lebih kecil dari tawaran sebelumnya','total'=>$pengumumanUser->total_auction]);
            }else if($pengumumanUser->total_auction==$total){
                return response()->json(['result'=>false,'message'=>'Tawaran anda tidak disimpan karena sama dengan tawaran sebelumnya']);
            }else{
                // CEK APAKAH TOTAL INPUTAN SAMA DENGAN USER LAIN
                $pengumumanUser2 = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction',$total)->where('user_id','<>',session('id'))->first();
                // JIKA SUDAH DIAMBIL USER LAIN
                if($pengumumanUser2!=null) {
                    return response()->json(['result'=>false,'message'=>'Total yang anda masukkan sama dengan Subkontraktor/Vendor lain. Silahkan ganti harga sebelum submit','total'=>$pengumumanUser->total_auction]);
                }
                $pengumumanUser->total_auction = $total;
                $pengumumanUser->save();
            }
        }
        Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->delete();
        Auction::create([
            'pengumuman_id'=>session('pengumuman'),
            'user_id'=>session('id'),
            'total'=>$total
        ]);
        PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->update(['total_auction'=>$total]);
        return response()->json(['result'=>true,'message'=>'Tawaran anda berhasil disimpan']);
    }


	// FUNGSI INI MENGGUNAKAN MIDDELWARE VERIFYAUCTION UNTUK CEK APAKAH AUCTION SUDAH DIMLAI ATAU BELUM DAN APAKAH AUCTION SUDAH SELESAI ATAU BELUM
	public function addAuction(Request $request)
	{
	    #CEK APAKAH USER YANG TELAH MELAKUKAN VALIDITAS HARGA SUDAH LEBIH DARI 1, JIKA BELUM REDIRECT KE HOME
	    $p = Pengumuman::has('listValidUser','>',1)->find(session('pengumuman'));
        if($p==null) return response()->json(['result'=>false],401);
        
		// INISIALISASI VARIABEL
		$total = 0;
        if($p->jenis=='itemize'){
            $grup = strtotime("now");
            #ALGORITMA ITEMIZE: 
            #1. cek apakah harga lebih dari 0 tiap barang
            #2. cek apakah harga ada yang menyamai tiap barang
            #3. cek apakah harga yang dimasukkan lebih besar dari sebelumnya
            #4. jika lolos. input semua, harga sebelumnya di set status=0 dan return true

            $hargaBarang = [];
            $hargaBarangEksternal = [];
            
            // MANIPULASI INPUTAN, MENGHAPUS . , 
            $request->merge(array('harga_barang'=>str_replace(["Rp","."," "], "", $request->input('harga_barang'))));
            $request->merge(array('harga_barang_eksternal'=>str_replace(["Rp","."," "], "", $request->input('harga_barang_eksternal'))));

            // PERSIAPAN INSERT + COUNTING TOTAL UNTUK PENGECEKAN. DATA BELUM DIINSERT DAN DIRUBAH SEBELUM TERVERIFIKASI
            
            if($request->input('harga_barang')!=""){
                foreach ($request->input('harga_barang') as $key => $value) {
                    if($value>0){#CEK HARGA LEBIH DARI 0
                        $cekHargaSama = PengumumanBarang::with('inAuction')->whereHas('inAuction',function($q)use($value){
                                $q->where('harga',$value)->where('user_id','<>',session('id'));
                            }
                        )->where('barang_id',$key)->first();
                        if($cekHargaSama!=null){#CEK APAKAH ADA HARGA YANG SAMA PADA ITEM TERSEBUT
                            return response()->json(['result'=>false,'message'=>'Ada harga item yang sama dengan pengguna lain, silahkan ganti dengan harga lain','indication'=>'harga_barang'.$key]);
                        }
                        
                        $cekhargaSebelumnya = PengumumanBarangUser::whereHas('pengumumanBarangInfo',function($q)use($key){$q->where('barang_id',$key);})->where('user_id',session('id'))->where('status',1)->first();
                        if($cekhargaSebelumnya->harga<$value){#CEK APAKAH HARGA ITEM LEBIH KECI DARI SEBELUMNYA
                            return response()->json(['result'=>false,'message'=>'Harga setiap item harus lebih kecil dari sebelumnya','indication'=>'harga_barang'.$key,'value'=>$cekhargaSebelumnya->harga]);   
                        }
                        
                        PengumumanBarangUser::whereHas('pengumumanBarangInfo',function($q)use($key){$q->where('barang_id',$key);})->where('user_id',session('id'))->update(['status'=>0,'is_win'=>0]);
                        $pengumumanBarang = PengumumanBarang::where('barang_id',$key)->where('pengumuman_id',session('pengumuman'))->first();
                        $hargaBarang = PengumumanBarangUser::create([
                            'pengumuman_barang_id'=>$pengumumanBarang->id,
                            'user_id'=>session('id'),
                            'harga'=>$value,
                            'grup'=>$grup
                        ]);
                        // SET CEK JIKA ITEM YANG DISUBMIT PALINNG KECIL NILAINYA
                        // $minHarga = PengumumanBarangUser::whereHas('pengumumanBarangInfo',function($q)use($key){$q->where('barang_id',$key);})->where('status',1)->orderBy('harga')->first();
                        // if($minHarga->id==$hargaBarang->id){
                        //     $hargaBarang->is_win = 1;
                        //     $hargaBarang->save();
                        // }
                        $total+=$value;
                    }else{
                        return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih dari 0','indication'=>'harga_barang'.$key]);
                    }
                }
            }
            
            if($request->input('harga_barang_eksternal')!=""){
                foreach ($request->input('harga_barang_eksternal') as $key => $value) {
                    if($value>0){#CEK HARGA LEBIH DARI 0
                        $cekHargaSama = BarangEksternalUser::where('barang_eksternal_id',$key)->where('status',1)->where('harga',$value)->where('user_id','<>',session('id'))->first();
                        if($cekHargaSama!=null){#CEK APAKAH ADA HARGA YANG SAMA PADA ITEM TERSEBUT
                            return response()->json(['result'=>false,'message'=>'Ada harga item yang sama dengan pengguna lain, silahkan ganti dengan harga lain','indication'=>'harga_barang_eksternal'.$key]);
                        }
                        $cekhargaSebelumnya = BarangEksternalUser::where('barang_eksternal_id',$key)->where('status',1)->where('user_id',session('id'))->first();
                        if($cekhargaSebelumnya->harga<$value){#CEK APAKAH HARGA ITEM LEBIH KECI DARI SEBELUMNYA
                            return response()->json(['result'=>false,'message'=>'Harga setiap item harus lebih kecil dari sebelumnya','indication'=>'harga_barang_eksternal'.$key,'value'=>$cekhargaSebelumnya->harga]);   
                        }
                        BarangEksternalUser::where('barang_eksternal_id',$key)->where('user_id',session('id'))->update(['status'=>0,'is_win'=>0]);
                        $hargaBarangEksternal = BarangEksternalUser::create([
                            'barang_eksternal_id'=>$key,
                            'user_id'=>session('id'),
                            'harga'=>$value,
                            'grup'=>$grup
                        ]);
                        // SET CEK JIKA ITEM YANG DISUBMIT PALINNG KECIL NILAINYA
                        // $minHarga = BarangEksternalUser::where('barang_eksternal_id',$key)->where('status',1)->orderBy('harga')->first();
                        // if($minHarga->id==$hargaBarangEksternal->id){
                        //     $hargaBarangEksternal->is_win = 1;
                        //     $hargaBarangEksternal->save();
                        // }
                        $total+=$value;
                    }else{
                        return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih dari 0','indication'=>'harga_barang_eksternal'.$key]);
                    }
                }
            }



            /*
            // CEK APAKAH TOTAL INPUTAN SAMA DENGAN USER LAIN
            $pengumumanUser = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction',$total)->first();

            // JIKA SUDAH DIAMBIL USER LAIN
            if($pengumumanUser!=null) {
                return response()->json(['result'=>false,'message'=>'Total auction yang anda masukkan sama dengan Subkontraktor lain. Silahkan ganti harga barang sebelum submit']);    
            }
            */

            // JIKA BELUM DIAMBIL OLEH USER LAIN
            // else{
                /*
                foreach ($hargaBarang as $key => $obj) {
                    PengumumanBarangUser::where('pengumuman_barang_id',$key)->where('user_id',session('id'))->update(['status'=>0]);
                    $obj->save();
                }
                foreach ($hargaBarangEksternal as $key => $obj) {
                    BarangEksternalUser::where('barang_eksternal_id',$key)->where('user_id',session('id'))->update(['status'=>0]);
                    $obj->save();
                }
                */
                Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->update(['status'=>0]);
                Auction::create([
                    'pengumuman_id'=>session('pengumuman'),
                    'user_id'=>session('id'),
                    'total'=>$total
                ]);
                PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->update(['total_auction'=>$total]);
                return response()->json(['result'=>true,'message'=>'Tawaran anda berhasil disimpan']);
            // }
        }
            /*
            $hargaBarangEksternalSebelumnya = BarangEksternal::with('inUserAuction')->where('pengumuman_id',session('pengumuman'));

            foreach ($hargaBarangEksternalSebelumnya as $key => $hargaBarang) {
                if($hargaBarang->inUserAuction->harga<$request->input('harga_barang_eksternal.'.$hargaBarang->id)) {#JIKA SEBUAH BARANG EKSTERNAL DICEK TERNYATA LEBIH BESAR DARI HARGA SEBELUMNYA
                    return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih kecil dari sebelumnya','indication'=>'harga_barang_eksternal'.$hargaBarang->id]);
                }
            }
            */
        else{
            $total = str_replace(["Rp","."," "], "", $request->input('total_auction'));
            // CEK JIKA TOTAL LEBIH BESAR DARI SEBELUMNYA
            $pengumumanUser = PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->first();
            if($pengumumanUser->total_auction<$total){
                return response()->json(['result'=>false,'message'=>'Tawaran harus lebih kecil dari tawaran sebelumnya','total'=>$pengumumanUser->total_auction]);
            }else if($pengumumanUser->total_auction==$total){
                return response()->json(['result'=>true,'message'=>'Tawaran anda tidak disimpan karena sama dengan tawaran sebelumnya']);
            }else{
                // CEK APAKAH TOTAL INPUTAN SAMA DENGAN USER LAIN
                $pengumumanUser2 = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction',$total)->where('user_id','<>',session('id'))->first();
                // JIKA SUDAH DIAMBIL USER LAIN
                if($pengumumanUser2!=null) {
                    return response()->json(['result'=>false,'message'=>'Total auction yang anda masukkan sama dengan Subkontraktor lain. Silahkan ganti harga item sebelum submit','total'=>$pengumumanUser->total_auction]);
                }
                $pengumumanUser->total_auction = $total;
                $pengumumanUser->save();
                Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->update(['status'=>0]);
                Auction::create([
                    'pengumuman_id'=>session('pengumuman'),
                    'user_id'=>session('id'),
                    'total'=>$total
                ]);
                return response()->json(['result'=>true,'message'=>'Tawaran anda berhasil disimpan']);
            }
        }
        
	}

	public function getDataBarang(Request $request)
	{
		$orderBy = '';
        // switch($request->input('order.0.column')){
        //     case "0":
        //         $orderBy = 'kode';
        //     break;
        //     case "1":
        //         $orderBy = 'deskripsi';
        //     break;
        //     default:
        //         $orderBy = 'kode';
        //     break;
        // }

        $barang = BarangEksternal::where('id','>',0);
        if($request->input('search.value')!=''){
            $barang = $barang
            	->where('kode','like','%'.$request->input('search.value').'%')
                ->orWhere('deskripsi','like','%'.$request->input('search.value').'%')
                ->orWhere('satuan','like','%'.$request->input('search.value').'%')
                ->orWhere('quantity','like','%'.$request->input('search.value').'%');
        }

        $recordsFiltered = $barang->count();
        $barang = $barang->get();
        // $barang = $barang->skip($request->input('start'))->take($request->input('length'))->get();
        // dd($barang);
        return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($barang)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$barang
        ],200);
	}

	public function internGetDataAuction(Request $request, $id)
	{
		$data = collect(PengumumanUser::with('userInfo')->where('pengumuman_id',$id)->whereNotNull('waktu_register')->where('total_auction','>',0)->orderBy('total_auction','asc')->get());
        $data = $data->merge(PengumumanUser::with('userInfo')->where('pengumuman_id',$id)->whereNotNull('waktu_register')->where('total_auction',0)->get());
		$recordsFiltered = count($data);
		return response()->json([
        	'draw'=>$request->input('draw'),
            'recordsTotal'=>count($data)/$request->input('length'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ],200);
	}

	public function isIWin(Request $request)
	{
        $pengumuman = Pengumuman::find(session('pengumuman'));
        if($pengumuman!=null){
            if($pengumuman->jenis!='group') return response()->json('BAD REQUEST',401);#HANYA BOLEH MENGGUNAKAN FUNGSI INI JIKA PENGUMUMAN JENIS ITEMIZE
            $data = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction','>',0)->whereNotNull('waktu_register')->orderBy('total_auction','asc')->get();
            if(count($data)>0){
                if($data[0]->user_id==session('id')){
                    return response()->json(true,200);
                }
                return response()->json(false,200);
            }
            return response()->json(false,200);
        }
        return response()->json('BAD REQUEST',401);
	}

    public function cekWinItem(Request $request)
    {
        $pengumuman = Pengumuman::find(session('pengumuman'));
        if($pengumuman!=null){
            if($pengumuman->jenis!='itemize') return response()->json('BAD REQUEST',401);#HANYA BOLEH MENGGUNAKAN FUNGSI INI JIKA PENGUMUMAN JENIS GROUP
            // ALGORITMA BUAT DAPET BARANG EKSTERNAL MANA SAJA YANG USER MENANGKAN
            $win = array();
            if(is_null($pengumuman->file_excel) || $pengumuman->file_excel==""){
                $barang = collect(PengumumanBarang::with('inAuction.pengumumanBarangInfo')->where('pengumuman_id',session('pengumuman'))->get());
                foreach ($barang as $key => $object) {
                    $o = collect($object->inAuction)->sortBy('harga');
                    foreach ($o as $k => $v) {
                        if($v->user_id==session('id')) array_push($win, $v->pengumumanBarangInfo->barang_id);
                        break;
                    }
                }
            }else{
                $barangEksternal = collect(BarangEksternal::with('inAuction')->where('pengumuman_id',session('pengumuman'))->get());
                foreach ($barangEksternal as $key => $object) {
                    $o = collect($object->inAuction)->sortBy('harga');
                    foreach ($o as $k => $v) {
                        if($v->user_id==session('id')) array_push($win, $v->barang_eksternal_id);
                        break;
                    }
                }
            }
            return response()->json($win,200);
        }
        return response()->json('BAD REQUEST',401);
    }

    public function tesItemize(Request $request)
    {
        $pengumuman = Pengumuman::with(['listBarangEksternal.inAuction'])->find(session('pengumuman'));
        if($pengumuman!=null){
            if($pengumuman->jenis!='itemize') return response()->json('BAD REQUEST',401);#HANYA BOLEH MENGGUNAKAN FUNGSI INI JIKA PENGUMUMAN JENIS GROUP
            // ALGORITMA BUAT DAPET BARANG EKSTERNAL MANA SAJA YANG USER MENANGKAN
            
            // $barangEksternalUser = BarangEksternalUser::with(['barangEksternalInfo','userInfo'])->whereHas('barangEksternalInfo',function($q){
                // $q->where('pengumuman_id',session('pengumuman'));
            // })->where('is_win',1)->get();
            #QUERY UNTUK MENDAPATKAN PEMENANG DAN ITEM ITEM NYA :D
            $pemenang = User::with(['listBarangEksternalAuction'=>function($q){
                $q->with('barangEksternalInfo')->where('is_win',1)->whereHas('barangEksternalInfo',function($q2){
                    $q2->where('pengumuman_id',session('pengumuman'));
                });
            }])->whereHas('listBarangEksternalAuction',function($q){
                $q->wherehas('barangEksternalInfo',function($q2){
                    $q2->where('pengumuman_id',session('pengumuman'));
                })->where('status',1)->where('is_win',1);
            })->get();

            $listBarangEksternalAuction = BarangEksternalUser::with(['userInfo','barangEksternalInfo'])->whereHas('barangEksternalInfo',function($q){
                $q->where('pengumuman_id',session('pengumuman'));
            })->get();
            $data['list_barang_eksternal_auction'] = $listBarangEksternalAuction;
            $data['pengumuman'] = $pengumuman;
            $data['para_pemenang'] = $pemenang;
            
            // $createBeritaAcara  = \PDF::loadView('berita_acara',$data)->setPaper('folio','potrait')->save(storage_path('app/tes/berita_acara/berita_acara_'.$pengumuman->id.'pdf'));
            $info = array();
            foreach ($pemenang as $pem) {
                $data['pemenang'] = $pem;
                \Mail::send('mail_pemenang', $data, function($message) use($pem,$pengumuman){
                    $message->to($pem->email, $pem->nama)->subject("Pengumuman Hasil Lelang Proyek ".$pengumuman->kode);
                    $message->from(env('MAIL_USERNAME'),"PT.PALL Indonesia (Persero)");
                });
                array_push($info, "sukses mengirim email ke ".$pem->email);
            }
            dd($info);
            return response()->json($win,200);
        }
        return response()->json('BAD REQUEST',401);
    }
}
