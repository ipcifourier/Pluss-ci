# 🔐 Scripts PHP Web - Guide Sécurité & Utilisation

> **ATTENTION:** Ces scripts permettent d'exécuter du code PHP sur votre serveur.
> À utiliser avec PRUDENCE et à SUPPRIMER après déploiement initial.

---

## 📝 Scripts Fournis

### 1. `public/deploy-init.php`

**Utilité:** Déploiement initial du projet (une seule fois)

**Actions:**
- Vérifier prérequis (PHP, fichiers, permissions)
- Générer APP_KEY
- Créer storage link
- Exécuter migrations
- Créer caches production

**Quand utiliser:** Première mise en ligne du projet

**Après utilisation:** ⚠️ **SUPPRIMER IMMÉDIATEMENT**

---

### 2. `public/maintenance.php`

**Utilité:** Maintenance continue sans SSH

**Actions disponibles:**
```
?action=health        → Vérifier santé application
?action=cache-clear   → Vider tous les caches
?action=cache-create  → Créer caches production
?action=logs          → Voir les 50 derniers logs
?action=storage-link  → Recréer lien storage
?action=migrate       → Exécuter nouvelles migrations
?action=php-info      → Infos serveur (diagnostique)
```

**Quand utiliser:** 
- Mise à jour code
- Nouveaux deployments
- Troubleshooting

**Après utilisation:** Optionnel à garder si maintenance régulière

---

## 🔒 Sécurité - Points Critiques

### ⚠️ Risque #1: Exécution de Code Arbitraire

**Problème:** Quelqu'un découvrant l'URL peut exécuter des commandes

**Mitigation:**
```
1. Utiliser une clé secrète FORTE
   - 32+ caractères aléatoires
   - Générer: openssl rand -hex 32

2. URL devient:
   https://votre-domaine.com/deploy-init.php?key=a1b2c3d4e5f6...
   
3. URL sans bonne clé = Access Denied (403)
```

### ⚠️ Risque #2: Divulgation d'Information

**Problème:** Les logs/erreurs peuvent révéler infos système

**Mitigation:**
```
1. APP_DEBUG=false en production
2. Vérifier qu'aucune info sensible en logs
3. Supprimer scripts après déploiement
```

### ⚠️ Risque #3: Déploiement Non-Autorisé

**Problème:** Quelqu'un pourrait modifier le code via deploy

**Mitigation:**
```
1. Garder deploy-init.php TEMPORAIRE SEULEMENT
2. Changer maintenance.php key régulièrement
3. Noter qui a accès à la clé
4. Limiter accès par IP si possible
```

---

## 🔑 Configurer les Clés de Sécurité

### Étape 1: Générer des Clés Aléatoires

```bash
# Sur votre machine locale:

# Pour deploy-init.php
DEPLOY_KEY=$(openssl rand -hex 32)
echo "Deploy key: $DEPLOY_KEY"

# Sortie exemple:
# Deploy key: 3k7j8m9n0p1q2r3s4t5u6v7w8x9y0z1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o

# Pour maintenance.php
MAINT_KEY=$(openssl rand -hex 32)
echo "Maintenance key: $MAINT_KEY"

# Garder ces clés quelque part de sûr (password manager, etc)
```

### Étape 2: Mettre dans les Scripts PHP

**Dans public/deploy-init.php - Ligne 16:**

```php
define('SECRET_KEY', 'VOTRE_DEPLOY_KEY_ICI');
```

**Dans public/maintenance.php - Ligne 11:**

```php
define('SECRET_KEY', 'VOTRE_MAINT_KEY_ICI');
```

### Étape 3: URLs Sécurisées

**Deploy (première fois):**

```
https://votre-domaine.com/deploy-init.php?key=3k7j8m9n0p1q2r3s4t5u6v7w8x9y0z1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o
```

**Maintenance (après):**

```
https://votre-domaine.com/maintenance.php?key=a1b2c3d4e5f6...&action=logs
```

---

## 📋 Procédures Recommandées

### Procédure: Déploiement Initial

```
1. Uploader deploy-init.php avec SECRET_KEY configurée

2. Accéder via navigateur:
   https://votre-domaine.com/deploy-init.php?key=YOUR_SECRET

3. Suivre les étapes affichées

4. À la fin:
   ⚠️ SUPPRIMER IMMÉDIATEMENT deploy-init.php via FTP
   - Risque sécurité sinon
   - Plus besoin après déploiement initial

5. Vérifier tout fonctionne:
   - Site accessible
   - /admin accessible
   - Logs OK
```

### Procédure: Mise à Jour Régulière

```
1. Garder maintenance.php (optionnel mais recommandé)

2. Upload code changé via FTP

3. Si migrations nécessaires:
   Accéder: maintenance.php?key=...&action=migrate

4. Rafraîchir caches:
   Accéder: maintenance.php?key=...&action=cache-create

5. Vérifier tout OK:
   Accéder: maintenance.php?key=...&action=health
```

