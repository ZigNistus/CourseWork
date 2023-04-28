<?php
    session_start();

    require_once 'connect.php';
    $user = $_SESSION['user']['id'];
    
    $check_orders_id = $db->prepare(
        "SELECT `id`
        FROM `item_order` WHERE `user_id` = ?");
    $check_orders_id->bind_param("i", $user);
    $check_orders_id->execute();
    $check_orders_id = $check_orders_id->get_result();
    if (mysqli_num_rows($check_orders_id) > 0) {
        $orders = mysqli_fetch_all($check_orders_id ,MYSQLI_ASSOC);

        foreach ($orders as $value) {
            $check_order_id = $db->prepare("SELECT `item_id` FROM `listfororder` WHERE `order_id` = ?");
            $check_order_id->bind_param('i', $value['id']);
            $check_order_id->execute();
            $check_order_id = $check_order_id->get_result();
            if (mysqli_num_rows($check_order_id) > 0) {
                echo '<h1>Заказ #'. $value['id'] .'</h1>';
                echo '<table class="stock_table">
                <thead>
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Цена</th>
                    </tr>
                </thead>
                <tbody">';
                
                $order = mysqli_fetch_all($check_order_id ,MYSQLI_ASSOC);
                $total = 0;
                foreach ($order as $v1) {
                    $chek_item = $db->prepare('SELECT `name`, `description`, `price` FROM `item` WHERE `id` = ?');
                    $chek_item->bind_param('i', $v1['item_id']);
                    $chek_item->execute();
                    $chek_item = $chek_item->get_result();
                    $item = mysqli_fetch_assoc($chek_item);
                    echo '<tr>'
                            . '<td>' . $item['name'] . '</td>'
                            . '<td>' . $item['price'] . '</td>'
                            . '</tr>';
                    $total += $item['price'];
                }
                echo '</tbody>
                <tfoot>
                    <tr>
                    <th scope="row" colspan="1">Итого: </th>
                    <td colspan="1">'. $total .'</td>
                    </tr>
                </tfoot>
                </table>';
            } else {echo 'Ошибка';}

        }
        echo '</tbody>
        </table>';
    }
    else
    {
        echo 'Не удалось загрузить заказы';
    }