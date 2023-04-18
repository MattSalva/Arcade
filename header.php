<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galaxy Arcade</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body>

<nav>
    <div class="nav">
        <input type="checkbox" id="nav-check">

        <div class="nav-header">

            <div class="nav-title">
                GALAXY ARCADE
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <?php if (!isset($_SESSION['usuario'])){
                echo '<a href="/modules/login.php">Entrar</a>';
            }
            else {
                echo '<a href="/modules/logout.php">Salir</a>';
            }
                ?>

        </div>
    </div>
</nav>