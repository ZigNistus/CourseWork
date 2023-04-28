<?php
    session_start();
    $total = 0;
    if(isset($_POST['cart']))
    {
        $cart = $_POST['cart'];
        $items = $_SESSION['items'];
        foreach ($items as $v) {
            for ($i=0; $i < count($cart); $i++) {
                if($v[3] == $cart[$i]['id']){
                    echo '<div class="cart-item" id="'. $v[3].'">
                    <span class="cart-item__name">'. $v[0].'</span>
                    <div class="cart-item__sum-count">
                    <span class="cart-item__price">'. $v[1] . ' руб.  x </span>
                    <span class="cart-item__count" id="cart-item__count">'. $cart[$i]['count'].'</span>
                    </div>
                    </div>';
                    $total += $v[1]*$cart[$i]['count'];
                }
            }
        }
    }
    
    echo '<hr class="cart-modal__border">
        <div class="cart-modal__total">
        <span class="cart-modal__total-text">Итого</span>
        <span id="cart-modal__total-sum">'. $total .' руб.</span>
        </div>';
