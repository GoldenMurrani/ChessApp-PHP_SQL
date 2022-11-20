<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<hatter status="no" msg="magic" />';
    exit;
}

process($_POST['user'], $_POST['pw']);

function process($user, $password) {
    // Connect to the database
    $pdo = pdo_connect();

    $userQ = $pdo->quote($user);
    $passwordQ = $pdo->quote($password);
    $query = "insert into chessuser(user, password) values($userQ, $passwordQ)";
    if($pdo->exec($query)){
        echo '<chess status="yes" msg="user created" />';
        exit;
    }
    echo '<chess status="no" msg="user create failed" />';

}

