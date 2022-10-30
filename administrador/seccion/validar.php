<?php
include('../config/bd.php');
$Usuario=$_POST ['usuario'];
$Password= $_POST['password'];

$consulta= "SELECT *FROM Personal where Usuario= '$Usuario' and password= '$Password' ";
$resultado=mysqli_query($conexionadmin,$consulta);
$filas= mysqli_num_rows($resultado);
if($filas){
    header("location:index.php");
}else{

    include("../Inicio.php");
    ?>
    <h1>ERROR DE AUTENTICACION</h1>
    <?php

}
mysqli_free_result($resultado);
mysqli_close($conexionadmin);

?>