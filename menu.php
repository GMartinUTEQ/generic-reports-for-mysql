<?php
if (!isset($_SESSION["UsID"])) {
    echo "<script>alert('No se ha registrado como usuario del sistema');window.location.href = 'index.php'; </script>";
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!--img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"-->
        <img style="max-width:230px" src="./ProjImg/Logo.png" />
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                if ($_SESSION["isAd"]) {
                ?>
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === "dashboard.php" ? "active" : "" ?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Inicio
                                <!--span class="right badge badge-danger">New</span-->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="modelo.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === "modelo.php" ? "active" : "" ?>">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Modelos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="usuario.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === "usuario.php" ? "active" : "" ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                <?php
                }
                ?>

                <?php
                include_once("./C0n3cZi.on.php");

                $sql = "select * from modelo where idsistema = " . $_SESSION["sSistema"];

                $result = $MyGRBConn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        echo '<li class="nav-item">
                        <a href="reporte.php?idm=' . $row["idmodelo"] . '" class="nav-link';
                        if (isset($_GET["idm"])) {
                            echo basename(strval($row["idmodelo"])) === $_GET["idm"] ? " active " : "";
                        }
                        echo '">
                        <i class="nav-icon far fa-table"></i>
                            <p>
                                ' . $row["nombremodelo"] . '
                            </p>
                        </a>
                    </li>';
                    }
                } else {
                }

                //$MyGRBConn->close();

                ?>


                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                            Cerrar Sesión
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>