<?php
    declare(strict_types = 1);
    namespace src\models;

    class OrderDetail {

        public $id;
        public $order_id;
        public $product_id;
        public $price;
        public $quantity;
        public $total;
        public $created_at;
        public $updated_at;

        public function __construct(int $product_id, float $price, float $quantity){
            $this->product_id = $product_id;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->total = 0;
        }
    }

