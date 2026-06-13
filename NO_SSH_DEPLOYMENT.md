# 🚀 Guide Complet - Déploiement SANS SSH

> **Situation:** Vous n'avez pas accès au terminal SSH sur votre serveur mutualisé
> **Solution:** Utiliser FTP/SFTP + Scripts PHP Web + Panel cPanel

---

## 📋 Résumé des Outils Disponibles

### 1. **FTP/SFTP** - Pour uploader les fichiers
- Client recommandé: FileZilla, WinSCP, Cyberduck
- Permet upload/download fichiers
- Non interactif

### 2. **File Manager cPanel** (si disponible)
- Interface web pour gérer fichiers
- Créer/éditer fichiers directement
- Visualiser structure

### 3. **PHP Scripts Web** ✨ (ce que nous utilisons)
- `deploy-init.php` - Déploiement initial
- `maintenance.php` - Maintenance continue
- Accessible via navigateur

### 4. **Composer Web Interface** (si disponible sur cPanel)
- Installer dépendances via boutons

---

## 🎯 Plan de Déploiement - Sans SSH

### Phase 1: Préparation (Locale)
1. Préparer le code et fichiers statiques
2. Créer `.env` de production
3. Organiser les fichiers à uploader

### Phase 2: Upload (FTP)
1. Uploader tous les fichiers du projet
2. Uploader le script de déploiement PHP
3. Créer les dossiers nécessaires

### Phase 3: Configuration (Web)
1. Accéder à `deploy-init.php` via navigateur
2. Suivre le guide interactif
3. L'app configure elle-même

### Phase 4: Maintenance (Web)
1. Utiliser `maintenance.php` pour mises à jour
2. Gérer caches, logs, migrations
3. Sans accès terminal

---

## 📁 Étape 1: Préparation Locale

### 1.1 Préparer le Code

```bash
# Sur votre machine locale

# 1. Installer dépendances PHP
composer install --optimize-autoloader --no-dev

# 2. Compiler les assets
npm run build

# 3. Créer un fichier .env pour la prod
cp .env.production .env.prod

# 4. Vérifier config locale
php artisan config:show | head -20
```

### 1.2 Organiser les Fichiers à Uploader

**À uploader via FTP:**
```
public/                    ← Point d'entrée HTTP
  index.php
  .htaccess
  deploy-init.php         ← Script déploiement
  maintenance.php         ← Script maintenance
  css/
  js/
  images/
  fonts/
  build/

app/                       ← Code application
bootstrap/
config/
database/
resources/
routes/
artisan                    ← Fichier CLI
composer.json
composer.lock
package.json
.htaccess                  ← (Top level)
```

**À IGNORER (uploader seulement sur serveur après):**
```
vendor/                    ← Installer via composer
node_modules/              ← Pas besoin sur serveur
storage/logs/*             ← Créé auto
bootstrap/cache/*          ← Créé auto
.git                       ← Optionnel (alourdit)
.env                       ← Créer sur serveur
```

### 1.3 Préparer le Fichier .env Production

```bash
# Sur votre machine locale

# Copier le template
cp .env.production .env.prod.template

# Éditer localement avec VOS paramètres réels:
# - APP_URL=https://votre-domaine.com
# - DB_HOST, DB_USERNAME, DB_PASSWORD
# - MAIL_* settings
# - Clés API externes
```

**⚠️ NE PAS committer le vrai .env!**

---

## 📤 Étape 2: Upload via FTP

### 2.1 Configurer le Client FTP

**FileZilla (Recommandé, gratuit):**

```
Fichier → Gestionnaire de sites
├─ Protocole: SFTP (ou FTP)
├─ Serveur: votre-domaine.com (ou IP)
├─ Identifiant: votre_user_ftp
├─ Mot de passe: votre_password
├─ Port: 22 (SFTP) ou 21 (FTP)
└─ Répertoire: /home/username/public_html
```

**WinSCP (Alternative):**
- Similaire à FileZilla
- Interface un peu différente
- Equally good

