@extends('santClient.layout.index')

@section('style')
	<link rel="stylesheet" href="assets/css/homeStyle.css?v=4">			
@endsection

@section('body')	
 
	<div class="row add-project" id="homeListProject">
		<div class="col s12">
			<div class="card ">
				<div class="card-content">
					<span class="card-title">{{$username}} </span>
				</div>
			</div>
		</div>
	</div>

	<section class="row list-project" id="homeListProject">
		<div class="col s12">
			<div class="card ">
				<div class="card-content">
					<span class="card-title">Profile Perusahaan</span>
					<div class="divider"></div>
					<ul>
						<li class="my-list"><label>Nama Perusahaan</label>:</li>
						<li class="my-list"><label>Contact Person</label>:</li>
						<li class="my-list"><label>Email</label>:</li>
						<li class="my-list"><label>Alamat</label>:</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col s12">
			<div class="card ">
				<div class="card-content">
					<span class="card-title">Daftar Project</span>
					<div class="divider"></div>
					<ul>
						<li class="my-list"><label>Jumlah Project</label>: {{$total_project}}</li>
						<li class="my-list"><label>Negosiasi</label>: {{$jumlah_nego}}</li>
						<li class="my-list"><label>Diproses</label>: {{$on_progress}}</li>
						<li class="my-list"><label>Selesai</label>:</li>
						<li class="my-list"><label>Project Gagal</label>: {{$cancel}}</li>
					</ul>
				</div>
			</div>
		</div>
	</section>


@endsection
	

