<?php
// Configuration email
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'musicascinema6@gmail.com');
define('SMTP_PASSWORD', 'cdar wsjs dvey gidi'); // Mot de passe d'application Gmail
define('SMTP_FROM_EMAIL', 'musicascinema6@gmail.com');
define('SMTP_FROM_NAME', 'GestionEtudiants');
define('SMTP_DEBUG', 0); // Changé à 0 pour la production, utiliser 2 pour le débogage
define('SMTP_SECURE', 'tls');

// Vérifier que l'extension PHP openssl est activée
if (!extension_loaded('openssl')) {
    die("L'extension PHP OpenSSL est requise pour l'envoi d'emails sécurisés.");
}
?>