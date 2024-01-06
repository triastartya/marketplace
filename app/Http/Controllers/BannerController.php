<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    //
    public function get_all(){
        $data = BannerModel::where('aktif',1)->get();
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function detail(Request $request){
        $data = BannerModel::where('id',$request->id)->first();
        return view('administrator.banner.input',$data);
    }
    
    public function create(Request $request){
        try{
            $upload_image_name = '';
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-banner.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/banner/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
                $request->request->add(['gambar'=>$upload_image_name]);
            }else{
                $request->request->add(['gambar'=>'']);
            }
            $request->request->add([
                'uuid'=>Str::uuid(),
                'slug'=>str_replace(" ", "-", $request->judul)
            ]);
            $data = BannerModel::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function update(Request $request){
        try{
            $data = BannerModel::where('id',$request->id);
            $upload_image_name = '';
            if($request->hasFile('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-banner.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/banner/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
                $request->request->add(['image'=>$upload_image_name]);
            }            
            $data->update([
                "judul" => $request->judul,
                "detail" => $request->detail,
                "gambar" => $upload_image_name,
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function delete(Request $request){
        try{
            $data = BannerModel::where('id',$request->id);            
            $data->update([
                "aktif" => 0
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
}
