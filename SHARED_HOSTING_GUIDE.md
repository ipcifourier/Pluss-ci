# Configuration Serveur Mutualisé - Guide Spécifique

## 📋 Ce qui Fonctionne / Ne Fonctionne Pas sur Serveur Mutualisé

### ✅ CE QUI FONCTIONNE

| Composant | Serveur Mutualisé | Notes |
|-----------|-------------------|-------|
| **Laravel** | ✅ Oui | 8.2+ requis |
| **Filament** | ✅ Oui | Panel admin sans soucis |
| **MySQL/MariaDB** | ✅ Oui | Inclus généralement |
| **Cache File** | ✅ Oui | Stockage disque local |
| **Cache Database** | ✅ Oui | Utiliser la BD |
| **Sessions Database** | ✅ Oui | Plus stable que cookie |
| **Queue Database** | ✅ Oui | Jobs traités par CRON |
| **Mail SMTP** | ✅ Oui | Externe requis |
| **File Storage** | ✅ Oui | Uploads/fichiers générés |
| **Storage Link** | ✅ Oui | `php artisan storage:link` |
| **Cron Jobs** | ✅ Oui | Via cPanel/console |

### ❌ CE QUI NE FONCTIONNE PAS

| Composant | Raison | Alternative |
|-----------|--------|-------------|
| **Redis** | Non disponible | Utiliser Cache::file ou Cache::database |
| **Memcached** | Non dispo | Utiliser Cache::file |
| **WebSockets** | Pas d'accès | Utiliser notifications DB ou polling |
| **Broadcasting** | Pas possible | Désactiver `BROADCAST_CONNECTION=log` |
| **Supervisor** | Pas dispo | Utiliser CRON pour worker |
| **SSL Self-signed** | Limité | Utiliser Let's Encrypt (généralement inclus) |
| **SSH Git Deploy** | Parfois bloqué | FTP/SFTP + composer install manuel |

---

## 🔧 Configuration .htaccess Optimisée

Remplacer le contenu de `public/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # ====================================================================
    # SECURITY - Protéger les fichiers sensibles
    # ====================================================================
    
    # Bloquer accès aux fichiers sensibles
    <FilesMatch "^(\.env|artisan|composer\.|package\.|webpack\.|gulpfile\.)">
        <IfModule mod_authz_core.c>
            Require all denied
        </IfModule>
        <IfModule !mod_authz_core.c>
            Order allow,deny
            Deny from all
        </IfModule>
    </FilesMatch>
    
    # Bloquer accès aux dossiers sensibles
    RewriteRule ^(\.env|artisan|composer\.|node_modules/) - [F,L]
    
    # ====================================================================
    # HTTPS REDIRECT - Forcer le HTTPS
    # ====================================================================
    # Décommenter si SSL installé et que redirection n'existe pas ailleurs
    
    # RewriteCond %{HTTPS} off
    # RewriteCond %{HTTP:X-Forwarded-Proto} !https
    # RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # ====================================================================
    # Handle Authorization Header
    # ====================================================================
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # ====================================================================
    # Handle X-XSRF-Token Header
    # ====================================================================
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # ====================================================================
    # Redirect Trailing Slashes If Not A Folder
    # ====================================================================
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # ====================================================================
    # Send Requests To Front Controller
    # ====================================================================
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# ============================================================================
# PERFORMANCE - Compression et Caching
# ============================================================================

<IfModule mod_deflate.c>
    # Activer compression pour types de fichiers
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css
    AddOutputFilterByType DEFLATE application/javascript application/x-javascript
    AddOutputFilterByType DEFLATE application/json application/xml
    AddOutputFilterByType DEFLATE application/rss+xml application/atom+xml
    AddOutputFilterByType DEFLATE image/svg+xml
    
    # Éviter double compression
    DeflateFilterNote Input instream
    DeflateFilterNote Output outstream
    DeflateFilterNote Ratio ratio
    
    LogFormat '%h %l %u %t \"%r\" %s %b mod_deflate: %{ratio}n' deflate
</IfModule>

<IfModule mod_expires.c>
    ExpiresActive On
    
    # HTML - Cache court (1 heure)
    ExpiresByType text/html "access plus 1 hour"
    
    # CSS et JS - Cache long (1 mois) - Faire attention au versioning!
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/x-javascript "access plus 1 month"
    ExpiresByType text/javascript "access plus 1 month"
    
    # Images - Cache très long (1 an)
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/x-icon "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    
    # Fonts - Cache long (1 an)
    ExpiresByType application/x-font-ttf "access plus 1 year"
    ExpiresByType application/x-font-truetype "access plus 1 year"
    ExpiresByType application/x-font-opentype "access plus 1 year"
    ExpiresByType application/x-font-woff "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
    
    # Documents PDF et archives - Cache moyen (30 jours)
    ExpiresByType application/pdf "access plus 30 days"
    ExpiresByType application/zip "access plus 30 days"
    
    # Par défaut
    ExpiresDefault "access plus 7 days"
</IfModule>

<IfModule mod_headers.c>
    # Cache validation avec ETag
    Header append Cache-Control "public"
    
    # Pour fichiers versionnés (contiennent hash/version dans nom)
    <FilesMatch "\.js$|\.css$|\.woff$|\.woff2$">
        Header set Cache-Control "public, immutable"
    </FilesMatch>
</IfModule>

# ============================================================================
# SECURITY HEADERS
# ============================================================================

<IfModule mod_headers.c>
    # Prévenir le clickjacking
    Header set X-Frame-Options "SAMEORIGIN"
    
    # Prévenir le MIME type sniffing
    Header set X-Content-Type-Options "nosniff"
    
    # XSS Protection (navigateurs anciens)
    Header set X-XSS-Protection "1; mode=block"
    
    # Referrer Policy
    Header set Referrer-Policy "strict-origin-when-cross-origin"
    
    # Feature Policy (Permissions Policy) - adapter selon votre app
    Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>
```

