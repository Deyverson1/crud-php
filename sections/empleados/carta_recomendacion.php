<?php
include("../../db.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; 
    
    $sentencia=$conexion->prepare("SELECT *,(SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto LIMIT 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();  
    $registro = $sentencia->fetch(PDO::FETCH_LAZY); 

    $primernombre =  $registro["primernombre"];  
    $segundonombre =  $registro["segundonombre"];  
    $primerapellido =  $registro["primerapellido"];  
    $segundoapellido =  $registro["segundoapellido"];  

    // Concatenacion de strings 
    $nombreCompleto=$primernombre." ".$segundonombre."  ".$primerapellido." ".$segundoapellido;

    $foto =  $registro["foto"];  
    $cv =  $registro["cv"];  
    $idpuesto =  $registro["idpuesto"];  
    $puesto =  $registro["puesto"];  
    $fechadeingreso =  $registro["fechadeingreso"];  

    $fechaInicio = new DateTime($fechadeingreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio,$fechaFin);

}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion</title>
</head>
<body>

<h1>Carta de Recomendación Laboral</h1>
<br><br>
Cali Valle, Colombia <strong> <?php echo date('d M Y'); ?> </strong>
<br><br>
Reciba un cordial y respetuoso saludo.
<br><br>
A traves de estas lineas deseo hacer de su conocimiento que Sr(a) <strong> <?php echo $nombreCompleto;?> </strong>,
quien laboró en mi organizacion durante <strong><?php echo $diferencia->y;?> años</strong>
es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador,
comprometido, responsable y fiel cumplidor de sus tareas.
Siempre ha manifestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos.
<br> <br>
Durante estos años se ha desempeñado como: <strong> <?php echo $puesto;?> </strong>
Es por ello que le sugiero que considere esta recomendacion, con la confianza de que estara siempre de los requerimientos.
<br><br>
Sin mas nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi numero de contacto al final del documento.
<br><br><br><br><br>
___________________________________
<br>
Atentamente, 
<br>
Futuro <br>
Ing. Mecatronico - FullStack-Senior Developer <br>
Deyverson Herrera Valencia.
</body>
</html>

<?php 
$HTML = ob_get_clean(); //obtiene todo el codigo html desde el inicio hasta esta etiqueta, y se pone en la parte de abajo para cargarlo en la variable
require_once("../../libs/autoload.inc.php");  
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$opciones = $dompdf->getOptions(); 
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));


?>