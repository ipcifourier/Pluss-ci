# 📚 Index Complet - Documentation Déploiement

> **Situation:** Serveur mutualisé SANS accès SSH
> **Solution:** FTP + Scripts PHP Web

---

## 🎯 Par Où Commencer?

### 👤 Vous Êtes EN URGENCE?

**Lire dans cet ordre (1 heure):**

1. [QUICK_START_NO_SSH.md](QUICK_START_NO_SSH.md) ⚡ (5 étapes simples)
2. Uploader les fichiers via FTP
3. Lancer deploy-init.php
4. Tester

### 👥 Vous Avez Temps de Comprendre?

**Lire dans cet ordre (2-3 heures):**

1. [NO_SSH_DEPLOYMENT.md](NO_SSH_DEPLOYMENT.md) 📖 (guide complet)
2. [QUICK_START_NO_SSH.md](QUICK_START_NO_SSH.md) ⚡ (pour appliquer)
3. [SECURITY_PHP_SCRIPTS.md](SECURITY_PHP_SCRIPTS.md) 🔐 (configure les clés)
4. Déployer

### 🚀 Vous Avez SSH?

**Lire plutôt:**

1. [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md) 📖 (guide standard)
2. [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md) ✅ (checklist)
3. [deploy.sh](deploy.sh) 🚀 (script auto)
4. Utiliser les commandes SSH normales

---

## 📁 Tous les Fichiers

### 📖 Guides Principaux

| Fichier | Audience | Temps | Contenu |
|---------|----------|-------|---------|
| **DEPLOYMENT_README.md** | Tout le monde | 10 min | Vue d'ensemble + index des guides |
| **NO_SSH_DEPLOYMENT.md** | Sans SSH | 1h | Guide complet sans terminal |
| **QUICK_START_NO_SSH.md** | Sans SSH (urgence) | 20 min | 5 étapes seulement |
| **DEPLOYMENT_GUIDE.md** | Avec SSH | 1h30 | Guide standard avec CLI |
| **SHARED_HOSTING_GUIDE.md** | Serveur mutualisé | 1h | Config optimisée mutualisé |

### 🔐 Sécurité & Configuration

| Fichier | Sujet | Urgence |
|---------|-------|---------|
| **SECURITY_CONFIG.md** | Sécurité générale | 🔴 Haute |
| **SECURITY_PHP_SCRIPTS.md** | Sécurité scripts PHP | 🔴 Haute |
| **.env.production** | Template configuration | 🔴 Haute |
| **config/filament/app.php.example** | Config Filament | 🟡 Moyenne |

### ✅ Checklists

| Fichier | Utilité | Quand? |
|---------|---------|--------|
| **DEPLOYMENT_CHECKLIST.md** | Cocher avant déploiement | Jour J |
| **QUICK_COMMANDS.md** | Commandes rapides | Référence continue |

### 🚀 Scripts d'Automatisation

| Fichier | Fonction | Utilisation |
|---------|----------|------------|
| **deploy.sh** | Déploiement auto bash | Avec SSH seulement |
| **maintenance.sh** | Maintenance via bash | Avec SSH seulement |
| **public/deploy-init.php** | Déploiement initial web | SANS SSH (une seule fois) |
| **public/maintenance.php** | Maintenance continue web | SANS SSH (optionnel) |

---

## 🎓 Decision Tree - Quel Guide Utiliser?

```
Avez-vous accès SSH?
│
├─ OUI (ssh user@domaine.com fonctionne)
│  │
│  ├─ LIRE: DEPLOYMENT_GUIDE.md
│  ├─ LIRE: SHARED_HOSTING_GUIDE.md
│  ├─ UTILISER: deploy.sh
│  └─ TERMINER en 1-2h
│
└─ NON (ssh bloqué ou pas disponible)
   │
   ├─ LIRE: NO_SSH_DEPLOYMENT.md (complet)
   │   OU: QUICK_START_NO_SSH.md (en urgence)
   │
   ├─ LIRE: SECURITY_PHP_SCRIPTS.md (configurer clés)
   │
   ├─ UTILISER: public/deploy-init.php
   ├─ UTILISER: public/maintenance.php (optionnel)
   │
   └─ TERMINER en 2-3h
```

---

## 🚀 Déploiement en 3 Les Grandes Étapes

### Phase 1️⃣: Préparation (30 min)

**À faire localement sur votre ordinateur:**

```bash
# 1. Installer composer
composer install --optimize-autoloader --no-dev

# 2. Compiler assets
npm run build

# 3. Lire:
# - NO_SSH_DEPLOYMENT.md OU DEPLOYMENT_GUIDE.md
# - SECURITY_PHP_SCRIPTS.md (pour scripts PHP)

# 4. Générer clé sécurité si sans SSH:
openssl rand -hex 32
```

