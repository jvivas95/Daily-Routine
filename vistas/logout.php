<?php

include_once '../config/config.php';

session_start();
session_unset();
session_destroy();
header("Location: ". BASE_URL ."vistas/login.php");
exit;
?>
