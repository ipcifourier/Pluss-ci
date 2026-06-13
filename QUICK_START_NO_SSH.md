# 🎯 Quick Start - Déploiement SANS SSH (5 Étapes)

> **Temps total:** ~2 heures (upload + vérifications)

---

## ⚡ 5 Étapes Simples

### Étape 1️⃣: Préparer Localement (15 min)

```bash
# Sur votre ordinateur

# 1. Installr dépendances
composer install --optimize-autoloader --no-dev

# 2. Compiler assets
npm run build

# 3. Générer une clé sécurité pour deploy (générer aléatoirement):
openssl rand -hex 32
# Résultat: a1b2c3d4e5f6...  (copier cette clé)
```

### Étape 2️⃣: Uploader via FTP (45 min)

**Télécharger client FTP gratuit:**
- FileZilla (Windows/Mac/Linux)
- WinSCP (Windows)
- Cyberduck (Mac)

**Configuration dans FileZilla:** (Fichier > Gestionnaire de sites)
```
Serveur: votre-domaine.com (ou IP)
Protocole: SFTP
Identifiant: votre_user_ftp
Mot passe: votre_password_ftp
Port: 22 (SFTP) ou 21 (FTP)
```

**Upload:**
```
À gauche (votre PC):  pluss-ci-v2/
À droite (serveur):   public_html/

1. Upload dossier public/
2. Upload app/, config/, database/, resources/, routes/
3. Upload bootstrap/, artisan, composer.json, composer.lock
4. Upload .htaccess (à la racine)
5. Upload deploy-init.php et maintenance.php dans public/

⚠️ NE PAS uploader: vendor/, node_modules/
```

### Étape 3️⃣: Créer le .env sur Serveur (10 min)

**Via File Manager cPanel:**
```
1. Aller à cPanel > File Manager
2. Naviguer à racine du projet
3. Click droit > Create File
4. Nom: .env
5. Click Edit
6. Copier contenu de .env.production
7. Changer les paramètres:
   - APP_URL=https://votre-domaine.com
   - DB_HOST=localhost (ou votre param)
   - DB_DATABASE=xxxxx (voir email hébergeur)
   - DB_USERNAME=xxxxx
   - DB_PASSWORD=xxxxx
   - MAIL_* (optionnel)
8. Save
```

**Ou uploader via FTP:**
```
1. Créer fichier local .env (à partir de .env.production)
2. Changer paramètres DB
3. Upload via FTP vers: /home/user/.env
```

### Étape 4️⃣: Lancer le Déploiement (30 min)

**Via navigateur:**

```
1. Ouvrir navigateur:
   https://votre-domaine.com/deploy-init.php?key=VOTRE_CLE_ALEATOIRE

   (Remplacer VOTRE_CLE_ALEATOIRE par la clé générée à l'Étape 1)

2. Page affiche vérifications:
   ✅ PHP version OK
   ✅ Fichier artisan OK
   ✅ Fichier .env OK
   ... etc

3. Si tout OK, cliquer:
   "▶️ Continuer avec Déploiement"

4. Attendre messages:
   ✅ Config cache
   ✅ Routes cache
   ✅ Views cache
   ✅ Storage link
   ✅ Migrations
   ... etc

5. À la fin: Message "🎉 Déploiement Terminé!"
```

### Étape 5️⃣: Vérifier & Nettoyer (10 min)

**Tester l'application:**

```
1. Ouvrir: https://votre-domaine.com
   → Doit afficher votre site

2. Ouvrir: https://votre-domaine.com/admin
   → Doit afficher login Filament

3. Ouvrir: https://votre-domaine.com/maintenance.php?key=VOTRE_CLE_ALEATOIRE&action=health
   → Doit afficher "✅ PASSED" pour tout
```

**Sécurité - SUPPRIMER:**

```
1. Via FTP ou File Manager:
   Supprimer: public/deploy-init.php

2. Optionnel (garder pour maintenance):
   Laisser maintenance.php MAIS
   - Changer la clé SECRET_KEY
   - Limiter accès
```

**Vérifier les logs (optionnel):**

```
Via navigateur:
https://votre-domaine.com/maintenance.php?key=VOTRE_CLE_ALEATOIRE&action=logs

Doit afficher les 50 derniers logs
Ne doit pas avoir de [ERROR]
```

---

## ✅ C'est Bon Si:

- ✅ Site accessible (`https://votre-domaine.com`)
- ✅ Admin login visible (`https://votre-domaine.com/admin`)
- ✅ Pas d'erreurs dans les logs
- ✅ Health check passe

---

## ❌ Ça Ka Gâcher Si:

| Problème | Solution |
|----------|----------|
| "deploy-init.php not found" | RE-upload dans public/ |
| "vendor/ not found" | Installer Composer à partir de cPanel ou FTP |
| "Database error" | Vérifier params DB dans .env |
| "Permission denied" | Chmod 775 storage/ via FTP |
| "404 everywhere" | Vérifier PUBLIC/.htaccess uploadé |
| "/admin shows blank" | Vider caches: maintenance.php?action=cache-clear |

---

## 🚀 Si Tout Marche

Vous êtes **DONE**! 🎉

Prochaines étapes:
1. Supprimer deploy-init.php
2. Garder maintenance.php pour futures updates (optionnel)
3. Configurer sauvegardes BD régulières
4. Monitorer les logs

---

## 📚 Besoin de Aide?

- Lire: `NO_SSH_DEPLOYMENT.md` (guide complet)
- Lire: `DEPLOYMENT_GUIDE.md` (général)
- Lire: `SHARED_HOSTING_GUIDE.md` (pour mutualisé)
- Vérifier logs: `maintenance.php?action=logs`

---

**Version:** 1.0
**Temps:** ~2h totales
**Outils:** FTP + Navigateur
**Facile:** ✅ OUI (même sans SSH)
