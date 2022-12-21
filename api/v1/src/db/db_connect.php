<?php

define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB_NAME', 'utip-test');


$connect = mysqli_connect(SERVER, USER, PASSWORD, DB_NAME);

if (!$connect) {
    echo "Не удалось подключиться к базе данных";
}
