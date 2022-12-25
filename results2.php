<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="styles.css">



  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>

</head>

<body style="margin : 50px;">

  <?php

  $servername = "sql110.epizy.com";
  $username = "epiz_32912138";
  $password = "Nw8sUu8IQmg0";
  $database = "epiz_32912138_ladra";
  // Connect to the database
  

  $connection = new mysqli($servername, $username, $password, $database);
  if ($connection->connect_error) {
    die("Connection failed:" . $connection->connect_error);
  }
  $connection->set_charset("utf8mb4");

  // Get the name of the selected user and the month from the form submission
  $name = $_POST['name'];
  $month = $_POST['month'];

  // Retrieve the data for the selected user from the database
  $sql ="SELECT people.name, types.typ, monthname(date) as month,
  COUNT(drinks.ID) as quantity,
  SUM(CASE WHEN types.typ = 'Mléko' THEN 50 ELSE 0 END +
      CASE WHEN types.typ = 'Espresso' THEN 7 ELSE 0 END +
      CASE WHEN types.typ = 'Coffe' THEN 14 ELSE 0 END +
      CASE WHEN types.typ = 'Long' THEN 14 ELSE 0 END +
      CASE WHEN types.typ = 'Doppio+' THEN 21 ELSE 0 END) as total_weight,
  SUM(CASE WHEN types.typ = 'Mléko' THEN 50 ELSE 0 END +
      CASE WHEN types.typ = 'Espresso' THEN 7 ELSE 0 END +
      CASE WHEN types.typ = 'Coffee' THEN 14 ELSE 0 END +
      CASE WHEN types.typ = 'Long' THEN 14 ELSE 0 END +
      CASE WHEN types.typ = 'Doppio+' THEN 21 ELSE 0 END +
      CASE WHEN types.typ = 'Coffe' THEN 14 ELSE 0 END) * 300 / 1000 as total_cost
FROM drinks
INNER JOIN people on drinks.id_people = people.ID
INNER JOIN types on drinks.id_types = types.ID
WHERE people.name = '" . $name . "'
GROUP BY people.name, types.typ, monthname(date)";
  $result = $connection->query($sql);

  if (!$result) {
    echo "Error: " . $connection->error;
    exit;
  }



  // Loop through the results and display them in a table
  echo "<table>";
  echo "<tr ><th '>Name</th>
  <th >Type</th>
  <th >Month</th>
  <th >Quantity</th>
  <th >Total weight</th>
  <th >Total cost</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td  style='background-color: white;'>" . $row['name'] . "</td>";
    echo "<td  style='background-color: white;'>" . $row['typ'] . "</td>";
    echo "<td  style='background-color: white;'>" . $row['month'] . "</td>";
    echo "<td  style='background-color: white;'>" . $row['quantity'] . "</td>";
    echo "<td  style='background-color: white;'>" . $row['total_weight'] . " g</td>";
    echo "<td  style='background-color: white;'>" . round($row['total_cost'], 2) . " Kč</td>";
    echo "</tr>";
  }
  echo "</table>";
  ?>

</body>

</html>
