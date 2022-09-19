<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reporte - GR4MySQL</title>
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
              <h1>Reporte </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <?php
                  include_once("./C0n3cZi.on.php");

                  $sql = "select nombremodelo, campos, tablas, host,dbusr, dbpass, dbname from modelo where idmodelo = " . $_REQUEST["idm"];
                  $result = $MyGRBConn->query($sql);
                  $campos = "";
                  $tablas = "";
                  $host = "";
                  $dbusr = "";
                  $dbpass = "";
                  $dbname = "";
                  $repName = "";
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $campos = $row["campos"];
                      $tablas = $row["tablas"];
                      $host = $row["host"];
                      $dbusr = $row["dbusr"];
                      $dbpass = $row["dbpass"];
                      $dbname = $row["dbname"];
                      $repName = $row["nombremodelo"];
                      $miscampos = explode(',', $campos);
                    }
                  }
                  ?>
                  <h3 class="card-title">Detalle del reporte: [<?= $repName ?>]</h3>
                </div>
                <div class="card-body" style="overflow-x: auto;white-space: nowrap;">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class=" table-dark">
                      <tr>
                        <?php


                        $servername2 = $host;
                        $username2 = $dbusr;
                        $password2 = $dbpass;
                        $dbname2 = $dbname;

                        $MyGRBConn2 = new mysqli($servername2, $username2, $password2, $dbname2);
                        if ($MyGRBConn2->connect_error) {
                          die("Connection failed: " . $MyGRBConn2->connect_error);
                        }

                        $sql = "select $campos from $tablas";
                        //echo $sql;
                        $result2 = $MyGRBConn2->query($sql);
                        $arreglo_datos = $result2->fetch_all(MYSQLI_ASSOC);

                        foreach ($arreglo_datos[0] as $key => $value) {
                          echo "<th>" . $key . "</th>";
                        }


                        $MyGRBConn->close();
                        $MyGRBConn2->close();

                        /*for ($i = 0; $i < count($miscampos); $i++) {
                          echo "<th>" . substr($miscampos[$i], (strpos(strval($miscampos[$i]), ".") + 1), (strlen($miscampos[$i]) - strpos(strval($miscampos[$i]), "."))) . "</th>";
                        }*/

                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php



                      for ($i = 0; $i < count($arreglo_datos); $i++) {
                        echo "<tr>";
                        foreach ($arreglo_datos[$i] as $key => $value) {
                          echo "<td>" . $value . "</td>";
                        }
                        echo "</tr>";
                      }

                      ?>

                    </tbody>
                  </table>
                </div>
                <?php
                if ($_SESSION["isAd"]) {
                  echo '<div class="card-footer">
                  <button class="btn btn-dark" id="btnsql">Ver consulta SQL</button>
                  <span id="spansql" style="display:none; background-color:white"><?= $sql ?></span>
                </div>';
                }
                ?>
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
  <script>
    const box = document.getElementById('spansql');

    const btn = document.getElementById('btnsql');

    btn.addEventListener('click', function handleClick() {
      if (box.style.display === 'none') {
        box.style.display = 'block';

        btn.textContent = 'Ocultar consulta';
      } else {
        box.style.display = 'none';

        btn.textContent = 'Ver consulta SQL';
      }
    });
  </script>

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
          title: 'Reporte<?php echo " " . $repName; ?>'
        }, {
          extend: 'excel',
          title: 'Reporte<?php echo " " . $repName; ?>'
        }, {
          extend: 'pdf',
          title: 'Reporte<?php echo " " . $repName; ?>',
          orientation: 'landscape'
        }, 'print', 'colvis'],


      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
  </script>
</body>

</html>