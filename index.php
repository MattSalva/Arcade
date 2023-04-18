<?php session_start(); ?>
<?php require_once('header.php'); ?>


<main>

    <?php
    function listarJuegos($arr_juegos)
    {
        for ($i = 0; $i < sizeof($arr_juegos); $i++) {
            $juego = $arr_juegos[$i];
            if (isset($_SESSION['usuario'])) {
                echo "<div class='card'>
                <img src='$juego[3]' alt='Avatar' style='width:10%'>
                <div class='container'>
                    <h4><b>$juego[1]</b></h4>
                </div>
                <div>
                    <form action='' method='get'>
                        <button type='submit' value='$juego[0]' name='id' id='$juego[0]'>Detalles</button>
                    </form>
                </div>
                <div>
                    <form action='' method='post'>
                        <button type='submit' value='$juego[1]' name='juego' id='$juego[0]'>Jugar</button>
                    </form>
                </div>
            </div>";

                if (isset($_GET['id']) && $juego[0] == $_GET['id']) {
                    echo "    <div class='card-detalles'> 
                                <h5>Descripción: $juego[4]</h5>
                                <h5>Valor: $juego[2]</h5>
                          </div>
                      </div>";
                } else {
                    echo "</div>";
                }

            } else {
                echo "<div class='card'>
                <img src='$juego[3]' alt='Avatar' style='width:10%'>
                <div class='container'>
                    <h4><b>$juego[1]</b></h4>
                </div>
                <div>
                    <form action='' method='post'>
                        <button type='submit' value='$juego[0]' name='id' id='$juego[0]'>Detalles</button>
                    </form>
                </div>
                <div>
                    <form action='' method='post'>
                        <button type='submit' value='$juego[1]' name='juego' id='$juego[0]' disabled>Jugar</button>
                    </form>
                </div>
            </div>";

                if (isset($_GET['id']) && $juego[0] == $_GET['id']) {
                    echo "    <div class='card-detalles'> 
                                <h5>Descripción: $juego[4]</h5>
                                <h5>Valor: $juego[2]</h5>
                          </div>
                      </div>";
                } else {
                    echo "</div>";
                }
            }

        }
    }
    function quitarCredito($user, $valor_juego, $link_db){
        $creditos_usuario = $user['creditos'] - 1;
        $id_usuario = $user['id'];
        mysqli_query($link_db,"UPDATE usuarios SET creditos = $creditos_usuario WHERE id = $id_usuario");

    }
    function cargarCredito($user, $link_db){
        $id_usuario = $user['id'];
        $creditos_usuario = $user['creditos'] + 1;
        mysqli_query($link_db,"UPDATE usuarios SET creditos = $creditos_usuario WHERE id = $id_usuario");
    }

    $db = mysqli_connect('127.0.0.1', 'root', '', 'arcade', 3307) or
    die("Error " . mysqli_error($db));
    $juegos = mysqli_query($db, "SELECT * FROM juegos") or die("Error " . mysqli_error($db));
    $juegos = mysqli_fetch_all($juegos);

    ?>
    <ul>
        <?php
        listarJuegos($juegos);
        ?>
    </ul>

    <?php
    if (!isset($_SESSION['usuario'])) {
        echo "<h2>Ingrese para jugar</h2>";
    } else {
        $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM usuarios WHERE id = " . $_SESSION['id_usuario'] ));
    }

    if (isset($_POST['juego'])){
        if ($user['creditos'] > 0){
            echo "<h2>Jugando al: " . $_POST['juego'] . "</h2>";
            $nombre_juego = $_POST['juego'];
            $juego = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM juegos WHERE nombre LIKE '$nombre_juego'"));
            quitarCredito($user, $juego['valor'], $db);
            unset($_POST['juego']);
        }
        else {
            echo "<h2>¡NO TIENES MAS CREDITOS!</h2>";
        }

    }

    if (isset($_SESSION['usuario'])){
        echo "<form action='' method='post' class='recarga'>
                <button type='submit' name='cargar' value='true'>Cargar Credito</button>
            </form>";
    }

    if(isset($_POST['cargar']) && $_POST['cargar'] == true){
        cargarCredito($user, $db);
    }

    if (isset($_SESSION['usuario'])){
        $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM usuarios WHERE id = " . $_SESSION['id_usuario'] ));
        echo "<h2>Creditos Disponibles: " . $user['creditos'] . "</h2>";
    }
    ?>
</main>
</body>
</html>


