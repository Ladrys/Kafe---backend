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


// Connect to the database
$servername = "sql110.epizy.com";
$username = "epiz_32912138";
$password = "Nw8sUu8IQmg0";
$database = "epiz_32912138_ladra";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
  die("Connection failed:" . $connection->connect_error);
}
$connection->set_charset("utf8mb4");

// Get the name of the selected user from the form submission
$name = $_POST['name'];

// Retrieve the data for the selected user from the database
$sql = "SELECT people.name, types.typ, COUNT(drinks.ID) as quantity
FROM drinks
INNER JOIN people on drinks.id_people = people.ID
INNER JOIN types on drinks.id_types = types.ID
WHERE people.name = '$name'
GROUP BY people.name, types.typ";
$result = $connection->query($sql);

if (!$result) {
  echo "Error: " . $connection->error;
  exit;
}

echo "<table>";
echo "<tr><th>Name</th><th>Type</th><th>Quantity</th></tr>";
while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td style='background-color: white;'>" . $row['name'] . "</td>";
  echo "<td style='background-color: white;'>" . $row['typ'] . "</td>";
  echo "<td style='background-color: white;'>" . $row['quantity'] . "</td>";
  echo "</tr>";
}
echo "</table>";

// Close the database connection
$connection->close();
?>





</body>

</html>
