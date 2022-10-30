
<?php
$host="localhost";
$bd="sisveterinaria";
$usuario="root";
$contraseña="";

try {
        $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña );  

      

} catch ( Exeption $ex) {

    echo $ex->getMessage();
}

?>

<?php
$conexionadmin=mysqli_connect("localhost","root","", "sisveterinaria");

?>