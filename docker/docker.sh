#!/bin/bash

set -e  # Arrêter l'exécution si une commande échoue

# Fonction pour vérifier la disponibilité de la base de données
wait_for_db() {
  echo "Waiting for the database to be ready..."
  until php bin/console doctrine:query:sql "SELECT 1" >/dev/null 2>&1; do
    echo "Database is not ready yet. Retrying in 5 seconds..."
    sleep 5
  done
  echo "Database is ready!"
}

# Attendre que la base de données soit prête
wait_for_db

# Créer la base de données
echo "Creating database (if not exists)..."
php bin/console doctrine:database:create --if-not-exists --no-interaction || echo "Database already exists, skipping creation"

# Lancer les migrations
echo "Running migrations..."
php bin/console doctrine:migrations:migrate --no-interaction

# Charger les fixtures
echo "Loading fixtures..."
php bin/console doctrine:fixtures:load --no-interaction

# Créer l'utilisateur admin (décommenter si nécessaire)
# echo "Creating admin user..."
# php bin/console app:create-user admin@gmail.com admin || echo "Admin user creation skipped"

# Démarrer Apache en mode foreground
echo "Starting Apache..."
exec apache2-foreground
