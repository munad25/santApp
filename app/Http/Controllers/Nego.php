<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\negosiasi;

class Nego extends Controller
{
    public function index(){
    	return view('santClient/negoIndex');
    }


    public function getAll(){
    	$id_client = session()->get('data.id_user');

    	$get_data = negosiasi::join('project', 'negosiasi.id_project', '=', 'project.id_project')
                             ->where('negosiasi.status_nego', 0)
    						 ->where('project.id_client', $id_client)
                             ->orderBy('negosiasi.id_nego', 'DESC')
    						 ->get()
    						 ->toArray();

        
       

    	echo json_encode($get_data);
    	
    }

    public function getOne($id){
    	$get_data = negosiasi::join('project', 'negosiasi.id_project', '=', 'project.id_project')
    						 ->join('rincian_project', 'project.id_project', '=', 'rincian_project.id_project')
    						 ->where('project.id_project', $id)
                             ->limit(1)
    						 ->get()
    						 ->toArray();
    	echo json_encode($get_data);

    }

    public function negoCancel($id){
        negosiasi::where('id_project', $id)->update([
            'status_nego' => 2
        ]);

        echo json_encode(['status' => 'success']);
    }

    public function negoUpdate($id, Request $request){
        $user = session()->get('data.username');
        negosiasi::where('id_project', $id)->update([
            'negosiator' => $user,
            'harga_nego' => $request->harga
        ]);

        echo json_encode(['status' => 'success']);
       // echo  $request->harga;
    }

    public function negoJadi($id){
        negosiasi::where('id_project', $id)->update([
            'status_nego' => 1
        ]);

        echo json_encode(['status' => 'success']);
    }


}
