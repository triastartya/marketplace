<?php

namespace App\Http\Controllers;

use App\Models\MasterCounter;
use App\Models\KeranjangBelanjaModel;
use App\Models\TrOrder;
use App\Models\TrOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    //
    public function buat_order(Request $request){
        try{
            DB::beginTransaction();
            $data = TrOrder::create([
                'tanggal_order' => date("Y-m-d"),
                'uuid' => Str::uuid(),
                'no_invoice' => $this->getNoInvoice(),
                'member_id' => $request->session()->get('data_member')->member_id,
                'keterangan' => '',
                'total_bayar' => $request->total,
                'jml' => $request->jml,
                'status' => 1,
                'status_bayar' =>'BELUM DI BAYAR',
                'bukti_transfer' => ''
            ]);
            
            foreach($request->detail as $detail){
                $insert_detail = TrOrderDetail::create([
                    'tr_order_id' => $data->id,
                    'no_order' => $this->getNoOrder(),
                    'qty' => $detail['qty'],
                    'harga' => $detail['harga'],
                    'total_harga' =>$detail['qty'] * $detail['harga'],
                    'member_id' => $detail['member_id'],
                    'merchant_id'=>$detail['merchant_produk']['merchant_id'],
                    'merchant_produk_id' => $detail['merchant_produk_id'],
                    'status' => 1,
                    'status_pengiriman' => 'BELUM DI BAYAR',
                    'rating' => 0,
                    'review' => ''
                ]);
                $delete_keranjang_belanja = KeranjangBelanjaModel::where('id',$detail['id'])->delete();
            }
            DB::commit();
            return response()->json(['status'=>true,'message'=>'berhasil buat pesanan silahkan lanjut ke pembayaran','data'=>$data]);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function getNoInvoice(){
           $update_master_counter = MasterCounter::where('keterangan','invoice')->lockForUpdate()->first();
            if($update_master_counter){
                $update_master_counter->counter = $update_master_counter->counter+1;
            }else{
                $update_master_counter->counter = 1;
            }
            $update_master_counter->save();
            $nomor = sprintf("%03s",$update_master_counter->counter);
            return 'INV'.date("Ymd").$nomor;
    }
    
    public function getNoOrder(){
        $update_master_counter = MasterCounter::where('keterangan','order')->lockForUpdate()->first();
         if($update_master_counter){
             $update_master_counter->counter = $update_master_counter->counter+1;
         }else{
             $update_master_counter->counter = 1;
         }
         $update_master_counter->save();
         $nomor = sprintf("%03s",$update_master_counter->counter);
         return 'ORD'.date("Ymd").$nomor;
 }
}
