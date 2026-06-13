#!/bin/bash

################################################################################
# COMMANDES UTILES POUR DÉPLOIEMENT ET MAINTENANCE
################################################################################
# Ces commandes peuvent être exécutées à la main ou en cron
# Adapter les chemins absolus si nécessaire

PROJECT_ROOT="/var/www/html"  # À adapter selon votre serveur

# ============================================================================
# OPTIMISATIONS
# ============================================================================

# Effacer tous les caches (safe even in production)
clear_all_caches() {
    cd "$PROJECT_ROOT"
    php artisan cache:clear
    php artisan view:clear
    php artisan route:clear
    php artisan config:clear
    echo "✓ Tous les caches nettoyés"
}

# Recréer les caches optimisés (pour production)
create_production_caches() {
    cd "$PROJECT_ROOT"
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    echo "✓ Caches de production créés"
}

# Optimiser l'autoloader Composer
optimize_composer() {
    cd "$PROJECT_ROOT"
    composer dump-autoload --optimize
    echo "✓ Autoloader Composer optimisé"
}

# ============================================================================
# BASE DE DONNÉES
# ============================================================================

# Migrer la BD
migrate_database() {
    cd "$PROJECT_ROOT"
    php artisan migrate --force
    echo "✓ Migrations exécutées"
}

# Sauvegarder la BD
backup_database() {
    DB_NAME=$(grep DB_DATABASE "$PROJECT_ROOT/.env" | cut -d '=' -f 2)
    DB_USER=$(grep DB_USERNAME "$PROJECT_ROOT/.env" | cut -d '=' -f 2)
    DB_PASS=$(grep DB_PASSWORD "$PROJECT_ROOT/.env" | cut -d '=' -f 2)
    BACKUP_FILE="backup_${DB_NAME}_$(date +%Y%m%d_%H%M%S).sql"
    
    mysqldump -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$PROJECT_ROOT/storage/backups/$BACKUP_FILE"
    gzip "$PROJECT_ROOT/storage/backups/$BACKUP_FILE"
    echo "✓ Sauvegarde créée: $BACKUP_FILE.gz"
}

# Afficher l'état des migrations
check_migrations() {
    cd "$PROJECT_ROOT"
    php artisan migrate:status
}

# ============================================================================
# MAINTENANCE
# ============================================================================

# Metrics du serveur
server_metrics() {
    echo "=== PHP Version ==="
    php -v | head -1
    
    echo -e "\n=== Espace Disque ==="
    df -h "$PROJECT_ROOT" | tail -1
    
    echo -e "\n=== Mémoire Disponible ==="
    free -h | grep Mem
    
    echo -e "\n=== CPU ==="
    top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk '{print "Idle: " $1 "%"}'
}

# Vérifier la santé de l'application
health_check() {
    cd "$PROJECT_ROOT"
    echo "Checking application health..."
    
    # Test DB connection
    if php artisan tinker --execute="DB::connection()->getPdo();" &> /dev/null; then
        echo "✓ Base de données: OK"
    else
        echo "✗ Base de données: ERREUR"
    fi
    
    # Test cache
    if php artisan tinker --execute="Cache::put('test', 'ok', 60);" &> /dev/null; then
        echo "✓ Cache: OK"
    else
        echo "✗ Cache: ERREUR"
    fi
    
    # Test storage
    if [ -w "$PROJECT_ROOT/storage" ]; then
        echo "✓ Storage permissions: OK"
    else
        echo "✗ Storage permissions: ERREUR"
    fi
    
    # Check logs
    RECENT_ERRORS=$(tail -50 "$PROJECT_ROOT/storage/logs/laravel.log" | grep -i "error\|exception" | wc -l)
    if [ $RECENT_ERRORS -gt 0 ]; then
        echo "⚠️  Erreurs récentes dans les logs: $RECENT_ERRORS"
    else
        echo "✓ Logs: Pas d'erreurs récentes"
    fi
}

# ============================================================================
# PERMISSIONS
# ============================================================================

# Fixer les permissions (générique)
fix_permissions() {
    echo "Fixing permissions..."
    
    # Utilisateur du serveur (adapter selon votre serveur)
    HTTP_USER="www-data"
    
    # Permissions fichiers
    find "$PROJECT_ROOT" -type f -exec chmod 644 {} \;
    find "$PROJECT_ROOT" -type d -exec chmod 755 {} \;
    
    # Storage et cache must be writable
    chmod -R 775 "$PROJECT_ROOT/storage"
    chmod -R 775 "$PROJECT_ROOT/bootstrap/cache"
    
    # .env readable only by server
    chmod 600 "$PROJECT_ROOT/.env"
    
    # Ownership (si possible et nécessaire)
    if command -v chown &> /dev/null; then
        chown -R "$HTTP_USER:$HTTP_USER" "$PROJECT_ROOT"
    fi
    
    echo "✓ Permissions normalisées"
}

# ============================================================================
# LOGS
# ============================================================================

# Voir les logs en temps réel
tail_logs() {
    tail -f "$PROJECT_ROOT/storage/logs/laravel.log"
}

