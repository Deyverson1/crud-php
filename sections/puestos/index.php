<?php
include("../../db.php"); //incluimos la base de datos que ya tenemos en db.php

// Verificar el envio de parametros a travez de la URL
if(isset( $_GET['txtID'] )){ //CRUD para borrar un dato, enviamos el dato desde url por el boton y en esta partde de abajo se procesa para eliminar
//instruccion de borrar
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; 
    $sentencia=$conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje); 
};

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); //atrapa el contenido de la variable
$sentencia->execute(); //ejecta las sentencias 
$lista_tbl_puestos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);  //return un array con el nombre de $lista_tbl_puestos, se guardan en la anterior variable 

// print_r($lista_tbl_puestos);
// Para revisar si si se estan consultando, se printa arriba del header
?>

<?php include("../../templates/header.php"); ?> 
<!-- Insertando el header -->


<br>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar Registro
    </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_tbl_puestos as $registro) { ?> 
                    <!-- Por cada vez que encuentre un resultado va a presentar lo de abajo -->
                    <tr class="">
                        <td scope="row"><?php echo $registro["id"];?></td>
                        <td><?php echo $registro["nombredelpuesto"];?></td> 
                        <!-- <?php echo $registro["nombredelpuesto"];?> de la manera anteirior podemos imprimir en la etiqueta html el dato que esta en la base de datos -->
                        <td>
                             <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'];?>" role="button">Editar</a>
                            | <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'];?>);" role="button">Eliminar</a>
                            <!-- Por medio del href enviamos la id por medio del echo, esta deve de ser procesada -->
                        </td>
                    </tr>

                    <?php  } ?>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?> 
<!-- Insertando el footer -->