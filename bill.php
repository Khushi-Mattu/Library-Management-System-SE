<?php
$bill = $_POST['bill'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO bill ( bill ) VALUES ('.$bill.')";

if (mysqli_query($conn, $sql)) {
  echo "New order Placed";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>