<?php
$db = mysqli_connect("localhost", "root", "", "fitfollow", 3307);
$datestring = date("Ymd",strtotime($_POST['exercisedate']));
$file = fopen("workouts/files/workout". $datestring . ".txt", "w+");

foreach ($_POST as $key => $val){
    if ($key == "exercisedate"){
        fwrite($file, "Fecha: ".$_POST['exercisedate']. "\n");
    } elseif ($key == "routine"){
        fwrite($file, "Rutina: ".$_POST['routine']. "\n");
    } elseif ($key == "difficulty"){
        fwrite($file, "Dificultad: ".$_POST['difficulty']. "\n");
    }




    else {
        $query = "SELECT * FROM exercises WHERE id = " . $key;
        $exercise = mysqli_query($db, $query);
        $exercise = mysqli_fetch_array($exercise);
        fwrite($file,"- $val - Sets: $exercise[2] - Reps $exercise[3] - Muscle Group $exercise[4]  \n" ) ;
    }
}
echo "Workout saved in file: " . "workout". $datestring . ".txt";

fclose($file);
?>
<br>
<a href="http://localhost:8080/fitfollow"><button>Go Back</button></a>
