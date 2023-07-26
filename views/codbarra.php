<?php
error_reporting(0);
session_start();
?>

<?php include "../includes/header.php"; ?>
<script src="../js/JsBarcode.all.min.js"></script>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de BarCode</h6>
                <br>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#codbarra">
                    <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Codigo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $sql = "SELECT cd.id, cd.codigo, i.codigo, i.producto FROM codbarra cd INNER JOIN inventario i ON cd.id_producto = i.id";
                            $resultado = mysqli_query($conexion, $sql);

                            // declaramos arreglo para guardar codigos
                            $codbarra = array();
                            ?>
                            <?php while ($fila = mysqli_fetch_assoc($resultado)) :
                                $codbarra[] = (string) $fila['codigo'];
                            ?>
                                <tr>
                                    <td><?php echo $fila['producto'] ?></td>
                                    <td>
                                        <svg id="<?php echo 'barcode' . $fila['codigo']; ?>"></svg>
                                    </td>
                                    <td>
                                        <a href="../includes/eliminar_cod.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <script>
                        $('.btn-del').on('click', function(e) {
                            e.preventDefault();
                            const href = $(this).attr('href')

                            Swal.fire({
                                title: 'Estas seguro de eliminar este registro?',
                                text: "¡No podrás revertir esto!!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, eliminar!',
                                cancelButtonText: 'Cancelar!',
                            }).then((result) => {
                                if (result.value) {
                                    if (result.isConfirmed) {
                                        Swal.fire(
                                            'Eliminado!',
                                            'El registro fue eliminado.',
                                            'success'
                                        )
                                    }

                                    document.location.href = href;
                                }
                            })

                        })
                    </script>

                    <script type="text/javascript">
                        function arrayjsonbarcode(j) {
                            json = JSON.parse(j);
                            arr = [];
                            for (var x in json) {
                                arr.push(json[x]);
                            }
                            return arr;
                        }

                        jsonvalor = '<?php echo json_encode($codbarra) ?>';
                        valores = arrayjsonbarcode(jsonvalor);

                        for (var i = 0; i < valores.length; i++) {
                            JsBarcode("#barcode" + valores[i], valores[i].toString(), {
                                format: "CODE128",
                                lineColor: "#000",
                                width: 2,
                                height: 30,
                                displayValue: true
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</body>

<?php include "form_cod.php"; ?>
<?php include "../includes/footer.php"; ?>

</html>