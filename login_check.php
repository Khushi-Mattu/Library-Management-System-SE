<?php 

$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'password');



if (!empty($email)) {
	# code...
	if (!empty($pass)) {
		# code...
		$server = "localhost";
		$uname = "root";
		$dpass = "";
		$dbname = "library";
		$conn = mysqli_connect($server, $uname, $dpass, $dbname);
		if (mysqli_connect_error()) {
			# code...
			die('Connection error ('. mysqli_connect_errno(). ')'.mysqli_connect_error());
		}
		else{

			$result1 = mysqli_query($conn,"SELECT name, email, pass FROM userrec WHERE email = '".$email."' AND  pass = '".$pass."'");


            if (mysqli_num_rows($result1) > 0 && $row = $result1->fetch_assoc() ) { 
				// check if data is present in the database or not and  mysqli_fetch_assoc() function fetches a 
				//result row as an associative array.
            	session_start();
           	    $_SESSION['loggedin'] = true;
           	    $conn->close();
            	header('location: mainpage.php');

            }
            else{
            	echo "invalid user name and password";		
            }

		}


	}
	else{
		echo "enter password";

	}
}
else{
	echo "enter email";
}


 ?>