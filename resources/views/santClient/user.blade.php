@extends('santClient.layout.index')

@section('style')
	<link rel="stylesheet" href="assets/css/homeStyle.css?v=4">			
@endsection

@section('body')
	<div class="row add-project" id="homeListProject">
		<div class="col s12">
			<div class="card ">
				<div class="card-content">
					<ul class="collection">
						<li class="collection-item"><a href="{{url('logout-client')}}">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection