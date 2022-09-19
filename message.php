<?php

if (isset($_SESSION["sMsgT"])) {
    switch ($_SESSION["sMsgT"]) {
        case "ok":
            echo '<div  style="padding-left: 275px;" class="alert alert-success" role="alert">
                ' . $_SESSION["sMessage"] . '
            </div>';
            break;
        case "err":
            echo '<div  style="padding-left: 275px;" class="alert alert-warning" role="alert">
                ' . $_SESSION["sMessage"] . '
            </div>';
            break;
    }
}

$_SESSION["sMsgT"] = "";
$_SESSION["sMessage"] = "";
