<?php
    declare(strict_types = 1);
    namespace src\services;

    use src\database\DBProvider;
    use PDOException;
    use src\models\Order;

    class OrderService {
        
        private $_db;

        public function __construct(){
            $this->_db = DBProvider::get();
        }

        public function create(Order $order): void {
            try {
                $this->_db->beginTransaction();

                $this->prepareOrder($order);
                $this->createOrder($order);
                $this->createOrderDetails($order);

                $this->_db->commit();
            } catch (PDOException $e) {
                $this->_db->rollBack();
                echo $e->getMessage();
            }
        }

        private function prepareOrder(Order &$order): void {
            $now = date("Y-m-d H:i:s");
            foreach ($order->details as $item) {
                $item->total = $item->quantity * $item->price;
                $item->created_at = $now;
                $item->updated_at = $now;
                $order->total += $item->total;
            }
            $order->created_at = $now;
            $order->updated_at = $now;
        }

        private function createOrder(Order &$order): void {
            $stm = $this->_db->prepare("
                INSERT INTO orders(user_id, creater_id, total, created_at, updated_at)
                VALUES(:user_id, :creater_id, :total, :created_at, :updated_at)
            ");
            $stm->execute([
                'user_id' => $order->user_id,
                'creater_id' => $order->creater_id,
                'total' => $order->total,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
            $order->id = $this->_db->lastInsertId();
        }

        private function createOrderDetails(Order $order): void {
            foreach ($order->details as $item) {
                $stm = $this->_db->prepare("
                    INSERT INTO order_detailx(order_id, product_id, quantity, price, total, created_at, updated_at)
                    VALUES(:order_id, :product_id, :quantity, :price, :total, :created_at, :updated_at)
                ");
                $stm->execute([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }
    }