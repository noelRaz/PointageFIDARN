@include('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Carte personnel</h3>
                </div>
              <!-- /.card-header -->
                <div class="card-body" id="captureCard">
                    <div class="">
                        <div class="m-ca border card-body rounded-lg w-40 h-45 bg-white">
                            {{-- <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="bg-darkblue rounded">
                                    <div class="bg-white mt-1 ml-1 my-1 mr-1 rounded">
                                        <x-application-rep/>
                                    </div>
                                </div>
                                <div class="bg-darkblue rounded">
                                    <div class="bg-white mt-1 ml-1 my-1 mr-1 rounded w-95 h-85">
                                        <x-application-primature class="mt-4"/>
                                    </div>
                                </div>

                            </div>
                            <div class="bg-darkblue rounded-lg mt-1">
                                <x-application-logo/>
                            </div> --}}
                            <div class="mt-2">
                                {!! DNS2D::getBarcodeHTML("$pers->ext_code", 'QRCODE',4, 4) !!}
                            </div>
                            <!--
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="mt-2">
                                    {!! DNS2D::getBarcodeHTML("$pers->ext_code", 'QRCODE',4, 4) !!}
                                </div>
                                <div class="cadr bg-black rounded border mt-2 ml-auto">
                                    <div class="m-k photo rounded bg-white">
                                        <label for="Photo" class="ml-md-3 mt-5 ml-3">Photo 4*4</label>
                                    </div>
                                </div>

                            </div>-->
                                <!--Nom-->
                            <div class="mt-2">

                                <input id="persNomModif"
                                            class="inputText border-transparent block rounded mt-0 w-full"
                                            type="text" name="persNomModif"
                                            oninput="qrcode.makeCode(this.value)"
                                            type="text"
                                            name="nom"
                                            value="{{ $pers->extNom}} {{ $pers->extPrenom}}"/>
                            </div>

                            {{-- <div class="mt-1">
                                <label>Fonction</label>
                                <input id="persFoncModif"
                                            class="uppercase border-transparent block rounded mt-0 w-full"
                                            type="text" name="persFoncModif"
                                            value="{{ $pers->extFonc}}"/>
                            </div>

                            <div class="mt-1">
                                <label>Direction</label>
                                <x-direction/>
                            </div>

                            <div class="text-center mt-1 bg-darkblue rounded-lg">
                                <x-site/>
                            </div> --}}

                        </div>
                    </div>
                </div>
                <div class="ml-3">
                    <a href="{{url("listeAS/")}}">
                        <button type="button" class="btn btn-warning border-transparent" > Annuler</button>
                    </a>
                    <button onclick="capturer()" class="btn btn-success border-transparent">Generer carte</button>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    function capturer(){
        var carte = new html2canvas(document.getElementById("badge"));
        carte = html2canvas(document.querySelector("#captureCard")).then(canvas => {
    document.body.appendChild(canvas)
    });
    }
</script>
