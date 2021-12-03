<?php
echo $dname = filter_input(INPUT_POST, 'dname');
echo $dprice = filter_input(INPUT_POST, 'dprice');
echo $aname = filter_input(INPUT_POST, 'aname');
echo $message = filter_input(INPUT_POST, 'message');
$conn = mysqli_connect("localhost", "root", "", "library");

if (mysqli_connect_error()) {
# code...
		die('Connection error ('. mysqli_connect_errno(). ')'.mysqli_connect_error());
}	else {
		$sql=mysqli_query($conn, "INSERT INTO books (book_item,a_name,des,price) VALUES ('$dname','$aname','$message','$dprice')");
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		}
		else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		header('location: admin.html');
		$conn->close();
}

?>