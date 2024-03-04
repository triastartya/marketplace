<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\MerchantModel;
use App\Models\MerchantProdukGambarModel;
use App\Models\MerchantProdukModel;
use App\Models\TrOrder;
use App\Models\TrOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    //
    public function daftar_merchant(Request $request){
        try{
            $request->request->add(['uuid'=>Str::uuid()]);
            
            $upload_image_name = '';
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-logo.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/logo/'), $upload_image_name);
                $request->request->add(['logo'=>$upload_image_name]);
            }else{
                $request->request->add(['logo'=>'']);
            }
            $request->request->add(['password'=>md5($request->password)]);
            $request->request->add(['rating'=>0]);
            $data = MerchantModel::create($request->all());
            $request->session()->put('data_merchant',$data);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function login_merchant(Request $request){
        try{
            $data = MerchantModel::where('email',$request->email)->first();
            if($data == null){
                return response()->json(['status'=>false,'message'=>'email tidak di temukan', 'data'=>[]]);    
            }
            
            if($data->password != md5($request->password)){
                return response()->json(['status'=>false,'message'=>'password salah', 'data'=>[]]);
            }
            
            $request->session()->put('data_merchant',$data);
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function toko(Request $request){
        if ($request->session()->has('data_merchant')) {
            $data = [
                'merchant' => MerchantModel::where('merchant_id',$request->session()->get('data_merchant')->merchant_id)->first(),
            ];
            return view('website/toko',$data);
        }else{
            return redirect('/');
        }
    }
    
    public function tambah_produk(Request $request){
        $data = [
            'kategori' => KategoriModel::all(),
            'produk' => null
        ];
        return view('website/produk_tambah',$data);
    }
    
    public function edit_produk(Request $request){
        $data = [
            'kategori' => KategoriModel::all(),
            'produk' => MerchantProdukModel::with('merchant_produk_gambar')->where('uuid',$request->uuid)->first()
        ];
        return view('website/produk_tambah',$data);
    }
    
    public function create_produk(Request $request){
        try{
            $request->request->add(['uuid'=>Str::uuid()]);
            $upload_image_name = '';
            
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-produk.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/produk/'), $upload_image_name);
            }else{
                $upload_image_name = '';
            }
            
            $request->request->add(['merchant_id'=>$request->session()->get('data_merchant')->merchant_id]);
            $request->request->add(['rating'=>0]);
            $request->request->add(['terjual'=>0]);
            $request->request->add(['delete'=>0]);
            $request->request->add(['harga_jual'=>$request->harga]);
            $data = MerchantProdukModel::create($request->all());
            $gambar = MerchantProdukGambarModel::create([
                'merchant_produk_id' => $data->merchant_produk_id,
                'path' => $upload_image_name
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function update_produk(Request $request){
        try{
            $update = MerchantProdukModel::where('uuid',$request->uuid)->first();
            
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-produk.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/produk/'), $upload_image_name);
                $delete = MerchantProdukGambarModel::where('merchant_produk_id',$update->merchant_produk_id)->delete();
                $gambar = MerchantProdukGambarModel::create([
                    'merchant_produk_id' => $update->merchant_produk_id,
                    'path' => $upload_image_name
                ]);
            }
            
            $update->nama_produk = $request->nama_produk;
            $update->kategori_id = $request->kategori_id;
            $update->harga = $request->harga;
            $update->harga_jual = $request->harga;
            $update->stok = $request->stok;
            $update->keterangan = $request->keterangan;
            $update->save();
            
            return response()->json(['status'=>true,'data'=>$update]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function delete_produk(Request $request){
        try{
            $data = MerchantProdukModel::with('order')->where('uuid',$request->uuid)->get();
            if(count($data->order)==0){
                MerchantProdukModel::where('uuid',$request->uuid)->delete();
            }else{
                MerchantProdukModel::where('uuid',$request->uuid)->update([
                    'delete' => false
                ]);
            }
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function get_produk_toko(Request $request){
        try{
            $data = MerchantProdukModel::with('merchant_produk_gambar','kategori')
                ->where('merchant_id',$request->session()->get('data_merchant')->merchant_id)
                ->where('delete',0)
                ->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function get_order_produk_toko(Request $request){
        try{
            $data = TrOrderDetail::with('merchant_produk.merchant_produk_gambar','merchant_produk.merchant','member')
                ->where('merchant_id',$request->session()->get('data_merchant')->merchant_id)
                ->where('status','>',2)
                ->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function kirim_barang(Request $request){
        try{
            $data=TrOrderDetail::where('tr_order_detail_id',$request->id)->update([
                'status'=> 4,
                'tgl_dikirim' => date('Y-m-d H:i:s'),
                'status_pengiriman' => "SUDAH DI KIRIM"
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function di_terima(Request $request){
        try{
            $data=TrOrderDetail::where('tr_order_detail_id',$request->id)->update([
                'status'=> 5,
                'rating' =>$request->rating,
                'review' => $request->review,
                'tgl_diterima' => date('Y-m-d H:i:s'),
                'status_pengiriman' => "SUDAH DI TERIMA"
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function logout(Request $request){
        $request->session()->forget('data_merchant');
        return redirect('/');
    }
    
    public function edit(Request $request){
        try{
        
            $data=MerchantModel::where('merchant_id',$request->session()->get('data_merchant')->merchant_id)
            ->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    } 
    
    public function ubah_password(Request $request){
        try{
            $data=MerchantModel::where('merchant_id',$request->session()->get('data_merchant')->merchant_id)
            ->update([
                'password' => md5($request->password)
            ]);
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
}
