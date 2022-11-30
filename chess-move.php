<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<hatter status="no" msg="magic" />';
    exit;
}

process($_POST['game'], $_POST['piece'], $_POST['x'], $_POST['y'], $_POST['turn']);

function process($gameID, $pieceID, $x, $y, $turn) {
    // Connect to the database
    $pdo = pdo_connect();

//    $userQ = $pdo->quote($user);
//    $passwordQ = $pdo->quote($password);
    $query = "UPDATE chessgames SET piece=$pieceID, x=$x, y=&y, turn=$turn WHERE id=$gameID";
    if($pdo->exec($query)){
        echo '<chess status="yes" msg="piece moved" />';
        exit;
    }
    echo '<chess status="no" msg="piece move failed" />';

}
