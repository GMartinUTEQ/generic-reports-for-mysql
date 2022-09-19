<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios - GR4MySQL</title>
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <style>
    .table-hover tbody tr:hover td,
    .table-hover tbody tr:hover th {
      color: white !important;
      background-color: rgba(0, 123, 255, 0.75) !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <?php
  include_once("./C0n3cZi.on.php");

  $target = "usuarioacciones.php";

  $usuario = "";
  $contraseña = "";
  $isadmin = "";
  $activo = "";
  if (isset($_GET["ide"])) {
    $target = "usuarioacciones.php?ide=" . $_GET["ide"];
    echo $target;
    $sql = "select * from usuario where idusuario = " . $_GET["ide"];

    $result = $MyGRBConn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $usuario = $row["nombreusuario"];
        $isadmin = $row["isadmin"] === "1" ? "checked" : "";
        $activo = $row["activo"] === "1" ? "checked" : "";
      }
    }
  }
  ?>
  <div class="wrapper">
    <!-- Navbar -->
    <?php include_once("header.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once("menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Usuario</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-md-10">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Datos del usuario</h3>
                </div>
                <form action="<?= $target ?>" method="post">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-3" for="exampleInputEmail1">Usuario</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Escriba el usuario" value="<?= $usuario ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3" for="exampleInputPassword1">Contraseña</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Escriba la contraseña" value="<?= $contraseña ?>">
                      </div>
                    </div>

                    <div class="form-check">
                      <input type="checkbox" onclick="alert('Está seguro de esta acción?')" class="form-check-input" id="isadmin" name="isadmin" <?= $isadmin ?>>
                      <label class="form-check-label" for="exampleCheck1"><strong>*Definir como administrador</strong></label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="activo" name="activo" <?= $activo ?>>
                      <label class="form-check-label" for="exampleCheck1">Activo</label>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.row -->
          <div class="row d-flex justify-content-center">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class=" table-dark">
                      <tr>
                        <th>NombreUsuario</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //include_once("./C0n3cZi.on.php");

                      $sql = "select * from usuario where idsistema = " . $_SESSION["sSistema"];

                      $result = $MyGRBConn->query($sql);

                      if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                          $activo = '<span class="badge badge-danger">Inactivo</span>';
                          $btnactivo = "";
                          if ($row["activo"] === "1") {
                            $activo = '<span class="badge badge-success">Activo</span>';
                            $btnactivo = "<a class='h5' href='usuarioacciones.php?idi={$row["idusuario"]}'><span class='badge badge-danger'><i  class='fas fa-times-circle'></i>&nbsp;Desactivar</span></a>";
                          }
                          $admin =  '<span class="badge badge-secondary">Usuario</span>';
                          if ($row["isadmin"] === "1") {
                            $admin = '<span class="badge badge-primary">Administrador</span>';
                          }
                          echo "<tr>
                                  <td>{$row["nombreusuario"]}</td>
                                  <td>$admin</td>
                                  <td>$activo</td>
                                  <td><a class='h5' href='usuario.php?ide={$row["idusuario"]}'><span class='badge badge-warning'><i  class='fas fa-pen-square'></i>&nbsp;Editar</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $btnactivo . "</td>
                                </tr>";
                          //<td><strong><a href=''  class='text-left'><i style='color:green;' class='fas fa-check-circle'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='' class='text-rigth'><i style='color:red;' class='fas fa-times-circle'></i></a></strong></td>
                        }
                      } else {
                      }

                      $MyGRBConn->close();
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php") ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.js"></script>
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./plugins/jszip/jszip.min.js"></script>
  <script src="./plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="./plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "lengthChange": false,
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 to 0 of 0 registros",
          "infoFiltered": "(Filtrado de _MAX_ total registros)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ registros",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior",
            "colvis": "Ocultar columnas"
          },
          "buttons": {
            "copy": "Copiar",
            "colvis": "Ocultar columnas",
            "collection": "Colección",
            "colvisRestore": "Restaurar visibilidad",
            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
            "copySuccess": {
              "1": "Copiada 1 fila al portapapeles",
              "_": "Copiadas %ds fila al portapapeles"
            },
            "print": "Imprimir",
          },
        },
        "dom": 'Blfrtip',
        "lengthMenu": [
          [50, -1],
          [50, "Ver Todas"]
        ],
        "initComplete": function() {
          $("#reminders").show();
        },
        "buttons": ['copy', {
          extend: 'csv',
          title: 'Reporte de usuarios'
        }, {
          extend: 'excel',
          title: 'Reporte de usuarios'
        }, {
          extend: 'pdf',
          title: 'Reporte de usuarios'
        }, 'print', 'colvis'],


      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
  </script>
</body>

</html>