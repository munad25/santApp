@extends('santClient.layout.index')
@section('style')
	<link rel="stylesheet" href="assets/css/homeStyle.css?v=4">			
	<link rel="stylesheet" href="assets/css/project.css?v=4">			
@endsection
@section('body')
	<div class="row add-project">
		<div class="col s12">
			<div class="card-panel center-block">Tambah Project <i class="fas fa-plus right"></i></div>
		</div>
	</div>

	<section class="row list-project" id="homeListProject">
		<div class="col s12">
			<div class="card ">
				<div class="card-content">
					<span class="card-title">Ini project pertama</span>
					<div class="divider"></div>
					<ul>
						<li class="my-list"><label>Waktu Tenggang</label>:</li>
						<li class="my-list"><label>Status</label>:</li>
					</ul>
				</div>
			</div>
		</div>
		
	</section>

	@endsection

	@section('sidenav')

	<div class="sidenav my-sidenav" id="myNavbar">
		<div class="right close-nav-button"><i class="far fa-times-circle"></i></div>
		<div class="row">
			<div class="col s12 center-block">
				<img src="assets/image/AAA.jpeg" alt="logo" class="responsive-img center-block">
			</div>
		</div>

		<div class="row">
			<div class="col s10 offset-s1 center-align">
				<h5 id="title-nav">Ajukan Project Baru</h5>
			</div>
		</div>
		<div class="row" id="form-container">
			<div class="col s10 offset-s1">

				<div class="row">
					<form action="{{url('add-project')}}" method="post" id="formAddProject">
						@csrf
					<div class="col s12 input-field">
						<select name="jenis_project" id="jenis_project" class="validate">
							<option value="" disabled selected>Pilih Kategori Project</option>
							<option value="CLeaning">Cleaning</option>
							<option value="Construction">Construktion</option>
							<option value="Electrical">Electrical</option>
							<option value="Mechanical">Mechanical</option>
							<option value="Sipil">Sipil</option>
						</select>						
					</div>

					<div class="input-field col s12">
						<textarea id="deskripsi" class="materialize-textarea validate" data-length="150" name="deskripsi"></textarea>
						<label for="deskripsi">Deskripsi Project</label>
					</div>
		

					</form>
				</div>

				<div class="row">
					<div class="col s8 offset-s2">
						<button class="btn waves-effect waves-light my-btn-submit" type="submit" name="action" id="btnAddProject">Ajukan</button>

					</div>
				</div>

			</div>
		</div>
	</div>

	@endsection

	@section('modal')
	<div id="modalProgress" class="modal">
		<div class="modal-content">
			<ul class="collapsible">
				
			</ul>
		</div>
		<div class="modal-footer">
			<a href="#!" class="waves-effect waves-green btn-flat" id="btn-close-progress">TUTUP</a>
		</div>
	</div>


	<div id="modalDetail" class="modal">
		<div class="modal-content">
			
		</div>
		<div class="modal-footer">
			<a href="#!" class="waves-effect waves-green btn-flat" id="btn-close-detail">TUTUP</a>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="assets/js/project.js"></script>
	@endsection
