<?php
include('../../db.php');

if(isset( $_GET['txtID'] )){ 
    // Borrar // no solo el registro si no tambien los archivos adjuntados
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
            // Buscar archivo relacionado con el empleado
    $sentencia=$conexion->prepare("SELECT  foto,cv FROM `tbl_empleados` WHERE id=:id"); 
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia -> fetch(PDO::FETCH_LAZY); //lazy devuelve un registro
    print_r($registro_recuperado);

// Borra el archivo almacenado foto
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
                unlink("./".$registro_recuperado["foto"]);
        }
    }
// Borra el archivo almacenado Cv
    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
                unlink("./".$registro_recuperado["cv"]);
        }
    }

    $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje= "Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje); 


};
    
$sentencia=$conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto LIMIT 1) as puesto 
FROM `tbl_empleados`"); //atrapa el contenido de la variable // En lo anterior hay una subconsulta que al final termina almacencado en la variable puesto
$sentencia->execute(); //ejecta las sentencias 
$lista_tbl_empleados = $sentencia -> fetchAll(PDO::FETCH_ASSOC);  //return un array con el nombre de $lista_tbl_puestos, se guardan en la anterior variable 
?>



<?php include("../../templates/header.php"); ?> 
<!-- Insertando el header -->
<br>
<h4> Empleados </h4>
<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar Registro
    </a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
        <table class="table" id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Cv</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="">

            <?php foreach($lista_tbl_empleados as $registro) { ?>

                <tr>
                    <td> <?php echo $registro['id'];?> </td>
                    <td scope="row">
                    <?php echo $registro['primernombre'];?>
                    <?php echo $registro['segundonombre'];?>
                    <?php echo $registro['primerapellido'];?>
                    <?php echo $registro['segundoapellido'];?>
                    </td>
                    <td>
                        <img 
                        width='40' 
                        src="<?php echo $registro['foto'];?>" 
                        class="img-fluid rounded"
                        alt="Imagen Empleado">
                    </td>
                    <td> 
                        <a target="blank" href="<?php echo $registro['cv'];?>">
                        <?php echo $registro['cv'];?></a>
                    </td>
                    <td><?php echo $registro['puesto'];?></td> 
                    <!-- Con la subconsulta de las primeras lineas podemos mostrar aca el valor de puesto, no el id como tal si no el nombre del puesto -->
                    <td><?php echo $registro['fechadeingreso'];?></td>
                    <td>
                        <a class="btn btn-primary" href="carta_recomendacion.php?txtID=<?php echo $registro['id'];?>" role="button">Carta</a>
                    | <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'];?>" role="button">Editar</a>
                    | <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'];?>);"role="button">Eliminar</a>
                </tr>
                
            <?php  } ?>

            </tbody>
        </table>
    </div>
    </div>
</div>
<?php include("../../templates/footer.php"); ?> 
<!-- Insertando el footer -->