### 2.2 Structurer l'Upload

```
LOCAL DIRECTORY             FTP DESTINATION
pluss-ci-v2/
├─ public/          →      public_html/
├─ app/             →      public_html/../app/
├─ config/          →      public_html/../config/
├─ database/        →      public_html/../database/
├─ resources/       →      public_html/../resources/
├─ routes/          →      public_html/../routes/
├─ bootstrap/       →      public_html/../bootstrap/
├─ composer.json    →      public_html/../composer.json
├─ composer.lock    →      public_html/../composer.lock
├─ artisan          →      public_html/../artisan
└─ .htaccess        →      public_html/../.htaccess
```

### 2.3 Étapes FTP Détaillées

**Via FileZilla:**

```
1. Connecter au serveur FTP
2. Panel gauche: Naviguer à pluss-ci-v2/public
   Panel droit: Vous êtes dans public_html/

3. Upload public uniquement d'abord:
   - public/* → public_html/

4. Remonter d'un dossier (public/.. = projet root)
   Panel gauche: pluss-ci-v2/
   Panel droit: public_html/../ = /home/user/

5. Upload le reste du projet:
   - app → public_html/../app
   - config → public_html/../config
   - ... (tous les dossiers)

6. Créer dossiers qui n'existent pas:
   Panel droit: Clic droit → Créer dossier
   - storage/
   - storage/app/
   - storage/logs/
   - storage/cache/
   - bootstrap/cache/

7. Upload les fichiers root:
   - composer.json
   - composer.lock
   - artisan
   - .htaccess
```

### 2.4 Uploads des Scripts de Déploiement

```
Upload ces fichiers dans public_html/:
├─ public/deploy-init.php   (ou public_html/deploy-init.php)
└─ public/maintenance.php    (ou public_html/maintenance.php)
```

### 2.5 Créer le .env sur le Serveur

**Via File Manager cPanel (si disponible):**

```
1. Aller à File Manager
2. Naviguer à /home/user/public_html/../
3. Créer un fichier:
   - Clic droit → Create New File
   - Nom: .env

4. Éditer le fichier:
   - Clic droit sur .env → Edit
   - Copier le contenu de .env.prod.template
   - Changer les paramètres:
     * APP_URL
     * DB_* (voir email d'installation de l'hébergeur)
     * MAIL_* (si vos paramètres)
   - Sauvegarder

5. Vérifier permissions:
   .env doit être 600 ou 644
   (Clic droit → Change Permissions → 600)
```

**Ou via FTP:**

```
1. Créer localement: .env (copier de .env.prod.template)
2. Éditer localement avec bons paramètres
3. Upload via FTP vers:
   /home/user/.env  (pas dans public_html!)
```

---

## ⚙️ Étape 3: Configuration via Web (Déploiement)

### 3.1 Lancer le Script de Déploiement Initial

**Via navigateur:**

```
1. URL: https://votre-domaine.com/deploy-init.php?key=YOUR_SECRET_KEY

   ⚠️ IMPORTANT: Changer YOUR_SECRET_KEY par une clé aléatoire
   - Générer une clé aléatoire: 
     openssl rand -hex 32
   - La mettre à la place de YOUR_SECRET_KEY

2. La page affiche:
   ✅ Vérifications préalables
   ├─ PHP version
   ├─ Fichier artisan
   ├─ Fichier .env
   ├─ Dossiers writable
   └─ Vendor

3. Si tout OK (✅), cliquer "Continuer avec Déploiement"

4. Le script exécute:
   ✅ Nettoyage caches
   ✅ Génération APP_KEY
   ✅ Storage link
   ✅ Migrations
   ✅ Caches production

5. Messages de succès s'affichent progressivement
```

### 3.2 En cas d'Erreur Pendant le Déploiement

**Erreur: "vendor/ NOT FOUND"**

