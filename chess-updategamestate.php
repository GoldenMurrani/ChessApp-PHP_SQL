<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_POST['magic']) || $_POST['magic'] != "NechAtHa6RuzeR8x") {
    echo '<chess status="no" msg="magic" />';
    exit;
}

process($_POST['user'], $_POST['pw'], $_POST['magic'], $_POST['xml']);

function process($user, $password, $magic, $xml) {
    // Connect to the database
    $pdo = pdo_connect();
    $userid = getUser($pdo, $user, $password);

    $xmlQ = $pdo->quote($xml);
    $query = "update chessgames set gamestate = $xmlQ where player1id = $userid or player2id = $userid";

    if($pdo->exec($query)){
        echo '<chess status="yes" msg="game updated" />';
        exit;
    }
    echo '<chess status="no" msg="game update failed" />';

}

/**
 * Ask the database for the user ID. If the user exists, the password
 * must match.
 * @param $pdo
 * @param $user
 * @param $password
 * @return $id
 */
function getUser($pdo, $user, $password) {
    // Does the user exist in the database?
    $userQ = $pdo->quote($user);
    $query = "SELECT id, password from chessuser where user=$userQ";

    $rows = $pdo->query($query);
    if($row = $rows->fetch()) {
        // We found the record in the database
        // Check the password
        if($row['password'] != $password) {
            echo '<chess status="no" msg="password error" />';
            exit;
        }
        return $row['id'];
    }

    echo '<chess status="no" msg="user error" />';
    exit;
}