<?php
include("../../db.php"); //incluimos la base de datos que ya tenemos en db.php

if($_POST){ //con lo anterior se verifica si se realizo un post, es decir un envio a la vace de datos
    // print_r($_POST); //muestra en pantalla el post enviado a la base de datos


// Recolectamos datos de metodo post
    $nombredelpuesto = (isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:""); //The isset() function can be used to check if a variable has been set before using it, to avoid errors
    //verifica si existe la informacion que se desa validar, que en este caso es nombredelpuesto
    // si existe se asigna, en caso de que no se pone en blanco
    
// Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id, nombredelpuesto)
        VALUES (null, :nombredelpuesto)"); //insertar los datos del metodo post en la base de datos, se especifica donde y que valor va a tener 
// Asignando los valores qye vienen del metodo POST (Los que vienen del formulario)

    $sentencia -> bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia -> execute();
    $mensaje="Registro agregado";
    header("Location:index.php?mensaje=".$mensaje); 
};



?>


<?php include("../../templates/header.php"); ?> 
<!-- Insertando el header -->
<br>

<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
      
    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
      <input type="text"
        class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
    </div>
    <button type="submit" class="btn btn-success">Agregar</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?> 
<!-- Insertando el footer -->