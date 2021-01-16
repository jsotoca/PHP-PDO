<?php
    declare(strict_types = 1);
    require_once "vendor/autoload.php";
    require_once "config.php";

    use src\services\ProductService;
    use src\models\Product;

    $productService = new ProductService();
    // $product = new Product();
    // $product->id = 8;
    // $product->name = "Black Clover";
    // $product->price = 999.999;
    // $productService->updated($product);
    var_dump($productService->delete(8));
    var_dump($productService->getAll());