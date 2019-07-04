<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loginModel;
use Illuminate\Support\Facades\DB;
use App\project;
use Validator;



class projectController extends Controller
{   

    function get_id_user(){
        return session()->get('data.id_user');
    }

    public function index(){
    	return view('santClient/daftarproject');
    }

    public function getAll(){
    	$id_user = session()->get('data.id_user');

        $get_data = project::join('rincian_project', 'project.id_project', '=', 'rincian_project.id_project')
                            ->where('id_client', $id_user)
                            ->get()
                            ->toArray();

    	echo json_encode($get_data);

    }

    public function getOne($id){
        $data = project::join('rincian_project', 'project.id_project', '=', 'rincian_project.id_project')
                    ->where('project.id_project', $id)
                    ->get()
                    ->toArray();

        echo json_encode($data);
    }

    public function getProgress($id){
        $data = DB::table('progress')
                ->join('project', 'progress.id_project', '=', 'project.id_project')
                ->where('project.id_project', $id)
                ->where('project.id_client', $this->get_id_user())
                ->get()
                ->toArray();

        echo json_encode($data);
    }

    public function addProject(Request $request){
         $validator = Validator::make($request->all(),[
            'jenis_project'  => 'required',
            'deskripsi' => 'required',
        ]);

         if($validator->fails()){
            $data = [
                'status' => 'failed',
                'mesage' => $validator->errors()->toArray()
            ];

            echo json_encode($data);
         }else{


            $id_project = $this->kodeProject('id_project', 4, 'PRJ');
           DB::table('project')->insert([
                'id_project' => $id_project,
                'id_client'  => session()->get('data.id_user'),
                'jenis_project' => $request->jenis_project,
                'seen'        => 0
            ]);

           DB::table('rincian_project')->insert([
                'id_project' => $id_project,
                'rincian_project' => $request->jenis_project,
                'keterangan'      => $request->deskripsi
           ]);

             $data = [
                'status' => 'success',
            ];

            echo json_encode($data);
         }
    }

    public function kodeProject($field, $lebar=0, $awalan=''){
        $hasil = project::orderBy($field, 'DESC');
        $jumlahRecord = $hasil->count();

        if($jumlahRecord == 0){
            $nomor = 0;
        }else{
            $row = $hasil->first();
            $nomor = intval(substr($row->id_project, strlen($awalan)))+1;
        }

        if($lebar>0){
            $angka = $awalan.str_pad($nomor, $lebar, 0, STR_PAD_LEFT);
        }
        else{
            $angka = $awalan.$nomor;
        }

        return $angka;
    }

}
