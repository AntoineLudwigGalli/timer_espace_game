# Escape Game - Compte à Rebours

## Description
Cette application est un mini escape game avec un compte à rebours. Les joueurs doivent entrer un code correct avant la fin du temps imparti pour gagner. Si le code est correct, le compte à rebours s'arrête et la page de victoire s'affiche.

## Fonctionnalités
- Lancer un compte à rebours avec une durée définie en minutes.
- Affichage dynamique du temps restant avec mise à jour automatique.
- Validation d'un code secret pour arrêter le compte à rebours.
- Redirection vers une page de victoire si le code est correct.

## Installation
1. Cloner ce dépôt ou télécharger les fichiers.
2. Placer les fichiers sur un serveur web supportant PHP.
3. Assurez-vous que le serveur peut écrire dans le fichier `timer.txt`.

## Utilisation
1. Ouvrir `index.html` ou accéder à `countdown.php`.
2. Définir une durée pour le compte à rebours et le démarrer.
3. Entrer le code secret pour arrêter le compte à rebours.
4. Si le code est correct, vous serez redirigé vers `victory.php`.

## Configuration
- Le code secret par défaut est : `LicorneDeFortnite`.
- Vous pouvez modifier ce code dans `countdown.php`.

## Technologies utilisées
- PHP (backend pour la gestion du compte à rebours et de la validation du code)
- JavaScript (mise à jour dynamique du compte à rebours)
- HTML/CSS (interface utilisateur)

## Auteurs
Développé par Antoine Ludwig - Lab'Aux Le Tiers Lieu de l'Auxois

## Licence
Ce projet est sous licence MIT. Vous pouvez l'utiliser et le modifier librement.

