<?php
require_once 'pages/config/db.php';

// Vérifier si un token est fourni
if (!isset($_GET['token'])) {
    header('Location: login.php');
    exit();
}

$token = $_GET['token'];

// Vérifier si le token est valide et n'a pas expiré
$stmt = $pdo->prepare("SELECT user_id FROM users WHERE reset_token = ? AND reset_token_expires > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['error'] = "Le lien de réinitialisation est invalide ou a expiré.";
    header('Location: login.php');
    exit();
}

if (isset($_POST['reset_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    if ($password === $confirmPassword) {
        // Hasher le nouveau mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Mettre à jour le mot de passe et supprimer le token
        $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires = NULL WHERE user_id = ?");
        try {
            $stmt->execute([$hashedPassword, $user['user_id']]);
            $_SESSION['success'] = "Votre mot de passe a été réinitialisé avec succès.";
            header('Location: login.php');
            exit();
        } catch(PDOException $e) {
            $error = "Une erreur est survenue lors de la réinitialisation du mot de passe.";
        }
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - GestionEtudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="auth-page">
    <div class="auth-left">
        <div class="login-form">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">Nouveau mot de passe</h1>
                <h2 class="text-dark fs-6 fw-normal">Choisissez votre nouveau mot de passe</h2>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="password" class="form-label required-field">Nouveau mot de passe</label>
                    <i class="fas fa-lock"></i>
                    <div class="password-field">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Votre nouveau mot de passe" required>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="form-group mb-4">
                    <label for="confirmPassword" class="form-label required-field">Confirmer le mot de passe</label>
                    <i class="fas fa-lock"></i>
                    <div class="password-field">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" 
                               placeholder="Confirmez votre mot de passe" required>
                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" name="reset_password" class="btn btn-primary">
                        Changer le mot de passe
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

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.parentElement.querySelector('.password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>