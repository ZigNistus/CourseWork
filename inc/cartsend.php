<?php
    session_start();
    require_once 'connect.php';
    $cart = $_POST['cart'];
    if(isset($_SESSION['user']))
    {
        $user_id = $_SESSION['user']['id'];
    }
    else{
        $user_id = null;
    }
    $order = $db->prepare("INSERT INTO item_order (user_id) VALUES (?)");
    $order->bind_param("i", $user_id);
    if ($order->execute())
    {
        $entry_id = $db->insert_id;
    }
    foreach ($cart as $value) {
        for ($i=0; $i < $value['count']; $i++) { 
            $itemsend = $db->prepare("INSERT INTO listfororder (order_id, item_id) VALUES (?,?)");
            $itemsend->bind_param("ii", $entry_id, $value['id']);
            $itemsend->execute();
        }
    }