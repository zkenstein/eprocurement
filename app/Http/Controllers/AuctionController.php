<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Auction;
use App\Pengumuman;
use App\PengumumanUser;
use App\BarangEksternal;
use App\BarangEksternalUser;
use App\PengumumanBarang;
use App\PengumumanBarangUser;

class AuctionController extends Controller
{
    public function pengajuan(Request $request)
    {
        $pengumuman = Pengumuman::find(session('pengumuman'));
        $total = 0;
        // dd($request->all());
        if($pengumuman->jenis=='itemize'){
            // INISIALISASI VARIABEL
            $hargaBarang = [];
            $hargaBarangEksternal = [];
            $grup = strtotime("now");
            
            // MANIPULASI INPUTAN, MENGHAPUS . , 
            $request->merge(array('harga_barang'=>str_replace(["Rp","."," "], "", $request->input('harga_barang'))));
            $request->merge(array('harga_barang_eksternal'=>str_replace(["Rp","."," "], "", $request->input('harga_barang_eksternal'))));

            // PERSIAPAN INSERT + COUNTING TOTAL UNTUK PENGECEKAN. DATA BELUM DIINSERT DAN DIRUBAH SEBELUM TERVERIFIKASI
            if($request->input('harga_barang')!=""){
                foreach ($request->input('harga_barang') as $key => $value) {
                    if($value>0){
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
            }

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

            foreach ($hargaBarang as $key => $obj) {
                PengumumanBarangUser::where('pengumuman_barang_id',$key)->where('user_id',session('id'))->delete();
                $obj->save();
            }
            foreach ($hargaBarangEksternal as $key => $obj) {
                BarangEksternalUser::where('barang_eksternal_id',$key)->where('user_id',session('id'))->delete();
                $obj->save();
            }
        }else{
            $auction = Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->first();
            if($auction!=null){
                if($request->input('total_harga_input')!='' && $request->input('total_harga_input')!=null){
                    $total = str_replace(["Rp","."," "], "", $request->input('total_harga_input'));
                    if($auction->total<$total){
                        return response()->json(['result'=>false,'message'=>'Tawaran anda ditolak, tawaran harus lebih kecil dari tawaran sebelumnya','total'=>$auction->total]);
                    }
                    if($total<=0){
                        return response()->json(['result'=>false,'message'=>'Tawaran anda ditolak, tawaran harus lebih dari 0','total'=>$auction->total]);
                    }
                }else{
                    return response()->json(['result'=>false,'message'=>'Tawaran anda ditolak','total'=>0]);
                }
            }else{
                if($request->input('total_harga_input')!='' && $request->input('total_harga_input')!=null){
                    $total = str_replace(["Rp","."," "], "", $request->input('total_harga_input'));
                }else{
                    return response()->json(['result'=>false,'message'=>'Tawaran anda ditolak','total'=>0]);
                }
                if($total<=0){
                    return response()->json(['result'=>false,'message'=>'Tawaran anda ditolak, tawaran harus lebih dari 0']);
                }
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
	    $p = Pengumuman::with('listValidUser')->find(session('pengumuman'));
        if(count($p->listValidUser)<2) return redirect()->route('home');

		// INISIALISASI VARIABEL
		$total = 0;
		$hargaBarang = [];
		$hargaBarangEksternal = [];
		
		// MANIPULASI INPUTAN, MENGHAPUS . , 
		$request->merge(array('harga_barang'=>str_replace(["Rp","."," "], "", $request->input('harga_barang'))));
		$request->merge(array('harga_barang_eksternal'=>str_replace(["Rp","."," "], "", $request->input('harga_barang_eksternal'))));

		// PERSIAPAN INSERT + COUNTING TOTAL UNTUK PENGECEKAN. DATA BELUM DIINSERT DAN DIRUBAH SEBELUM TERVERIFIKASI
        if($request->input('harga_barang')!=""){
            foreach ($request->input('harga_barang') as $key => $value) {
                if($value>0){
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
        }

		foreach ($request->input('harga_barang_eksternal') as $key => $value) {
            if($value>0){
                $hargaBarangEksternal[$key] = new BarangEksternalUser([
                    'barang_eksternal_id'=>$key,
                    'user_id'=>session('id'),
                    'harga'=>$value
                ]);
                $total+=$value;
            }else{
                return response()->json(['result'=>false,'message'=>'Harga setiap barang harus lebih dari 0','indication'=>'harga_barang_eksternal'.$key]);
            }
		}

		// CEK APAKAH TOTAL INPUTAN SAMA DENGAN USER LAIN
		$pengumumanUser = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction',$total)->first();
		// JIKA SUDAH DIAMBIL USER LAIN
		if($pengumumanUser!=null) {
			return response()->json(['result'=>false,'message'=>'Total auction yang anda masukkan sama dengan Subkontraktor lain. Silahkan ganti harga barang sebelum submit']);	
		}
		// JIKA BELUM DIAMBIL OLEH USER LAIN
		else{
			foreach ($hargaBarang as $key => $obj) {
				PengumumanBarangUser::where('pengumuman_barang_id',$key)->where('user_id',session('id'))->update(['status'=>0]);
				$obj->save();
			}
			foreach ($hargaBarangEksternal as $key => $obj) {
				BarangEksternalUser::where('barang_eksternal_id',$key)->where('user_id',session('id'))->update(['status'=>0]);
				$obj->save();
			}
			Auction::where('pengumuman_id',session('pengumuman'))->where('user_id',session('id'))->update(['status'=>0]);
			Auction::create([
				'pengumuman_id'=>session('pengumuman'),
				'user_id'=>session('id'),
				'total'=>$total
			]);
			PengumumanUser::where('user_id',session('id'))->where('pengumuman_id',session('pengumuman'))->update(['total_auction'=>$total]);
			return response()->json(['result'=>true,'message'=>'Tawaran anda berhasil disimpan']);
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
		$data = PengumumanUser::where('pengumuman_id',session('pengumuman'))->where('total_auction','>',0)->whereNotNull('waktu_register')->orderBy('total_auction','asc')->get();
		if(count($data)>0){
            if($data[0]->user_id==session('id')){
                return response()->json(true,200);
            }
            return response()->json(false,200);
        }
        return response()->json(false,200);
	}
}
