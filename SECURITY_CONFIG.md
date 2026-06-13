# Configuration Sécurité et Best Practices - Production

## 🔒 Sécurité Critique

### 1. Fichiers et Permissions

```bash
# .env doit être lisible SEULEMENT par le serveur web
chmod 600 .env

# Storage doit être writable par le serveur
chmod 775 storage
chmod 775 bootstrap/cache

# Protéger la racine
chmod 755 .
```

### 2. Fichiers à JAMAIS Committer sur Git

Ajouter au `.gitignore`:

```
.env                 # Configuration sensible
.env.*.php          
.env.lock
storage/logs/*
storage/cache/*
bootstrap/cache/*
node_modules/
vendor/
```

### 3. Clé Secrète

```bash
# Générer une clée secrète FORTE
php artisan key:generate

# Vérifier que APP_KEY est définie
echo $APP_KEY
```

## 🛡️ Headers de Sécurité

Ajouter au `.htaccess` pour sécurité supplémentaire:

```apache
# Prevent access to sensitive files
<FilesMatch "^(\.env|artisan|composer\.|package\.|webpack\.|gulpfile\.)">
    <IfModule mod_authz_core.c>
        Require all denied
    </IfModule>
    <IfModule !mod_authz_core.c>
        Order allow,deny
        Deny from all
    </IfModule>
</FilesMatch>

# Security Headers
Header set X-Frame-Options "SAMEORIGIN"
Header set X-Content-Type-Options "nosniff"
Header set X-XSS-Protection "1; mode=block"
Header set Referrer-Policy "strict-origin-when-cross-origin"

# Force HTTPS (si certificat SSL installé)
<IfModule mod_rewrite.c>
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

## 🔐 Base de Données

### Sauvegardes Régulières

```bash
# Sauvegarder la BD (ajouter en CRON)
mysqldump -u [user] -p[password] [database] > backup_$(date +%Y%m%d_%H%M%S).sql

# Compresser et archiver
gzip backup_*.sql && mv backup_*.sql.gz /chemin/securise/
```

### Utilisateur DB Restreint

```sql
-- Créer un utilisateur avec permissions minimales
CREATE USER 'app_user'@'localhost' IDENTIFIED BY 'strong_password';

-- Accord permissions SEULEMENT pour la DB app
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER ON app_db.* TO 'app_user'@'localhost';

-- PAS de permissions SUPER, FILE, PROCESS, SHUTDOWN, etc.
```

## 🔑 Authentification et Authorization

### Filament Admin Protection

```php
// Vérifier App/Filament/Pages/Auth/Login.php
// S'assurer que seuls les users autorisés peuvent se connecter

// Dans le model User ou Guard:
protected function canAccessFilament(): bool
{
    return $this->is_admin && $this->active;
}
```

### Rate Limiting

Ajouter dans `app/Http/Middleware/ThrottleRequests.php`:

```php
// Limiter les tentatives de login
'login' => '5,1',  # 5 tentatives par minute

// Limiter les API requests
'api' => '60,1',   # 60 par minute
```

## 📊 Monitoring et Logs

### Log Rotation

Ajouter en CRON (quotidien):

```bash
# Archiver les anciens logs
find storage/logs -name "*.log" -mtime +30 -exec gzip {} \;

# Supprimer les logs plus vieux que 90 jours
find storage/logs -name "*.log.gz" -mtime +90 -delete
```

### Alertes sur Erreurs

Configurer les logs pour alerter sur erreurs critiques:

```env
LOG_CHANNEL=stack
LOG_DISK=single
LOG_LEVEL=error  # Alerter seulement sur erreurs

