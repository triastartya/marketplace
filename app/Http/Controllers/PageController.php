<?php

namespace App\Http\Controllers;

use App\Models\PageModel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function get(){
        $data = PageModel::where('page_id',1)->first();
        return view('administrator.page',$data);
    }
    
    public function update(Request $request){
        try{
            $upload_image_name = '';
            if($request->hasFile('file')){
                $upload_image = $request->file('file');
                $upload_image_name = rand().'-logo.'.$upload_image->getClientOriginalExtension();
                $upload_image->move(public_path('images/logo/'), $upload_image_name);
                $insert['image'] = $upload_image_name;
                $request->request->add(['image'=>$upload_image_name]);
            }            
            
            $update = PageModel::where('page_id',1)->update([
                'nama'=>$request->nama,
                'logo'=>$upload_image_name,
                'tentang'=>$request->tentang
            ]);
            return response()->json(['status'=>true,'data'=>$update]);
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage(), 'data'=>[]]);
        }
    }
}
