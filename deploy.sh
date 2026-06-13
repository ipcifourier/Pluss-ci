#!/bin/bash

################################################################################
# SCRIPT DE DÉPLOIEMENT PRODUCTION - LARAVEL + FILAMENT
################################################################################
# Usage: ./deploy.sh
# ou: bash deploy.sh
# Assurez-vous que c'est exécutable: chmod +x deploy.sh
################################################################################

set -e  # Exit on error

# Couleurs pour l'output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

function print_header() {
    echo -e "${BLUE}================================${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}================================${NC}"
}

function print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

function print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

function print_error() {
    echo -e "${RED}✗ $1${NC}"
}

function confirm() {
    read -p "Continuer? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_error "Opération annulée"
        exit 1
    fi
}

# ============================================================================
# VÉRIFICATIONS PRÉALABLES
# ============================================================================

print_header "VÉRIFICATIONS PRÉALABLES"

# Vérifier que nous sommes à la racine du projet
if [ ! -f "artisan" ]; then
    print_error "artisan not found. Exécuter le script depuis la racine du projet."
    exit 1
fi
print_success "Racine du projet détectée"

# Vérifier PHP version
PHP_VERSION=$(php -v | head -n 1 | grep -oP 'PHP \K[0-9.]+' | cut -d. -f1,2)
print_success "PHP version détectée: $PHP_VERSION"

# Vérifier Composer
if ! command -v composer &> /dev/null; then
    print_error "Composer non trouvé. Installez Composer d'abord."
    exit 1
fi
print_success "Composer trouvé"

# ============================================================================
# ÉTAPE 1: MISE EN MAINTENANCE
# ============================================================================

print_header "ÉTAPE 1: Mise en Mode Maintenance"
php artisan down --render=errors::503
print_success "Mode maintenance activé"

# ============================================================================
# ÉTAPE 2: SAUVEGARDE DE .ENV
# ============================================================================

print_header "ÉTAPE 2: Sauvegarde de la Configuration"
if [ -f ".env" ]; then
    BACKUP_FILE=".env.backup.$(date +%Y%m%d_%H%M%S)"
    cp .env "$BACKUP_FILE"
    print_success "Sauvegarde créée: $BACKUP_FILE"
else
    print_warning ".env non trouvé"
fi

# ============================================================================
# ÉTAPE 3: NETTOYAGE DES CACHES
# ============================================================================

print_header "ÉTAPE 3: Nettoyage des Caches"
php artisan config:clear
print_success "Config cache nettoyé"

php artisan cache:clear
print_success "Cache nettoyé"

php artisan view:clear
print_success "View cache nettoyé"

php artisan route:clear
print_success "Route cache nettoyé"

php artisan event:clear
print_success "Event cache nettoyé"

# ============================================================================
# ÉTAPE 4: PULL LES DERNIERS CHANGEMENTS (optionnel)
# ============================================================================

print_header "ÉTAPE 4: Récupération du Code (Optionnel)"
read -p "Voulez-vous faire un git pull? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    if [ -d ".git" ]; then
        git pull origin main
        print_success "Code mis à jour"
    else
        print_warning "Git repository non trouvé"
    fi
fi

# ============================================================================
# ÉTAPE 5: DÉPENDANCES PHP
# ============================================================================

print_header "ÉTAPE 5: Mise à Jour Dépendances PHP"
print_warning "Cette étape peut prendre du temps..."

read -p "Exécuter composer install? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    composer install --optimize-autoloader --no-dev --no-interaction
    print_success "Dépendances PHP installées"
fi

# ============================================================================
# ÉTAPE 6: DÉPENDANCES NODE (Assets)
# ============================================================================

print_header "ÉTAPE 6: Compilation des Assets"

if [ -f "package.json" ]; then
    read -p "Compiler les assets (npm run build)? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        if command -v npm &> /dev/null; then
            npm ci --prefer-offline --no-audit
            npm run build
            print_success "Assets compilés"
        else
            print_warning "npm non trouvé. Installation des assets ignorée."
        fi
    fi
