<?php

session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($db, "SELECT * FROM `users` WHERE `name` = '$login' and `pass` = '$password' ");

if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "name" => $user['name']
    ];

    header('Location: ../index.php');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: ../login.php');
}
