<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$book = $_GET["bookName"];

$sql_1 = "SELECT * FROM stock WHERE book_name = '$book'";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$bookName = mysqli_fetch_assoc($result_1);
if (!$bookName) {
    echo "Sorry! We do not have this book.";
    return;
}
$book_id = $book['book_id'];

$sql_2 = "SELECT * FROM book WHERE book_id = $book_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$book = mysqli_fetch_all($result_2, MYSQLI_ASSOC);

$sql_3 = "SELECT * 
            FROM borrowed_books iup
            INNER JOIN book p ON iup.book_id = p.book_id
            WHERE p.book_id = $book_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!";
    return;
}
$interested_users_books = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
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
                <?php echo $bookName; ?>
            </li>
        </ol>
    </nav>

    <div class="page-container">
        <?php
        foreach ($book as $book) {
            $book_images = glob("img/books/" . $book['book_id'] . "/*");
        ?>
            <div class="book-card book-id-<?= $book['book_id'] ?> row">
                <div class="image-container col-md-4">
                    <img src="<?= $book_images[0] ?>" />
                </div>
                <div class="content-container col-md-8">
                    <div class="row no-gutters justify-content-between">
                        <?php
                        $total_rating = ($book['rating_plot'] + $book['rating_suspense'] + $book['rating_story_building']) / 3;
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
                        <div class="book-name"><?= $book['bookName'] ?></div>
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
        }

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
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/book_list.js"></script>
</body>

</html>
