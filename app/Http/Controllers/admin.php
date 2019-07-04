<?php

namespace App\Http\Controllers;

use Session;
use View;
use redirect;
use Input;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Login;
use App\negosiasi;
use App\project;
use App\rincian_project;
use App\client;
use App\progress;

class admin extends Controller
{
  public function __construct()
    {
        // $this->user = Auth::user();
      $this->middleware('login', ['only'=>['user']]);
    }

  public function index()
  {
    session_start();
    $data = project::orderBy('id_project','DESC')->get();

    $notif = project::where('seen','=','0')->count();

    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('page',['username'=>Session::get('username'),'data'=>$data,'notif'=>$notif]);
        }
  }

  // public function pindah($sesi,$w)
  // {
  //   return view('page');
  // }

  public function signin()
  {
    session_start();
    if(Session::get('username')){
            return redirect('pageAdmin')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('login');
        }
  }

  public function login(Request $request)
  {
    session_start();
    // $data = array(
    //   'username'=>$request->username,
    //   'password'=>$request->password,
    //   // 'id_client'=>$request->id_client,
    // );
    $username = $request->username;
    $password = $request->password;

    $data = Login::where('username',$username)->first();
        if($data){
            if(Hash::check($password,$data->password)){
                if ($data->level===1) {
                  Session::put('username',$data->username);
                  Session::put('login',TRUE);
                  return redirect('pageAdmin');
                }else{
                  return view('#');
                }
}
            // }
            // else{
            //     return redirect('loginAdmin')->with('alert','Password atau Email, Salah !');
            // }
          }else{
                return redirect('loginAdmin')->with('alert','Password atau Email, Salah !');
            }
  }

  public function ordered()
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $data = project::orderBy('id_project','DESC')->get();

    $notif = project::where('seen','=','0')->count();

    return view('ordered',compact('data','notif'));
  }

  public function orderedNeh($id_project=NULL)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $cek = project::where('id_project','=',$id_project)->count();
    if (!empty($id_project) || $cek == '1') {
    $project = project::where('id_project','=',$id_project)->get();
    $data = project::orderBy('id_project','DESC')->get();
    $rinci = rincian_project::where('id_project','=',$id_project)->get();
    $client = client::where('id_client','=',$project[0]->id_client)->get();

    $notif = project::where('seen','=','0')->count();
    project::where('id_project','=',$id_project)->update(['seen'=>1]);
    return view('orderedNeh',compact('project','rinci','client','notif','data'));
  }else{
    return redirect('/ordered');
  }
  }

  public function orderedkuy($id_project,$status)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $cek = project::where('id_project','=',$id_project)->count();
    if (!empty($id_project) || $cek == '1') {
      $rinci = rincian_project::where('id_project','=',$id_project)->get();
      if ($status == '0' || $status == '1' || $status == '2' || $status == '3') {
        rincian_project::where('id_project','=',$id_project)->update(['status_pengerjaan'=>$status]);
        return redirect('/orderby/'.$id_project);
      }else{
        return redirect('/orderby');
      }
  }else{
    return redirect('/ordered');
  }
  }

  public function kodeotomatis($field,$lebar=0,$awalan='')
   {
     session_start();
		 $hasil = project::orderBy($field,'DESC');
		 	if(!$hasil) die('gagal auto number query:'.mysqli_error());
		 		$jumlahrecord= $hasil->count();
		 		if($jumlahrecord == 0)
		 			$nomor=1;
		 		else
		 		{
		 	$row= $hasil->first();
		 	$nomor=intval(substr($row->id_project,strlen($awalan)))+1;
		 	}
		 	if($lebar>0)
		 		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
			 	else
			 	$angka = $awalan.$nomor;
			 	return $angka;
		 	}

  public function nego($id_project=NULL)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    if ($id_project != NULL) {
    $data = project::orderBy('id_project','DESC')->get();
    $uhh = negosiasi::where('id_project','=',$id_project)->get();
    $username = Session::get('username');
    $status = negosiasi::where([['id_project','=',$id_project],['status_nego','=','1']])->count();

    $notif = project::where('seen','=','0')->count();

    return view('nego',compact('id_project','data','notif','uhh','username','status'));
  }else{
    return redirect('/ordered');
  }
  }

  public function negokuy($id_project,$status)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $cek = project::where('id_project','=',$id_project)->count();
    if (!empty($id_project) || $cek == '1') {
      $nego = negosiasi::where('id_project','=',$id_project)->get();
      $harganya = negosiasi::where('id_project','=',$id_project)->orderBy('id_nego','DESC')->first();
      if ($status == '0' || $status == '1') {
        negosiasi::where('id_project','=',$id_project)->update(['status_nego'=>$status]);
        rincian_project::where('id_project','=',$id_project)->update(['harga'=>$harganya['harga_nego']]);
        return redirect('/nego/'.$id_project);
      }else{
        return redirect('/nego');
      }
  }else{
    return redirect('/nego');
  }
  }

  public function masukNego(Request $request, $id_project)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
      $harga = $request->harga;

      $insert = negosiasi::insert(
        ['id_nego' => '0', 'id_project' => $id_project, 'negosiator' => 'admin', 'harga_nego' => $harga, 'status_nego' => '0']
      );
      if ($insert) {
        return redirect("nego/{$id_project}")->with(['sukses' => 'Input Data Harga Nego Berhasil']);
      }else{
        return redirect("nego/{$id_project}")->with(['gagal' => 'Input Data Harga Nego Gagal']);
      }

  }

  public function progress($id_project)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
      $rinci = rincian_project::where('id_project','=',$id_project)->get();
      $proses = progress::where('id_project','=',$id_project)->get();
      $data = project::orderBy('id_project','DESC')->get();


    return view('progress', compact('id_project','rinci','proses','data'));
  }

  public function Input(Request $request, $id_project)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $waktu_mulai = $request->waktu_mulai;
    $waktu_selesai = $request->waktu_selesai;
    $bar = $request->bar;
    $tanggal = $request->tanggal;
    $keterangan = $request->keterangan;
    $foto = $request->file('foto');
    $namefile = $foto->getClientOriginalName();
    $foto->move('../public/uploadFoto/',$namefile);

    progress::insert(['id_progress' => '0', 'id_project' => $id_project, 'tanggal' => date('Y-m-d H:i:s'), 'keterangan' => $keterangan, 'foto' => $namefile]
  );
    rincian_project::where('id_project','=',$id_project)->update(['bar'=>$bar, 'waktu_mulai'=>$waktu_mulai, 'waktu_selesai'=>$waktu_selesai]);

    if ($bar == 100) {
      rincian_project::where('id_project','=',$id_project)->update(['status_pengerjaan'=>'1']);
      return redirect("orderby/{$id_project}");
    }

  return redirect("/progress/{$id_project}");
  }

  public function kelar()
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $rinci = rincian_project::where('bar','=',100)->get();
    $data = project::orderBy('id_project','DESC')->get();

    return view('finish', compact('rinci','data'));
  }

  public function data()
  {
    session_start();
    if(!Session::get('username')){
            return redirect('loginAdmin')->with('alert','Kamu harus login dulu');
        }
    $users = DB::table('client')->get();
    $data = project::orderBy('id_project','DESC')->get();

    return view('data', compact('users','data'));
  }

  public function logout(){
       Session::flush();
       return redirect('loginAdmin')->with('alert','Kamu sudah logout');
   }


}
