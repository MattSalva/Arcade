<?php
//pasamos los datos del formulario
$dni = $_POST["dni"];
$email = $_POST["email"];
$curso = $_POST["curso"];
//conexión con la base y selección de la base de datos
$conexion = mysqli_connect("localhost","root","","inter", 3307);
//creamos la sentencia sql y la ejecutamos
$ssql="UPDATE alumnos SET email='$email', curso='$curso' WHERE dni=$dni";
mysqli_query($conexion, $ssql);
header("Location: mostrar_lista.php");
?>