---

## ⚙️ Optimisations Spécifiques Serveur Mutualisé

### 1. Configuration PHP (php.ini ou .htaccess)

```apache
# Dans public/.htaccess ou via cPanel:

<IfModule mod_php.c>
    # Memory limit
    php_value memory_limit 128M
    
    # Upload max
    php_value post_max_size 50M
    php_value upload_max_filesize 50M
    
    # Timeout (peut être limité par serveur)
    php_value max_execution_time 300
    
    # Display errors (false en production)
    php_value display_errors 0
    
    # Error reporting
    php_value error_reporting E_ALL
    
    # Short tags (déconseillé mais possible besoin)
    php_value short_open_tag 0
</IfModule>
```

### 2. Configuration Laravel Optimisée

**Dans `config/app.php`:**

```php
return [
    // ... coustruir config existante ...
    
    // Encoder par défaut (pour XSS prevention)
    'url_encode' => true,
    
    // Trusted proxies (si derrière load balancer)
    'trustedproxies' => explode(',', env('TRUSTED_PROXIES', '')),
    'trustedheaders' => [
        'X-Forwarded-For' => 'REMOTE_ADDR',
        'X-Forwarded-Port' => 'SERVER_PORT',
        'X-Forwarded-Proto' => 'HTTP_SCHEME',
    ],
];
```

### 3. Optimisation Database

**Dans `.env` pour serveur mutualisé:**

```env
# Connexion pooling
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user

# Connection settings
DB_CONNECTION_POOL_MIN=1
DB_CONNECTION_POOL_MAX=5

# Mode pour MySQL
DB_MYSQL_SQL_MODE=null  # Désactiver SQL_MODE strict si problèmes
```

### 4. Queue on Shared Hosting

Ajouter cette tâche CRON (pointer vers sa fréquence):

```bash
# Toutes les 5 minutes via cPanel Cron Jobs:
*/5 * * * * /usr/bin/php /home/user/public_html/artisan queue:work --once --max-attempts=3

# Ou chaque minute (si permet):
* * * * * /usr/bin/php /home/user/public_html/artisan queue:work --once --max-attempts=3
```

Adapter le path `/usr/bin/php` selon votre serveur (demander à l'hébergeur).

### 5. Cleanup Tasks - Ajouter en CRON

```bash
# Renouveler les sessions expirées (quotididien)
0 0 * * * /usr/bin/php /home/user/public_html/artisan session:prune --hours=24

# Nettoyer les fichiers temporaires (quotidien)
0 1 * * * /usr/bin/php /home/user/public_html/artisan storage:prune

# Nettoyer les failed jobs (tous les jours)
0 2 * * * /usr/bin/php /home/user/public_html/artisan queue:prune-failed
```

---

## 🔍 Test Configurations Serveur

Vérifier ce qui fonctionne:

```bash
# Via SSH ou Terminal cPanel:

# 1. Test mod_rewrite
curl -I https://votre-domaine.com/artisan
# Doit retourner 404 (bloqué par .htaccess)

# 2. Test PHP extensions
php -m | grep -i "curl\|gd\|pdo\|zip"
# Doit afficher les extensions

# 3. Test autoload
php -r "require 'vendor/autoload.php'; echo 'OK';"

# 4. Test permissions
ls -la storage
# storage doit avoir 'w' (writable)
```

---

## 📞 Support Hébergeurs Recommandés

Parmi les plus populaires supportant Laravel:

| Hébergeur | Niveau | Filament | Notes |
|-----------|--------|----------|-------|
| **OVH** | Entrée | ✅ | Français, bon support |
| **1&1 Ionos** | Entrée | ✅ | Bon prix, ok support |
| **Kinsta** | Premium | ✅✅ | Optimisé Laravel |
| **Forge** | Auto | ✅✅ | Déploiement auto |
| **Coolify** | Self-hosted | ✅✅ | Contrôle total |
| **Hetzner** | VPS | ✅✅ | Très bon rapport prix |

---

## ⚠️ Limitations Connues Serveur Mutualisé

1. **Pas d'accès root** → Certaines optimisations système impossibles
2. **Limites memoires/CPU** → Performance réduite sous charge
3. **Pas d'écoute ports custom** → Pas de socket serveurs
4. **Limites connexions BD** → Pools limités
5. **Max execution time** → Peut être court (30-120s)
6. **Pas d'accès mail direct** → SMTP externe requis
7. **Filesize uploads limits** → Généralement 50-100MB
8. **Domain limitations** → Nombre de domaines/sousdomaines limité

---

## 🎯 Recommandations Finales

Pour un **serveur mutualisé avec Filament**:

1. ✅ **Cache Strategy**: `CACHE_STORE=file` (simple et efficace)
2. ✅ **Session**: `SESSION_DRIVER=database` (plus stable)
3. ✅ **Queue**: `QUEUE_CONNECTION=database` + CRON
4. ✅ **Mail**: SMTP externe (SendGrid, Mailgun, etc)
5. ✅ **Storage**: Local disk avec `storage:link`
6. ✅ **Broadcasting**: Désactiver (pas de WebSocket)
7. ✅ **Notifications**: Database driver
8. ✅ **Logs**: Rotation automatique
9. ✅ **Assets**: Vite avec npm run build
10. ✅ **SSL**: Let's Encrypt (gratuit)

---

**Version:** 1.0 - Février 2026
**Pour mise à jour:** Consulter hébergeur et Laravel docs
