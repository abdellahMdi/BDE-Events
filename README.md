# 🎟️ BDE-Events — La Billetterie du Campus ENAA

**BDE-Events** est la plateforme centralisée de gestion d'événements et de billetterie du campus ENAA. Elle offre au Bureau des Étudiants (BDE) un outil d'administration complet pour publier et piloter les événements, tout en permettant aux étudiants de réserver leur place en un clic, de simuler un paiement sécurisé et d'obtenir un billet numérique unique (Pass) directement sur leur profil.

---

## 🌟 Table des Matières
- [Fonctionnalités Principales](#-fonctionnalités-principales)
- [Technologies Utilisées](#-technologies-utilisées)
- [Prérequis](#-prérequis)
- [Installation & Configuration](#-installation--configuration)
- [Base de Données & Seeding](#-base-de-données--seeding)
- [Épics & User Stories](#-épics--user-stories)
- [Auteur](#-auteur)

---

## 🚀 Fonctionnalités Principales

### 👨‍💼 Espace BDE (Administration)
* **Création & Gestion d'Événements :** Publication complète d'événements (Titre, Description, Lieu, Date, Heure, Prix, Jauge maximale).
* **Mise à jour & Suppression :** Édition en temps réel des détails d'un événement via des routes sécurisées (`PUT`/`DELETE`).
* **Suivi des Capacités :** Tableau de bord affichant le nombre de places restantes en temps réel pour adapter la logistique.
* **Contrôle d'Accès Sécurisé :** Middleware d'administration filtrant strictement l'accès aux membres du BDE.

### 🎓 Espace Étudiant
* **Consultation du Catalogue :** Découverte des événements disponibles sur le campus.
* **Inscriptions en Un Clic :** Validation immédiate des réservations pour les événements gratuits sans passer par un tunnel de paiement.
* **Pass Numérique / Billet Unique :** Génération automatique d'un ticket avec une référence unique (`BDE-2026-XXXXX`).
* **Gestion des Réservations :** Espace *"Mes Billets"* permettant de consulter tous les billets actifs et leurs détails.

---

## 🛠️ Technologies Utilisées

* **Backend :** [Laravel 13](https://laravel.com/) (PHP 8.5)
* **Frontend :** Blade Templates, Tailwind CSS
* **Base de Données :** MySQL / MariaDB
* **Authentification & Autorisation :** Middleware Laravel Custom (`AdminMiddleware`, `auth`)
* **Gestion de Dates :** Carbon (Intégration Laravel)

---

## ⚙️ Prérequis

Avant de commencer, assurez-vous de disposer des éléments suivants :
* **PHP** `>= 8.2` (PHP 8.5 recommandé)
* **Composer**
* **MySQL** ou **MariaDB**
* **Node.js & NPM** (pour le build des assets)

---

## 📥 Installation & Configuration

### 1. Cloner le projet
```bash
git clone https://github.com/votre-compte/bde-events.git
cd bde-events
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Configurer l'environnement
Copiez le fichier `.env.example` pour créer votre fichier `.env` :
```bash
cp .env.example .env
```

Ouvrez `.env` et configurez votre base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bde_events
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Générer la clé d'application
```bash
php artisan key:generate
```

---

## 🗄️ Base de Données & Seeding

Exécutez les migrations pour créer la structure de la base de données, accompagnées des seeders pour générer les rôles et administrateurs par défaut :

```bash
php artisan migrate:fresh --seed
```

> **Note :** Le seeder initialise par défaut un compte Administrateur (BDE) et un compte Étudiant pour vos tests.

### Réinitialiser le Cache des Routes & Configuration
```bash
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

### 5. Lancer le serveur local
```bash
php artisan serve
```
La plateforme est accessible à l'adresse : `http://127.0.0.1:8000`

---

## 📋 Épics & User Stories

### 🔹 Épic 1 : Gestion des Événements (Dashboard Admin - BDE)
* **US 1.1 — Création d'un événement :** En tant qu'administrateur BDE, je peux créer un événement avec une jauge maximale supérieure à `0`. L'accès est strictly réservé au rôle `admin`.
* **US 1.2 — Suivi des capacités :** Visualisation en temps réel des places restantes par événement sur le tableau de bord d'administration.

### 🔹 Épic 2 : Réservation & Espace Étudiant
* **US 2.1 — Inscription en un clic :** Inscription instantanée à un événement gratuit. Le système empêche les doubles inscriptions et bloque la réservation si la jauge maximale est atteinte.

### 🔹 Épic 3 : Le Générateur de Tickets (Le Pass Étudiant)
* **US 3.1 — Ticket & Pass Numérique :** Génération d'un pass unique (format `BDE-2026-XXXXX`) accessible dans la section *"Mes Billets"*, regroupant les détails de l'événement et les informations de l'étudiant.

---

## 👤 Auteur

* **Créatrices/Créateurs du Projet :** Mahmoudi Abdellah
* **Projet :** Billetterie du Campus ENAA
* **Date de Création :** 14/07/2026
