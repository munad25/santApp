<?php
session_start();
include '../func/func.php';
$konfig = konfig();
$konek = koneksi();
if(!isset($_SESSION['username'])) {
    header('location:'.$konfig['url'].'/inihaladmin/login.php');
}
?>
<?php include 'inc/header.php'; ?>

    <main>
        <div class="container">
          <!--Card-->
                      <div class="card card-cascade wider reverse my-4 pb-5">

                          <!--Card image-->
                          <div class="view view-cascade overlay wow fadeIn">
                              <!-- <img src="<?=$konfig['url']?>/assets/img/banner kain.jpg" class="img-fluid" style="height: 450px; width: 100%;"> -->
                              <a href="#!">
                                  <div class="mask rgba-white-slight"></div>
                              </a>
                          </div>
                          <!--/Card image-->

                          <!--Card content-->
                          <div class="card-body card-body-cascade text-center wow fadeIn" data-wow-delay="0.2s">
                              <!--Title-->
                              <h4>Selamat Datang Di <?=$konfig['judul']?> <?=$konfig['perusahaan']?></h4>

                          </div>
                          <!--/.Card content-->

                      </div>
                      <!--/.Card-->
        	<section class="mt-lg-5">
                <div class="row mt-5 pt-5">
                    <div class="col text-center">    
                        <div class="row">
                          	

                          </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

   <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/js/mdb.min.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/js/popper.min.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/sa/sweetalert.min.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/sa/sweetalert-dev.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/admin/js/jquery.PrintArea.js"></script>
	<script>
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
</body>
</html>