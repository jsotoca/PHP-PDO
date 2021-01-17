<?php
    declare(strict_types = 1);
    require_once "vendor/autoload.php";
    require_once "config.php";

    use src\services\OrderService;
    use src\models\Order;
    use src\models\OrderDetail;

    $orderService = new OrderService();

    $order = new Order(1,3);
    $orderDetail1 = new OrderDetail(1,1200,2);
    $orderDetail2 = new OrderDetail(2,657.88,4);
    $order->details[] = $orderDetail1;
    $order->details[] = $orderDetail2;

    $orderService->create($order);
