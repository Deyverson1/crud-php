<?php
include("../../db.php"); 

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; 
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute(); //con esto se busca el valor del id, para saber cual es el nombre y el id del puesto
    // header("Location:index.php"); 
    $registro = $sentencia->fetch(PDO::FETCH_LAZY); //para que solo se cargue un registro
    $usuario =  $registro["usuario"];  
    $password =  $registro["password"];  
    $correo =  $registro["correo"];  
    // header('Location:index.php');
}
if ($_POST) {
    // Recolectamos los datos del método POST
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET
    usuario=:usuario,
    password=:password,
    correo=:correo
    WHERE id=:id
    ");
    // Asigna valores que tienen uso de :variables
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET
    usuario=:usuario,
    password=:password,
    correo=:correo
    WHERE id=:id
    ");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtID);
    // Ejecutar la consulta
    $sentencia->execute();
    $mensaje= "Registro actualizado";
    header("Location:index.php?mensaje=".$mensaje); 
}

?>

<?php include("../../templates/header.php"); ?> 
<!-- Insertando el header -->
<br>
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <!-- Username -->
        <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="txtID" class="form-label">ID:</label>
        <input type="text"
        value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre del usuario</label>
            <input type="text" 
            class="form-control" 
            name="usuario" 
            id="usuario" 
            value="<?php echo $usuario;?>"
            aria-describedby="helpId"
            placeholder="Nombre del usuario">
        </div>
            <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" 
            value="<?php echo $password;?>"
            class="form-control" name="password" id="password" aria-describedby="helpId"
                    placeholder="Escriba su contraseña">
        </div>
            <!-- Correo -->
        <div class="mb-3">
            <label for="correo" class="form-label">Correo: </label>
            <input type="email" 
            value="<?php echo $correo;?>"
            class="form-control" name="correo" id="correo" aria-describedby="helpId"
                    placeholder="Escriba su correo">
        </div>

            <!-- Botones de control -->
        <button type="submit" class="btn btn-success">Agregar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?> 
<!-- Insertando el footer -->