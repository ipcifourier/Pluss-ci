# Guide de Déploiement - Serveur Mutualisé

Ce guide vous aide à déployer votre application Laravel avec Filament sur un serveur mutualisé.

## 📋 Prérequis

- **PHP**: 8.2 ou supérieur
- **Composer**: Dernière version
- **Node.js**: v18+ (pour compiler les assets)
- **Extensions PHP recommandées**:
  - `php-mbstring`
  - `php-xml`
  - `php-json`
  - `php-fileinfo`
  - `php-curl`
  - `php-gd`
  - `php-mysql` ou `php-sqlite3`

## 🚀 Étapes de Déploiement

### 1. Préparation Locale

```bash
# Cloner ou zipper le projet
git clone [votre-repo] . ou unzip project.zip

# Installer les dépendances PHP
composer install --optimize-autoloader --no-dev

# Compiler les assets
npm install
npm run build

# Créer le fichier .env
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Vérifier les permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### 2. Configuration du Serveur

#### Structure de Répertoires Recommandée

Sur votre serveur mutualisé, deux approches sont possibles:

**Option A: Public_html comme racine (recommandée)**
```
public_html/          <- Point d'entrée HTTP
├── index.php
├── .htaccess
└── ...autres fichiers publics

private/              <- En dehors de public_html
├── app/
├── config/
├── database/
├── routes/
├── storage/
├── bootstrap/
├── artisan
└── ...autres fichiers
```

**Option B: Sous-dossier (si accès SSH limité)**
```
public_html/
└── app/               <- Ou le nom de votre project
    ├── public/        <- Point d'entrée HTTP
    ├── app/
    ├── config/
    └── ...
```

#### Fichier .htaccess (public_html)

Le fichier `.htaccess` est déjà configuré correctement. Vérifiez que:
- `mod_rewrite` est activé sur votre serveur
- Vous avez les permissions d'utiliser `.htaccess`

```bash
# Tester mod_rewrite
curl https://votre-site.com/test-rewrite
```

### 3. Configuration Variables d'Environnement

Voir le fichier `.env.production` pour un exemple complet avec tous les paramètres pour la production.

**Points critiques:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

DB_CONNECTION=mysql      # ou sqlite si inclus dans le plan
DB_HOST=localhost        # Peut être différent chez votre hébergeur
DB_PORT=3306
DB_DATABASE=votre_db_name
DB_USERNAME=votre_user
DB_PASSWORD=***

CACHE_STORE=file         # ou database sur serveur mutualisé
SESSION_DRIVER=database
QUEUE_CONNECTION=database

FILESYSTEM_DISK=local
```

### 4. Optimisations Laravel pour Production

```bash
# Pré-compiler les routes
php artisan route:cache

# Pré-compiler la configuration
php artisan config:cache

# Pré-compiler les vues
php artisan view:cache

# Pré-compiler les événements
php artisan event:cache

# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Nettoyer le debug
php artisan artisan:down (avant)
php artisan cache:clear
php artisan artisan:up (après)
```

### 5. Configuration Filament pour Production

**Désactiver les modèles de développement:**

dans `config/filament/app.php` (sera généré par Filament):

```php
'display_notification_using' => 'database', // au lieu de 'broadcast'
'enable_database_notifications' => true,
```

**Générer une clé d'administration sécurisée:**

```bash
php artisan filament:install
# Ensuite customiser le guard si nécessaire
```

### 6. Migrations et Base de Données

```bash
# Exécuter les migrations
php artisan migrate --force

# (Optionnel) Seeder les données initiales
php artisan db:seed --class=ProductionSeeder
```

### 7. Permissions et Propriété des Fichiers

```bash
# Sur le serveur, ajuster les permissions:
# (Remplacer 'www-data' par l'utilisateur de votre serveur)

chmod -R 755 /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html
```

### 8. Configuration des Uploads et Stockage

**Créer un lien symbolique:**

```bash
php artisan storage:link
```

**Vérifier les permissions:**

```bash
# Le dossier storage/uploads doit être accessible en écriture
chmod -R 775 storage/app/public
```

**Configuration de Filament pour uploads:**

Assurez-vous que `FILESYSTEM_DISK=local` pointe vers le bon chemin dans `config/filesystems.php`.

### 9. Sécurité

#### CORS (si API séparée)

Modifier `config/cors.php` si nécessaire:

```php
'allowed_origins' => explode(',', env('CORS_ALLOWED_ORIGINS', '*')),
```

#### Trusted Proxies (sur serveur mutualisé)

