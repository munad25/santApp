<?php

namespace App\Http\Middleware;

use Closure;
use App\loginModel;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $username = $request->username;
        $password = $request->password;

        $get_username = loginModel::where('username', $username)->get()->toArray();

        if( empty($get_username)){
            $notice = [
                'status' => false,
                'field'  => 'username'
            ];

            echo json_encode($notice);
        }

        $get_password = loginModel::where('password', $password)->get()->toArray();
        if(!empty($get_username)  && empty($get_username)){
            $notice = [
                'status' => false,
                'field'  => 'password'
            ];

            echo json_encode($notice);
        }


        $get_data = loginModel::where('username', $username)->where('password', $password)->get()->toArray();

        if(!empty($get_data)){
            $data = [
                'id_user'    => $get_data[0]['id_user'],
                'username'   => $get_data[0]['username'],
                'level'      => $get_data[0]['level'],
                'id_client'  => $get_data[0]['id_client']
            ];
            session()->put(['data' => $data]);

            echo json_encode(['status' => true]);
        }
        
        return $next($request);
    }
}
