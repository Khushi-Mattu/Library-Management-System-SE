<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$stock=mysqli_query("select * from stock",$connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK <?php echo $bookName ?> Library</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/book_list.css" rel="stylesheet" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $book[0]['book_name']; ?>
            </li>
        </ol>
    </nav>

    <div class="page-container">
    
            <div class="book-card book-id-<?= $book['book_id'] ?> row">
                <div class="image-container col-md-4">
                    <img src="img/books/1000" />
                </div>
                <div class="content-container col-md-8">
                    <div class="row no-gutters justify-content-between">
                        <?php
                        $total_rating = ($book['rating_plot'] + $book['rating_suspense'] + $book['rating_story_buildup']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <div class="star-container" title="<?= $total_rating ?>">
                            <?php
                            $rating = $total_rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star"></i>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        
                    </div>
                    <div class="detail-container">
                        <div class="book-name"><?= $book['book_name'] ?></div>
                    </div>
                    <div class="row no-gutters">
                        <div class="price-container col-6">
                            <div class="price">₹ <?= number_format($book['price']) ?>/-</div>
                        </div>
                        <div class="button-container col-6">
                            <a href="book_details.php?book_id=<?= $book['book_id'] ?>" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        

        if (count($book) == 0) {
        ?>
            <div class="no-book-container">
                <p>No book to list</p>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    ?>

    <script type="text/javascript" src="js/book_list.js"></script>
</body>

</html>
