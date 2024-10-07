<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si l'utilisateur soumet un temps pour le compte à rebours
    if (isset($_POST['time'])) {

        $time = intval($_POST['time']); // Convertir en entier pour plus de sécurité
        if ($time > 0) {
            // Calculer l'heure de fin du compte à rebours
            $end_time = time() + ($time * 60);
            file_put_contents('timer.txt', $end_time); // Crée ou met à jour le fichier avec l'heure de fin
            $message = "Le compte à rebours a démarré !";
        } else {
            $message = "Veuillez entrer un nombre de minutes valide.";
        }
    }

    // Si l'utilisateur soumet un code
    if (isset($_POST['code'])) {
        $typed_code = $_POST['code'];
        $correct_code = "LicorneDeFortnite"; // Définir le bon code pour l'escape game

        if ($typed_code == $correct_code) {
            file_put_contents('timer.txt', time()); // Réinitialiser le compte à rebours en mettant à jour le fichier
            header('Location: victory.php');
            exit();
        } else {
            $message = "Code incorrect. Essayez encore.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte à Rebours</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countdownInterval;  // Garde l'intervalle global

            // Fonction pour récupérer l'heure de fin via AJAX
            function fetchEndTime() {
                return fetch('get_timer.php')
                    .then(response => response.json())
                    .then(data => data.end_time * 1000);
            }

            // Script JavaScript pour mettre à jour le compte à rebours
            function startCountdown() {
                clearInterval(countdownInterval);  // Clear previous interval if any

                fetchEndTime().then(endTime => {
                    if (!endTime || endTime <= Date.now()) {
                        document.getElementById("countdown").innerHTML = "Temps écoulé!";
                        return;
                    }

                    countdownInterval = setInterval(function() {
                        let now = new Date().getTime();
                        let timeLeft = endTime - now;

                        if (timeLeft <= 0) {
                            clearInterval(countdownInterval);
                            document.getElementById("countdown").innerHTML = "Temps écoulé!";
                            return;
                        }

                        let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                        document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";

                    }, 1000);
                });
            }

            // Mettre à jour le compte à rebours toutes les 5 secondes pour synchronisation
            function updateCountdownPeriodically() {
                setInterval(() => {
                    fetchEndTime().then(endTime => {
                        let now = new Date().getTime();
                        if (endTime > now) {
                            startCountdown();  // Redémarre le compte à rebours avec la nouvelle durée
                        }
                    });
                }, 5000); // Toutes les 5 secondes
            }

            startCountdown();
            updateCountdownPeriodically();
        });


    </script>
</head>
<body>
<div style="background-color: #000000; padding: 10px; text-align: center;">
    ⚠️ Ne fermez pas la page pendant le compte à rebours sinon je fais tout sauter !
</div>
<!-- Afficher le message si défini -->
<?php if (!empty($message)) echo "<p>$message</p>"; ?>

<div id="countdown"></div>
<br>

<!-- Si le compte à rebours n'a pas encore commencé, afficher le formulaire de temps -->
<?php if (!file_exists('timer.txt') || file_get_contents('timer.txt') <= time()) : ?>
    <form action="countdown.php" method="POST">
        <label for="time">Définir le temps (en minutes) :</label>
        <input type="number" id="time" name="time" required>
        <button type="submit">Lancer le compte à rebours</button>
    </form>
<?php else : ?>
    <!-- Formulaire pour saisir le code si le compte à rebours est en cours -->
    <form action="countdown.php" method="POST">
        <label for="code">Saisissez le code :</label>
        <input type="text" id="code" name="code" required>
        <button type="submit">Valider</button>
    </form>
<?php endif; ?>

</body>
</html>
