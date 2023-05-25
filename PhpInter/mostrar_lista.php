<!doctype html>
<html lang="en">
<head>
    <title>Consulta de Alumnos</title>
</head>
<body>
<h1>Lectura de tabla de alumnos</h1>
<?php

date_default_timezone_set('America/Los_Angeles');

echo date("l"). "<br>";
// Imprime el día, fecha, mes, año, hora, AM o PM
echo date("l jS \of F Y h:i:s A"). "<br>";
// Imprime 3 de octubre de 1975 que fue un día viernes
echo "Oct 3,1975 fue un día ".date("l", mktime(0, 0, 0, 10, 3, 1975)). "<br>";
// Usa una constante en el parámetro de formato
echo date(DATE_RFC822). "<br>";
// imprime algo como: 1975-10-03T00:00:00+00:00
echo date(DATE_ATOM, mktime(0, 0, 0, 10, 3, 1975));


$fecha_actual = getdate(time());
echo($fecha_actual['hours'] . "-" . $fecha_actual['minutes'] . "-" .
    $fecha_actual['seconds']);


// Imprime el array de getdate()
print_r(getdate());
echo "<br><br>";
// Devuelve la información de fecha/hora de una marca de tiempo; luego formatea la salida
$mydate = getdate(date("U"));
echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";



//conectamos la base de datos
$conexion = mysqli_connect("localhost", "root", "", "inter", 3307);
//ejecutamos la sentencia sql
$result = mysqli_query($conexion, "SELECT * from alumnos");


// poner el contenido de un fichero en una cadena

$miArchivo = fopen ("algo.txt", "w");
$txt = "Rubén\n";
fwrite($miArchivo, $txt);
$txt = "Emilia\n";
fwrite($miArchivo, $txt);
fclose($miArchivo);

$nombreFichero = "algo.txt";
$gestor = fopen($nombreFichero, "r");
$contenido = fread($gestor, filesize($nombreFichero));

while (!feof($gestor)) {
    echo fgets($gestor). "<br>";
    echo "<br>";

}

fclose($gestor);

$miArchivo = fopen ("prueba.txt", "w");
$txt = "Cosas de prueba\n";
fwrite($miArchivo, $txt);
fclose($miArchivo);



$miArchivo = fopen("prueba.txt", "r");
// Lee la primera línea
echo fgets($miArchivo);
echo "<br>";

// Se dirige al principio del archivo
fseek($miArchivo, 0);
fclose($miArchivo);


$miArchivo = fopen("prueba.txt","r");
//Cambia la posición del puntero del archivo
fseek($miArchivo,"15");
//Establece el puntero de archivo a 0
rewind ($miArchivo);
fclose($miArchivo);


$miArchivo = fopen("prueba.txt","r");
// Devuelve la posición actual del puntero
echo ftell($miArchivo);
echo "<br>";

// Mueve el puntero 15 lugares
fseek($miArchivo,"15");
// Devuelve la nueva posición actual
echo "<br>" . ftell($miArchivo);
echo "<br>";
fclose($miArchivo);

echo copy("prueba.txt","copia.txt");
echo "<br>";

rename("copia.txt","copiaprueba.txt");

$archivo = fopen("prueba.txt","w");
echo fwrite($archivo,"Este es el contenido de nuestro archivo");
echo "<br>";

fclose($archivo);
unlink("prueba.txt");


?>


<table align="center" border="1">
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Curso</th>
    </tr>
    <?php
    //mostramos los registros con un bucle while
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr><td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $row["curso"] . '</td></tr>';
    }
    mysqli_free_result($result)
    ?>
</table>
<nav>
    <ul>
        <li><a href="añadir.html">Añadir un registro</a></li>
        <li><a href="actualizar.php">Actualizar un registro</a></li>
        <li><a href="borrar.php">Borrar un registro</a></li>
    </ul>
</nav>
</body>
</html>