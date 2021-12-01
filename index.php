<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books!!</title>
    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/index.css" rel="stylesheet" />
    
</head>

<style>
  <?php include "css/index.css" ?>
  <?php include "css/index.css" ?>
  <?php include "css/bootstrap.min.css" ?>
</style>
<body style="background-color: burlywood;">
    <?php
    include "includes/header.php";
    ?>

    <div class="banner-container">
        <h2 class="white-pb-3">This is the perfect place for bookworms!</h2>

        <form id="search-form" action="book_list.php" method="GET">
            <div class="input-group city-search">
                <input type="text" class="form-control input-city" id='bookName' name='bookName' placeholder="Enter the book name you want to search for" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">
                        <em class="fa fa-search"></em>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    include "includes/footer.php";
    ?>

</body>

</html>
