<?php
    session_start();
    if(!$_SESSION['user']){
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="dist/css/header.css">
    <link rel="stylesheet" href="dist/css/cab.css">
</head>
<body>
    <nav class="header">
        <div class="header__container">
            <span class="header__title">
                 <?php if(isset($_SESSION['user']))
                {echo $_SESSION['user']['name'];}
                else{
                    echo 'Гость';
                }
                 ?> 
            </span>
            <div class="leftcont">
                <a href="index.php" class="account">Назад</a>
                <button class="header__popbtn" id="popbtn">
                    <img src="/dist/img/cart.png" class="header__cartimg">
                </button>
                <a href="inc/logout.php" class="account">Выйти из аккаунта</a>
            </div>
        </div>
    </nav>

    <div class="main" id="main">
    </div>
                
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#main').load('inc/orderload.php')
        })
    </script>
</body>
</html>