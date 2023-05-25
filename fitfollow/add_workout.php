<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fitfollow</title>
</head>
<body>
    <h3>Select Exercises Done</h3>

    <form method="post" action="generate.php">
        <div>
            <label for="exercisedate">Date of exercises</label>
            <input type="date" name="exercisedate" id="exercisedate">
        </div>
      <?php

      $db = mysqli_connect("localhost", "root", "", "fitfollow", 3307);
      $query = "SELECT * FROM exercises INNER JOIN
    exercises_routines er ON exercises.id = er.exercise_id INNER JOIN routines r on er.routine_id = r.id WHERE r.id = " . $_GET['routines'];
      $res = mysqli_query($db, $query);
      $exercises = mysqli_fetch_all($res);
      $routine =  mysqli_query($db, "SELECT name, difficulty FROM routines WHERE id = ". $_GET['routines']);
      $routine =  mysqli_fetch_array($routine);
      echo "<input type='hidden' id='routinename' name='routine' value=$routine[0]>";
      echo "<input type='hidden' id='routinedifficulty' name='difficulty' value=$routine[1]>";

      foreach ($exercises as $exercise){
          echo "<input type='checkbox' id='$exercise[1]' name='$exercise[0]' value='$exercise[1]'/>";
          echo "<label for='$exercise[1]'>$exercise[1]</label></br>";
      }
      ?>



      <input type="submit">


    </form>

    <br>
    <a href="http://localhost:8080/fitfollow"><button>Go Back</button></a>
</body>
</html>