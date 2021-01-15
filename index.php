<?php
    declare(strict_types = 1);
    require_once "vendor/autoload.php";
    require_once "config.php";

    use src\services\ProductService;

    $productService = new ProductService();
    // var_dump($productService->getAll());
    var_dump($productService->get(1));