<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lancer le Compte à Rebours</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<h1>Escape Game - Lancer le compte à rebours</h1>
<form action="countdown.php" method="POST">
    <label for="time">Définir le temps (en minutes) :</label>
    <input type="number" id="time" name="time" required>
    <button type="submit">Lancer le compte à rebours</button>
</form>
<a href="countdown.php">Accéder au compte à rebours déjà lancé</a>
</body>
</html>