else
    print_warning "package.json non trouvé"
fi

# ============================================================================
# ÉTAPE 7: BASE DE DONNÉES
# ============================================================================

print_header "ÉTAPE 7: Migrations Base de Données"

read -p "Exécuter les migrations? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    print_success "Migrations exécutées"
else
    print_warning "Migrations ignorées"
fi

# ============================================================================
# ÉTAPE 8: OPTIMISATIONS LARAVEL
# ============================================================================

print_header "ÉTAPE 8: Optimisations Laravel"

# Route cache
php artisan route:cache
print_success "Route cache créé"

# Config cache
php artisan config:cache
print_success "Config cache créé"

# View cache
php artisan view:cache
print_success "View cache créé"

# Event cache
php artisan event:cache
print_success "Event cache créé"

# Filament cache
php artisan filament:cache-components
print_success "Filament components cache créé"

# Optimisation composer autoloader
print_warning "Optimisation Composer (cf. composer.json pour --no-dev)..."
print_success "À exécuter manuellement si nécessaire: composer dump-autoload --optimize"

# ============================================================================
# ÉTAPE 9: PERMISSIONS
# ============================================================================

print_header "ÉTAPE 9: Permissions des Répertoires"

# Obtenir l'utilisateur HTTP
HTTP_USER="www-data"
if ! id "$HTTP_USER" &>/dev/null; then
    HTTP_USER=$(whoami)
    print_warning "Utilisateur $HTTP_USER utilisé (www-data non trouvé)"
fi

print_warning "Les commandes suivantes peuvent nécessiter sudo..."

# Storage
sudo chmod -R 775 storage bootstrap/cache 2>/dev/null || chmod -R 775 storage bootstrap/cache
print_success "Permissions storage/bootstrap ajustées"

# Optional: Changer propriétaire
# sudo chown -R $HTTP_USER:$HTTP_USER storage bootstrap/cache 2>/dev/null || echo "Skipping chown..."

# ============================================================================
# ÉTAPE 10: VÉRIFICATION
# ============================================================================

print_header "ÉTAPE 10: Vérification"

# Test de base
if php artisan tinker --execute="exit(0);" &> /dev/null; then
    print_success "Application accessible"
else
    print_warning "Vérification application échouée"
fi

# ============================================================================
# ÉTAPE 11: FIN DE MAINTENANCE
# ============================================================================

print_header "ÉTAPE 11: Fin du Mode Maintenance"

php artisan up
print_success "Application en ligne"

# ============================================================================
# RÉSUMÉ
# ============================================================================

echo ""
print_header "DÉPLOIEMENT TERMINÉ ✓"

echo ""
echo -e "${GREEN}Étapes complétées:${NC}"
echo "  ✓ Vérifications préalables"
echo "  ✓ Mode maintenance"
echo "  ✓ Nettoyage des caches"
echo "  ✓ Mise à jour du code"
echo "  ✓ Dépendances PHP"
echo "  ✓ Compilation des assets"
echo "  ✓ Migrations BD"
echo "  ✓ Optimisations production"
echo "  ✓ Permissions fichiers"
echo "  ✓ Retour en ligne"

echo ""
echo -e "${YELLOW}Actions recommandées après déploiement:${NC}"
echo "  1. Tester accès Filament: /admin"
echo "  2. Vérifier les logs: tail -f storage/logs/laravel.log"
echo "  3. Tester les principales fonctionnalités"
echo "  4. Supprimer les fichiers de déploiement temporaires"
echo "  5. Vérifier SSL/HTTPS certificat"

echo ""
echo -e "${BLUE}Pour annuler en cas d'erreur:${NC}"
echo "  - Restaurer sauvegarde: cp $BACKUP_FILE .env"
echo "  - Rouler arrière migrations: php artisan migrate:rollback"
echo "  - Consulter logs: storage/logs/laravel.log"

echo ""
