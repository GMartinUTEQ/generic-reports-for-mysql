<?php
session_start();

include_once("./C0n3cZi.on.php");

$sql = "select idusuario, contrasena, isadmin from usuario where activo = 1 and idsistema = " . $_POST["idsistema"];
$sql .= " and nombreusuario = '" . $_POST["usuario"] . "' ";
$sql .= " limit 1";
$result = $MyGRBConn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["contrasena"] === md5($_POST["pass"])) {
            $_SESSION["UsID"] = $row["idusuario"];
            $_SESSION["isAd"] = $row["isadmin"] === "1" ? true : false;
            $_SESSION["uName"] = $_POST["usuario"];
            $_SESSION["sSistema"] = $_POST["idsistema"];
        } else {
            echo "<script>alert('Usuario incorrecto');window.location.href = 'index.php'; </script>";
            die();
        }
    }
} else {
    echo "0 results";
}
$MyGRBConn->close();

echo "<script>window.location.href = 'dashboard.php'; </script>";
