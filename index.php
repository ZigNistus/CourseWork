<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
        <meta charset="UTF-8">
        <title>Главная</title>
        <link rel="stylesheet" href="dist/css/header.css">
        <link rel="stylesheet" href="dist/css/main.css">
        <link rel="stylesheet" href="dist/css/cart.css">
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
                <a href="cab.php" class="account">Личный кабинет</a>
                <button class="header__popbtn" id="popbtn">
                    <img src="/dist/img/cart.png" class="header__cartimg">
                </button>
                <?php if(isset($_SESSION['user']))
                {
                    echo '<a href="inc/logout.php" class="account">Выйти из аккаунта</a>';
                }?>
            </div>
        </div>
    </nav>
    
    <div class="cart-modal">
        <div class="cart-modal__body">
            <div class="cart-modal__top">
                <span class="cart-modal__title">Мой заказ</span>
                <div class="cart-modal__close-btn">✕</div>
            </div>
            <div id="cart-modal__main"></div>
            
            <button class="cart-modal__order">Заказать</button>
        </div>
    </div>

    <div class="main-container" id="main">

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            const cart = []
            $('button.header__popbtn').on('click', function() {
                if(cart != '')
                {
                    const cart1 = [] 
                    cart.forEach(element => {
                        cart1.push(Object.fromEntries(element))
                    });
                    $('#cart-modal__main').load('inc/cartload.php', {cart: cart1})
                }
                $('.cart-modal').addClass('active')
            })
            $('.cart-modal__close-btn').on('click', function() {
                $('.cart-modal').removeClass('active')
            })
            $("#main").load('inc/itemsload.php')
            setTimeout(
                function() 
                {
                    $('button.item__add-button').on('click', function() {
                        var bool = false
                        cart.forEach(element => {
                            if(element.get('id') === this.value)
                            {
                                element.set('count', (element.get('count') ?? 0) + 1)
                                bool = true
                            }
                        });
                        if(bool === false)
                        {
                            var tmp = new Map([
                                ['id', this.value],
                                ['count', 1]
                            ])
                            cart.push(tmp)
                        }
                    })
                }, 500);
                $('button.cart-modal__order').on('click', function() {
            const cart2 = [] 
                    cart.forEach(element => {
                        cart2.push(Object.fromEntries(element))
                    });
            $.ajax({
                method: "POST",
                url: "inc/cartsend.php",
                data: {cart: cart2}
            })
            .done(function() {
                alert("Заказ успешно создан")
                cart1 = []
                $('#cart-modal__main').load('inc/cartload.php', {cart: cart1})
            })
        })
        })
        
    </script>
</body>
</html>