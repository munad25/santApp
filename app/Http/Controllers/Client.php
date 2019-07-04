<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Client extends Controller
{
    public function index(){
    	$username = session()->get('data.username');
    	$id_user = session()->get('data.id_user');
    	
    	$total_project = DB::table('project')->count();
    	$jumlah_nego = DB::table('project')
    					->join('negosiasi', 'project.id_project', '=', 'negosiasi.id_project')
    					->where('status_nego', 0)
    					->where('project.id_client', $id_user)
    					->count();

		$on_progress = DB::table('project')
					->join('negosiasi', 'project.id_project', '=', 'negosiasi.id_project')
					->where('status_nego', 1)
					->where('project.id_client', $id_user)
					->count();

		$cancel= DB::table('project')
			->join('negosiasi', 'project.id_project', '=', 'negosiasi.id_project')
			->where('status_nego', 2)
			->where('project.id_client', $id_user)
			->count();

    	// dd($total_project);

    	$data = [
    		'username' => $username,
    		'total_project' => $total_project,
    		'jumlah_nego' 	=> $jumlah_nego,
    		'on_progress'	=> $on_progress,
    		'cancel'		=> $cancel
    	];

    	return view('santClient/home', $data);

    }

}
