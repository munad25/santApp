	<footer class="page-footer blue darken-3">

		<div class="row">
			<div class="col s3 center-align ">
				<a href="{{url('pageClient')}}">
					<span class="font-action"><i class="fas fa-home"></i></span>
					<div class="action-label">home</div>
				</a>
			</div>

			<div class="col s3 center-align ">
				<a href="{{url('project')}}">
					<span class="font-action"><i class="fas fa-clipboard-list"></i></span>
					<div class="action-label">Daftar Project</div>
				</a>
			</div>

			<div class="col s3 center-align ">
				<a href="{{url('negoa')}}">
					<span class="font-action"><i class="fas fa-comments-dollar"></i></span>
					<div class="action-label">Negosiasi</div>
				</a>
			</div>

			<div class="col s3 center-align ">
				<a href="{{url('user-setting')}}">
					<span class="font-action"><i class="fas fa-user-cog"></i></span>
					<div class="action-label">Akun</div>
				</a>
			</div>
		</div>

	</footer>
	<script src="assets/js/jquery-3.4.0.min.js"></script>
	<script src="assets/fontawesome/js/fontawesome.min.js"></script>
	<script src="assets/materialize/js/materialize.min.js"></script>
	@yield('script')
	
</body>
</html>