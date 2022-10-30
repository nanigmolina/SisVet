<?php include ('../templates/cabecera.php'); ?>

<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");


switch($accion){
    //INSERT INTO `buscan_hogar` (`ID`, `Descripcion`, `Imagen`) VALUES (NULL, '', '')
    case"Agregar":
        $sentenciaSQL=$conexion->prepare("INSERT INTO buscan_hogar (Descripcion,Imagen ) VALUES (:Descripcion,:imagen);");
        $sentenciaSQL->bindParam(':Descripcion',$txtDescripcion);
    
        $Fecha= new Datetime();
        $nombreArchivo=($txtImagen!="")?$Fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        }
          $sentenciaSQL->bindParam(':imagen',$nombreArchivo); 
          $sentenciaSQL-> execute();
          header("location:perdidos.php");       
          break;

       //UPDATE `buscan_hogar` SET `Descripcion` = 'momo' WHERE `buscan_hogar`.`ID` = 3
    case"Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE `buscan_hogar` SET `Descripcion` = :Descripcion WHERE `buscan_hogar`.`ID` = :id");
        $sentenciaSQL->bindParam(':Descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL-> execute();
  
        
        if($txtImagen!=""){

            $Fecha= new Datetime();
            $nombreArchivo=($txtImagen!="")?$Fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT Imagen FROM buscan_hogar WHERE ID=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL-> execute();
            $perdidos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if(isset($perdidos["imagen"]) &&($perdidos["imagen"]!="imagen.jpg")){
                  if(file_exists("../../img/".$perdidos["imagen"])){
                  unlink("../../img/".$perdidos["imagen"]);
                }
            }
            $sentenciaSQL=$conexion->prepare("UPDATE buscan_hogar SET Imagen=:imagen WHERE ID=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL-> execute();

        }
          header("Location:perdidos.php");
        break;
        
        break;


    case"Cancelar":
         header("Location:perdidos.php");
        break; 

    case"Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM buscan_hogar WHERE ID=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL-> execute();
        $perdidos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtDescripcion=$perdidos['Descripcion'];
        $txtImagen=$perdidos['imagen'];
        
        //echo "Presionado boton Seleccionar";
        break;

      case"Borrar":
        
        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM buscan_hogar WHERE ID=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL-> execute();
        $perdidos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($perdidos["imagen"]) &&($perdidos["imagen"]!="imagen.jpg")){


            if(file_exists("../../img/".$perdidos["imagen"])){

                unlink("../../img/".$perdidos["imagen"]);
            }
        }
        
        $sentenciaSQL=$conexion->prepare("DELETE FROM buscan_hogar WHERE ID=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL-> execute();
        header("Location:perdidos.php");
        break;
        //echo "Presionado boton Borrar";
       
    
}
$sentenciaSQL=$conexion->prepare("SELECT * FROM buscan_hogar");
$sentenciaSQL-> execute();
$buscanhogar=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
   
   <div class="card">
       <div class="card-header">
           Datos del animal
       </div>
        
       <div class="card-body">
           
       <form method= "POST" enctype="multipart/form-data" >

   <div class = "form-group">
   <label for="txtID">ID:</label>
   <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"  placeholder="ID">
   </div>
   <br>
   <div class = "form-group">
   <label for="txtDescripcion">Descripcion:</label>
   <textarea required class="form-control"  value="<?php echo "mailto: $txtDescripcion "; ?>" name="txtDescripcion" id="txtDescripcion" rows="2" placeholder="Descripcion animal encontrado"></textarea>
   </div>   



   <br>
   <div class = "form-group">
   <label for="txtDescripcion" >Imagen(solo jpg):</label>
   

   <br/><br>

    <?php
    
        if($txtImagen!=""){ ?>
        <img class="thumbnail rounded" src="../../img/<?php echo $txtImagen;?>"width="50" alt="" srcset="">
    
     <?php } ?>

   
   <input type="file" class="form-control"  name="txtImagen" id="txtImagen"  placeholder="Nombre del animal">
   </div>   
  <br>
  <div class="btn-group" role="group" aria-label="">
      <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
      <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
      <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
  </div>

   </form>     
       </div>      

   </div>
    
</div>

<div class="col-md-7">
    
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>        
    </thead>

    <tbody>
    <?php
    foreach($buscanhogar as $perdidos) {
        
    ?>
        <tr>
            <td><?php echo $perdidos ['ID']?></td>
            <td><?php echo $perdidos ['Descripcion']?></td>
            <td>
            
            <img class="thumbnail rounded" src="../../img/<?php echo $perdidos ['Imagen']?>"width="50" alt="" srcset="">
                        
            
            </td>
                      
            <td>           

            <form method="post">
            
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $perdidos ['ID'] ?>" />
           
            <input type="submit" name= "accion" value="Seleccionar"class="btn btn-primary"/ >
                      
            <input type="submit" name= "accion" value="Borrar"class="btn btn-danger"/ >
            
            </form>

            </td>

        </tr>
        <?php   }?>   

    </tbody>
</table>
    
</div>

<?php include ('../templates/pie.php'); ?>