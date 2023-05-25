<?php
$db = mysqli_connect("localhost", "root", "", "fitfollow", 3307);
if (isset($_GET['name'])){
    $name = $_GET['name'];
    $difficulty = $_GET['difficulty'];
    $query = "INSERT INTO routines (name, difficulty) VALUES ('$name', '$difficulty')";
    echo $query;
    $res = mysqli_query($db, $query);
    $last_id = mysqli_insert_id($db);
    $fk = mysqli_query($db, "SET GLOBAL FOREIGN_KEY_CHECKS=0;");

    foreach ($_GET as $key => $value){
        if ($key !== "name" AND $key !== "difficulty"){
            $query = "INSERT INTO exercises_routines VALUES ('$value', '$last_id')";
            $res = mysqli_query($db, $query);
            }
        }
    }

?>

<form method="get" action="add_routine.php">
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="difficulty">Difficulty</label>
        <input type="text" id="difficulty" name="difficulty">
    </div>
    <?php
    $exercises = mysqli_query($db, "SELECT id, name FROM exercises");
    $exercises = mysqli_fetch_all($exercises);
    foreach ($exercises as $exercise){
      echo "<input type='checkbox' id='$exercise[1]' name='$exercise[1]' value='$exercise[0]'/>";
      echo "<label for='$exercise[1]'>$exercise[1]</label></br>";
          }


      ?>


    <button type="submit">Add</button>
</form>

<br>
<a href="http://localhost:8080/fitfollow"><button>Go Back</button></a>
