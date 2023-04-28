<?php
    
    require_once 'connect.php';
    session_start();
    $check_items = $db->prepare(
        "SELECT item.name,
        price,
        img,
        item.id
        FROM item");
    $check_items->execute();
    $check_items = $check_items->get_result();
    
    if (mysqli_num_rows($check_items) > 0) {
        $data = mysqli_fetch_all($check_items);
        $_SESSION['items'] = $data;
        echo '<div class="main__item-container"><div class="main__title"><h1>Лапша\Рис</h1></div><div class="main__items-list">';
        for ($i=0; $i < 3; $i++) { 
            echo '<div class="item">'
            . '<span class="item__name">' . $data[$i][0] . '</span>'
            . '<img style="width: 90px; height: 90px; margin: auto;" src="../dist/img/items/'. $data[$i][2] .'.jpg">'
            . '<span class="item__price">'. $data[$i][1] .' руб</span>'
            . '<button class="item__add-button" value="'. $data[$i][3] .'">Добавить</button>'
            .'</div>';
        }
        echo '</div></div>';

        echo '<div class="main__item-container"><div class="main__title"><h1>Роллы</h1></div><div class="main__items-list">';
        for ($i=3; $i < 6; $i++) { 
            echo '<div class="item">'
            . '<span class="item__name">' . $data[$i][0] . '</span>'
            . '<img style="width: 90px; height: 90px; margin: auto;" src="../dist/img/items/'. $data[$i][2] .'.jpg">'
            . '<span class="item__price">'. $data[$i][1] .' руб</span>'
            . '<button class="item__add-button" value="'. $data[$i][3] .'">Добавить</button>'
            . '</div>';
        }
        echo '</div></div>';

        echo '<div class="main__item-container"><div class="main__title"><h1>Десерты</h1></div><div class="main__items-list">';
        for ($i=6; $i < 8; $i++) { 
            echo '<div class="item">'
            . '<span class="item__name">' . $data[$i][0] . '</span>'
            . '<img style="width: 90px; height: 90px; margin: auto;" src="../dist/img/items/'. $data[$i][2] .'.jpg">'
            . '<span class="item__price">'. $data[$i][1] .' руб</span>'
            . '<button class="item__add-button" value="'. $data[$i][3] .'">Добавить</button>'
            . '</div>';
        }
        echo '</div></div>';

        echo '<div class="main__item-container"><div class="main__title"><h1>Закуски</h1></div><div class="main__items-list">';
        for ($i=8; $i < 11; $i++) { 
            echo '<div class="item">'
            . '<span class="item__name">' . $data[$i][0] . '</span>'
            . '<img style="width: 90px; height: 90px; margin: auto;" src="../dist/img/items/'. $data[$i][2] .'.jpg">'
            . '<span class="item__price">'. $data[$i][1] .' руб</span>'
            . '<button class="item__add-button" value="'. $data[$i][3] .'">Добавить</button>'
            . '</div>';
        }
        echo '</div></div>';

        echo '<div class="main__item-container"><div class="main__title"><h1>Напитки</h1></div><div class="main__items-list">';
        for ($i=11; $i < 14; $i++) { 
            echo '<div class="item">'
            . '<span class="item__name">' . $data[$i][0] . '</span>'
            . '<img style="width: 90px; height: 90px; margin: auto;" src="../dist/img/items/'. $data[$i][2] .'.jpg">'
            . '<span class="item__price">'. $data[$i][1] .' руб</span>'
            . '<button class="item__add-button" value="'. $data[$i][3] .'">Добавить</button>'
            . '</div>';
        }
        echo '</div></div>';
        
        $_SESSION['items'] = $data;
    }
    else {
        $_SESSION['message'] = 'Товары не найдены';
    }

