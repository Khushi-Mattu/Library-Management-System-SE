<?php
	$usernames = array();
	$usernames = $_POST['username'];
	$sum = 0;
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- webstite name -->
        <title>
            
            Bill
        </title>
        
            <!-- Bootstrap CSS -->
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- header section reqirement -->
            <link rel="stylesheet" href="header.css">

    </head>

    <body style="background-color: white; color: black;">
        <!-- Main container -->
        
      
        
        
        <div class="container">
            <div class="jumbotron" style="margin-top:30px; background-color: white; text-align : center;">
                <h1 id="menu" >Bill</h1>
                <h3>Verify Your Order</h3>

            </div>

            <div>
                <form method="post" action="order_con.php">
                <?php
                // database connetion 
                $conn = mysqli_connect("localhost", "root", "", "library");
                $query = "SELECT * FROM books";  
                $result = mysqli_query($conn, $query);
                
                // echo "<div class='row' style= 'color : black; margin-top : 1px;'>";
                $i=1;
$counter = 0;
$sum = 0;
?>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Book Name</th>
      <th scope="col">Price</th>
      <th scope="col">Mode</th>
      <th scope="col">Amount</th>
      
    </tr>
  </thead>
  <tbody>
	
			<?php	while($row = mysqli_fetch_array($result)){ ?>    
 <tr>
 <?php
 
 if(!$usernames[$counter] == ''){?>
     <th scope="row"><?php echo $i++;?></th>
      <td> <?php echo $row['book_item'];?> </td>
      <td><?php echo $row['price'];?></td>
      <td><?php echo $usernames[$counter];?></td>
      <td><?php echo $sum = $sum + $row['price'];?></td>
    </tr>

 
     
		
                <?php
                }
                    $counter++;

                    }
				?>
               
                
                </form>
            </div>
        </div> 
        </tbody>
</table>

<form action="bill.php" method="POST">
<h1> Total Bill = 
<input type = 'number' name = 'bill' class = 'class_name form-control input-number' value='<?php echo $sum ;?>'/><br/>

</h1>
 <input type="submit" style="float : right; margin-top : 30px;" class="btn btn-primary btn-lg btn-block" value="Confirm">
<form>

        
        

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    </body>
</html>