# Voir les erreurs récentes
recent_errors() {
    echo "=== ERREURS DES 24 DERNIÈRES HEURES ==="
    find "$PROJECT_ROOT/storage/logs" -name "*.log" -mtime -1 -exec grep -l "ERROR\|Exception" {} \;
    
    echo -e "\n=== Dernières 20 erreurs ==="
    grep -h "ERROR\|Exception" "$PROJECT_ROOT/storage/logs/laravel.log" | tail -20
}

# Archiver et nettoyer les anciens logs
clean_logs() {
    echo "Archiving old logs..."
    find "$PROJECT_ROOT/storage/logs" -name "*.log" -mtime +30 -exec gzip {} \;
    
    echo "Deleting very old logs (> 90 days)..."
    find "$PROJECT_ROOT/storage/logs" -name "*.log.gz" -mtime +90 -delete
    
    echo "✓ Logs nettoyés"
}

# ============================================================================
# DÉPLOIEMENT
# ============================================================================

# Mettre l'app en maintenance
app_down() {
    cd "$PROJECT_ROOT"
    php artisan down --render=errors::503
    echo "✓ Application en maintenance"
}

# Remettre l'app en ligne
app_up() {
    cd "$PROJECT_ROOT"
    php artisan up
    echo "✓ Application en ligne"
}

# Déploiement complet (voir deploy.sh pour version complète)
quick_deploy() {
    echo "Quick deployment..."
    cd "$PROJECT_ROOT"
    
    app_down
    clear_all_caches
    php artisan migrate --force
    create_production_caches
    app_up
    
    echo "✓ Déploiement rapide terminé"
}

# ============================================================================
# FILAMENT
# ============================================================================

# Réinstaller/Mettre à jour Filament
filament_upgrade() {
    cd "$PROJECT_ROOT"
    php artisan filament:upgrade
    echo "✓ Filament mis à jour"
}

# Vider le cache Filament
filament_cache_clear() {
    cd "$PROJECT_ROOT"
    php artisan filament:cache-components --forget-cache
    echo "✓ Cache Filament nettoyé"
}

# ============================================================================
# SAUVEGARDES
# ============================================================================

# Sauvegarde complète (BD + fichiers)
full_backup() {
    BACKUP_DIR="/var/www/backups"
    mkdir -p "$BACKUP_DIR"
    
    BACKUP_NAME="backup_$(date +%Y%m%d_%H%M%S)"
    
    # Sauvegarder la BD
    echo "Saving database..."
    backup_database
    
    # Sauvegarder les uploads
    echo "Saving uploads..."
    tar -czf "$BACKUP_DIR/${BACKUP_NAME}_uploads.tar.gz" \
        "$PROJECT_ROOT/storage/app/public" 2>/dev/null || true
    
    # Sauvegarder la config
    echo "Saving config..."
    cp "$PROJECT_ROOT/.env" "$BACKUP_DIR/${BACKUP_NAME}.env"
    
    echo "✓ Sauvegarde complète: $BACKUP_DIR/$BACKUP_NAME*"
    
    # Garder seulement les 5 dernières sauvegardes
    echo "Cleaning old backups..."
    ls -t "$BACKUP_DIR"/* | tail -n +6 | xargs rm -f 2>/dev/null || true
}

# ============================================================================
# AIDE
# ============================================================================

show_help() {
    echo "================================"
    echo "COMMANDES DISPONIBLES"
    echo "================================"
    echo ""
    echo "OPTIMISATIONS:"
    echo "  clear_all_caches          - Effacer tous les caches"
    echo "  create_production_caches  - Créer caches production"
    echo "  optimize_composer         - Optimiser autoloader Composer"
    echo ""
    echo "BASE DE DONNÉES:"
    echo "  migrate_database          - Exécuter migrations"
    echo "  backup_database           - Sauvegarder la BD"
    echo "  check_migrations          - État des migrations"
    echo ""
    echo "MAINTENANCE:"
    echo "  server_metrics            - Afficher métriques serveur"
    echo "  health_check              - Vérifier santé application"
    echo "  fix_permissions           - Corriger les permissions"
    echo ""
    echo "LOGS:"
    echo "  tail_logs                 - Voir logs en temps réel"
    echo "  recent_errors             - Erreurs des 24h"
    echo "  clean_logs                - Archiver vieux logs"
    echo ""
    echo "DÉPLOIEMENT:"
    echo "  app_down                  - Maintenance ON"
    echo "  app_up                    - Maintenance OFF"
    echo "  quick_deploy              - Déploiement rapide"
    echo ""
    echo "FILAMENT:"
    echo "  filament_upgrade          - Mettre à jour Filament"
    echo "  filament_cache_clear      - Vider cache Filament"
    echo ""
    echo "SAUVEGARDES:"
    echo "  full_backup               - Sauvegarde complète"
    echo ""
    echo "UTILISATION:"
    echo "  source maintenance.sh && <command>"
    echo ""
}

# ============================================================================
# APPEL DE LA COMMANDE
# ============================================================================

# Si argument fourni, l'exécuter
if [ $# -eq 0 ]; then
    show_help
else
    "$@"
fi
