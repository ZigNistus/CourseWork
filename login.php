<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="dist/css/login.css"> 
</head>

<body>

    <form action="inc/logval.php" method="post">
        <label class="tittle">Авторизация</label>
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
        ?>
        <button type="submit">Войти</button>
    </form>
</body>

</html>