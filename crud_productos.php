<?php 
if(!empty($_POST)) {
    $txt_id = $_POST["txt_id"];
    $txt_producto =utf8_decode( $_POST["txt_producto"]);
    $drop_marca =utf8_decode( $_POST["drop_marca"]);
    $txt_descripcion =utf8_decode( $_POST["txt_descripcion"]);
    $txt_costo =utf8_decode( $_POST["txt_costo"]);
    $txt_venta =utf8_decode( $_POST["txt_venta"]);
    $txt_existencia =utf8_decode( $_POST["txt_existencia"]);

    $sql="";
    if(isset($_POST['btn_agregar'])){
        $sql="INSERT INTO productos (producto,id_marca,descripcion,precio_costo,precio_venta,existencia) 
        VALUES ('".$txt_producto."',".$drop_marca.",'".$txt_descripcion."','".$txt_costo."','".$txt_venta."','".$txt_existencia."');";    
    }

    if(isset($_POST['btn_actualizar'])){
        $sql="Update productos set producto='".$txt_producto."',id_marca=".$drop_marca.",descripcion='".$txt_descripcion."',precio_costo='".$txt_costo."',precio_venta='".$txt_venta."',existencia='".$txt_existencia."'  
        where id_producto = ".$txt_id.";";
    }

    if(isset($_POST['btn_eliminar'])){
        $sql="delete from productos where id_producto=".$txt_id;
    }
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);

        
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            header("Location: /crud_php examen 2");
        }else{
            echo"Error" . $sql . "<br>".$db_conexion ->close();

        }
    
} 

?>