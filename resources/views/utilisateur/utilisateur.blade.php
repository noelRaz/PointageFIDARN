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
                <h3 class="card-title">Liste utilisateur</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="persListe" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Admin</th>
                        <th>Etat</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            <label class="switch">
                                <?php if($item->admin== 1) {?>
                                    <input name="roleDes" type="checkbox" checked value="0">
                                    <span class="slider round"></span>
                                <?php }
                                else {?>
                                        <input name="roleAct " type="checkbox" value="1">
                                        <span class="slider round"></span>
                                <?php } ?>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <?php if($item->role == 1) {?>
                                    <form method="POST" action="activeUser">
                                        <input name="roleDes" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </form>
                                <?php }
                                else {?>
                                        <input name="roleAct " type="checkbox">
                                        <span class="slider round"></span>
                                <?php } ?>
                            </label>
                        </td>
                        <?php if(Auth::user()->admin == '1') {?>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Action</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                  <span class="sr-only"></span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <button type="button" value="{{ $item->id }}" class="dropdown-item mt-2 btn btn-secodary editUser" data-toggle="modal" data-target="#modifierModal">
                                        <span class="fa fa-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Modifier
                                    </button>
                                    <button type="button" value="{{ $item->id }}" class="suppPers dropdown-item mt-2 btn btn-danger" data-toggle="modal" data-target="#modal-supp">
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
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Admin</th>
                        <th>Etat</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>

                <div class="modal fade" id="modal-supp">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Suppression du utilisateur</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ url('deleteutilisateur') }}" method="POST">
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
                            <form action="{{ url('updateUser') }}" method="POST">
                                @csrf
                                @method('PUT')
                              <div class="modal-body">
                                <!-- Le formulaire pour modifier les données -->
                                <input type="hidden" class="form-control" id="id" name="id">

                                <div class="form-group">
                                  <label for="nom">Admin</label>
                                  <input type="number" class="form-control" id="admin" name="admin" required>
                                </div>

                                <div class="form-group">
                                  <label for="prenom">Role</label>
                                  <input type="number" class="form-control" id="role" name="role">
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
        $(document).on('click', '.editUser', function(){
            var id = $(this).val();
            $('#modifierModal').modal('show');

            $.ajax({
                type: "GET",
                url:"/editUser/"+id,
                success: function(response){
                    $('#id').val(id);
                    $('#admin').val(response.personnel.admin);
                    $('#role').val(response.personnel.role);
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
