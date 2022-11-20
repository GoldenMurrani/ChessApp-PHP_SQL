<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

if(!isset($_GET['magic']) || $_GET['magic'] != "NechAtHa6RuzeR8x") {
    echo '<chess status="no" msg="magic" />';
    exit;
}

process($_GET['user'], $_GET['pw'], $_GET['magic']);

function process($user, $password, $magic) {
    // Connect to the database
    $pdo = pdo_connect();
    $userid = getUser($pdo, $user, $password);

    //get gamestate
    $query = "select gamestate from chessgames where player1id = $userid or player2id = $userid";
    $rows = $pdo->query($query);
    if($row = $rows->fetch()){
        echo '<chess status="yes" msg="gamestate found" />';
        echo $row['gamestate'];
        exit;
    }
    echo '<chess status="no" msg="gamestate not found" />';

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