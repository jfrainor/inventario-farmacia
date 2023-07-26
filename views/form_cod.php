<?php

session_start();
error_reporting(0);

?>


<div class="modal fade" id="codbarra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Generar Codigo de Barras</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="codeForm">

                    <div class="form-group">
                        <label class="form-label"><--Selecciona el producto--></label>
                        <select class="form-control" required id="id_producto" name="id_producto">
                            <option value="">--Selecciona una opcion--</option>
                            <?php
                            include "../includes/db.php";
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM inventario ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['producto'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>
                    <br>
                    <div class="form-group" id="select2lista">

                    </div>
                    <input type="hidden" name="accion" value="insertar_codebarra">
                    <br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#id_producto').val(1);
        recargarLista();

        $('#id_producto').change(function() {
            recargarLista();
        });
    })
</script>
<script>
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "data.php",
            data: "codigo=" + $('#id_producto').val(),
            success: function(r) {
                $('#select2lista').html(r);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#codeForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            formData += '&id_producto=' + $('#id_producto').val();

            $.ajax({
                url: '../includes/functions.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Los datos se guardaron correctamente'
                        }).then(function() {
                            window.location = "codbarra.php";
                        });
                        //tiene que decir lo mismo el respomse.mesage que en el functions
                    } else if (response.status === 'error' && response.message === 'El número de código ya está en uso') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Este producto ya tiene generado su codigo de barra.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error inesperado'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error inesperado'
                    });
                }
            });
        });
    });
</script>