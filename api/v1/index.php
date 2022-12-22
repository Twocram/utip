<?php

header('Content-type: application/json');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require "./src/db/db_connect.php";
require "./src/handlerMethods.php";

$q = $_GET['q'];
$method = $_SERVER['REQUEST_METHOD'];
$params = explode('/', $q);


$type = $params[0];
$param = $params[1];

switch ($method) {
    case "GET":
        switch ($type) {
            case 'posts':
                if (isset($param)) {
                    getPost($connect, $param);
                } else {
                    getPosts($connect, $_GET);
                }
                break;

            case 'users':
                if (isset($param)) {
                    logout($param);
                } else {
                    getUser($connect, $_GET);
                }
                break;
        }
        break;


    case "POST":
        switch ($type) {
            case 'posts':
                createPost($connect, $_POST);
                break;
            case 'users':
                createUser($connect, $_POST);
                break;
        }
        break;

    case "PUT":
        switch ($type) {
            case 'posts':
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                editPost($connect, $param, $data);
                break;
        }
        break;

    case "DELETE":
        switch ($type) {
            case 'posts':
                if (isset($param)) {
                    deletePost($connect, $param);
                }
                break;
        }
        break;
}
