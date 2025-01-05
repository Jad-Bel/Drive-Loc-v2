# 🚗 Système de Gestion de Location de Voitures - Drive & Loc

---

## 📜 **Contexte du Projet**

L'agence **Drive & Loc** souhaite enrichir son site web en intégrant un système de gestion de location de voitures.  
L'objectif est de développer une plateforme créative et fonctionnelle permettant :

- Aux clients de parcourir et réserver des véhicules adaptés à leurs besoins.
- À l'administration de gérer efficacement les données liées aux réservations, véhicules, et évaluations.

Ce projet est développé en **PHP POO** et **SQL** pour une architecture robuste et évolutive.

---

## 🎯 **Objectifs**

- **Version I :** Système de location de voitures.  
- **Version II :** Blog interactif pour les passionnés d'automobiles.

---

## 🚀 **Fonctionnalités (User Stories)**

### **User Stories - Version I : Location de Voitures**

1. **Authentification :**  
   - 🚗 En tant que client ou admin, je dois me connecter pour accéder à la plateforme de location.

2. **Exploration des véhicules :**  
   - 🏍️ Je peux explorer les différentes catégories de véhicules disponibles.  
   - 🚗 Je peux cliquer sur un véhicule pour afficher ses détails (modèle, prix, disponibilité, etc.).

3. **Réservation :**  
   - 🛣️ Je peux réserver un véhicule en précisant les dates et lieux de prise en charge.

4. **Recherche & Filtrage :**  
   - 🔎 Je peux rechercher un véhicule spécifique par son modèle ou ses caractéristiques.  
   - 🏍️ Je peux filtrer les véhicules disponibles par catégorie sans rafraîchir la page.

5. **Pagination :**  
   - 🏦 Je peux lister les véhicules disponibles par pages :  
     - **Version 🚙 :** Pagination simple avec PHP.  

6. **Administration :**  
   - 🏦 L'administrateur peut :  
     - Ajouter et modifier des véhicules.  
     - Gérer les réservations, véhicules, utilisateur avec des statistiques (Dashboard Admin).

---

### **User Stories - Version II : Blog Interactif**

1. **Exploration des thèmes :**  
   - 🛣️ Je peux explorer les différents thèmes du blog.  
   - 🚗 Je peux afficher les articles associés à un thème spécifique.

2. **Ajout et gestion d'articles :**  
   - ✍️ Je peux ajouter des articles avec un titre, un contenu, des tags, et des médias optionnels (images/vidéos).  
   - 🏷️ Je peux rechercher un article spécifique ou filtrer par tags.  
   - ❤️ Je peux ajouter un article à mes favoris.

3. **Commentaires :**  
   - 💬 Je peux consulter les commentaires sur un article.  
   - 💬 Je peux ajouter, modifier ou supprimer mes propres commentaires.

4. **Pagination des articles :**  
   - 📑 Je peux afficher les articles par lots (5, 10, ou 15) avec une pagination simple.

5. **Administration :**  
   - 🛠️ L'administrateur peut :  
     - Gérer les thèmes, articles, tags, et commentaires depuis un tableau de bord.  
     - Approuver les articles soumis par les clients avant publication.

---

## 📂 **Structure du Projet**

- **Back-end :**  
  - Développé avec **PHP POO** et **SQL** pour les opérations CRUD et la gestion des données.

- **Base de données :**  
  - Conception relationnelle avec tables pour les clients, véhicules, réservations, avis, articles, tags, etc.

- **Front-end :**  
  - Conçu pour une expérience utilisateur intuitive (HTML, CSS, JS).  
  - Intégration de AJAX pour une pagination dynamique.

- **Administration :**  
  - Tableau de bord pour gérer les réservations, véhicules, articles, et statistiques.

---

## 📌 **Prérequis**

1. **Serveur web :** Apache.  
2. **PHP :** Version 8.  
3. **Base de données :** MySQL.  
4. **Extensions nécessaires :** PDO, cURL, etc.

---

## 🚧 **Instructions pour l'installation**

1. Clonez ce dépôt sur votre machine locale :  
   ```bash
   git clone https://github.com/username/drive-and-loc.git
