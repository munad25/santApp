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
          <span class="badge red">{{$notif}}</span> <i class="fas fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          </a>
          @foreach ($data as $isi)
            <a class="dropdown-item" href="/ordered/{{ $isi->id_project}}">

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

  </header>
  <br>
  <body class="fixed-sn grey-skin">
       <main>
        <div class="container">
              <section class="mb-4">

            <div class="card">
              <div class="card-body d-flex justify-content-between">
                <h4 class="h4-responsive mt-3">Project #{{ $project[0]->id_project }}</h4>

                <div>
                  @if ($rinci[0]->status_pengerjaan==0)
                    <span class="badge badge-warning">Tertunda</span>
                    <a href="/orderby/{{$project[0]->id_project}}/2" class="btn btn-sm btn-success"> Terima</a>
                    <a href="/orderby/{{$project[0]->id_project}}/3" class="btn btn-sm btn-danger"> Batalkan</a>
                  @elseif ($rinci[0]->bar == 100 || $rinci[0]->status_pengerjaan==1)
                    <span class="badge badge-success">Sukses</span>
                    <a href="/progress/{{$isi->id_project}}" class="btn btn-warning"> Cek Progress</a>
                  @elseif ($rinci[0]->status_pengerjaan==2)
                    <a href="/nego/{{ $isi->id_project}}" class="btn btn-primary"> Negosiasi</a>
                    <a href="/progress/{{$isi->id_project}}" class="btn btn-warning"> Cek Progress</a>
                  @elseif ($rinci[0]->status_pengerjaan==3)
                    <span class="badge badge-danger">Batal</span>
                  @endif
                  <a href="#" class="btn btn-primary" id="cetak"> Cetak</a>
                </div>

          </div>
        </div>

      </section>

      <section class="mb-5">

        <div class="card">
          <div class="card-body">
            <print id="areaprint">
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>ID</td>
                    <td>{{$project[0]->id_project}}</td>
                  </tr>
                  <tr>
                    <td>Jenis Project</td>
                    <td>{{$project[0]->jenis_project}}</td>
                  </tr>
                  <tr>
                    <td>Nama Perusahaan</td>
                    <td>{{$client[0]->nama_client}}</td>
                  </tr>
                  <tr>
                    <td>Jenis Client</td>
                    <td>{{$client[0]->jenis_client}}</td>
                  </tr>
                  <tr>
                    <td>Deskripsi</td>
                    <td>{{$rinci[0]->keterangan}}</td>
                  </tr>
                  @if ($rinci[0]->waktu_mulai == '1111-11-11')
                    <tr>
                      <td>Tanggal Mulai</td>
                      <td>--,--,--</td>
                    </tr>
                    <tr>
                      <td>Tanggal Selesai</td>
                      <td>--,--,--</td>
                    </tr>
                  @else
                    <tr>
                      <td>Tanggal Mulai</td>
                      <td>{{$rinci[0]->waktu_mulai}}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Selesai</td>
                      <td>{{$rinci[0]->waktu_selesai}}</td>
                    </tr>
                  @endif
                  <tr>
                    <td>Harga Deal</td>
                    <td>{{$rinci[0]->harga}}</td>
                  </tr>

                </tbody>
              </table>
            </print>
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
    <script type="text/javascript" src="{{url('')}}/js/addons/datatables.min.js"></script>
    <script>
      $(document).ready(function(){
          $("#cetak").click(function(){
              var mode = 'iframe'; //popup
              var close = mode == "popup";
              var options = { mode : mode, popClose : close};
              $("print#areaprint").printArea( options );
          });
      });
      </script>
             <script type="text/javascript">
             $(document).ready(function() {
               setTimeout(function() {
               // Material Design example
               $('#example').DataTable();
               $('#example_wrapper').find('label').each(function () {
               $(this).parent().append($(this).children());
               });
               $('#example_wrapper .dataTables_filter').find('input').each(function () {
               // $('input').attr("placeholder", "Search");
               // $('input').removeClass('form-control-sm');
               });
               $('#example_wrapper .dataTables_length').addClass('d-flex flex-row');
               $('#example_wrapper .dataTables_filter').addClass('md-form');
               $('#example_wrapper select').removeClass(
               'custom-select custom-select-sm form-control form-control-sm');
               $('#example_wrapper select').addClass('mdb-select');
               $('#example_wrapper .mdb-select').materialSelect();
               $('#example_wrapper .dataTables_filter').find('label').remove();
             }, 100);
             } );
           </script>

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
