<?php
session_start();
session_destroy();
header("Location: /Xcelstage/public/"); // Redirige vers la page d'accueil
exit();
?>