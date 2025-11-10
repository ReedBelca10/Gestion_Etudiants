<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Vérifier si l'utilisateur a le profil admin pour les pages sensibles
function requireAdmin() {
    if (!isset($_SESSION['profile']) || $_SESSION['profile'] !== 'admin') {
        header("Location: students_list.php");
        exit;
    }
}
?>