**Guides à consulter:**
- Si SSH: `DEPLOYMENT_GUIDE.md`
- Si SANS SSH: `NO_SSH_DEPLOYMENT.md`
- Sécurité: `SECURITY_PHP_SCRIPTS.md`

### Phase 2️⃣: Upload & Configuration (1h)

**Avec SSH:**
```bash
# Just run le script:
./deploy.sh
```

**Sans SSH:**
```
1. Upload via FTP:
   - Tous les fichiers du projet
   - public/deploy-init.php
   - public/maintenance.php

2. Créer .env sur serveur:
   - Via File Manager ou FTP
   - Changer paramètres DB

3. Accéder via navigateur:
   https://domaine.com/deploy-init.php?key=YOUR_KEY

4. Suivre les étapes affichées
```

**Guide:**
- Avec SSH: `deploy.sh` (automatique)
- Sans SSH: `NO_SSH_DEPLOYMENT.md` étape 2 & 3

### Phase 3️⃣: Vérification & Maintenance (30 min)

**Avec SSH:**
```bash
php artisan health
tail -f storage/logs/laravel.log
```

**Sans SSH:**
```
Accéder à:
https://domaine.com/maintenance.php?key=YOUR_KEY&action=health
```

**Guide:** `DEPLOYMENT_CHECKLIST.md`

---

## 🗂️ Comment Organiser les Fichiers

```
pluss-ci-v2/
│
├─ 📖 GUIDES (lire d'abord):
│  ├─ DEPLOYMENT_README.md        (point d'entrée)
│  ├─ NO_SSH_DEPLOYMENT.md        (sans terminal)
│  ├─ QUICK_START_NO_SSH.md       (rapide)
│  ├─ DEPLOYMENT_GUIDE.md         (complet)
│  ├─ SHARED_HOSTING_GUIDE.md     (mutualisé)
│  └─ SECURITY_PHP_SCRIPTS.md     (sécurité scripts)
│
├─ ✅ CHECKLISTS:
│  ├─ DEPLOYMENT_CHECKLIST.md
│  └─ QUICK_COMMANDS.md
│
├─ 🚀 SCRIPTS:
│  ├─ deploy.sh                   (automatisé bash)
│  ├─ maintenance.sh              (maintenance bash)
│  ├─ public/deploy-init.php      (web initial)
│  └─ public/maintenance.php      (web continue)
│
├─ 🔧 CONFIGURATION:
│  ├─ .env.production             (template)
│  ├─ config/filament/app.php.example
│  └─ public/.htaccess            (déjà bon)
│
└─ 📝 CODE PROJECT (app/ config/ etc)
```

---

## 🎯 Parcours Par Cas d'Usage

### Cas 1: Première Mise en Ligne

**Sans SSH:**
1. `QUICK_START_NO_SSH.md` (5 min pour comprendre)
2. `NO_SSH_DEPLOYMENT.md` étape 1, 2, 3
3. `SECURITY_PHP_SCRIPTS.md` (configurer clés)
4. Accéder deploy-init.php
5. Vérifier tout fonctionne
6. Supprimer deploy-init.php

**Avec SSH:**
1. `DEPLOYMENT_GUIDE.md` (comprendre)
2. `deploy.sh` (exécuter)
3. Tests et vérifications

**Temps:** 2-3 heures

---

### Cas 2: Mise à Jour Code Déjà Deploié

**Sans SSH:**
1. Upload fichiers changés via FTP
2. Si migrations: `maintenance.php?action=migrate`
3. Rafraîchir caches: `maintenance.php?action=cache-create`
4. Vérifier: `maintenance.php?action=health`

**Avec SSH:**
1. `./deploy.sh` (automatique)
2. Ou commandes manuelles de `QUICK_COMMANDS.md`

**Temps:** 15 min

---

### Cas 3: Problème en Production

**Diagnostique:**
1. Sans SSH: `maintenance.php?action=logs`
2. Avec SSH: `tail -f storage/logs/laravel.log`
3. Lire l'erreur exacte
4. Googler: "Laravel [erreur]"

**Fixes courants:**
- Permissions: `SHARED_HOSTING_GUIDE.md`
- DB: Vérifier `.env`
- Cache: `maintenance.php?action=cache-clear`

**Référence:** `SECURITY_CONFIG.md` section troubleshooting

**Temps:** 30 min à 2h selon la complexité

---

### Cas 4: Sauvegarder la BD

**Sans SSH:**
- Demander hebergeur ou outils cPanel

