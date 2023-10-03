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
                <h3 class="card-title">Liste pointage personnel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-ajout">
                            <span class="fa fa-qrcode">&nbsp;</span>
                            Scanner QR Code
                        </button>
                    </div>
                    <div class="ml-auto">
                        <form method="get" action="pointageFiltre">
                            <div class="my-3 input-group">
                                <select name="date_filter" id="" class="form-select rounded">
                                    {{-- <option value="">Toutes les dates</option> --}}
                                    <option value="today">Ajourd'hui</option>
                                    <option value="yesterday">Hier</option>
                                    <option value="this_week">Cette semaine</option>
                                    <option value="last_week">La semaine dernière</option>
                                    <option value="this_month">Ce mois-ci</option>
                                    <option value="last_month">Le mois dernier</option>
                                    <option value="this_yeas">Cet année</option>
                                    <option value="last_yeas">Année dernière</option>
                                </select>
                                <button type="submit" class="btn btn-primary ml-1">Filtrer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <table id="persPoint" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nom et Prénom</th>
                        <th>Fonction</th>
                        <th>Heure</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td>{{$item->persNom }} {{$item->persPrenom}}</td>
                        <td>{{$item->persFonc}}</td>
                        <td>{{date('h:i', strtotime($item->created_at))}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Nom et Prénom</th>
                        <th>Fonction</th>
                        <th>Heure</th>
                    </tr>
                  </tfoot>
                </table>
                <div class="modal fade" id="modal-ajout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Nouvelle pointage personnel</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="addPoint">
                                <div class="modal-body">
                                    @if (Session::get('Success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('Success') }}
                                    </div>
                                    @endif

                                    @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>

                                    @endif
                                        @csrf
                                        <div class="flex">
                                            <div class="mt-2 mr-2 bg-gray-100">
                                                <video id="preview" class="w-50 h-35"></video>
                                            </div>
                                            <div class="mt-2 w-full ml-2">
                                                <label>Code</label>
                                                <input type="text" name="persCode" id="qrResult" readonly="" placeholder="Code" class="form-control">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <span class="fa fa-disave"></span>&nbsp;&nbsp;&nbsp;
                                            Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="fa fa-save"></span>&nbsp;&nbsp;&nbsp;
                                            Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                  <!-- /.modal -->
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

<!-- DataTables  & Plugins -->
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('jszip/jszip.min.js') }}"></script>
<script src="{{ asset('pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('https://rawgit.com/schmich/instascan-builds/master/instascan.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js') }}"></script>
<script>
  $(function () {
    $("#persPoint").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#persPoint_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
    Instascan.Camera.getCameras().then(function function_name(cameras){
        if (cameras.length > 0){
            scanner.start(cameras[0]);
        }
        else{
            alert('Camera non trouver');
        }
    }).catch(function(e){
        consolee.error(e);
    });

    scanner.addListener('scan', function(c){
        document.getElementById('qrResult').value=c;
    });
</script>
