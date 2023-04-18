<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Galaxy Arcade</title>
	<link rel="stylesheet" type="text/css" href="../login.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Registrarse</label>
					<input type="text" name="new_user" placeholder="User name" required="">
					<input type="email" name="new_email" placeholder="Email" required="">
					<input type="password" name="new_pswd" placeholder="Password" required="">
                    <?php
                    $db = mysqli_connect('127.0.0.1', 'root', '', 'arcade', 3307) or
                    die("Error " . mysqli_error($db));

                    if (isset($_POST['email'])  && isset($_POST['pswd'])){
                        $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM usuarios WHERE mail LIKE '". $_POST['email'] . "';"));
                        if(isset($user)){
                            if($user["password"] == md5($_POST["pswd"])){
                                $_SESSION['usuario'] = $user['usuario'];
                                $_SESSION['id_usuario'] = $user['id'];
                                $_SESSION['creditos_usuario'] = $user['creditos'];
                                sleep(2);
                                header('Location: http://localhost:8080');
                                exit;
                            }
                            else {
                                echo "<h1>Wrong Login</h1>";
                            }

                        }
                        else {
                            echo "<h1>Wrong Login</h1>";
                        }

                    }

                    if (isset($_POST['new_user'])){
                        $user = mysqli_fetch_array(mysqli_query($db, "SELECT id, usuario, mail FROM usuarios WHERE usuario LIKE '". $_POST['new_user'] . "' OR mail LIKE '" . $_POST['new_email'] . "';"));
                        if(!is_null($user)) {
                            echo "<h1>El usuario ya existe!</h1>";
                            unset($_POST['new_user']);
                        }
                        else {
                            $_POST['new_pswd'] = md5($_POST['new_pswd']);
                            $sql = "INSERT INTO usuarios(usuario, password, mail) VALUES(?,?,?)";
                            $stmt = mysqli_prepare($db, $sql);
                            mysqli_stmt_bind_param($stmt, 'sss', $_POST['new_user'], $_POST['new_pswd'], $_POST['new_email']);
                            mysqli_stmt_execute($stmt);
                            echo "<h1>Registro OK</h1>";
                            unset($_POST['new_user']);
                        }

                    }
                    ?>
					<button>Registrarse</button>
				</form>
			</div>

			<div class="login">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Ingresar</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Ingresar</button>
				</form>
			</div>
	</div>
</body>
</html>