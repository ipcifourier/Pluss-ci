# 📋 Checklist Pre-Deployment - Serveur Mutualisé

## ⚡ Avant de Déployer

- [ ] **Code**
  - [ ] Tous les changements sont commitées (`git status` = clean)
  - [ ] Pas de fichiers `.vscode/` ou IDE secrets en Git
  - [ ] `.gitignore` contient: `.env`, `vendor/`, `node_modules/`, `storage/logs/*`
  - [ ] README.md à jour

- [ ] **Configuration**
  - [ ] `.env.example` complètement rempli
  - [ ] `.env.production` créé et sécurisé
  - [ ] `APP_KEY` générée: `php artisan key:generate`
  - [ ] Variables sensibles (DB, MAIL, API keys) configurées
  - [ ] `APP_DEBUG=false` (production)
  - [ ] `APP_URL=https://...` (avec https)

- [ ] **Dépendances**
  - [ ] `composer.json` à jour
  - [ ] `npm install` exécuté
  - [ ] `npm run build` exécuté (assets compilés)
  - [ ] `composer.lock` en Git
  - [ ] `package-lock.json` ou `yarn.lock` en Git

- [ ] **Base de Données**
  - [ ] Migrations créées pour tous les changements
  - [ ] Migrations testées localement
  - [ ] Seeders créés si données initiales nécessaires
  - [ ] Sauvegarde actuelle effectuée (avant migration)

- [ ] **Filament**
  - [ ] Admin panel custom installé et testé
  - [ ] Authentification fonctionne
  - [ ] Resources affichées correctement
  - [ ] Permissions configurées si nécessaire
  - [ ] Widgets/Dashboard personnalisés testés

- [ ] **Assets et Storage**
  - [ ] CSS/JS compilés en production mode
  - [ ] Images optimisées
  - [ ] Dossier `public/` contient tous les assets nécessaires
  - [ ] `storage:link` configuration testée
  - [ ] Uploads handling testé (fichiers générés accessible)

- [ ] **Tests**
  - [ ] Tests unitaires passent: `php artisan test`
  - [ ] Tests feature passent
  - [ ] Vérification manuelle des pages principales
  - [ ] Filament admin panel accessible et fonctionnel
  - [ ] Mails de test envoyés (si mail config)

- [ ] **Sécurité**
  - [ ] Pas de secrets dans le code (`grep -r "password=" app/`)
  - [ ] `.env` avec permissions 600
  - [ ] HTTPS/SSL ready
  - [ ] Rate limiting configuré
  - [ ] CORS approprié si API
  - [ ] Validation inputs partout

- [ ] **Performance**
  - [ ] Caches configurés (Redis/File/Database approprié)
  - [ ] Database queries optimisées (pas de N+1)
  - [ ] Images compressées
  - [ ] Assets minifiés
  - [ ] Lazy loading images

- [ ] **Logs et Monitoring**
  - [ ] `LOG_LEVEL` approprié (pas `debug` en prod)
  - [ ] Dossier `storage/logs/` prêt (writeable)
  - [ ] Rotation des logs configured
  - [ ] Email alertes configuré

- [ ] **Documentation**
  - [ ] `DEPLOYMENT_GUIDE.md` fourni
  - [ ] `SECURITY_CONFIG.md` lu et compris
  - [ ] Commandes importantes documentées
  - [ ] Points de contact (support) identifiés

---

## 🚀 Jour du Déploiement

### Avant de Commencer

```bash
# 1. Vérifier qu'on a un point stable
git status  # Doit être clean

# 2. Créer une branche de backup
git branch backup-$(date +%Y%m%d)

# 3. Sauvegarder localement la config
cp .env .env.local.backup
```

### Préparation Locale Final

```bash
# 1. Installer dépendances
composer install --optimize-autoloader --no-dev

# 2. Compiler assets
npm run build

# 3. Générer APP_KEY (si besoin)
php artisan key:generate

# 4. Vérifier configuration
php artisan config:show | grep -E "APP_|DB_"

# 5. Tester localement (avant upload)
php artisan serve
# => Accéder à http://localhost:8000/admin
```

### Upload sur Serveur

#### Option A: FTP/SFTP (Plus simple)

