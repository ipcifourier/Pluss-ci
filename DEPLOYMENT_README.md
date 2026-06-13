# 📚 Guide Complet - Déploiement Production Serveur Mutualisé

> **Date de préparation**: Février 2026
> **Projet**: Laravel 12 + Filament 5.1
> **Serveur cible**: Serveur mutualisé

---

## 🎯 Vue d'ensemble

Ce projet a été **préparé spécifiquement pour un déploiement sur serveur mutualisé** avec un focus sur les meilleures pratiques avec **Filament** (admin panel).

Tous les fichiers de documentation et scripts nécessaires ont été créés dans le répertoire racine du projet.

---

## 📁 Fichiers de Déploiement Créés

### 1. **DEPLOYMENT_GUIDE.md** 📖
**Lire en premier! Guide complet étape par étape**

Contient:
- Prérequis (PHP 8.2+, dépendances)
- Structure de répertoires recommandée (2 options)
- Configuration des variables d'environnement
- Optimisations Laravel pour production
- Configuration Filament pour production
- Permissions et sécurité

**👉 Commencer par:** `DEPLOYMENT_GUIDE.md`

---

### 2. **DEPLOYMENT_CHECKLIST.md** ✅
**Checklist à cocher avant et pendant le déploiement**

Contient:
- Vérifications préalables au déploiement
- Checklist jour du déploiement
- Commandes étape par étape
- Vérifications sur serveur
- Rollback en cas d'erreur
- Troubleshooting courant

**👉 Utiliser lors du déploiement**: Suivre point par point

---

### 3. **SHARED_HOSTING_GUIDE.md** 🔧
**Configuration optimisée pour serveur mutualisé**

Contient:
- Ce qui fonctionne / ne fonctionne pas
- Configurations .htaccess optimisées
- Optimisations PHP spécifiques
- Configuration database optimisée
- Queue jobs avec CRON
- Limitations connues
- Recommandations finales

**👉 Lire absolument si c'est votre 1er déploiement mutualisé**

---

### 4. **SECURITY_CONFIG.md** 🔒
**Configuration sécurité et best practices**

Contient:
- Permissions fichiers
- Headers de sécurité
- Protection base de données
- Authentification Filament
- Rate limiting
- Logs et monitoring
- Protection CSRF/XSS
- Incident response

**👉 Implémenter toutes les mesures listées**

---

### 5. **QUICK_COMMANDS.md** ⚡
**Commandes rapides à copier-coller**

Contient:
- Préparation locale avant déploiement
- Commandes sur serveur (initial + updates)
- Jobs CRON recommandés
- Scripts sauvegarde/nettoyage
- Health checks et monitoring
- Tests fonctionnels
- Actions urgence

**👉 Copier les commandes selon vos besoins**

---

### 6. **.env.production** 🔑
**Template configuration production**

Contient:
- Tous les paramètres pour production
- Commentaires explicatifs pour chaque section
- Valeurs par défaut sensées
- Notes de sécurité
- À adapter avec vos vrais paramètres

**👉 Utiliser comme modèle pour créer votre .env**

---

### 7. **deploy.sh** 🚀
**Script de déploiement automatisé (bash)**

Contient:
- Vérifications préalables
- Mode maintenance automatique
- Nettoyage caches
- Installation dépendances
- Compilation assets
- Migrations automatiques
- Optimisations production
- Retour en ligne auto

**👉 Rendre exécutable:** `chmod +x deploy.sh`
**👉 Utiliser sur serveur:** `./deploy.sh`

---

### 8. **maintenance.sh** 🔧
**Scripts de maintenance simples**

Contient:
- Fonctions de nettoyage caches
- Functions optimisations
- Scripts sauvegarde BD
- Health checks
- Script permission fixing
- Log monitoring

**👉 Source et utiliser:** `source maintenance.sh && <command>`

---

### 9. **config/filament/app.php.example** ⚙️
**Configuration recommandée pour Filament production**

Contient:
- Paramètres optimisés pour serveur mutualisé
- Notifications en database (pas WebSocket)
- Désactivation broadcasting
- Caching activé
- Pagination optimisée

**👉 Comparer avec votre `config/filament/app.php` existant**

---

## 🚀 Commandes de Démarrage Rapide

### Sur votre Machine Locale

```bash
# 1. Préparer le code
composer install --optimize-autoloader --no-dev
npm install && npm run build

# 2. Créer .env pour production (à partir du template)
cp .env.production .env.prod-settings

# 3. Vérifier que tout compile
php artisan config:show

# 4. Créer backup de votre code (git)
git tag v1.0-production
git push origin --tags
```

### Sur le Serveur Mutualisé (Première fois)

```bash
# 1. Se connecter en SSH
ssh user@votre-domaine.com
cd /home/user/public_html

# 2. Upload code et créer .env
# Via FTP puis:
cp .env.production .env
nano .env  # Adapter avec vrais paramètres

# 3. Lancer la config initiale
composer install --optimize-autoloader --no-dev --no-interaction
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
```

### Déploiement Ultérieur (Updates)

```bash
# Utiliser le script fourni:
./deploy.sh

# Ou manuellement:
php artisan down
# ... update code ...
composer install --optimize-autoloader --no-dev --no-interaction
php artisan migrate --force
php artisan cache:clear && php artisan config:cache
php artisan up
```

---

## 📊 Checklist Pre-Deployment (5 minutes)

