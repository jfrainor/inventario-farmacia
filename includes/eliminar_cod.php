<?php

session_start();
error_reporting(0);


$id = $_GET['id'];
include "db.php";
$query = mysqli_query($conexion, "DELETE FROM codbarra WHERE id = '$id'");

header('Location: ../views/codbarra.php?m=1');
