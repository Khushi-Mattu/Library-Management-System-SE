<?php
session_start();
require "includes/database_connect.php";

$mem_id = isset($_SESSION['mem_id']) ? $_SESSION['mem_id'] : NULL;
$book = $_GET["book_id"];

$sql_1 = "SELECT *
            FROM stock 
            WHERE book_id=$book" ;

$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}

$sql_2 = "SELECT * FROM testimonials WHERE book_id = $book";
//die($sql_2);
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$testimonials = mysqli_fetch_all($result_2, MYSQLI_ASSOC);

$sql_4 = "SELECT * FROM borrowed_book WHERE book_id = $book";
$result_4 = mysqli_query($conn, $sql_4);
if (!$result_4) {
    echo "Something went wrong!";
    return;
}
$interested_users = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_4);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $stock['book_name']; ?> | Library</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/book_details.css" rel="stylesheet" />
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
            <li class="breadcrumb-item">
                <a href="book_list.php?book=<?= $book['book_name']; ?>"><?= $book['book_name']; ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= $stock['book_name']; ?>
            </li>
        </ol>
    </nav>

    <div id="book-images" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $book_images = glob("img/books/" . $stock['book_id'] . "/*");
            foreach ($book_images as $index => $book_image) {
            ?>
                <li data-target="#book-images" data-slide-to="<?= $index ?>" class="<?= $index == 0 ? "active" : ""; ?>"></li>
            <?php
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            foreach ($book_images as $index => $book_image) {
            ?>
                <div class="carousel-item <?= $index == 0 ? "active" : ""; ?>">
                    <img class="d-block w-100" src="<?= $book_image ?>" alt="slide">
                </div>
            <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-images" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

        <div class="detail-container">
            <div class="book-name"><?= $stock['book_name'] ?></div>
        <div class="row no-gutters">
            <div class="rent-container col-6">
                <div class="price">₹ <?= ($stock['price']) ?>/-</div>
            </div>
            <div class="button-container col-6">
                <a href="#" class="btn btn-primary">Buy Now</a>
            </div>
        </div>
            </div>

    <div class="book-about page-container">
        <h1>About the Book</h1>
        <p><?= $stock['description'] ?></p>
    </div>

    <div class="book-rating">
        <div class="page-container">
            <h1>Book Rating</h1>
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <div class="rating-criteria row">
                        <div class="col-6">
                            <span class="rating-criteria-text">Plot</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?= $stock['rating_plot'] ?>">
                            <?php
                            $rating = $stock['rating_plot'];
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

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <span class="rating-criteria-text">Suspense</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?= $stock['rating_suspense'] ?>">
                            <?php
                            $rating = $stock['rating_suspense'];
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

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <span class="rating-criteria-text">Story Buildup</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?= $stock['rating_story_buildup'] ?>">
                            <?php
                            $rating = $stock['rating_story_buildup'];
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
                </div>

                
            </div>
        </div>
    </div>

    <div class="property-testimonials page-container">
        <h1>What people say</h1>
        <?php
        foreach ($testimonials as $testimonial) {
        ?>
            <div class="testimonial-block">
                <div class="testimonial-text">
                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                    <p><?= $testimonial['testimonial'] ?></p>
                </div>
                <div class="testimonial-name">- <?= $testimonial['testimonial_name'] ?></div>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    ?>

    <script type="text/javascript" src="js/common.js"></script>
</body>

</html>
