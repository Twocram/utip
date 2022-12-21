<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['auth']['user'])) {
    header('Location: http://localhost/utip-test/client/auth.php');
}
?>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <?php require './components/header.php' ?>
    <div class="container">
        <div class="posts-filter">
            <select class="select-item" id="sort-select" name="sort">
                <option selected value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
            <select class="select-item" id="filter-select" name="filter">
                <option selected disabled>Сортировать по:</option>
                <option value="title">Названию</option>
                <option value="content">Описанию</option>
            </select>

            <button class="modal-btn">Create Post</button>
        </div>


        <?php require "./components/addModal.php" ?>

        <?php require "./components/editModal.php" ?>

        <?php require "./components/detailsModal.php" ?>

        <div class="posts-list">
        </div>

        <div class="posts-pages">

        </div>
    </div>
    <script src="./scripts/main.js"></script>
    <script src="./scripts/modal.js"></script>
    <script src="./scripts/logout.js"></script>

</body>

</html>