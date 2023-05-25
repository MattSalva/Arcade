<?php
//conexión con la base y selección de la base de datos
$conexion = mysqli_connect("localhost","root","","inter", 3307);
//traigo los datos del formulario
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$curso = $_POST["curso"];
//ejecución de la sentencia sql
mysqli_query($conexion, "INSERT INTO alumnos (nombre,email,curso)
VALUES ('$nombre','$email','$curso')");
header("Location: mostrar_lista.php");
?>