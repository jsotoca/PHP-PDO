<?php
    declare(strict_types = 1);
    require_once "vendor/autoload.php";
    require_once "config.php";

    use src\services\ProductService;
    use src\models\Product;

    $productService = new ProductService();
    $product = new Product();
    $product->name = "Jujutsu Kaisen";
    $product->price = 666.666;
    $productService->created($product);
    var_dump($productService->getAll());