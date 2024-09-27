<?php
require("includes/database.php");

if (isset($_POST['reply'])) {
    $action = $_POST['reply'];

} else {
    $action = null;
}

$reply = htmlspecialchars($_POST['reply'], ENT_QUOTES, 'UTF-8');

if ($action === 'Twerker') {


?>