<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\loginModel;
use App\login;
use Validator;
use Hash;

class loginClient extends Controller
{


    public function index(){
    	return view('santClient/login');
    }

    public function login(Request $request){
    	$username = $request->username;
        $password = $request->password;


        $data = loginModel::where('username', $username)
                            ->where('level', 2)
                            ->first();

        if( !empty($data)){
            if(Hash::check($password, $data->password)){

                   $data_sess = [
                    'id_user'    => $data->id_user,
                    'username'   => $data->username,
                    'level'      => $data->level,
                ];
                session()->put(['data' => $data_sess]);
                echo json_encode(['status' => true]);

            }else{
                $notice = [
                    'status' => false,
                    'field'  => 'password'
                ];

                echo json_encode($notice);
            }

        }else{
            $notice = [
                'status' => false,
                'field'  => 'username'
            ];

            echo json_encode($notice);

        }

    }


    public function logout(Request $request){
    	$request->session()->forget('data');
    	return redirect()->route('login');
    }

    public function regist(){
    	return view('santClient/regist');
    }


    public function storeRegist(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_perusahaan'  => 'required',
            'jenis_perusahaan' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'status' => 'failed',
                'mesage' => $validator->errors()->toArray()
            ];

            echo json_encode($data);
        }else{

            $data = DB::table('users')->get();
            $data = new Login;
            $data->username = $request->username;
            $data->password = bcrypt($request->password);
            $data->level    = 2;
            $data->save();

            DB::table('client')->insert([
                'id_client' => $data->id,
                'nama_client' => $request->nama_perusahaan,
                'jenis_client' => $request->jenis_perusahaan
            ]);

            echo json_encode(['status' => 'success']);
        }

    }

    public function userSetting(){
        return view('santClient/user');
    }

    
}