### Procédure: Troubleshooting

```
1. Vérifier les logs:
   maintenance.php?key=...&action=logs

2. Chercher [ERROR] ou [EXCEPTION]

3. Lire l'erreur exacte

4. Googler l'erreur + "Laravel"

5. Appliquer la solution

6. Rafraîchir caches:
   maintenance.php?key=...&action=cache-clear
   maintenance.php?key=...&action=cache-create
```

---

## 🚫 À NE PAS FAIRE

```
❌ Ne pas laisser deploy-init.php après déploiement
❌ Ne pas utiliser une clé simple (123456, password, etc)
❌ Ne pas partager la clé en clair dans emails
❌ Ne pas mettre les scripts dans public si on a SSH
❌ Ne pas oublier de vérifier APP_DEBUG=false
```

---

## ✅ À FAIRE

```
✅ Utiliser clés aléatoires (32+ caractères)
✅ Stocker les clés de manière sécurisée
✅ Vérifier qu'accès HTTPS (pas HTTP)
✅ Supprimer deploy-init.php après utilisation
✅ Changer les clés périodiquement
✅ Limiter accès par IP si possible
✅ Monitorer l'usage via les logs
```

---

## 🔑 Gestion des Clés

### Stocker les Clés Sécurisément

```
Options (du plus au moins sûr):

1. Password Manager (BitWarden, 1Password, KeePass)
   → Accès chiffré
   → Partage sécurisé multi-users

2. Notes chiffrées (privées)
   → Jamais en emails
   → Jamais en chat non-chiffré

3. Tableau Google Drive/Notion (Accès contrôlé)
   → Partage seulement à l'équipe

❌ NE PAS:
- Laisser en clair dans code
- Envoyer par email
- Mettre en Git
- Partager en public
```

### Rotation des Clés

```
Recommandé chaque 3 mois:

1. Générer nouvelle clé
2. Updater dans le script sur serveur (via FTP)
3. Documenter changement
4. Notifier équipe

Code pour rotation:

# Vieille clé: 3k7j8m9n0p1q2r3s...
# Nouvelle: a1b2c3d4e5f6g7h8...

# Remplacer dans public/maintenance.php:
# define('SECRET_KEY', 'a1b2c3d4e5f6g7h8...');
```

---

## 🐛 Debugging Issues

### Issue: "Accès Refusé" (403)

```
Possible causes:
1. Clé incorrecte ou manquante
2. URL mal formée (pas de ?key=)
3. IP bloquée (si config IP restrict)

Solution:
- Vérifier la clé dans l'URL
- Vérifier elle correspond define('SECRET_KEY')
- Vérifier ?key= est dans l'URL
```

### Issue: Script s'exécute mais action ne fait rien

```
Possible causes:
1. exec() ou passthru() désactivé
   → Demander hébergeur les activer

2. proc_open() désactivé
   → Certaines fonctions critiques manquantes

3. Permissions insuffisantes
   → storage/ ou bootstrap/cache/ pas writable

Solution:
Regarder page /maintenance.php?action=php-info
Voir section "disabled_functions"
Si exec, passthru, shell_exec listés:
→ Contacter hébergeur
```

### Issue: "vendor/ not found"

```
Signifie: Composer pas encore exécuté

Solutions:
1. Via cPanel Composer (si disponible)
2. Demander hébergeur installer dépendances
3. Uploader composer.phar et créer run-composer.php
```

---

## 📊 Monitoring Script Usage

### Vérifier qui a utilisé les scripts

```
Chercher dans logs:
grep "deploy-init\|maintenance" storage/logs/laravel.log

Vérifier IP accédant:
- Logs Apache: /var/log/apache2/access_log
- Logs Nginx: /var/log/nginx/access.log
```

### Logs que devraient avoir le script

```
Les appels au script DEVRAIENT créer logs:
- Migrations exécutées
- Caches créés
- Commandes artisan lancées

Logs à surveiller:
[2026-02-28 10:30:45] production.INFO: cache:clear
[2026-02-28 10:30:46] production.INFO: route:cache
...
```

---

## 🎓 Quand Utiliser SSH à la Place

**Préférer SSH SI:**
- Vous avez accès SSH
- Déploiements fréquents (> 1x/jour)
- Besoin scripts automatisés
- Sécurité critique (production sensible)

**Raison:** SSH est plus sûr et contrôlé

**Solution:**
- Demander hébergeur activer SSH
- Passer à VPS/Dedicated server
- Considérer Forge ou Coolify pour auto-deploy

---

## 📞 Questions Sécurité?

```
Contacter hébergeur si besoin:
1. Activer SSH (remplace besoin de scripts)
2. Vérifier extensions PHP (exec, passthru)
3. Vérifier WAF/CSP n'interfère pas
4. Relatedexécution de commandes système
```

---

**Version:** 1.0 - Février 2026
**Risque Sécurité:** MOYEN (clés fortes = très bon)
**Alternative:** SSH merci pour solutions professionnelles