```bash
# Fichiers à uploader (adapter chemins):
# - public/*                (point d'entrée)
# - app/
# - config/
# - database/
# - routes/
# - resources/
# - bootstrap/
# - composer.json
# - composer.lock
# - artisan

# Fichiers à IGNORER:
# - vendor/            (installer sur serveur)
# - node_modules/
# - storage/logs/*
# - bootstrap/cache/*
# - .git
# - .env             (créer sur serveur)

# Utiliser un client FTP (FileZilla, WinSCP):
# 1. Fresh upload du code (sans vendor/)
# 2. S'assurer que .htaccess est uploadé
# 3. Vérifier structure de répertoires
```

#### Option B: SSH/Git (Plus sûr)

```bash
# Sur serveur:
cd /var/www/html

# 1. Clone le repo
git clone [votre-repo] .

# 2. Ou mise à jour
git pull origin main

# 3. Créer .env
cp .env.example .env
# Éditer et remplir les paramètres
nano .env
```

### Configuration Serveur

```bash
# Sur le serveur via SSH:

cd /path/to/project

# 1. Installer dépendances
composer install --optimize-autoloader --no-dev

# 2. Permissions
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
chmod 600 .env

# 3. Générer APP_KEY
php artisan key:generate

# 4. Créer liens symboliques
php artisan storage:link

# 5. Exécuter migrations
php artisan migrate --force

# 6. Cache en production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 7. Vérifier
php artisan health
```

### Vérifications

```bash
# Sur serveur:

# 1. Test connexion DB
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit

# 2. Test cache
php artisan tinker  
>>> Cache::put('test', 'ok', 60);
>>> Cache::get('test');  # Doit retourner 'ok'
>>> exit

# 3. Tester accès web
curl https://votre-domaine.com/admin
# Doit afficher login Filament

# 4. Logs
tail -50 storage/logs/laravel.log
# Ne doit pas avoir d'erreurs critiques

# 5. Permissions
ls -la storage
ls -la bootstrap/cache
# Doit avoir permissions 775

# 6. Health check
php artisan health
# Tous green
```

### Validation Finale

```bash
# Tester dans un navigateur:

1. https://votre-domaine.com         # Page d'accueil
2. https://votre-domaine.com/admin   # Admin login
3. Loggger avec un compte test
4. Vérifier les pages principales
5. Tester upload fichier si applicable
6. Tester formulaire contact si applicable
7. Vérifier logs: tail -f storage/logs/laravel.log
```

---

## ✅ Post-Deployment (24-48h après)

- [ ] Monitorer les logs pour erreurs
- [ ] Tester toutes les fonctionnalités principales
- [ ] Vérifier performance (page load times)
- [ ] Valider envoi d'emails (si applicable)
- [ ] Confirmer sauvegardes automatiques (si configurées)
- [ ] Notifier utilisateurs si changements significatifs
- [ ] Préparer plan de rollback (garder branche backup)

---

## 🚨 Rollback (En Cas de Problème)

```bash
# Sur serveur:

# 1. Mettre en maintenance
php artisan down

# 2. Revenir à version antérieure
git checkout HEAD~1  # Ou votre dernier commit stable
# Ou
git reset --hard [commit_id]

# 3. Adapter .env si files changes
cp .env.backup .env

# 4. Rollback BD si erreur migration
php artisan migrate:rollback --step=1

# 5. Nettoyer caches
php artisan cache:clear
php artisan config:clear

# 6. Remonter l'app
php artisan up

# 7. Investiguer l'erreur
tail -100 storage/logs/laravel.log | grep -i "error\|exception"
```

---

## 📞 Troubleshooting Courant

| Erreur | Solution |
|--------|----------|
| 404 Not Found | Vérifier mod_rewrite, .htaccess, APP_URL |
| Permission denied storage | `chmod 775 storage bootstrap/cache` |
| SQLSTATE error | Vérifier DB params dans .env, BD existe |
| ClassNotFoundException | `composer dump-autoload --optimize` |
| Migrations Failed | Vérifier colums existants, backup BD |
| Filament Login Page Blank | Vérifier VIEW cache, logs |
| Emails not send | Vérifier MAIL_* config, logs |
| Images not showing | Vérifier `public/` permissions, `storage:link` |
| Slow performance | Vérifier caches, DB queries, assets |

---

## 📊 Documentation Importante

📌 Voir ces fichiers pour plus détails:
- `DEPLOYMENT_GUIDE.md` - Guide complet déploiement
- `SECURITY_CONFIG.md` - Configuration sécurité
- `deploy.sh` - Script déploiement automatisé
- `maintenance.sh` - Commandes utiles maintenance
- `.env.production` - Template configuration production

---

**Bonne chance pour le déploiement! 🚀**

:::info
Pour questions: Consultez le guide complet et/ou contactez votre hébergeur.
:::
