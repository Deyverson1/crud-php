<?php
include('../../db.php');

if($_POST){ //verificar si hay un post
    // print_r($_POST); //recepcionar fotos 
    // print_r($_FILES);

    $primernombre = (isset($_POST["primernombre"])?$_POST["primernombre"]:""); 
    $segundonombre = (isset($_POST["segundonombre"])?$_POST["segundonombre"]:""); 
    $primerapellido = (isset($_POST["primerapellido"])?$_POST["primerapellido"]:""); 
    $segundoapellido = (isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:""); 

    $foto = (isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:""); 
    $cv = (isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:""); 


    $idpuesto = (isset($_POST["idpuesto"])?$_POST["idpuesto"]:""); 
    $fechadeingreso = (isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:""); 

    $sentencia = $conexion->prepare("INSERT INTO `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`) 
    VALUES (NULL,:primernombre,:segundonombre,:primerapellido,:segundoapellido,:foto,:cv,:idpuesto, :fechadeingreso);");

    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);

    // La fecha generada a continuacion nos sirve tanto para el documento como para la foto
    $fecha_ = new DateTime(); //obtener el tiempo //de alguna manera genera como un identificador unico
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:""; //armar nuevo nombre del archivo //para que no se sobre escriba con otras
    $tmp_foto=$_FILES["foto"]['tmp_name']; //usar archivo temporal 
    if($tmp_foto!=''){
        move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto); //mover el temporal a uno nuevo que es el nombre del archivo
    }
    // se adjunta en la seccion de empleados, despues la podremos mostrar por medio de index.php empleados
// Lo anterior despues de actualia en la db aqui abajo 

    $sentencia->bindParam(":foto", $nombreArchivo_foto);

// FILE
    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:""; 
    $tmp_cv=$_FILES["cv"]['tmp_name']; 
    if($tmp_cv!=''){
        move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv); 
    }
    $sentencia->bindParam(":cv", $nombreArchivo_cv);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia -> execute();
    $mensaje= "Registro agregado";
    header("Location:index.php?mensaje=".$mensaje); 
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); 
$sentencia->execute();
$lista_tbl_puestos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>


<?php include("../../templates/header.php"); ?> 
<!-- Insertando el header -->
<br>

<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">
<!-- Primer nombre -->
    <div class="mb-3">
        <label for="primernombre" class="form-label">Primer nombre</label>
        <input type="text"
        class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
    </div>
<!-- Segundo nombre -->
    <div class="mb-3">
      <label for="segundonombre" class="form-label">Segundo nombre</label>
      <input type="text"
        class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
    </div>
<!-- Primer apellido -->
    <div class="mb-3">
      <label for="primerapellido" class="form-label">Primer apellido</label>
      <input type="text"
        class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
    </div>
<!-- Segundo apellido -->
    <div class="mb-3">
      <label for="segundoapellido" class="form-label">Segundo apellido</label>
      <input type="text"
        class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
    </div>
<!-- Foto -->
    <div class="mb-3">
      <label for="foto" class="form-label">Foto:</label>
      <input type="file"
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
    </div>
<!-- Curriculum Vitae -->
    <div class="mb-3">
      <label for="cv" class="form-label">Cv(PDF):</label>
      <input type="file"
        class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="">
    </div>
<!-- Puesto -->
    <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>
        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">

        <?php foreach($lista_tbl_puestos as $registro) { ?> 

            <option value="<?php echo $registro['id']?>">
            <?php echo $registro['nombredelpuesto']?></option>

        <?php  } ?>

        </select>
    </div>

<!-- Fecha de ingreso -->
    <div class="mb-3">
      <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
      <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
    </div>
<!-- Buttons -->

    <button type="subtmit" class="btn btn-success">Agregar registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    </form>
    </div>
    <div class="card-footer text-muted">
</div>

<?php include("../../templates/footer.php"); ?> 
<!-- Insertando el footer -->