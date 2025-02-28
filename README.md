# TouriStay 2030

TouriStay 2030 est une plateforme qui facilite la location de maisons et d’appartements pour les touristes venant assister aux événements du Mondial 2030 "Morocco-Spain-Portugal". Le projet se concentre sur l’authentification, la gestion des annonces et la recherche d’hébergements.

## Contexte du projet

L’objectif de ce projet est de poser les bases de la plateforme en se concentrant sur les aspects suivants :

- Authentification sécurisée des utilisateurs
- Gestion des annonces (création, mise à jour, suppression)
- Recherche d’hébergements avec des filtres avancés
- Interface utilisateur simple et responsive

## User Stories

### En tant qu'utilisateur :
- 🔑 Je veux m'inscrire sur la plateforme et m'authentifier en toute sécurité pour accéder à mon espace personnel.
- 👤 Je veux consulter mon profil et modifier mes informations personnelles.

### En tant que propriétaire :
- 🏡 Je veux publier une annonce avec les informations sur la localisation, le prix, les équipements et les disponibilités.
- 📂 Je veux modifier ou supprimer mes annonces pour garder mon offre à jour.

### En tant que touriste :
- 📌 Je veux explorer les offres d’hébergement avec pagination dynamique (4, 10, 25 annonces par page).
- 🔍 Je veux rechercher des hébergements en fonction de la ville et de la date de disponibilité.
- ⭐ Je veux pouvoir enregistrer des annonces en favoris pour les retrouver facilement.

### En tant qu'administrateur :
- 🗑️ Je veux pouvoir supprimer des annonces inappropriées ou frauduleuses.
- 📊 Je veux avoir une section de statistiques pour suivre le nombre d’inscriptions, de locations et d’annonces actives.

## Fonctionnalités Techniques

- ✅ **Authentification sécurisée** avec Laravel.
- ✅ **CRUD (Create, Read, Update, Delete)** pour les annonces.
- ✅ **Système de recherche avancée** avec filtres par ville et par date.
- ✅ **Gestion des profils utilisateurs**.
- ✅ **Interface simple et responsive**.

## Prérequis

Avant de démarrer, assurez-vous que vous avez installé les outils suivants :

- PHP 8.x ou supérieur
- Composer
- Laravel 8.x ou supérieur
- Base de données (MySQL, PostgreSQL, etc.)

## Installation

1. Clonez le repository :

   ```bash
   git clone https://github.com/votre-utilisateur/touristay-2030.git
