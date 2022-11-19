<?php

function pdo_connect() {
    try {
        // Production server
        $dbhost="mysql:host=mysql-user.cse.msu.edu;dbname=kroskema";
        $user = "kroskema";
        $password = "phppassword";
        return new PDO($dbhost, $user, $password);
    } catch(PDOException $e) {
        echo '<chess status="no" msg="Unable to select database" />';
        exit;
    }
}