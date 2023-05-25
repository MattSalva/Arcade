<?php
//pasamos los datos del formulario
$id = $_POST["dni"];
//conexión con la base y seleccion de la base de datos
$conexion = mysqli_connect("localhost","root","","inter", 3307);
//creamos la sentencia sql y la ejecutamos
$ssql="DELETE FROM alumnos WHERE dni='$id'";
mysqli_query($conexion,$ssql);

header("Location: mostrar_lista.php");
?>
