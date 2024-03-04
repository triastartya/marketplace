<?php

namespace App\Http\Controllers;

use App\Models\KeranjangBelanjaModel;
use App\Models\MemberAlamatModel;
use App\Models\MemberModel;
use App\Models\MerchantProdukModel;
use App\Models\TrOrder;
use App\Models\TrOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    //
    public function daftar_member(Request $request){
        try{
            $uuid = Str::uuid();
            $request->request->add(['uuid'=>$uuid]);
            $insert = $request->all();
            $insert['password'] = md5($insert['password']);
            unset($insert['confirm']);
            $data = MemberModel::create($insert);
            
            $session = MemberModel::where('uuid',$uuid)->first();
            $request->session()->put('data_member',$session);
            return response()->json(['status'=>true,'data'=>$session]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function login_member(Request $request){
        try{
            $data = MemberModel::where('email',$request->email)->first();
            if($data == null){
                return response()->json(['status'=>false,'message'=>'email tidak di temukan', 'data'=>[]]);    
            }
            
            if($data->password != md5($request->password)){
                return response()->json(['status'=>false,'message'=>'password salah', 'data'=>[]]);
            }
            
            $request->session()->put('data_member',$data);
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function member(Request $request){
        // dd($request->session()->get('data_member'));
        if ($request->session()->has('data_member')) {
            $data = [
                'member' => MemberModel::where('member_id',$request->session()->get('data_member')->member_id)->first(),
            ];
            return view('website/akun',$data);
        }else{
            return redirect('/');
        }
    }
    
    public function tambah_keranjang_belanja(Request $request){
        try{
            // if ($request->session()->get('data_member')->member_id==null) {
            //     return response()->json(['status'=>false,'message'=>"anda belum login", 'data'=>[]]);
            // }
            $produk = MerchantProdukModel::where('uuid',$request->uuid)->first();
            $edit = KeranjangBelanjaModel::where('merchant_produk_id',$produk->merchant_produk_id)
            ->where('member_id',$request->session()->get('data_member')->member_id)
            ->first();
            if($edit){
                $edit->qty = $edit->qty + $request->qty;
                $edit->save();
            }else{
                $data = KeranjangBelanjaModel::create([
                    'member_id'=>$request->session()->get('data_member')->member_id,
                    'merchant_produk_id'=>$produk->merchant_produk_id,
                    'qty'=>$request->qty
                ]);
            }
            return response()->json(['status'=>true,'data'=>null]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function keranjang_belanja(Request $request){
        try{
            $data=KeranjangBelanjaModel::
            with('merchant_produk','merchant_produk.merchant','merchant_produk.merchant_produk_gambar')
            ->where('member_id',$request->session()->get('data_member')->member_id)
            ->get();
            foreach ($data as $key => $item) {
                $data[$key]->checked = false;
                $data[$key]->harga = $item->merchant_produk->harga;
            }
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function get_alamat(Request $request){
        try{
            $data=MemberAlamatModel::where('member_id',$request->session()->get('data_member')->member_id)
                ->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function buat_alamat(Request $request){
        try{
            $data=MemberAlamatModel::create([
                'member_id' => $request->session()->get('data_member')->member_id,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'uuid' => Str::uuid()
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function hapus_alamat(Request $request){
        try{
            $data=MemberAlamatModel::where('uuid',$request->uuid)->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function getOrder(Request $request){
        try{
            $data=TrOrder::with('tr_order_detail.merchant_produk.merchant_produk_gambar','tr_order_detail.merchant_produk.merchant','tr_order_detail.member')
                ->where('member_id',$request->session()->get('data_member')->member_id)
                ->orderBy('status', 'asc')
                ->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function getOrderProduk(Request $request){
        try{
            $data=TrOrderDetail::with('merchant_produk.merchant_produk_gambar','merchant_produk.merchant')
                ->where('member_id',$request->session()->get('data_member')->member_id)
                ->where('status','>',2)
                ->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function upload_bukti_pembayran(Request $request){
        try{
            $upload_image_name = '';
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-bukti_transfer.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/bukti_transfer/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
            }else{
                return response()->json(['status'=>false,'message'=>"file bukti harus di isi", 'data'=>[]]);
            }
        
            $data=TrOrder::where('uuid',$request->uuid)->update([
                'status'=> 2,
                'status_bayar' => 'MENUNGGU VERIFIKASI',
                'tgl_bukti_transfer' => date('Y-m-d H:i:s'),
                'bukti_transfer' => $upload_image_name
            ]);
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function di_terima(Request $request){
        try{
            $data=TrOrderDetail::where('uuid',$request->uuid)->update([
                'status'=> 5,
                'tgl_kirim' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function logout(Request $request){
        $request->session()->forget('data_member');
        return redirect('/');
    }
    
    public function edit(Request $request){
        try{
            $data=MemberModel::where('member_id',$request->session()->get('data_member')->member_id)
            ->update($request->all());
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    } 
    
    public function ubah_password(Request $request){
        try{
            $data=MemberModel::where('member_id',$request->session()->get('data_member')->member_id)
            ->update([
                'password' => md5($request->password)
            ]);
            
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
}
