<?php

function logout($param)
{
    if ($param === 'logout') {
        session_start();
        session_destroy();
    }
}

function createUser($connect, $data)
{
    $email = $data['email'];
    $password =  $data['password'];

    $sql = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");



    if (!mysqli_fetch_array($sql)) {
        mysqli_query($connect, "INSERT INTO `users` (`id`, `email`, `password`) VALUES ( NULL, '$email', '$password')");

        http_response_code(201);

        $res = [
            "status" => true,
            "message" => "User successfully added",
            "user_id" => mysqli_insert_id($connect),
            "user_email" => $email,
        ];

        echo json_encode($res);
        session_start();
        $user = mysqli_query($connect, "SELECT * from `users` WHERE `email` = '$email' AND `password` = '$password'");
        $user = mysqli_fetch_assoc($user);
        session_start();
        $_SESSION['auth']['user'] = $user;
    } else {
        http_response_code(409);

        $res = [
            "status" => false,
            "message" => "User already exist",
        ];
        echo json_encode($res);
    }
}

function getUser($connect, $data)
{
    $email = $data['email'];
    $password = $data['password'];


    $user = mysqli_query($connect, "SELECT * from `users` WHERE `email` = '$email' AND `password` = '$password'");
    if (!mysqli_num_rows($user)) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "User not found",
        ];
        echo json_encode($res);
    } else {
        $user = mysqli_fetch_assoc($user);
        echo json_encode($user);
        session_start();
        $_SESSION['auth']['user'] = $user;
    }
}


function getPosts($connect, $data)
{
    session_start();

    if (!isset($_SESSION['auth']['user'])) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "You must be authorizated",
        ];
        echo json_encode($res);
    } else {
        $filter = strlen($data['filter']) ?  $data['filter'] : 'NULL';
        $sort = strlen($data['sort']) ?  $data['sort'] : 'NULL';
        $page = strlen($data['page']) ?  $data['page'] : 'NULL';

        $offset = ($page - 1) * $sort;

        $count_sql = mysqli_query($connect, "SELECT COUNT(*) FROM `posts`");
        $total_rows = mysqli_fetch_array($count_sql)[0];

        $total_pages = ceil($total_rows / $sort);

        $posts = mysqli_query($connect, "SELECT * FROM `posts` ORDER BY $filter LIMIT $offset, $sort");

        $postsList = [];

        while ($post = mysqli_fetch_assoc($posts)) {
            $postsList[] = $post;
        }

        echo json_encode([$postsList, "page" => $total_pages]);
    }
}

function getPost($connect, $id)
{
    session_start();

    $post = mysqli_query($connect, "SELECT * from `posts` WHERE `id` = '$id'");
    if (!mysqli_num_rows($post)) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Post not found",
        ];
        echo json_encode($res);
    } else if (!isset($_SESSION['auth']['user'])) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "You must be authorizated",
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function createPost($connect, $data)
{
    session_start();

    $title = $data['title'];
    $content = $data['content'];
    $author_id = $data['author_id'];
    $status = $data['status'];

    if ((strlen($title) < 5) || (strlen($content) < 10)) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "The title must have 5 characters and the content must have more than 10",
        ];
        echo json_encode($res);
    } else if (!isset($_SESSION['auth']['user'])) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "You must be authorizated",
        ];
        echo json_encode($res);
    } else {
        $date = date_create();

        mysqli_query($connect, "INSERT INTO `posts` (`title`, `content`, `author_id`, `status`) VALUES ('$title', '$content', '$author_id', '$status')");

        http_response_code(201);

        $res = [
            "status" => true,
            "id" => mysqli_insert_id($connect),
            "created_at" => date_timestamp_get($date),
        ];

        echo json_encode($res);
    }
}

function editPost($connect, $id, $data)
{
    session_start();

    $title = $data['title'];
    $content = $data['content'];
    $status = $data['status'];


    if (!isset($_SESSION['auth']['user'])) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "You must be authorizated",
        ];
        echo json_encode($res);
    } else {
        if ((mb_strlen($title, 'UTF-8') < 5) || (mb_strlen($content, 'UTF-8') < 10)) {
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "The title must have 5 characters and the content must have more than 10",
            ];
            echo json_encode($res);
        } else {
            mysqli_query($connect, "UPDATE `posts` SET `title` = '$title', `content` = '$content', `status` = '$status' WHERE `posts`.`id` = '$id'");

            http_response_code(200);

            $res = [
                "status" => true,
                "message" => "Post successfully updated",
            ];

            echo json_encode($res);
        }
    }
}

function deletePost($connect, $id)
{
    session_start();

    if (!isset($_SESSION['auth']['user'])) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "You must be authorizated",
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, "DELETE FROM `posts` WHERE `id`='$id'");

        http_response_code(200);

        $res = [
            "status" => true,
            "message" => "Post successfully deleted",
        ];

        echo json_encode($res);
    }
}
