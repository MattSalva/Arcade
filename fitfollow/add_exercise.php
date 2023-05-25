<?php
    if (isset($_GET['name'])){
        $name = $_GET['name'];
        $sets = $_GET['sets'];
        $reps = $_GET['reps'];
        $muscle = $_GET['muscle_group'];
        $db = mysqli_connect("localhost", "root", "", "fitfollow", 3307);
        $query = "INSERT INTO exercises (name, sets, reps, muscle_group) VALUES ('$name', '$sets', '$reps', '$muscle')";
        echo $query;
        $res = mysqli_query($db, $query);
    }
?>

<form method="get" action="add_exercise.php">
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="sets">Sets</label>
        <input type="number" id="sets" name="sets">
    </div>
    <div>
        <label for="reps">Reps</label>
        <input type="number" id="reps" name="reps">
    </div>
    <div>
        <label for="muscle_group">Muscle Group</label>
        <input type="text" id="muscle_group" name="muscle_group">
    </div>

    <button type="submit">Add</button>
</form>

<br>
<a href="http://localhost:8080/fitfollow"><button>Go Back</button></a>
