<?php
session_start();
header('Content-Type: application/json');

// Vérifier si l'utilisateur est connecté (par exemple, si $_SESSION['user_id'] est défini)
$response = ["loggedIn" => isset($_SESSION['user_id'])];

echo json_encode($response);
?>