Dans `app/Http/Middleware/TrustProxies.php`:

```php
protected $proxies = '*';
// ou
protected $proxies = ['10.0.0.0/8', '172.16.0.0/12', '192.168.0.0/16'];
```

#### Headers de Sécurité

Dans `config/security.php` (si vous utilisez un package) ou dans un middleware:

```php
'X-Content-Type-Options: nosniff',
'X-Frame-Options: SAMEORIGIN',
'X-XSS-Protection: 1; mode=block',
```

### 10. Logs et Monitoring

**Configurer les logs pour production:**

```env
LOG_CHANNEL=stack
LOG_LEVEL=warning          # ou 'error' en production
```

**Vérifier les logs:**

```bash
tail -f storage/logs/laravel.log
```

### 11. Certificat SSL/HTTPS

Assurez-vous que:
1. Un certificat SSL est installé (Let's Encrypt gratuit généralement)
2. `APP_URL=https://votre-domaine.com` (avec https)
3. Redirection HTTP vers HTTPS dans `.htaccess`

**Ajouter au `.htaccess`:**

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

### 12. Vérification Pre-Deployment

```bash
# Vérifier la configuration
php artisan config:show

# Vérifier les permissions
php artisan optimize

# Tester la base de données
php artisan tinker
>>> DB::connection()->getPdo();

# Tester l'email (optionnel)
php artisan tinker
>>> Mail::raw('Test', function($message) { $message->to('you@example.com'); });
```

### 13. Déploiement via FTP/SFTP

Fichiers/dossiers à ignorer lors de l'upload:

```
node_modules/
vendor/
.git/
.env (générer sur le serveur)
storage/logs/
bootstrap/cache/*
```

Fichiers/dossiers critiques à uploader:

```
public/           (point d'entrée)
app/
config/
database/
resources/
routes/
bootstrap/
composer.json
composer.lock
package.json (optionnel)
artisan
```

### 14. Script de Déploiement Post-Upload

Créer un script `public/deploy.php` (supprimer après):

```php
<?php
// SECURITE: Supprimer ce fichier après utilisation!

if($_GET['key'] !== env('DEPLOY_KEY')) die('Unauthorized');

system('cd ' . base_path() . ' && php artisan migrate --force');
system('cd ' . base_path() . ' && php artisan cache:clear');
system('cd ' . base_path() . ' && php artisan view:cache');
system('cd ' . base_path() . ' && php artisan route:cache');

echo 'Deployed successfully!';
```

Accès: `https://votre-site.com/deploy.php?key=YOUR_KEY`

**⚠️ Supprimer immédiatement après utilisation!**

## 🔧 Troubleshooting

### "404 Not Found"
- Vérifier que `mod_rewrite` est activé
- Vérifier le `.htaccess` est dans `public/`
- Contacter l'hébergeur pour activer `mod_rewrite`

### "Permission denied"
- Vérifier les permissions de `storage/` et `bootstrap/cache/`
- Utiliser `chmod 775` au lieu de `755` pour les dossiers accessibles en écriture

### "SQLSTATE[HY000]: General error"
- Vérifier que les paramètres DB dans `.env` sont corrects
- S'assurer que la base de données existe
- Vérifier que l'utilisateur DB a les bonnes permissions

### "Call to undefined function proc_open"
- Certaines fonctions PHP sont désactivées
- Contacter l'hébergeur pour les activer (nécessaire pour CLI)

### Filament Admin Panel Inaccessible
- Vérifier que l'authentification fonctionne
- Vérifier les logs: `storage/logs/laravel.log`
- Vérifier la configuration de `config/filament/app.php`

## 📞 Support Hébergeur Recommandé

Pour un serveur mutualisé supportant Laravel/Filament:

- **OVH** (France)
- **Kinsta** (optimisé pour Laravel)
- **Forge** (déploiement automatisé)
- **Digital Ocean** (VPS, non mutualisé)
- **AWS Lightsail** (simple, scalable)

## ✅ Checklist Final

- [ ] PHP 8.2+ avec extensions requises
- [ ] Dépendances Composer installées
- [ ] Assets compilés (`npm run build`)
- [ ] Variables `.env` configurées
- [ ] Migrationsx exécutées
- [ ] Permissions des dossiers correctes
- [ ] SSL/HTTPS activé
- [ ] Logs configurés
- [ ] Tests accès Filament admin
- [ ] Tests fonctionnalités principales
- [ ] Sauvegardes sauvegardées

---

**Dernière mise à jour:** Février 2026
**Version Laravel:** 12.x
**Version Filament:** 5.x
