<?php
session_start();

include("./C0n3cZi.on.php");

if (isset($_GET["idi"])) {
    $sql = "update usuario set activo = 0 where idusuario = " . $_GET["idi"];
    if ($MyGRBConn->query($sql) === TRUE) {
        $_SESSION["sMsgT"] = "ok";
        $_SESSION["sMessage"] = "Usuario desactivado exitosamente";
    } else {
        $_SESSION["sMsgT"] = "err";
        $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
    }
} else {
    if (isset($_GET["ide"])) {

        $admin = ", isadmin = 0";
        if (isset($_POST["isadmin"])) {
            $admin = ", isadmin = 1";
        }
        $activo = " activo = 0";;
        if (isset($_POST["activo"])) {
            $activo = ", activo = 1";
        }
        $pass = "";
        if (strlen($_POST["contrasena"]) > 0) {
            $pass = ", contrasena = md5('" . $_POST["pass"] . "')";
        }
        $sql = "update usuario set nombreusuario = '" . $_POST["usuario"] . "'" . $pass . " " . $admin . " " . $activo . " where idusuario = " . $_GET["ide"];
        if ($MyGRBConn->query($sql) === TRUE) {
            $_SESSION["sMsgT"] = "ok";
            $_SESSION["sMessage"] = "Usuario actualizado exitosamente";
        } else {
            $_SESSION["sMsgT"] = "err";
            $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
        }
    } else {
        $admin = ", 0";
        if (isset($_POST["isadmin"])) {
            $admin = ", 1";
        }
        $activo = ", 0";;
        if (isset($_POST["activo"])) {
            $activo = ", 1";
        }
        $sql = "insert into usuario values(0, '" . $_POST["usuario"] . "', md5('" . $_POST["pass"] . "') " . $admin . " " . $activo . ", " . $_SESSION["sSistema"] . ");";
        if ($MyGRBConn->query($sql) === TRUE) {
            $_SESSION["sMsgT"] = "ok";
            $_SESSION["sMessage"] = "Usuario guardado exitosamente";
        } else {
            $_SESSION["sMsgT"] = "err";
            $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
        }
    }
}

$MyGRBConn->close();

echo "<script>window.location.href = 'usuario.php'; </script>";
