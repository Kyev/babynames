
<?php
require_once './php/db_connect.php';
$tablefavorite = "CREATE TABLE IF NOT EXISTS FAVORITE (
                rank int(11),
                name varchar(255) NOT NULL,
                gender varchar(255) NOT NULL)";

$tablebabynames2015 = "CREATE TABLE IF NOT EXISTS BABYNAMESONE (
                rank int(11),
                name varchar(255) NOT NULL,
                gender varchar(255) NOT NULL,
                num_births int(11))";

$tablebabynames2005 = "CREATE TABLE IF NOT EXISTS BABYNAMESTWO (
                rank int(11),
                name varchar(255) NOT NULL,
                gender varchar(255) NOT NULL,
                num_births int(11))";

$tablebabynames1995 = "CREATE TABLE IF NOT EXISTS BABYNAMESTHREE (
                rank int(11),
                name varchar(255) NOT NULL,
                gender varchar(255) NOT NULL,
                    num_births int(11))";

mysqli_query($db, $tablefavorite);

mysqli_query($db, $tablebabynames2015);

mysqli_query($db, $tablebabynames2005);

mysqli_query($db, $tablebabynames1995);

$myfileone = fopen("yob2015.txt", "r") or die("Unable to open file!");
      $girlrank = 1;
      $boyrank = 1;
      while (!feof($myfileone))
        {
          $line = fgets($myfileone)."<br />";
          list($Name,$Gender,$Num_births) = array_pad(explode(',', $line, 3), 3, $line);
          if ($Gender == 'F'){
              mysqli_query($db, "INSERT INTO BABYNAMESONE (rank, name, gender, num_births)
              VALUES ('$girlrank', '$Name', '$Gender', '$Num_births')");
              $girlrank++;
          } else {
              mysqli_query($db, "INSERT INTO BABYNAMESONE (rank, name, gender, num_births)
              VALUES ('$boyrank', '$Name', '$Gender', '$Num_births')");
              $boyrank++;
          }
        }
      fclose($myfileone);

$myfiletwo = fopen("yob2005.txt", "r") or die("Unable to open file!");
      $girlrank = 1;
      $boyrank = 1;
      while (!feof($myfiletwo))
        {
          $line = fgets($myfiletwo)."<br />";
          list($Name,$Gender,$Num_births) = array_pad(explode(',', $line, 3), 3, $line);
          if ($Gender == 'F'){
              mysqli_query($db, "INSERT INTO BABYNAMESTWO (rank, name, gender, num_births)
              VALUES ('$girlrank', '$Name', '$Gender', '$Num_births')");
              $girlrank++;
          } else {
              mysqli_query($db, "INSERT INTO BABYNAMESTWO (rank, name, gender, num_births)
              VALUES ('$boyrank', '$Name', '$Gender', '$Num_births')");
              $boyrank++;
          }
        }
      fclose($myfiletwo);

$myfilethree = fopen("yob1995.txt", "r") or die("Unable to open file!");
     $girlrank = 1;
     $boyrank = 1;
     while (!feof($myfilethree))
       {
         $line = fgets($myfilethree)."<br />";
         list($Name,$Gender,$Num_births) = array_pad(explode(',', $line, 3), 3, $line);
         if ($Gender == 'F'){
             mysqli_query($db, "INSERT INTO BABYNAMESTHREE (rank, name, gender, num_births)
             VALUES ('$girlrank', '$Name', '$Gender', '$Num_births')");
             $girlrank++;
         } else {
             mysqli_query($db, "INSERT INTO BABYNAMESTHREE (rank, name, gender, num_births)
             VALUES ('$boyrank', '$Name', '$Gender', '$Num_births')");
             $boyrank++;
         }
       }
     fclose($myfilethree);


if (isset($_POST['submit'])){

    $result4 = mysqli_query($db,"SELECT * FROM FAVORITE WHERE name ='$_POST[name]'");

    if($result4->num_rows > 0) {
        mysqli_query($db,"UPDATE FAVORITE SET rank=rank+1 WHERE name='$_POST[name]'");
    } else {
        mysqli_query($db, "INSERT INTO FAVORITE (rank, name, gender) VALUES ('1','$_POST[name]','$_POST[gender]')");
    }
    header('HTTP/1.1 303 See Other');
    header('Location: vote.php?message=success&name=$_POST[name]');
    exit();

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Babynames</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
  <body>
      <div class="container">
        <div class="page-header">
          <h1><center>Most Popular Names</center></h1>
        </div>
        <div class="alert alert-info">
            <div class='row'>
                <div class='center-block col-md-3 col-sm-12'>
                  <div class="form-group">
                     <form action="vote.php" method="post">
                         <input class="form-control" type="text" name="name" required="true"><br />
                         <select class="form-control dropdown" name="gender">
                           <option value="M">Male</option>
                           <option value="F">Female</option>
                         </select>
                        <button type="submit" class="voteAdded button btn btn-info" name="submit">SUBMIT!</button>
                     </form>
                        <div class="text-center">
                          <div class="btn-group" data-toggle="buttons">
                            <input type='button' class="btn btn-primary" id='hideshowvote' value='VOTE'>
                            <input type='button' class="btn btn-primary" id='hideshowone' value='2015'>
                            <input type='button' class="btn btn-primary" id='hideshowtwo' value='2005'>
                            <input type='button' class="btn btn-primary" id='hideshowthree' value='1995'>
                         </div>
                      </div>
                   </div>
                 </div>
            </div>
        </div>
        <div id="confirmVote" class="alert alert-success" style="display:none"><center><h2>Thank you!!! Your vote is being added!!!<h2></center></div>
<div class="row">
    <div class="col-md-12">
        <div id="content-vote"  class='data-one alert alert-success'>
       <?php
       echo "
       <div class='col-md-12'>
       <center><h2>Popular Votes<h2></center>" . PHP_EOL;
       $result3 = mysqli_query($db,"SELECT * FROM FAVORITE ORDER BY rank DESC");
       if($result3->num_rows > 0) {
          echo "
          <table class='table table-striped'>
          <thead>
          <tr>
          <th>Votes</th>
          <th>Name</th>
          <th>Sex</th>
          </tr>
          </thead>
          <tbody>" . PHP_EOL;
          while($row = $result3->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $row["rank"] . '</td>';
              echo '<td>' . $row["name"] . '</td>';
              echo '<td>' . $row["gender"] . '</td>';
              echo '</tr>'. PHP_EOL;
          }
          echo '         </tbody> </table> </div>' . PHP_EOL;

       }  else {
          echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
       }
       echo "</div>". PHP_EOL;
       ?>
 </div>
</div>
      <div class="row">
          <div class="col-md-12">
              <div id="content-one"  class="data-one alert alert-success">
                   <?php
                   $result3 = mysqli_query($db,"SELECT * FROM BABYNAMESONE WHERE gender = 'M' AND rank < 6");
                   echo "
                   <div class='col-md-6 col-sm-12'>
                   <h1>Boy Names 2015</h1>" . PHP_EOL;
                   if($result3->num_rows > 0) {
                      echo "<div class='alert alert-info'>
                      <table class='table table-striped'>
                      <thead>
                      <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th># of births</th>
                      </tr>
                      </thead>
                      <tbody>" . PHP_EOL;
                      while($row = $result3->fetch_assoc()) {
                          echo '<tr>';
                          echo '<td>' . $row["rank"] . '</td>';
                          echo '<td>' . $row["name"] . '</td>';
                          echo '<td>' . $row["num_births"] . '</td>';
                          echo '</tr>'. PHP_EOL;
                      }
                      echo '         </tbody> </table> </div>' . PHP_EOL;

                   }  else {
                      echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                   }
                   echo "</div>". PHP_EOL;
                   $result4 = mysqli_query($db,"SELECT * FROM BABYNAMESONE WHERE gender = 'F' AND rank < 6");
                   echo "<div class='col-md-6 col-sm-12'>
                   <h1>Girl Names 2015</h1>" . PHP_EOL;
                   if($result4->num_rows > 0) {
                      echo "<div class='alert alert-danger'>
                      <table class='table table-striped'>
                      <thead>
                      <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th># of births</th>
                      </tr>
                      </thead>
                      <tbody>" . PHP_EOL;
                      while($row = $result4->fetch_assoc()) {
                          echo '<tr>';
                          echo '<td>' . $row["rank"] . '</td>';
                          echo '<td>' . $row["name"] . '</td>';
                          echo '<td>' . $row["num_births"] . '</td>';
                          echo '</tr>'. PHP_EOL;
                      }
                      echo '         </tbody> </table> </div>' . PHP_EOL;

                   }  else {
                      echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                   }
                   echo "</div>". PHP_EOL;
                   echo "</div>". PHP_EOL;
                   ?>
               </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <?php
                  $result = mysqli_query($db,"SELECT * FROM BABYNAMESTWO WHERE gender = 'M' AND rank < 6");
                  echo "
                  <div id='content-two'  class='data-one alert alert-success'>
                  <div class='col-md-6 col-sm-12'>
                  <h1>Boy Names 2005</h1>" . PHP_EOL;
                  if($result->num_rows > 0) {
                     echo "<div class='alert alert-info'>
                     <table class='table table-striped'>
                     <thead>
                     <tr>
                     <th>Rank</th>
                     <th>Name</th>
                     <th># of births</th>
                     </tr>
                     </thead>
                     <tbody>" . PHP_EOL;
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["rank"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["num_births"] . '</td>';
                        echo '</tr>'. PHP_EOL;
                    }
                    echo '         </tbody> </table> </div>' . PHP_EOL;
                     }  else {
                        echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                     }
                     echo "</div>". PHP_EOL;
                     $result2 = mysqli_query($db,"SELECT * FROM BABYNAMESTWO WHERE gender = 'F' AND rank < 6");
                     echo "<div class='col-md-6 col-sm-12'>
                     <h1>Girl Names 2005</h1>" . PHP_EOL;
                     if($result2->num_rows > 0) {
                        echo "<div class='alert alert-danger'>
                        <table class='table table-striped'>
                        <thead>
                        <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th># of births</th>
                        </tr>
                        </thead>
                        <tbody>" . PHP_EOL;
                        while($row = $result2->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["rank"] . '</td>';
                            echo '<td>' . $row["name"] . '</td>';
                            echo '<td>' . $row["num_births"] . '</td>';
                            echo '</tr>'. PHP_EOL;
                        }
                        echo '         </tbody> </table> </div>' . PHP_EOL;

                     }  else {
                        echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                     }
                     echo "</div>". PHP_EOL;
                     echo "</div>". PHP_EOL;
                     ?>
               </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div id="content-three"  class="data-one alert alert-success">
                       <?php
                       $result5 = mysqli_query($db,"SELECT * FROM BABYNAMESTHREE WHERE gender = 'M' AND rank < 6");
                       echo "
                       <div class='col-md-6 col-sm-12'>
                       <h1>Boy Names 1995</h1>" . PHP_EOL;
                       if($result5->num_rows > 0) {
                          echo "<div class='alert alert-info'>
                          <table class='table table-striped'>
                          <thead>
                          <tr>
                          <th>Rank</th>
                          <th>Name</th>
                          <th># of births</th>
                          </tr>
                          </thead>
                          <tbody>" . PHP_EOL;
                          while($row = $result5->fetch_assoc()) {
                              echo '<tr>';
                              echo '<td>' . $row["rank"] . '</td>';
                              echo '<td>' . $row["name"] . '</td>';
                              echo '<td>' . $row["num_births"] . '</td>';
                              echo '</tr>'. PHP_EOL;
                          }
                          echo '         </tbody> </table> </div>' . PHP_EOL;

                       }  else {
                          echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                       }
                       echo "</div>". PHP_EOL;
                       $result6 = mysqli_query($db,"SELECT * FROM BABYNAMESTHREE WHERE gender = 'F' AND rank < 6");
                       echo "<div class='col-md-6 col-sm-12'>
                       <h1>Girl Names 1995</h1>" . PHP_EOL;
                       if($result6->num_rows > 0) {
                          echo "<div class='alert alert-danger'>
                          <table class='table table-striped'>
                          <thead>
                          <tr>
                          <th>Rank</th>
                          <th>Name</th>
                          <th># of births</th>
                          </tr>
                          </thead>
                          <tbody>" . PHP_EOL;
                          while($row = $result6->fetch_assoc()) {
                              echo '<tr>';
                              echo '<td>' . $row["rank"] . '</td>';
                              echo '<td>' . $row["name"] . '</td>';
                              echo '<td>' . $row["num_births"] . '</td>';
                              echo '</tr>'. PHP_EOL;
                          }
                          echo '         </tbody> </table> </div>' . PHP_EOL;

                       }  else {
                          echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
                       }
                       echo "</div>". PHP_EOL;
                       echo "</div>". PHP_EOL;
                       ?>
                   </div>
              </div>
</div>
<?php
mysqli_query($db,"DROP TABLE BABYNAMESONE");
mysqli_query($db,"DROP TABLE BABYNAMESTWO");
mysqli_query($db,"DROP TABLE BABYNAMESTHREE");
?>
  </body>
</html>