Solution: Installer Composer d'abord
```
Options:
1. Via cPanel Composer (si disponible)
   - Aller à cPanel → Composer
   - Cliquer "Install"

2. Via SSH (si disponible):
   ssh user@domaine
   cd public_html
   composer install --optimize-autoloader --no-dev --no-interaction

3. Via PHP CLI sur serveur:
   - Uploader composer.phar via FTP
   - Créer run-composer.php dans public/
   - Accéder via navigateur

4. Demander à l'hébergeur d'installer les dépendances
```

**Erreur: "storage/ not writable"**

Solution: Ajuster permissions via FTP
```
FileZilla:
1. Clic droit sur storage/
2. Changer permissions → 775
3. Cocher "Récursif"

WinSCP:
1. Sélectionner storage/
2. Properties
3. Permissions: 775
```

**Erreur: "DB connection failed"**

Solution: Vérifier .env
```
1. Vérifier les paramètres DB:
   - Host: Généralement localhost (vérifier email hébergeur)
   - Port: 3306 (standard MySQL)
   - Username/Password: Vérifier email installation
   - Database: Nom de la BD

2. Tester la connexion:
   - Aller à deploy-init.php
   - Chercher "Database connectivity test"
   - Voir le message d'erreur exact
```

### 3.3 Points de Contrôle

```bash
# Après déploiement réussi, tester via navigateur:

1. Page d'accueil:
   https://votre-domaine.com/
   → Doit afficher le site, pas erreur 404/500

2. Panel Filament Admin:
   https://votre-domaine.com/admin
   → Doit afficher login page

3. Logs pour erreurs:
   Aller à maintenance.php?key=...&action=logs
   → Lire les dernières 50 lignes
   → Ne doit pas avoir [ERROR] ou [EXCEPTION]
```

---

## 🔧 Étape 4: Maintenance Continue (Sans SSH)

### 4.1 Accéder à maintenance.php

```
https://votre-domaine.com/maintenance.php?key=YOUR_SECRET_KEY&action=COMMAND
```

**Actions disponibles:**

| Action | Description | Utilisation |
|--------|-------------|------------|
| `health` | Vérifier santé app | Quotidien |
| `cache-clear` | Vider tous caches | Avant update |
| `cache-create` | Créer caches prod | Après update |
| `logs` | Voir derniers logs | Troubleshooting |
| `storage-link` | Recréer lien storage | Au besoin |
| `migrate` | Exécuter migrations | Nouvelle version |
| `php-info` | Infos serveur | Diagnostique |

### 4.2 Mise à Jour du Code (Regular Deploys)

```bash
# Quand vous avez une nouvelle version à déployer:

1. Localement: Préparer le code
   composer install --optimize-autoloader --no-dev
   npm run build

2. Via FTP: Upload uniquement les fichiers changés
   - Fichiers modifiés
   - Fichiers supprimés

3. Si migrations nécessaires:
   Accéder à: maintenance.php?key=...&action=migrate

4. Rafraîchir caches:
   Accéder à: maintenance.php?key=...&action=cache-create

5. Vérifier tout fonctionne:
   Accéder à: maintenance.php?key=...&action=health
```

### 4.3 Exemple: Ajouter un événement cron

**Sans SSH, créer un fichier PHP exécuté en cron:**

```php
// public/cron.php
<?php

// Sécurité: vérifier la source
if (php_sapi_name() !== 'cli' && !isset($_GET['cron_key'])) {
    die('Unauthorized');
}

require __DIR__ . '/../bootstrap/app.php';

// Exécuter une commande artisan
Artisan::call('queue:work', ['--once' => true, '--max-attempts' => 3]);
Artisan::call('schedule:run');

echo "Cron executed\n";
```

Dans cPanel Cron Jobs:
```
/usr/bin/php /home/user/public_html/cron.php cron_key
```

---

## 🔒 Sécurité - IMPORTANT

### 4.4 Avant de Laisser en Production

```
⚠️ SUPPRIMER CES FICHIERS après utilisation:

1. public/deploy-init.php     ← Risque sécurité!
2. public/maintenance.php     ← Si ne pas utiliser en prod

Raison: Permet exécution code PHP sur serveur
```

