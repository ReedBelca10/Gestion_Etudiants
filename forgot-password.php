<?php
require_once 'pages/config/db.php';
require_once 'pages/config/mail.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['request_reset'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    
    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT user_id, email FROM users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Générer un token unique
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Sauvegarder le token dans la base de données
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE user_id = ?");
        $stmt->execute([$token, $expires, $user['user_id']]);
        
        // Préparer le lien de réinitialisation
        $resetLink = "http://" . $_SERVER['HTTP_HOST'] . 
                    dirname($_SERVER['PHP_SELF']) . 
                    "/reset-password.php?token=" . $token;
        
        // Configurer PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Configuration du serveur
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = SMTP_DEBUG;
            
            // Options supplémentaires pour résoudre les problèmes de connexion
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Destinataires
            $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
            $mail->addAddress($user['email']);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de votre mot de passe - GestionEtudiants';
            
            // Corps du message en HTML
            $mail->Body = "
                <html>
                <body style='font-family: Arial, sans-serif;'>
                    <h2>Réinitialisation de votre mot de passe</h2>
                    <p>Bonjour,</p>
                    <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>
                    <p>Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>
                    <p style='margin: 25px 0;'>
                        <a href='{$resetLink}' 
                           style='background-color: #0d6efd; 
                                  color: white; 
                                  padding: 10px 20px; 
                                  text-decoration: none; 
                                  border-radius: 5px;
                                  display: inline-block;'>
                            Réinitialiser mon mot de passe
                        </a>
                    </p>
                    <p>Ce lien expirera dans 1 heure.</p>
                    <p>Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.</p>
                    <hr>
                    <p style='color: #666; font-size: 12px;'>
                        Ceci est un email automatique, merci de ne pas y répondre.
                    </p>
                </body>
                </html>
            ";
            
            // Version texte pour les clients mail qui ne supportent pas l'HTML
            $mail->AltBody = "
                Bonjour,
                
                Vous avez demandé la réinitialisation de votre mot de passe.
                
                Cliquez sur le lien suivant pour réinitialiser votre mot de passe :
                {$resetLink}
                
                Ce lien expirera dans 1 heure.
                
                Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.
            ";

            $mail->send();
            $success = "Un email a été envoyé avec les instructions pour réinitialiser votre mot de passe.";
            
        } catch (Exception $e) {
            $error = "Une erreur est survenue lors de l'envoi de l'email. Erreur : " . $mail->ErrorInfo;
        }
    } else {
        $error = "Aucun compte trouvé avec ces informations.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - GestionEtudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="auth-page">
    <div class="auth-left">
        <div class="login-form">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">Mot de passe oublié</h1>
                <h2 class="text-dark fs-6 fw-normal">Entrez vos informations pour réinitialiser votre mot de passe</h2>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="username" class="form-label required-field">Nom d'utilisateur</label>
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" id="username" name="username" 
                           placeholder="Votre nom d'utilisateur" required>
                </div>
                
                <div class="form-group mb-4">
                    <label for="email" class="form-label required-field">Email</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" id="email" name="email" 
                           placeholder="Votre adresse email" required>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <a href="login.php" class="text-primary text-decoration-none">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la connexion
                    </a>
                    <button type="submit" name="request_reset" class="btn btn-primary">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.auth-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.login-form {
    width: 100%;
    max-width: 450px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>