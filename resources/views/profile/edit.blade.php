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
                <h3 class="card-title">Paramètre de compte</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="py-1">
                    <div class="max-w-7xl mx-auto sm:px-1 lg:px-1 space-y-6">
                        <div class="mt-2 p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="mt-2 p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="mt-2 p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
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

