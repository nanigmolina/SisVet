<?php include ('templates/cabecera.php'); ?>

<?php 
include("administrador/config/bd.php");
$sentenciaSQL=$conexion->prepare("SELECT * FROM buscan_hogar");
$sentenciaSQL-> execute();
$perdidos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($perdidos as $buscan_hogar ){ ?>
<div class="col-md-3" >
<div class="card"  >
<img class="card-img-top" src="./img/<?php echo $buscan_hogar['Imagen']; ?>" alt="">
<div class="card-body">
        <h4 class="card-title" ><?php echo $buscan_hogar['Descripcion']; ?></h4>
        
       <a name="" id="" class="btn btn-primary" href="mailto:veterinaria@gmail.com" role="button">Consultas  </a>
</div>
</div>
</div>

<?php }?>

<?php include ('templates/pie.php'); ?>