<?php

namespace App\Http\Controllers;

use App\Models\TrOrder;
use App\Models\TrOrderDetail;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    //
    public function Order(Request $request){
        try{
            if($request->status!=0){
                $data = TrOrder::with('member')->where('status',$request->status)->get();                        
            }else{
                $data = TrOrder::all();            
            }
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function konfirmasi(Request $request){
        try{
            $data = TrOrder::with('member')->where('status',2)->get();                        
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function verifikasi(Request $request){
        try{
            $data = TrOrder::where('uuid',$request->uuid)->update([
                'user_id_verifikasi' => 1,//$request->session()->get('data_user')->id,
                'tgl_verifikasi' => date('Y-m-d H:i:s'),
                'status' =>3,
                'status_bayar' => 'SUDAH DI BAYAR',
            ]);                        
            $data_order = TrOrder::where('uuid',$request->uuid)->first();
            // dd($data_order);
            $detail = TrOrderDetail::where('tr_order_id',$data_order->tr_order_id)->update([
                'status'=>3,
                'status_pengiriman'=> 'SUDAH DI BAYAR'
            ]);
        
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function pengajuan_pencairan_dana(Request $request){
        try{
            $data = TrOrderDetail::with('merchant','order','merchant_produk')->where('status',5)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function history_pembayaran(Request $request){
        try{
            $data = TrOrderDetail::with('merchant','order','merchant_produk')->where('status',6)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function pencairan(Request $request){
        try{

            $upload_image_name = '';
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-bukti_cair.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/bukti_cair/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
            }else{
                return response()->json(['status'=>false,'message'=>"file bukti harus di isi", 'data'=>[]]);
            }
        
            $data = TrOrderDetail::where('tr_order_detail_id',$request->id)->update([
                'tgl_cair' => date('Y-m-d H:i:s'),
                'status' => 6,
                'status_pengiriman' => 'DANA SUDAH CAIR',
                'bukti_transfer' => $upload_image_name,
                'user_id_cair' =>1
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
}
