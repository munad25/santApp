@extends('santClient.layout.index')
@section('style')
	<link rel="stylesheet" href="assets/css/homeStyle.css?v=4">			
	<link rel="stylesheet" href="assets/css/negoStyle.css?v=4">			
@endsection
@section('body')

	<div class="row add-project">
		<div class="col s12">
			<div class="card-panel center-block">Daftar Negosiasi Project</div>
		</div>
	</div>

	<section class="row list-project" id="homeListNego">
		
		
	</section>

@endsection

@section('sidenav')
	<div class="sidenav my-sidenav" id="myNavbar">
		<div class="right close-nav-button"><i class="far fa-times-circle"></i></div>

	</div>
@endsection
@section('modal')
	<div id="negoModal" class="modal">
		<div class="modal-content">
			
		</div>
		<div class="modal-footer">
			<a href="#!" class="waves-effect waves-green btn-flat" id="btnN">Cancel</a>
			<a href="#!" class="waves-effect waves-green btn-flat" id="btnY">Nego</a>
		</div>
	</div>
@endsection
	
@section('script')
	<script src="assets/js/negoindex.js?v=2"></script>
@endsection

