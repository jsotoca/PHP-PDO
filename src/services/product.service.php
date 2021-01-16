<?php
    declare(strict_types = 1);
    namespace src\services;

    use src\database\DBProvider;
    use src\models\Product;
    use PDO;
    use PDOException;

    class ProductService {

        private $_db;

        public function __construct(){
            $this->_db = DBProvider::get();
        }

        public function getAll() : Array {
            $result = [];

            try {
                $stm = $this->_db->prepare("SELECT * FROM products");
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_CLASS,"\\src\\models\\Product");
            } catch (PDOException $e) {
                $e->getMessage();
            }

            return $result;
        }

        public function get(int $id) : ?Product {
            $result = null;

            try {
                $stm = $this->_db->prepare("SELECT * FROM products WHERE id = :id");
                $stm->execute([
                    'id' => $id
                ]);
                $data = $stm->fetchObject("\\src\\models\\Product");
                if($data) $result = $data;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            return $result;
        }

        public function created(Product $product) : void {
            $now = date("Y-m-d H:i:s");

            try {
                $stm = $this->_db->prepare("
                    INSERT INTO products(name, price, created_at, updated_at ) 
                    VALUES(:name, :price, :created_at, :updated_at)
                ");
                $stm->execute([
                    'name' => $product->name,
                    'price' => $product->price,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }