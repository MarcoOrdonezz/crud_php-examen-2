<!doctype html>
<html lang="en">
  <head>
    <title>Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </head>
  <body>
      <h1>Formulario Productos</h1>
<div class="container">
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" id="btn" name="btn" data-bs-toggle="modal" data-bs-target="#modelId">
      Nuevo
    </button>
    
    <!-- Modal -->
    <div class="modal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro Empleados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="d-flex" action="crud_empleado.php" method="post" id="form_empleados">
            <div class="col">
                <div class="mb-3">
                <input type="text"  class="form-control" id="txt_id" name="txt_id" placeholder="0" readonly>
                </div>
                <div class="mb-3">
                    <label for="lbl_producto" class="form-label"><b>Producto</b></label>
                    <input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Producto: Producto 1" required>                 
                </div>
                <div class="mb-3">
                  <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                  <select class="form-select" name="drop_marca" id="drop_marca">
                    <option value=0>---- Marca ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select id_marca as id, marca from marcas;");
                    $resultado = $db_conexion->use_result();
                    while($fila =  $resultado->fetch_assoc()){
                        echo"<option value=".$fila['id'].">".$fila['marca']."</option>";
                    }
                    $db_conexion ->close();
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripcion" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_costo" class="form-label"><b>Precio Costo</b></label>
                    <input type="number" name="txt_costo" id="txt_costo" class="form-control" placeholder="Costo: Q0.00" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label"><b>Precio Venta</b></label>
                    <input type="number" name="txt_venta" id="txt_venta" class="form-control" placeholder="Venta: Q0.00" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_existencia" class="form-label"><b>Existencia</b></label>
                    <input type="number" name="txt_existencia" id="txt_existencia" class="form-control" placeholder="Cantidad: 0" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
                    <input type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-warning" value="Actualizar">
                    <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" value="Eliminar" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false">
                </div>             
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Descripcion</th>
                    <th>Precio Costo</th>
                    <th>Precio Venta</th>
                    <th>Existencias</th>
                </tr>
                </thead>
                <tbody id="tbl_productos">
                <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("SELECT p.id_producto as id, p.producto, m.marca , p.descripcion, p.precio_costo, p.precio_venta, p.existencia , p.id_marca FROM productos as p
                    inner join marcas as m on p.id_marca = m.id_marca");
                    $resultado = $db_conexion->use_result();
                    while($fila = $resultado->fetch_assoc()){
                        echo"<tr data-id=".$fila['id']." data-idm=".$fila['id_marca'].">";
                        echo"<td>".$fila['producto']."</td>";
                        echo"<td>".$fila['marca']."</td>";
                        echo"<td>".$fila['descripcion']."</td>";
                        echo"<td>".$fila['precio_costo']."</td>";
                        echo"<td>".$fila['precio_venta']."</td>";
                        echo"<td>".$fila['existencia']."</td>";
                        echo"</tr>";
                    }
                    $db_conexion ->close();
                    ?>
                </tbody>
        </table>    
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#btn').click(function() {
	    document.getElementById("btn_agregar").disabled = false;
            document.getElementById("form_empleados").reset();            
            });
        });
    $('#tbl_productos').on('click','tr td', function(evt){
	document.getElementById("btn_agregar").disabled = true;	
    $('#modelId').modal("show");
    var target,ide,idm,producto,marca,descripcion,precio_costo,precio_venta,existencia;  
    target = $(event.target);
    ide=target.parents().data('id');
    idm=target.parents().data('idm');
    producto= target.parents("tr").find("td").eq(0).html();
    marca= target.parents("tr").find("td").eq(1).html();
    descripcion= target.parents("tr").find("td").eq(2).html();
    precio_costo= target.parents("tr").find("td").eq(3).html();
    precio_venta= target.parents("tr").find("td").eq(4).html();
    existencia= target.parents("tr").find("td").eq(5).html();

    $("#txt_id").val(ide);
    $("#txt_producto").val(producto);
    $("#drop_marca").val(idm);
    $("#txt_descripcion").val(descripcion);
    $("#txt_costo").val(precio_costo);
    $("#txt_venta").val(precio_venta);
    $("#txt_existencia").val(existencia);
    });
</script>
  </body>
</html>