<?php
    declare(strict_types = 1);
    require_once "vendor/autoload.php";
    require_once "config.php";

    use src\database\DBProvider as Database;

    var_dump(Database::get());
