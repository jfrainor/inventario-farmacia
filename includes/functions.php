<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros
        case 'insertar_categoria':
            insertar_categoria();
            break;

        case 'insertar_proveedor':
            insertar_proveedor();
            break;

        case 'insertar_inventario':
            insertar_inventario();
            break;


        case 'insertar_codebarra':
            insertar_codebarra();
            break;

        case 'editar_inv':
            editar_inv();
            break;

        case 'editar_prov':
            editar_prov();
            break;

        case 'editar_cat':
            editar_cat();
            break;

        case 'editar_user':
            editar_user();
            break;

        case 'editar_perfil':
            editar_perfil();
            break;
    }
}

function insertar_categoria()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO categorias (categoria) VALUES ('$categoria')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_proveedor()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO proveedores (name, direccion, correo) 
    VALUES ('$name','$direccion','$correo')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_inventario()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO inventario (codigo, producto, cantidad, fecha_venci, lote, farmaceuta, proveedor, personal_ingreso, num_control, venci_factura, fecha_factura, id_categoria) 
    VALUES ('$codigo', '$producto','$cantidad', '$fecha_venci', '$lote', '$farmaceuta','$proveedor','$personal_ingreso', '$num_control', '$venci_factura', '$fecha_factura', '$id_categoria')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_codebarra()
{
    require_once("db.php");
    extract($_POST);

    // Verificar si el número de código ya existe en la base de datos
    $consultaExistencia = "SELECT * FROM codbarra WHERE codigo = '$codigo'";
    $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

    if (mysqli_num_rows($resultadoExistencia) > 0) {
        $response = array(
            'status' => 'error',
            'message' => 'El número de código ya está en uso'
        );
        echo json_encode($response);
        return; // Termina la ejecución de la función
    }

    $consulta = "INSERT INTO codbarra (id_producto, codigo) VALUES ('$id_producto', '$codigo')";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}


function editar_inv()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE inventario SET codigo = '$codigo', producto = '$producto', 
        cantidad = '$cantidad',  fecha_venci = '$fecha_venci', lote = '$lote',
		farmaceuta = '$farmaceuta ', proveedor='$proveedor', personal_ingreso= '$personal_ingreso', num_control='$num_control', venci_factura= '$venci_factura', fecha_factura='$fecha_factura', id_categoria = '$id_categoria' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_prov()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE proveedores SET name = '$name', 
    direccion = '$direccion', correo = '$correo' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_cat()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE categorias SET categoria = '$categoria' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_user()
{
    require_once("db.php");
    extract($_POST);
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]);
    $consulta = "UPDATE users SET usuario = '$usuario', correo = '$correo', password = '$password',
		telefono='$telefono', id_rol='$id_rol' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_perfil()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE users SET usuario = '$usuario', correo = '$correo' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado === true) {
        echo json_encode("updated");
    }
    if ($resultado === false) {
        echo json_encode("error");
    }
}
