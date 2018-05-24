


# NOA - Nos amis les oiseaux [![SensioLabsInsight](https://insight.sensiolabs.com/projects/94482459-0c36-4959-a3b4-b813277a5a4a/big.png)](https://insight.sensiolabs.com/projects/94482459-0c36-4959-a3b4-b813277a5a4a)
## OpenClassRooms Parcours Chef de Projet Multimedia :
### Projet N°5 - Création d'une application participative permettant l'observation des espèces d'oiseaux.  

## Description du projet:
Michel Dujardin est le fondateur de l’association NAO (Nos Amis les Oiseaux), regroupant les passionnés d’ornithologie. Il souhaite créer une application participative dans laquelle les particuliers pourraient indiquer où ils ont observé des oiseaux au cours de leurs promenades.

---

### Objectifs:

- Le principal objectif de l'application est de permettre l'ajout d'observations ornithologique depuis un smartphone, tablette ou ordinateur.
    - Les observations permetterons d'indiquer:
        1. Le type d'espèce
        2. La date d'observation
        3. Les coordonnées GPS de l'observation
        4. L'ajout d'une photo de l'observation (facultative)

- L'application devra permettre de rechercher les différentes espèces d'oiseaux et de la afficher sur une carte.

---

## Installation de l'application

1. Création la base de données "NAO":
    1. Se connecter à MySql "mysql -u login -p" (puis taper le password)
    2. Puis faire "Create database nao;"
    3. Sortir de MySql (exit)
2. Aller dans le dossier WWW
3. Copier les Sources dans le répertoire "nao" (à créer)
4. Ouvrir la console et se placer dans le dossier "nao"
5. Faire un Composer install
    1. l'adresse du serveur (127.0.0.1 par defaut)
    2. le nom de la base mettre "nao" (symfony par defaut)
    3. le login de la connexion à la base (root par defaut)
    4. le mot de passe de la base (null par défaut)
    5. puis les autres valeurs correspondantes à swiftmailer

---

## DEMO:

[Nos amis les oiseaux](https://yc-design.fr/nao/web/)

---

## Fonctionnalitées

### FRONT:

- Présentation de l'association:
    - Ses Actions
    - Son Projet de recherche
- Rechercher une espèce d'oiseau dans la base de données
- Afficher une espèce d'oiseau sur une carte après filtrage
- Ajouter des observations ornithologique sur le terrain
    - Les obsvervations seront validées:
        - Automatiquement pour les naturalistes (professionels)
        - Manuellement pour les particuliers (validation par des naturalistes)
- Un formulaire de contact permettera de communiquer avec l'association

### BACKOFFICE:

- Gestion des comptes utilisateurs
    - Validation d'un compte
    - Suppression d'un compte
    - Réinitialisation d'un mot de passe.
- Gestion des observations:
    - Validation d'une observation
    - Suppression d'une observation
        - Suppression de toutes les observations d'un compte 
    - Modification d'une observation
    

