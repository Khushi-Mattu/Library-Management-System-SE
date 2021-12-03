<?php
session_start();
require "includes/database_connect.php";

if (!isset($_SESSION["mem_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_SESSION['mem_id'];

$sql_1 = "SELECT * FROM users WHERE id = $mem_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
}

$sql_2 = "SELECT * 
            FROM borrowed_book iup
            INNER JOIN stock p ON iup.book_id = p.book_id
            WHERE iup.mem_id = $user_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$borrowed_books = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | PG Life</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/dashboard.css" rel="stylesheet" />
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
                Dashboard
            </li>
        </ol>
    </nav>

    <div class="my-profile page-container">
        <h1>My Profile</h1>
        <div class="row">
            <div class="col-md-3 profile-img-container">
                <i class="fas fa-user profile-img"></i>
            </div>
            <div class="col-md-9">
                <div class="row no-gutters justify-content-between align-items-end">
                    <div class="profile">
                        <div class="name"><?= $user['full_name'] ?></div>
                        <div class="email"><?= $user['email'] ?></div>
                        <div class="phone"><?= $user['phone'] ?></div>
                        <div class="college"><?= $user['college_name'] ?></div>
                    </div>
                    <div class="edit">
                        <div class="edit-profile">Edit Profile</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (count($borrowed_books) > 0) {
    ?>
        <div class="my-interested-books">
            <div class="page-container">
                <h1>My Borrowed Books</h1>

                <?php
                foreach ($borrowed_books as $stock) {
                    $book_images = glob("img/books" . $stock['book_id'] . "/*");
                ?>
                    <div class="book-card book-id-<?= $stock['book_id'] ?> row">
                        <div class="image-container col-md-4">
                            <img src="<?= $book_images[0] ?>" />
                        </div>
                        <div class="content-container col-md-8">
                            <div class="row no-gutters justify-content-between">
                                <div class="interested-container">
                                    <i class="is-interested-image fas fa-heart" book_id="<?= $stock['book_id'] ?>"></i>
                                </div>
                            </div>
                            <div class="detail-container">
                                <div class="book-name"><?= $stock['name'] ?></div>
                            </div>
                            <div class="row no-gutters">
                                <div class="rent-container col-6">
                                    <div class="price">₹ <?= number_format($stock['price']) ?>/-</div>
                                </div>
                                <div class="button-container col-6">
                                    <a href="book_details.php?book_id=<?= $stock['book_id'] ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <?php
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/dashboard.js"></script>
</body>

</html>