- [ ] As-tu relu `DEPLOYMENT_GUIDE.md`?
- [ ] As-tu vérifié `APP_DEBUG=false` dans `.env`?
- [ ] As-tu généré la `APP_KEY`?
- [ ] As-tu adapté les paramètres DB/MAIL?
- [ ] As-tu testé localement (`php artisan serve`)?
- [ ] As-tu committés tous les changements (`git status`)?
- [ ] As-tu créé un tag/branch backup?
- [ ] As-tu sauvegardé la BD existante (si migration)?

---

## 🔍 Vérifications Post-Deployment

### Immédiat (5 min après)

```bash
# Sur serveur:
php artisan health
tail -20 storage/logs/laravel.log
curl https://votre-domaine.com/admin
```

### Après 1 heure

```bash
# Vérifier pas d'erreurs:
tail -100 storage/logs/laravel.log | grep ERROR

# Vérifier uploads/fichiers:
ls -la storage/app/public

# Tester dans navigateur:
# - Admin panel login
# - Créer/éditer un item
# - Upload un fichier
```

### Après 24 heures

```bash
# Vérifier cron jobs:
php artisan queue:work --once

# Vérifier sauvegardes:
ls -la storage/backups

# Monitorer la BD:
php artisan tinker
> \App\Models\User::count();
```

---

## ❓ FAQ Rapide

### Q: Par où commencer?
**R:** Lire `DEPLOYMENT_GUIDE.md` en entier (30 min)

### Q: Mon hébergeur refuse certaines commandes?
**R:** Voir `SHARED_HOSTING_GUIDE.md` section limitations

### Q: Comment savoir si l'app est en bonne santé?
**R:** Lancer: `php artisan health` (besoin SSH)

### Q: Quoi faire si l'app crash en production?
**R:** Voir `QUICK_COMMANDS.md` section "Actions Urgence"

### Q: Comment updater sans downtime?
**R:** Voir `deploy.sh` (mode maintenance + cache clear)

### Q: Comment déployer seulement le code sans BD?
**R:** Commenter ligne migration dans `deploy.sh`

### Q: Mon Filament admin n'est pas accessible?
**R:** Voir `QUICK_COMMANDS.md` section "Filament Inaccessible"

### Q: Comment configurer les logs?
**R:** Voir `DEPLOYMENT_GUIDE.md` section "Logs et Monitoring"

---

## 🎓 Lectures Recommandées

### Documentation Officielle
1. [Laravel Deployment](https://laravel.com/docs/deployment)
2. [Filament Admin Panel](https://filamentphp.com)
3. [PHP Security](https://www.php.net/manual/en/security.php)

### Guides Complémentaires
- OWASP Top 10 pour sécurité
- MySQL Performance Tuning
- Apache mod_rewrite

---

## 🆘 Support et Troubleshooting

### En cas de Problème

1. **Vérifier les logs d'abord:**
   ```bash
   tail -100 storage/logs/laravel.log
   ```

2. **Consulter la section troubleshooting correspondante:**
   - Erreurs 404 → `DEPLOYMENT_GUIDE.md`
   - Permissions → `SHARED_HOSTING_GUIDE.md`
   - Filament → `SECURITY_CONFIG.md`

3. **Réseau/Infrastructure:**
   - Contacter votre hébergeur pour:
     - Vérifier mod_rewrite activé
     - Vérifier PHP 8.2+ installé
     - Vérifier extensions requises présentes
     - Status serveur/BD

4. **Laravel Specifique:**
   - Lancer `php artisan migrate:status`
   - Lancer `php artisan config:show`
   - Lancer `php artisan health`

---

## 📈 Optimisations Après Déploiement

Une fois en production et stable:

1. **Semaine 1:**
   - Monitorer logs
   - Tester toutes les fonctionnalités
   - Vérifier performance

2. **Mois 1:**
   - Configurer monitoring
   - Mettre en place alertes email
   - Planifier sauvegardes automatiques

3. **Mois 3+:**
   - Analyser logs pour optimisations
   - Envisager migration VPS si besoin
   - Auditer sécurité

---

## 📞 Fichiers Clés à Garder Accessibles

Bookmark ou imprimer pour future référence:

| Fichier | Utilisation |
|---------|-----------|
| `DEPLOYMENT_GUIDE.md` | Guide complet - consulter en cas de doute |
| `QUICK_COMMANDS.md` | Commandes rapides - copier-coller |
| `DEPLOYMENT_CHECKLIST.md` | À chaque déploiement |
| `.env.production` | Pour configurer `.env` réel |
| `deploy.sh` | Lancer pour auto-déployer |

---

## ✅ Étapes Finales

Avant de dire "c'est bon":

1. [ ] Tests de charge (au moins accès simultanés)
2. [ ] Backup BD première fois
3. [ ] Monitoring logs 24h
4. [ ] Documenter VOS procédures (pour équipe)
5. [ ] Plan de rollback documenté
6. [ ] Contact hébergeur noté
7. [ ] Sauvegardes automatiques vérifiées

---

## 🎉 Bon Déploiement!

Vous avez maintenant **tous les outils et documentation** pour un déploiement réussi sur serveur mutualisé avec Filament.

**Points clés à retenir:**
- 📖 Lire les guides
- ✅ Suivre les checklists
- 🔐 Appliquer la sécurité
- 💾 Sauvegarder!
- 🚀 Déployer progressivement

---

**Questions?** Consulter l'index des fichiers ci-dessus ou contacter votre hébergeur.

**Dernière mise à jour:** Février 2026
**Version de référence:** Laravel 12, Filament 5.1
