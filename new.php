<?php
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'pass1');
$con = filter_input(INPUT_POST, 're_pass');

$conn = mysqli_connect("localhost", "root", "", "library");

if (mysqli_connect_error()) {
# code...
		die('Connection error ('. mysqli_connect_errno(). ')'.mysqli_connect_error());
}	else {
		$sql=mysqli_query($conn, "INSERT INTO userrec (name,email,pass,contact) VALUES ('$name','$email','$password','$con')");
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		}
		else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		header('location: login.php');
		$conn->close();
}
?>