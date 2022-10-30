<?php include("templates/cabecera.php");?>
<?php include ('./buscan_hogar.php'); ?>
<?php include_once("./administrador/config/bd.php");
$conexionBD=BD::crearInstancia();

print_r($_POST);

?>



<?php include("templates/pie.php");?>