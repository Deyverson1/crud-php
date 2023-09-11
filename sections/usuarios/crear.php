<?php
include('../../db.php');

if ($_POST) {
    // Recolectamos los datos del método POST
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");

    // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios (id, usuario, password, correo)
    VALUES (NULL, :usuario, :password, :correo)");

    // Asigna valores que tienen uso de :variables
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);

    // Ejecutar la consulta
    $sentencia->execute();
    $mensaje= "Registro agregado";
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
                <label for="usuario" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId"
                    placeholder="Nombre del usuario">
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                    placeholder="Escriba su contraseña">
            </div>
            <!-- Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo: </label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
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
