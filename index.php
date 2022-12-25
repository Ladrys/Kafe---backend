<?php

$servername = "sql110.epizy.com";
$username = "epiz_32912138";
$password = "Nw8sUu8IQmg0";
$database = "epiz_32912138_ladra";


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed:" . $connection->connect_error);
}
$connection->set_charset("utf8mb4");
?>


<!DOCTYPE html>
<html lang="en">

<head>
 
  <link rel="stylesheet" href="styles.css">

  <script src="script.js"></script>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>

</head>



<body style="margin : 50px;">

  <h1>Kdo toho kolik vypil?</h1>
  <form action="results.php" method="post">
    <label for="name">Vyber uživatele:</label>
    <select name="name" id="name">
      <option value="">---</option>
      
      <?php

    // Connect to the database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
      die("Connection failed:" . $connection->connect_error);
    }
    $connection->set_charset("utf8mb4");

    // Retrieve a list of all users from the database
    $sql = "SELECT * FROM people";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" value="Submit">
  </form>



  <h1>Kdo toho kolik vypil měsíčně a kolik ho to stálo?</h1>



  <form action="results2.php" method="post">
    <label for="name">Vyber uživatele:</label>
    <select name="name" id="name">
      <option value="">---</option>
      <?php
    

    // Retrieve a list of all users from the database
    $sql = "SELECT * FROM people";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" value="Submit">
  </form>

  



</body>

</html>
