<?php
session_start();
include("./C0n3cZi.on.php");


if (isset($_GET["ide"])) {
    $activo = ", activo = 0";;
    if (isset($_POST["activo"])) {
        $activo = ", activo = 1";
    }
    $sql = "update modelo set nombremodelo = '" . $_POST["nombremodelo"] . "', campos = '" . $_POST["campos"] . "', tablas = '" . $_POST["tablas"] . "', host = '" . $_POST["host"] . "', dbusr = '" . $_POST["usuario"] . "', dbpass = '" . $_POST["pass"] . "', dbname = '" . $_POST["nombrebd"] . "' " . $activo . " where idmodelo = " . $_GET["ide"];
    if ($MyGRBConn->query($sql) === TRUE) {
        $_SESSION["sMsgT"] = "ok";
        $_SESSION["sMessage"] = "Modelo actualizado exitosamente";
    } else {
        $_SESSION["sMsgT"] = "err";
        $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
    }
} else {
    if (isset($_GET["idi"])) {
        $sql = "update modelo set activo = 0 where idmodelo = " . $_GET["idi"];
        if ($MyGRBConn->query($sql) === TRUE) {
            $_SESSION["sMsgT"] = "ok";
            $_SESSION["sMessage"] = "Modelo desactivado exitosamente";
        } else {
            $_SESSION["sMsgT"] = "err";
            $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
        }
    } else {
        $activo = ", 0";;
        if (isset($_POST["activo"])) {
            $activo = ", 1";
        }
        $sql = "insert into modelo values(0, " . $_SESSION["sSistema"] . ", '" . $_POST["nombremodelo"] . "', '" . $_POST["campos"] . "', '" . $_POST["tablas"] . "', '" . $_POST["host"] . "', '" . $_POST["usuario"] . "', '" . $_POST["pass"] . "', '" . $_POST["nombrebd"] . "' " . $activo . ");";
        if ($MyGRBConn->query($sql) === TRUE) {
            $_SESSION["sMsgT"] = "ok";
            $_SESSION["sMessage"] = "Modelo guardado exitosamente";
        } else {
            $_SESSION["sMsgT"] = "err";
            $_SESSION["sMessage"] = "Error: " . $sql . "<br>" . $MyGRBConn->error;
        }
    }
}
//echo htmlspecialchars($_POST['texta']);

echo "<script>window.location.href = 'modelo.php'; </script>";
