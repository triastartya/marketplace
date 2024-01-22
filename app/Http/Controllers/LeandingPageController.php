<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Models\KategoriModel;
use App\Models\MerchantProdukModel;
use App\Models\PageModel;
use Illuminate\Http\Request;

class LeandingPageController extends Controller
{
    //
    public function index(){
        $data = [
            'page'=> PageModel::where('id',1)->first(),
            'kategoris'=> KategoriModel::where('aktif',true)->get(),
            'produks'=> MerchantProdukModel::with('merchant_produk_gambar','kategori','merchant')
                ->where('delete',0)
                ->orderBy('terjual', 'desc')
                ->offset(0)
                ->limit(12)->get(),
            'banners' => BannerModel::all(),
        ];
        return view('website/leanding_page',$data);
    }
    
    public function detail(Request $request){
        $data = MerchantProdukModel::with('merchant_produk_gambar','kategori','merchant',
            'order.member')
            ->where('uuid',$request->uuid)
            ->where('delete',0)
            ->first();
        //dd($data);
        return view('website/detail_produk',['produk'=>$data]);
    }
}
