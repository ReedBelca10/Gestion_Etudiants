-- Ajout des colonnes pour la réinitialisation du mot de passe
ALTER TABLE users
ADD COLUMN email VARCHAR(255) NOT NULL UNIQUE AFTER username,
ADD COLUMN reset_token VARCHAR(255) DEFAULT NULL,
ADD COLUMN reset_token_expires DATETIME DEFAULT NULL;

-- Définir l'utilisateur avec user_id = 1 comme administrateur
UPDATE users
SET profile = 'admin'
WHERE user_id = 1;
