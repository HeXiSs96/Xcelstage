<?php
class Database {
    public static function connect() {
        return new PDO('mysql:host=localhost;dbname=site_stage;charset=utf8', 'root', 'iyas');
    }
}
