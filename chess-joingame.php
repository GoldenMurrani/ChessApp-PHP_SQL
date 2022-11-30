<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<hatter status="no" msg="magic" />';
    exit;
}

process($_POST['game'], $_POST['user']);

function process($gameID, $user) {
    // Connect to the database
    $pdo = pdo_connect();

    $query = "SELECT id FROM chessuser WHERE user=$user";
    $rows = $pdo->query($query);
    if($row = $rows->fetch()) {
        $query = "UPDATE chessgames SET player2id='{$row['id']}' WHERE id=$gameID";
        if($pdo->exec($query)){
            echo '<chess status="yes" msg="joined game" />';
        exit;
        }
        
    }
    echo '<chess status="no" msg="join game failed" />';

}
