<?php
include_once "../includes/db.php"; // Archivo que contiene la conexión a la base de datos

if (isset($_GET['term'])) {
    $nombreCliente = $_GET['term'];

    $query = "SELECT cliente FROM clientes WHERE cliente LIKE '%".$nombreCliente."%'";
    $result = mysqli_query($conexion, $query);

    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row['cliente'];
    }

    echo json_encode($response);
}
?>

