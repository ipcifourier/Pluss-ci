# Commandes Rapides - Déploiement Production

## 🚀 Avant le Déploiement (Local)

### Préparation du Code

```bash
# 1. Vérifier l'état du repo
git status
git log --oneline -5

# 2. Créer une branche backup
git branch backup-$(date +%Y_%m_%d)

# 3. Créer un tag pour marking de version
git tag -a "v1.0-production" -m "Production release"
git push origin --tags
```

### Dépendances

```bash
# 1. Installer dépendances Composer
composer install --optimize-autoloader --no-dev

# 2. Compile assets
npm install
npm run build

# 3. Vérifier config
php artisan config:show | head -30
```

### Tests Local

```bash
# 1. Lancer le serveur local
php artisan serve

# 2. Vérifier la DB locally
php artisan tinker
> DB::connection()->getPdo();
> exit

# 3. Test Filament
# Accéder à http://localhost:8000/admin
```

---

## 🌐 Sur le Serveur Mutualisé

### Configuration Initiale (Une seule fois)

```bash
# 1. SSH sur le serveur
ssh user@votre-domaine.com

# 2. Aller au répertoire
cd /home/user/public_html  # Adapter selon l'hébergeur

# 3. Uploader les fichiers via FTP
# À travers FileZilla, WinSCP, ou scp

# 4. Créer .env depuis le modèle
cp .env.example .env

# 5. Éditer .env (vi, nano, ou via FTP)
nano .env
# Adapter: DB_*, MAIL_*, APP_URL

# 6. Générer clé d'application
php artisan key:generate

# 7. Installer dépendances
composer install --optimize-autoloader --no-dev --no-interaction

# 8. Créer répertoires nécessaires
mkdir -p storage/logs storage/cache storage/app/public storage/backups
chmod -R 775 storage bootstrap/cache

# 9. Storage link
php artisan storage:link

# 10. Migrations initiales
php artisan migrate --force

# 11. Caches de production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Mise à Jour Après (À chaque déploiement)

```bash
# 1. SSH au serveur
ssh user@votre-domaine.com
cd /home/user/public_html

# 2. Maintenance ON
php artisan down

# 3. Télécharger le nouveau code
git pull origin main
# Ou: Upload via FTP

# 4. Dépendances
composer install --optimize-autoloader --no-dev --no-interaction

# 5. Assets (seulement si changes JS/CSS)
npm install
npm run build

# 6. Migrations (seulement s'il y en a)
php artisan migrate --force

# 7. Rafraîchir les caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 8. Recréer caches production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 9. Vérifier les permissions
chmod -R 775 storage bootstrap/cache
chmod 600 .env

# 10. Maintenance OFF
php artisan up

# 11. Vérifier les logs
tail -50 storage/logs/laravel.log
```

---

## 🔧 Maintenance Régulière (Cron Jobs)

Ajouter dans cPanel > Cron Jobs ou via `crontab -e`:

```bash
# Sauvegarder la BD quotidiennement à 2h du matin
0 2 * * * /home/user/backup_db.sh

# Nettoyer les logs tous les 7 jours
0 3 * * 0 /home/user/clean_logs.sh

# Exécuter les queues (jobs) toutes les minutes
* * * * * /usr/local/bin/php /home/user/public_html/artisan queue:work --once --max-attempts=3

# Santé check tous les 6 heures
0 */6 * * * /usr/local/bin/php /home/user/public_html/artisan health check
```

### Script Sauvegarde BD

```bash
#!/bin/bash
# Fichier: backup_db.sh
# À rendre exécutable: chmod +x backup_db.sh

PROJECT_PATH="/home/user/public_html"
BACKUP_PATH="$PROJECT_PATH/storage/backups"

# Source .env
export $(cat "$PROJECT_PATH/.env" | grep '^[^#]' | xargs)

# Créer dossier backup
mkdir -p "$BACKUP_PATH"

# Faire la sauvegarde
FILENAME="backup_${DB_DATABASE}_$(date +%Y%m%d_%H%M%S).sql"
mysqldump -u "$DB_USERNAME" -p"$DB_PASSWORD" -h "$DB_HOST" "$DB_DATABASE" > "$BACKUP_PATH/$FILENAME"

# Compresser
gzip "$BACKUP_PATH/$FILENAME"

# Supprimer sauvegardes plus vieilles que 30 jours
find "$BACKUP_PATH" -name "*.sql.gz" -mtime +30 -delete

echo "Backup complété: $FILENAME.gz"
```

### Script Nettoyage Logs

```bash
#!/bin/bash
# Fichier: clean_logs.sh
# À rendre exécutable: chmod +x clean_logs.sh

PROJECT_PATH="/home/user/public_html"
LOGS_PATH="$PROJECT_PATH/storage/logs"

# Archiver logs de plus de 7 jours
find "$LOGS_PATH" -name "*.log" -mtime +7 -exec gzip {} \;