### 4.5 Si Vous Gardez maintenance.php

```
1. Protéger par mot de passe HTTP:
   Créer un fichier .htpasswd (où?)
   Ajouter dans .htaccess pour maintenance.php

2. Limiter accès à certaines IPs:
   <Files maintenance.php>
       Allow from 192.168.x.x
       Allow from 203.x.x.x
       Deny from all
   </Files>

3. Faire rotation de la clé SECRET_KEY:
   - La changer dans le code PHP
   - Notifier votre équipe
```

---

## 📋 Checklist - Déploiement Sans SSH

### Avant Upload

- [ ] Composer config installe dépendances locally
- [ ] Assets compilés (`npm run build`)
- [ ] `.env.prod.template` avec paramètres réels
- [ ] Tests locaux (`php artisan serve`)
- [ ] Code commité (`git status`)

### Pendant Upload

- [ ] Tous les dossiers uploadés app/, config/, etc
- [ ] public/ uploadé complet
- [ ] `.env` créé sur serveur (ou uploadé)
- [ ] Permissions: storage/ = 775, bootstrap/cache/ = 775

### Après Upload

- [ ] Accéder à deploy-init.php
- [ ] Vérifications préalables passées
- [ ] Cliquer déploiement
- [ ] Tous les caches créés
- [ ] Supprimer deploy-init.php
- [ ] Tester accès site + /admin

### Production

- [ ] Supprimer deploy-init.php
- [ ] Keeper maintenance.php protégé (optionnel)
- [ ] Monitorer logs régulièrement
- [ ] Sauvegardes BD régulières

---

## 🆘 Troubleshooting - Sans SSH

### "C'est quoi ce message d'erreur?"

1. Regarder dans `maintenance.php?key=...&action=logs`
2. Copier l'erreur exacte
3. Googler: "Laravel [erreur]"
4. Consulter `SHARED_HOSTING_GUIDE.md`

### "Comment voir les fichiers sur serveur?"

FileZilla → Panel droit affiche structure serveur
- Double-clic dossier: entrer dedans
- Clic droit fichier: éditer, supprimer, etc

### "Comment modifier un fichier sur le serveur?"

Via FTP:
```
1. Download le fichier localement
2. Éditer localement
3. Upload pour remplacer
```

Via File Manager cPanel:
```
1. Créer → New File ou Edit fichier existant
2. Éditer directement en web
3. Save
```

### "Les logs disent quoi?"

Exemples courants:

```
[ERROR] SQLSTATE[HY000]
→ Problème DB, vérifier .env DB_*

[ERROR] Class not found
→ Composer pas exécuté, installer dependencies

[ERROR] Permission denied
→ Permissions dossiers, chmod 775

[ERROR] Failed to open stream
→ Fichier manquant, vérifier upload
```

### "Tout semble OK mais 404/500?"

```
1. Vérifier APP_DEBUG=false (production)
2. Vérifier APP_URL correcto
3. Vérifier .htaccess dans public/
4. Vérifier mod_rewrite activé
5. Vérifier index.php est dans public/
```

---

## 📞 Obtenir de l'Aide

### De votre hébergeur

Demander:
- Accès SSH (peut débloquer)
- Installer Composer (si pas dispo)
- Vérifier mod_rewrite activé
- Vérifier PHP 8.2+
- Vérifier extensions PHP requises

### Documentation

- Consulter `DEPLOYMENT_GUIDE.md`
- Consulter `SHARED_HOSTING_GUIDE.md`
- Vérifier logs (`maintenance.php`)

---

## ✅ Success Indicators

Vous êtes bon à déployer SI:

- ✅ Site accessible sans erreur
- ✅ /admin page affiche Filament login
- ✅ Pas d'erreurs dans maintenance.php → logs
- ✅ php artisan health passe (via maintenance.php)
- ✅ Tests fonctionnalités principales OK

---

**Version:** 1.0 - Février 2026
**Pour:** Serveurs mutualisés sans SSH
**Scripts fournis:** deploy-init.php + maintenance.php
