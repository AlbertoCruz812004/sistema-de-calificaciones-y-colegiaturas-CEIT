<?php

require_once '../classes/Authentication.php';
require_once '../classes/UserEntity.php';
require_once '../config/DatabaseConfig.php';

$db = new DatabaseConfig();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = $db->openConnection();

    $user = new UserEntity($_POST["email"], $_POST["password"]);
    $auth = new Authentication($user, $conn);

    if ($auth->login()) {
        session_start();

        $_SESSION["user"] = $auth->getData();

        header("Location: /public/main.php");
        exit;
    }
} else {
    // error_log("No encontrado");
}