# Email sur erreurs critiques
MAIL_ON_ERRORS=true
ADMIN_EMAIL=admin@votre-domaine.com
```

## 🚀 Performance et Caching

### Caching Strategy

```php
// Dans AppServiceProvider.php
public function boot()
{
    // Cache les vues Filament
    Cache::remember('filament.resources', 3600, function() {
        return Filament::getResources();
    });
    
    // Cache les configurations
    config()->cache();
}
```

### Compression Gzip

Dans `.htaccess`:

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml
    AddOutputFilterByType DEFLATE text/css text/javascript
    AddOutputFilterByType DEFLATE application/javascript application/x-javascript
    AddOutputFilterByType DEFLATE application/xml application/rss+xml
    AddOutputFilterByType DEFLATE application/atom+xml application/x-httpd-php
</IfModule>

# Expiration du cache navigateur
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType text/javascript "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/x-icon "access plus 1 year"
    ExpiresByType application/x-font-ttf "access plus 1 year"
</IfModule>

# ETag pour cache validation
FileETag MTime Size
```

## 🕷️ Protection CSRF et XSS

### CSRF Tokens

S'assurer que TOUS les formulaires incluent le token:

```blade
<form method="POST">
    @csrf
    <!-- champs -->
</form>

{{-- Dans Filament, c'est automatique --}}
```

### Content Security Policy

Ajouter middleware personnalisé:

```php
// Ajouter dans Http/Middleware/SetContentSecurityPolicy.php
public function handle($request, $next)
{
    $response = $next($request);
    
    $response->header('Content-Security-Policy', 
        "default-src 'self'; " .
        "script-src 'self' 'unsafe-inline' cdn.jsdelivr.net; " .
        "style-src 'self' 'unsafe-inline'; " .
        "img-src 'self' data: https:; " .
        "font-src 'self' data:;"
    );
    
    return $response;
}
```

## 🔍 Validation et Sanitization

### Input Validation

Toujours valider les données reçues:

```php
// Dans les Requests Filament
protected function rules(): array
{
    return [
        'email' => 'required|email|unique:users,email,' . $this->user_id,
        'name' => 'required|string|min:3|max:255',
        'role' => 'required|in:admin,user,moderator',
    ];
}
```

### SQL Injection Prevention

Utiliser TOUJOURS les query builders ou Eloquent (déjà sécurisé par Filament/Laravel):

```php
// ✓ BON - Requête sécurisée
User::where('email', $email)->first();

// ✗ MAUVAIS - Vulnérable à SQL injection
DB::select("SELECT * FROM users WHERE email = '$email'");
```

## 🚨 Incidents et Responses

### En cas de Violation

1. **Mettez l'app en Maintenance**:
   ```bash
   php artisan down --render=errors::503
   ```

2. **Vérifiez les logs**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Identifiez la vulnérabilité**
   ```bash
   git log --oneline | head -20
   git diff HEAD~1
   ```

4. **Fixez et redéployez**:
   ```bash
   # Patch la vulnérabilité
   git commit -am "Security fix: ..."
   bash deploy.sh  # Redéployer
   ```

5. **Communiquez** (si données sensibles compromises):
   - Informez l'équipe
   - Changez les credentials
   - Notifiez les utilisateurs affectés

## ✅ Checklist Sécurité

- [ ] `APP_DEBUG=false` en production
- [ ] `APP_KEY` générée et configurée
- [ ] `.env` avec permissions 600
- [ ] `.env` pas en Git
- [ ] HTTPS/SSL configuré
- [ ] Headers sécurité dans `.htaccess`
- [ ] Sauvegardes BD régulières
- [ ] Logs monitoring configuré
- [ ] Rate limiting activé
- [ ] Utilisateur DB restreint
- [ ] Cache configurations activé
- [ ] CORS configuré si API
- [ ] Validation inputs partout
- [ ] Évaluée for common vulnerabilities (OWASP Top 10)

## 📚 Ressources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security](https://laravel.com/docs/security)
- [Filament Security](https://filamentphp.com/docs/3.x/guide#security)
- [PHP Security](https://www.php.net/manual/en/security.php)

---

**Dernière mise à jour:** Février 2026
