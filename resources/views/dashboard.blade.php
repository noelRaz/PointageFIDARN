@include('layouts.app')
@section('content')
<!-- Main content -->
<?php if(Auth::user()->role == '1') {?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item active"></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/pointage" active="request()->routeIs('index')">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-qrcode"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Scanner le QR Code</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/pointpersonnel" active="request()->routeIs('Pointpers')">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="far fa-list-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Liste pointage personnel</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/pointAS" active="request()->routeIs('PointAS')">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="far fa-list-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Liste pointage OS/AS</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/listepersonnel" active="request()->routeIs('Listepers')">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="far fa-list-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Liste pesonnel</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/listeAS" active="request()->routeIs('ListeAS')">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="far fa-list-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Liste CI/OS</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/visiteur" active="request()->routeIs('Utilisateur')">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Visiteur</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <?php if(Auth::user()->admin == '1') {?>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="/utilisateur" active="request()->routeIs('Utilisateur')">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1">
                            <i class="fas fa-user"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Utilisateur</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <?php } ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Ajourd'hui</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>
                                            <div id="horloge">
                                                <div class="flex">
                                                    <div id="jour" class="mr-2 text-capitalize h1 items-center"></div>
                                                    <div id="date" class="h1 text-center"></div>
                                                </div>
                                                <div class="text-center">
                                                    <span id="heure" class="h1 text-center"></span>
                                                    <span id="minute" class="h1 text-center"></span>
                                                    <span id="seconde" class="h1 text-center"></span>
                                                </div>
                                            </div>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
</div>
<?php }?>
<script src="{{ asset('js/horloge.js') }}"></script>
<script>
    // Utilisation de moment.js pour obtenir la date et l'heure actuelles
    const currentDate = moment().format('YYYY-MM-DD');
    const currentTime = moment().format('HH:mm:ss');

    // Affichage de la date et de l'heure dans les éléments HTML correspondants
    document.getElementById('currentDate').textContent = currentDate;
    document.getElementById('currentTime').textContent = currentTime;
</script>

