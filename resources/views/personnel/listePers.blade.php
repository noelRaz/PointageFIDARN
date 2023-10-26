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
                <h3 class="card-title">Liste personnel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(Auth::user()->admin == '1') {?>
                <button type="button" class="my-3 btn btn-success" data-toggle="modal" data-target="#modal-ajout">
                    <span class="fa fa-plus">&nbsp;</span>
                    Ajouter
                </button>
                <?php } ?>
                <table id="persListe" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Nom et Prénom(s)</th>
                        <th>E-mail</th>
                        <th>Fonction</th>
                        <th>Contact</th>
                        <?php if(Auth::user()->admin == '1') {?>
                        <th>Actions</th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->persNom}} {{$item->persPrenom}}</td>
                        <td>{{$item->persEmail}}</td>
                        <td>{{$item->persFonc}}</td>
                        <td>{{$item->persTel}}</td>
                        <?php if(Auth::user()->admin == '1') {?>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Action</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                  <span class="sr-only"></span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a href="{{"cartepersonnel/".$item->pers_code }}" >
                                        <button type="button" class="dropdown-item mt-2 btn btn-info affichePers">
                                            <span class="fas fa-qrcode"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                QR Code
                                        </button>
                                    </a>
                                    <button type="button" value="{{ $item->pers_code }}" class="dropdown-item mt-2 btn btn-secodary editPers" data-toggle="modal" data-target="#modifierModal">
                                        <span class="fa fa-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Modifier
                                    </button>
                                    <button type="button" value="{{ $item->pers_code }}" class="suppPers dropdown-item mt-2 btn btn-danger" data-toggle="modal" data-target="#modal-supp">
                                        <span class="fa fa-trash"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Supprimer
                                    </button>
                                </div>
                              </div>
                        </td>
                        <?php } ?>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Nom et Prénom(s)</th>
                        <th>E-mail</th>
                        <th>Fonction</th>
                        <th>Contact</th>
                        <?php if(Auth::user()->admin == '1') {?>
                        <th>Actions</th>
                        <?php } ?>
                    </tr>
                  </tfoot>
                </table>

                <div class="modal fade" id="modal-ajout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Nouvelle personnel</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form method="POST" action="addPers">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="persNom" class="form-control uppercase" id="persNom" placeholder="Entrer nom" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Prénom(s)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="persPrenom" class="form-control text-capitalize" id="persPrenom" placeholder="Entrer prénom(s)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="text" name="persEmail" class="form-control text-lowercase" id="persEmail" placeholder="Entrer adresse e-mail" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Fonction</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="persFonc" class="form-control uppercase" id="persFonc" placeholder="Entrer fonction" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="persTel" id="persTel" required>
                                        </div>
                                            <!-- /.input group -->
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

                  <!-- modal supprimer-->
                  <div class="modal fade" id="modal-supp">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Suppression du personnel</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ url('deletepersonnel') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="idSupp" name="idSupp">

                            <p>Voulez-vous vraiment supprimer&hellip;</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger">Valider</button>
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
                            <h4 class="modal-title">Modifier personnel</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal Body -->
                            <form action="{{ url('updatepersonnel') }}" method="POST">
                                @csrf
                                @method('PUT')
                              <div class="modal-body">
                                <!-- Le formulaire pour modifier les données -->
                                <input type="hidden" class="form-control" id="id" name="id">

                                <div class="form-group">
                                  <label for="nom">Nom</label>
                                  <input type="text" class="form-control uppercase" id="nom" name="nom" required>
                                </div>

                                <div class="form-group">
                                  <label for="prenom">Prenom(s)</label>
                                  <input type="text" class="form-control text-capitalizer" id="prenom" name="prenom">
                                </div>

                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control text-lowercase" id="email" name="email">
                                </div>
                                <div class="form-group">
                                  <label for="fonction">Fonction</label>
                                  <input type="text" class="form-control uppercase" id="fonction" name="fonction" required>
                                </div>
                                <div class="form-group">
                                  <label for="contact">Conctact</label>
                                  <input type="text" class="form-control" id="contact" name="contact" required>
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
<script>
  $(function () {
    $("#persListe").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis","add"]
    }).buttons().container().appendTo('#persListe_wrapper .col-md-6:eq(0)');
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
        $(document).on('click', '.editPers', function(){
            var pers_code = $(this).val();
            $('#modifierModal').modal('show');

            $.ajax({
                type: "GET",
                url:"/editpersonnel/"+pers_code,
                success: function(response){
                    $('#id').val(pers_code);
                    $('#nom').val(response.personnel.persNom);
                    $('#prenom').val(response.personnel.persPrenom);
                    $('#email').val(response.personnel.persEmail);
                    $('#fonction').val(response.personnel.persFonc);
                    $('#contact').val(response.personnel.persTel);
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.suppPers', function(){
            var pers_code = $(this).val();
            $('#modal-supp').modal('show');

            $.ajax({
                type: "GET",
                url:"/supprimePers/"+pers_code,
                success: function(response){
                    $('#idSupp').val(pers_code);
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.suppPers', function(){
            var pers_code = $(this).val();
            $('#modal-supp').modal('show');

            $.ajax({
                type: "POST",
                url:"/supprimePers/"+pers_code,
                success: function(response){
                    $('#idSupp').val(pers_code);
                }
            });
        });

    });
</script>

