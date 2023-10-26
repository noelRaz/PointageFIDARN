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
                <h3 class="card-title">Liste Visiteur</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-ajout">
                            <span class="fa fa-plus">&nbsp;</span>
                            Nouveau
                        </button>
                    </div>
                    <div class="ml-auto">
                        <form method="get" action="visiteurFiltre">
                            <div class="my-3 input-group">
                                <select name="date_filter" id="" class="form-select rounded">
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
                        <th>Nom</th>
                        <th>CIN 1</th>
                        <th>CIN 2</th>
                        <th>Entrer</th>
                        <th>Sortir</th>
                        <th class="item-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td>{{$item->visiNom }}</td>
                        <td><img src="{{asset('storage/images/'.$item->nomCIN1)}}" class="h-2 w-5"></td>
                        <td><img src="{{asset('storage/images/'.$item->nomCIN2)}}" class="h-2 w-5"></td>
                        <td>{{date('H:i', strtotime($item->created_at))}}</td>
                        <td>{{date('H:i', strtotime($item->updated_at))}}</td>
                        <td>
                            <button type="button" value="{{ $item->visiID }}" class="mt-2 btn btn-secodary bg-info editVisi" data-toggle="modal" data-target="#modifierModal">
                                <span class="fa fa-edit"></span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>CIN 1</th>
                        <th>CIN 2</th>
                        <th>Enter</th>
                        <th>Sortir</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
                <div class="modal fade" id="modal-ajout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Nouvelle Visiteur</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="addVisi" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="visiNom" class="form-control text-capitalize" id="visiNom" placeholder="Entrer nom de visiteur" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo 1</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            </div>
                                            <input type="file" accept="image/*" capture="environment" id="fileInput" name="photoCIN1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo 2</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            </div>
                                            <input type="file" accept="image/*" capture="environment" id="fileInput" name="photoCIN2">
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
                 <!-- Modifier Modal -->
                 <div class="modal" id="modifierModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Modifier visiteur</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal Body -->
                            <form action="{{ url('updateVisiteur') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <!-- Le formulaire pour modifier les données -->
                                    <input type="hidden" class="form-control" id="id" name="id">

                                    <div class="form-group">
                                        <label for="nom">Sortie</label><br/>
                                        {{-- <input type="text" class="form-control" id="sortie" name="sortie" required> --}}
                                        <input type="radio" value="Non" name="sortie" class="form-control">
                                        <label class="mt-3">Non</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" value="Oui" name="sortie" class="form-control">
                                        <label class="mt-3">Oui</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>

                              <!-- Modal Footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" id="saveModif">Enregistrer</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    $(document).ready(function(){
        $(document).on('click', '.editVisi', function(){
            var visiID = $(this).val();
            $('#modifierModal').modal('show');

            $.ajax({
                type: "GET",
                url:"/editvisiteur/"+visiID,
                success: function(response){
                    $('#id').val(visiID);
                    $('#sortie').val(response.visiteur.sortie);
                }
            });
        });

    });
</script>
