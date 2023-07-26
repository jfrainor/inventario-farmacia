<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Articulo</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="editInv<?php echo $fila['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Codigo</label>
                                <input type="text" id="codigo" name="codigo" class="form-control" value="<?php echo $fila['codigo']; ?>" required>

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Producto</label>
                                <input type="text" id="producto" name="producto" class="form-control" value="<?php echo $fila['producto']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Cantidad</label><br>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $fila['cantidad']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Fecha de Vencimiento</label><br>
                                <input type="date" name="fecha_venci" id="fecha_venci" class="form-control" value="<?php echo $fila['fecha_venci']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Lote </label><br>
                                <input type="number" id="lote" name="lote" class="form-control"
                                value="<?php echo $fila['lote']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Farmaceuta</label><br>
                                <input type="text" id="farmaceuta" name="farmaceuta" class="form-control" value="<?php echo $fila['farmaceuta']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Proveedor</label><br>
                                <!-- <input type="text" id="proveedor" name="proveedor" class="form-control"> -->
                                <select name="proveedor" id="proveedor" class="form-control" required>
                                    <option <?php echo $fila['proveedor'] === 'proveedor' ? 'selected' : ''; ?> value=<?php echo $fila['proveedor']; ?>"><?php echo $fila['proveedor']; ?></option>

                                    <?php

                                    include("../includes/db.php");
                                    // Codigo para mostrar proveedores desde otra tabla
                                    $sql = "SELECT * FROM proveedores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        $selected = $fila['proveedor'] === $consulta['id'] ? 'selected' : '';
                                        echo '<option value="' . $consulta['id'] . '" ' . $selected . '>' . $consulta['name'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Categoria</label><br>
                                <select name="id_categoria" id="id_categoria" class="form-control" required>
                                    <option <?php echo $fila['id_categoria'] === 'id_categoria' ? 'selected' : ''; ?> value="<?php echo $fila['id_categoria']; ?>"><?php echo $fila['id_categoria']; ?></option>
                                    <?php
                                    include("../includes/db.php");
                                    // Codigo para mostrar categorias desde otra tabla
                                    $sql = "SELECT * FROM categorias ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        $selected = $fila['id_categoria'] === $consulta['id'] ? 'selected' : '';
                                        echo '<option value="' . $consulta['id'] . '" ' . $selected . '>' . $consulta['categoria'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Personal de ingreso</label><br>
                                <select name="personal_ingreso" id="personal_ingreso" class="form-control" required>
                                    <option <?php echo $fila['personal_ingreso'] === 'Administrador' ? 'selected' : ''; ?> value="Administrador">Administrador</option>
                                    <option <?php echo $fila['personal_ingreso'] === 'Empleado' ? 'selected' : ''; ?> value="Empleado">Empleado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Nro. control de factura</label><br>
                                <input type="number" name="num_control" id="num_control" class="form-control" value="<?php echo $fila['num_control']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Vencimiento de factura </label><br>
                                <input type="date" id="venci_factura" name="venci_factura" class="form-control" value="<?php echo $fila['venci_factura']; ?>" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Fecha de factura</label><br>
                                <input type="date" id="fecha_factura" name="fecha_factura" class="form-control" value="<?php echo $fila['fecha_factura']; ?>">
                            </div>
                        </div>
                    </div>



                    <input type="hidden" name="accion" value="editar_inv">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editarInv(<?php echo $fila['id']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function editarInv(id) {
        var datosFormulario = $("#editInv" + id).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('inventario.php');
                    }, 2000);
                } else {
                    alert("Ha ocurrido un error al actualizar el registro");
                }
            },
            error: function() {
                alert("Error de comunicacion con el servidor");
            }
        });
    }
</script>