# Supprimer archives plus vieilles que 90 jours
find "$LOGS_PATH" -name "*.log.gz" -mtime +90 -delete

echo "Logs nettoyés"
```

---

## 🔍 Monitoring et Vérification

### Health Check

```bash
# Se connecter au serveur
ssh user@votre-domaine.com
cd /home/user/public_html

# Vérifier la santé
php artisan health

# Résultat attendu (tous GREEN)
Database ..................  PASSED
# Cache ......................  PASSED
```

### Vérifier les Erreurs

```bash
# Afficher les dernières erreurs
tail -100 storage/logs/laravel.log | grep -i "error\|exception\|failed"

# Afficher les erreurs en temps réel
tail -f storage/logs/laravel.log

# Compter les erreurs du jour
grep "$(date +%Y-%m-%d)" storage/logs/laravel.log | grep -i "error" | wc -l
```

### Tests Fonctionnels

```bash
# Test BD
php artisan tinker
> DB::table('users')->count()

# Test Cache
php artisan tinker
> Cache::put('test', 'ok', 60);
> Cache::get('test');
> exit

# Test API (si applicable)
curl -X GET https://votre-domaine.com/api/test -H "Accept: application/json"

# Test Filament Admin
# Ouvrir navigateur: https://votre-domaine.com/admin
```

---

## 📊 Optimisations Performance

```bash
# Optimiser autoloader Composer
composer dump-autoload --optimize

# Vérifier la config
php artisan config:show

# Vérifier les migrations
php artisan migrate:status

# Vérifier santé app
php artisan health

# Nettoyer TOUS les caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

---

## 🚨 Actions d'Urgence

### Application Lente

```bash
# 1. Vérifier les logs
tail -50 storage/logs/laravel.log

# 2. Vérifier la BD
php artisan tinker
> DB::enableQueryLog();
> \App\Models\User::all();
> DB::getQueryLog();
> exit

# 3. Redémarrer services
# Déjà appliqué pour serveur mutualisé
```

### Application Crash

```bash
# 1. Vérifier APP_DEBUG
grep APP_DEBUG .env
# Doit être false en production

# 2. Consulter les logs
tail -200 storage/logs/laravel.log

# 3. Maintenance mode
php artisan down --render=errors::503

# 4. Nettoyer caches
php artisan cache:clear

# 5. Maintenance OFF
php artisan up
```

### Filament Admin Inaccessible

```bash
# 1. Vérifier guard auth
grep 'guard' config/filament/app.php

# 2. Vérifier utilisateur
php artisan tinker
> \App\Models\User::first();
> exit

# 3. Vérifier permissions
php artisan tinker
> \App\Models\User::first()->can('access admin');
> exit

# 4. Vider cache
php artisan config:clear
php artisan view:clear

# 5. Logs
tail -100 storage/logs/laravel.log | grep -i filament
```

---

## 📝 Logging et Debugging

```bash
# Vérifier le niveau de log
grep LOG_LEVEL .env

# Changer le niveau temporairement
sed -i 's/LOG_LEVEL=warning/LOG_LEVEL=debug/g' .env
php artisan config:clear

# Ne pas oublier de remettre à warning après!
sed -i 's/LOG_LEVEL=debug/LOG_LEVEL=warning/g' .env
php artisan config:clear
```

---

## 💾 Sauvegardes et Restauration

### Sauvegarder Manuellement

```bash
# 1. Sauvegarder BD
mysqldump -u user -p password database > backup.sql

# 2. Compresser
gzip backup.sql

# 3. Télécharger
scp user@server:backup.sql.gz ./
```

### Restaurer Depuis Sauvegarde

```bash
# 1. Télécharger la sauvegarde
scp backup.sql.gz user@server:

# 2. SSH au serveur
ssh user@server
cd /home/user/public_html

# 3. Décompresser
gunzip backup.sql.gz

# 4. Restaurer
mysql -u user -p password database < backup.sql

# 5. Vérifier
php artisan migrate:status
```

---

## 🔐 Sécurité

```bash
# Vérifier fichiers sensibles ne sont pas accessible
curl https://votre-domaine.com/.env
curl https://votre-domaine.com/artisan

# Doit retourner 404 ou 403

# Vérifier headers sécurité
curl -I https://votre-domaine.com | grep -i "X-"

# Vérifier HTTPS redirects
curl -I http://votre-domaine.com | grep Location
# Doit montrer https://
```

---

## 📚 Ressources Utiles

```bash
# Documentation Laravel
https://laravel.com/docs

# Documentation Filament
https://filamentphp.com/docs

# Troubleshooting Laravel
https://laravel.com/docs/deployment

# Status page serveur
# Demander à votre hébergeur son URL
```

---

**Dernière mise à jour:** Février 2026
**Pour aide:** Consultez `DEPLOYMENT_GUIDE.md`