**Avec SSH:**
```bash
mysqldump -u user -p password db > backup.sql
gzip backup.sql
```

**Référence:** `SHARED_HOSTING_GUIDE.md` sauvegardes

---

## 🔑 Configuration des Clés de Sécurité

**Depuis le début:**

```bash
# Générer clés aléatoires:
openssl rand -hex 32  # Répéter 2 fois

# Résultats:
# deploy-init: a1b2c3d4...
# maintenance: x9y8z7w6...

# Mettre dans les scripts:
# public/deploy-init.php - ligne 16
# public/maintenance.php - ligne 11

# Garder les clés en sécurité!
```

**Guide complet:** `SECURITY_PHP_SCRIPTS.md`

---

## 📱 Références Rapides

### URLs d'Accès (sans SSH)

```
# Déploiement initial
https://votre-domaine.com/deploy-init.php?key=YOUR_KEY

# Vérifier santé
https://votre-domaine.com/maintenance.php?key=YOUR_KEY&action=health

# Voir logs
https://votre-domaine.com/maintenance.php?key=YOUR_KEY&action=logs

# Vider caches
https://votre-domaine.com/maintenance.php?key=YOUR_KEY&action=cache-clear

# Créer caches
https://votre-domaine.com/maintenance.php?key=YOUR_KEY&action=cache-create

# Exécuter migrations
https://votre-domaine.com/maintenance.php?key=YOUR_KEY&action=migrate
```

### Commandes CLI (avec SSH)

```bash
# Déploiement
./deploy.sh

# Maintenance
source maintenance.sh
health_check              # Santé
clear_all_caches          # Vider caches
create_production_caches  # Créer caches
recent_errors             # Voir erreurs
backup_database           # Sauvegarder BD
```

---

## ❓ Questions Fréquentes

### Q: Par où je commence?

**R:** Si pas SSH: [QUICK_START_NO_SSH.md](QUICK_START_NO_SSH.md) (5 min)

### Q: C'est quoi la différence avec SSH?

**R:** SSH = Terminal direct sur serveur = Plus rapide et sûr
SANS SSH = Via navigateur web = Plus lent mais accessible

### Q: J'ai une erreur, que faire?

**R:** 
1. Voir les logs: `maintenance.php?action=logs`
2. Lire l'erreur exacte
3. Googler l'erreur
4. Consulter section troubleshooting dans le guide

### Q: Comment installer Composer?

**R:** 
1. Via cPanel Composer (si disponible)
2. Demander hebergeur
3. Voir `NO_SSH_DEPLOYMENT.md` section Dépendances

### Q: Je peux garder maintenance.php?

**R:** Oui, mais:
1. Changer la clé régulièrement
2. Limiter accès par IP si possible
3. Vérifier logs d'utilisation

### Q: Après déploiement, quoi faire?

**R:**
1. Supprimer deploy-init.php (sécurité)
2. Optionnel: garder maintenance.php
3. Configurer sauvegardes BD
4. Monitorer logs régulièrement

---

## 🎓 Pour Aller Plus Loin

### Apprendre Laravel
- [Laravel Official Docs](https://laravel.com/docs)
- [Laracasts](https://laracasts.com)

### Apprendre Filament
- [Filament Admin Panel](https://filamentphp.com)
- [Filament Discord](https://discord.gg/filament)

### Sécurité
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Guide](https://www.php.net/manual/en/security.php)

### Déploiement Professionnel
- Passer à [Forge](https://forge.laravel.com/) (auto-deploy)
- Ou VPS [Digital Ocean](https://digitalocean.com)/[Hetzner](https://hetzner.de)

---

## ✅ Checklist Finale

Avant de dire "c'est bon":

- [ ] Guides lus et compris
- [ ] Code uploadé via FTP
- [ ] .env créé avec bons paramètres
- [ ] deploy-init.php lancé
- [ ] Tous les caches créés
- [ ] Site accessible: https://domaine.com
- [ ] Admin accessible: https://domaine.com/admin
- [ ] Logs OK (pas d'erreurs)
- [ ] deploy-init.php supprimé
- [ ] maintenance.php protégé (si gardé)
- [ ] Sauvegardes configurées
- [ ] Équipe notifiée

---

## 🎯 Support

Si besoin d'aide:

1. **Relire les guides** (souvent 80% réponses)
2. **Vérifier les logs** (`maintenance.php?action=logs`)
3. **Googler l'erreur exact**
4. **Contacter hébergeur** (pour problèmes serveur)
5. **Posting sur Laravel forums** (avec logs + contexte)

---

**Dernière mise à jour:** Février 2026
**Version Laravel:** 12.x
**Version Filament:** 5.1
**Status:** Production Ready ✅
