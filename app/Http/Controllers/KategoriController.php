<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    //
    public function get_all(){
        $data = KategoriModel::where('aktif',1)->get();
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function create(Request $request){
        try{
            $upload_image_name = '';
            if($request->file('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-kategori.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/kategori/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
                $request->request->add(['image'=>$upload_image_name]);
            }else{
                $request->request->add(['image'=>'']);
            }
            $request->request->add(['uuid'=>Str::uuid()]);
            $data = KategoriModel::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function update(Request $request){
        try{
            $data = KategoriModel::where('kategori_id',$request->kategori_id);
            $upload_image_name = '';
            if($request->hasFile('file')){
                unlink(public_path('images/kategori/'.$data->image));
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-kategori.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/kategori/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
                $request->request->add(['image'=>$upload_image_name]);
            }            
            $data->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
    
    public function delete(Request $request){
        try{
            $data = KategoriModel::where('kategori_id',$request->kategori_id);            
            $data->update([
                "aktif" => 0
            ]);
            return response()->json(['status'=>true,'data'=>$data]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }    
}
