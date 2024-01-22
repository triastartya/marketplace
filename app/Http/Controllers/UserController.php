<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function get_all(){
        $data = User::all();
        return response()->json(['status'=>true,'data'=>$data]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('data_user');
        return redirect('/');
    }

    public function login(Request $request)
    {
        try {
            $checkUsername = User::where('email', $request->username)->first();
            if ($checkUsername) {
                if(md5($request->password)==$checkUsername->password){
                    $request->session()->put('data_user', $checkUsername);
                    return Response()->json([
                        'status' => true,
                        'message' => null,
                        'data' => $checkUsername,
                    ]);
                }else{
                    return Response()->json([
                        'status' => false,
                        'message' => 'Password Salah',
                        'data' => null,
                    ]);
                }
            } else {
                return Response()->json([
                    'status' => false,
                    'message' => 'email Tidak Di Temukan',
                    'data' => null,
                ]);
            }
        } catch (\Exception $exception) {
            return Response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $data = new User();
            $data->email = $request->email;
            $data->password = md5($request->password);
            $data->name = $request->name;
            $data->uuid = Str::uuid();
            $data->save();
            return Response()->json([
                'status' => true,
                'message' => null,
                'data' => $data,
            ]);
        } catch (\Exception $exception) {
            return Response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = User::where('id', $request->id)->first();
            $data->email = $request->email;
            $data->name = $request->name;
            $data->save();
            return Response()->json([
                'status' => true,
                'message' => null,
                'data' => $data,
            ]);
        } catch (\Exception $exception) {
            return Response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = User::where('id', '=', $request->id)->delete();
            return Response()->json(['status' => true, 'message' => null], 201);
        } catch (\Exception $exception) {
            return Response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ]);
        }
    }
}
