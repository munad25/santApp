<html lang="en">
  <head>

    <title>Sants App</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{url('')}}/AAA.jpeg">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/mdb.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/modules/animations-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/print.css" media="print">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/tagify.css">
    <script type="text/javascript" src="{{url('')}}/js/jquery-3.3.1.min.js"></script>

    </head>

<body class="fixed-sn grey-skin">
	<!--Main Navigation-->
  <header>

      <!-- Sidebar navigation -->
      <div id="slide-out" class="side-nav sn-bg-3 fixed">
          <ul class="custom-scrollbar">
          <li>
      <a class="thumbnail">
      <img class="center">
        <img class="" class="img-fluid z-depth-4" src="{{url('')}}/AAA.jpeg" width="134px">

      </a>
          </li>
          <br><br>
          <li>
              <ul class="collapsible collapsible-accordion">

              <p align ="center" <b> SANDI TEKNIK APLIKASI </b></p>
                <li><a href="{{ url('/ordered') }}" class="collapsible-header waves-effect"><i class="fa fa-cubes"></i> Ordered Project</a></li>

                          <li><a href="{{ url('/finish') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-cubes"></i> Complete project</a>
                              <li><a href="{{ url('/dataMember') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-cubes"></i> Data Member </a>
                      {{-- <div class="collapsible-body">
                          <ul>
                              <li><a href="#" class="waves-effect">#</a></li>
                              <li><a href="#" class="waves-effect">#</a></li>
                          </ul>
                      </div> --}}
                  {{-- </li>
                  <li><a href="#" class="collapsible-header waves-effect"></i> #</a></li>
                  <li><a href="#" class="collapsible-header waves-effect"><i class="fa fa-file"></i> #</a></li> --}}
              </ul>

          </li>
          <!--/. Side navigation links -->
          </ul>
          <div class="sidenav-bg mask-strong"></div>
      </div>
      <!--/. Sidebar navigation -->

      <!-- Navbar -->
      <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
          <!-- SideNav slide-out button -->
          <div class="float-left">
              <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
          </div>
          <div class="breadcrumb-dn mr-auto">
              <p>Sants App</p>
          </div>
          <ul class="nav navbar-nav nav-flex-icons ml-auto">
              <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <h4>admin</h4>
          <span class="badge red">1</span> <i class="fas fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">

          @foreach ($data as $isi)
            <a class="dropdown-item" href="/orderby/{{ $isi->id_project}}">

                <span>Project Baru, ID : {{$isi->id_project}}</span><br>

            </a>
          @endforeach
        </div>
      </li>
              <li class="nav-item">
                  <a class="btn btn-outline-info btn-rounded btn-sm waves-effect waves-light" href="{{ url('/logout') }}"><i class="fa fa-sign-out-alt"></i> Keluar</a>
              </li>

          </ul>
          <!--/Navbar links-->
      </nav>
      <!-- /.Navbar -->
      <br>

  </header>



  <body class="fixed-sn grey-skin">
       <main>
        <div class="container">
          <section class="mb-5">
            <h1>Negosiasi Project #{{$id_project}}</h1>
            <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  @if ($status == 0)
                    <form action="/nego/{{$id_project}}" method="post">
                      @csrf
                      <div class="md-form">

                        <input type="number" name="harga" class="form-control">
                        <label>Harga Negosiasi</label>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Nego</button>
                      <a href="/nego/{{$id_project}}/1" onclick="if(!confirm('Apakah Anda Yakin?')) return false;" class="btn btn-success">Setuju?</a>
                    </form>
                  @else
                    <a href="/progress/{{$id_project}}" class="btn btn-warning"> Isi Progress</a>
                  @endif
                  @if ($pesan = Session::get('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{$pesan}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @elseif ($pesan = Session::get('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{$pesan}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-8">
            <div class="card">
              <div class="card-body">

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Harga</th>
                        <th>Negosiator</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($uhh as $yeah)
                        <tr>
                          <td>{{$yeah->harga_nego}}</td>
                          <td>{{$yeah->negosiator}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
            </div>
          </section>
				  </div>
				</div>
        </div>
    </main>


    <script type="text/javascript" src="{{url('')}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{url('')}}/js/mdb.min.js"></script>
    <script type="text/javascript" src="{{url('')}}/js/popper.min.js"></script>
    <script type="text/javascript" src="{{url('')}}/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{url('')}}/js/sweetalert-dev.js"></script>
    <script type="text/javascript" src="{{url('')}}/js/jquery.PrintArea.js"></script>


	<script>
		// $('[name=tags]').tagify();
        // SideNav Initialization
        $(".button-collapse").sideNav();
        var container = document.querySelector('.custom-scrollbar');
        Ps.initialize(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });

        // Data Picker Initialization
        $('.datepicker').pickadate();

        // Material Select Initialization
        $(document).ready(function () {
            $('.mdb-select').material_select();
        });

        // Tooltips Initialization
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>


	<script type="text/javascript">
    	(function() {
		  'use strict';
		  window.addEventListener('load', function() {
		    // Fetch all the forms we want to apply custom Bootstrap validation styles to
		    var forms = document.getElementsByClassName('needs-validation');
		    // Loop over them and prevent submission
		    var validation = Array.prototype.filter.call(forms, function(form) {
		      form.addEventListener('submit', function(event) {
		        if (form.checkValidity() === false) {
		          event.preventDefault();
		          event.stopPropagation();
		        }
		        form.classList.add('was-validated');
		      }, false);
		    });
		  }, false);
		})();
    </script>
</body>
</html>
