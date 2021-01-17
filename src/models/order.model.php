<?php
    declare(strict_types = 1);
    namespace src\models;

    class Order {

        public $id;
        public $user_id;
        public $creater_id;
        public $total;
        public $created_at;
        public $updated_at;
        public $details;

        public function __construct(int $user_id, int $creater_id){
            $this->user_id = $user_id;
            $this->creater_id = $creater_id;
            $this->total = 0;
            $this->details = [];
        }
    }


