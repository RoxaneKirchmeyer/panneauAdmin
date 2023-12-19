<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Panneau d'administration</title>
</head>
<body>

    <header>
    <p class="admin">Panneau d'administration</p>
    <nav>
        <ul>
            <li><a href="?page=accueil">Accueil</a></li>
            <li><a href="?page=utilisateurs">Utilisateurs</a></li>
            <li><a href="?page=parametres">Paramètres</a></li>
            <?php
            $userConnected = isset($_SESSION['user']);
              if ($userConnected) {
                // On affiche un onglet information personnel, un onglet paramètres et un onglet de déconnexion
                echo '<li><a href="?page=deconnexion">Déconnexion</a></li>';
            }

            // Sinon on affiche un onglet de connexion
            else {
                echo '<li><a href="?page=connexion">Connexion</a></li>';
            }
            ?>
        </ul>
    </nav>
    </header>

<?php

if (!$userConnected) {
    if (isset($_GET['page']) && ($_GET['page'] === "utilisateurs" || $_GET['page'] === "parametres")) {
        echo "<p class='attention'>Vous devez être connecté.e pour accéder à cette page.</p>";
    }
}
?>

<?php
    if (isset($_GET['page']) && $_GET['page'] === "connexion") {
    // Initialise le message d'erreur
    $message = '';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Données d'identification correctes
    $identifiant_correct = 'roxane';
    $motDePasse_correct = '1234';
    
    // Vérifie si les identifiants soumis correspondent aux données correctes
    if (
        isset($_POST['identifiant']) && isset($_POST['motDePasse']) &&
        $_POST['identifiant'] === $identifiant_correct &&
        $_POST['motDePasse'] === $motDePasse_correct
    ) {
        // Affiche un message de validation si les identifiants sont corrects
        $message = "<p class='valide'>Vous êtes maintenant connecté.e.</p>";

        $_SESSION['user'] = $_POST['identifiant'];

    } else {
        // Stocke le message d'erreur
        $message = "<p class='erreur'>Mot de passe ou identifiant incorrect.</p>";
    }
}

// Affiche toujours le formulaire pour se connecter si la page est "accueil"
echo "<div class='container'>
        <p class='titre'>Identifiez vous</p>
        <form method='post' class='form'>
            <label for='identifiant'>Identifiant :&nbsp;
                <input type='text' name='identifiant' placeholder='Identifiant' required>
            </label>
            <label for='motDePasse'>Mot de passe :&nbsp;
                <input type='password' name='motDePasse' placeholder='Mot de passe' required>
            </label>
            <input type='submit' name='submit' value='Se connecter'>
        </form>
        $message
      </div>";
}
?>
    
<!-- Login -->
<?php
if (isset($_GET['page']) && $_GET['page'] === "accueil") {
    // Initialise le message d'erreur
    $message = '';

    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Données d'identification correctes
        $identifiant_correct = 'roxane';
        $motDePasse_correct = '1234';
        
        // Vérifie si les identifiants soumis correspondent aux données correctes
        if (
            isset($_POST['identifiant']) && isset($_POST['motDePasse']) &&
            $_POST['identifiant'] === $identifiant_correct &&
            $_POST['motDePasse'] === $motDePasse_correct
        ) {
            // Affiche un message de validation si les identifiants sont corrects
            $message = "<p class='valide'>Vous êtes maintenant connecté.e.</p>";

            // Démarre la session après la connexion réussie
            $_SESSION['user'] = $_POST['identifiant'];

        } else {
            // Stocke le message d'erreur
            $message = "<p class='erreur'>Mot de passe ou identifiant incorrect.</p>";
        }
    }

    // Affiche toujours le formulaire pour se connecter si la page est "accueil"
    echo "<div class='container'>
            <p class='titre'>Identifiez vous</p>
            <form method='post' class='form'>
                <label for='identifiant'>Identifiant :&nbsp;
                    <input type='text' name='identifiant' placeholder='Identifiant' required>
                </label>
                <label for='motDePasse'>Mot de passe :&nbsp;
                    <input type='password' name='motDePasse' placeholder='Mot de passe' required>
                </label>
                <input type='submit' name='submit' value='Se connecter'>
            </form>
            $message
          </div>";
}
?>

<?php
if (isset($_GET['page']) && $_GET['page'] === "utilisateurs") {
    echo "<section>
            <p class='titre'>Vos informations utilisateurs</p>";

    // Vérifie si les informations sont disponibles dans la session
    if (isset($_SESSION['prenom'], $_SESSION['nom'], $_SESSION['age'], $_SESSION['role'])) {
        // Affichage des informations récupérées depuis la page "Paramètres"
        echo "<p>Prénom : " . $_SESSION['prenom'] . "</p>";
        echo "<p>Nom : " . $_SESSION['nom'] . "</p>";
        echo "<p>Âge : " . $_SESSION['age'] . "</p>";
        echo "<p>Rôle : " . $_SESSION['role'] . "</p>";
    } else {
        echo "<p>Les informations ne sont pas disponibles.</p>";
    }
    echo "</section>";
}
?>

<?php
$modifMessage = ''; // Initialisez la variable $modifMessage

if (isset($_GET['page']) && $_GET['page'] === "parametres") {
    if (!isset($_SESSION['user'])) {
        echo "<p class='titre'>Les informations ne sont pas disponibles.</p>";
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Stocke les informations modifiées dans la session
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['role'] = $_POST['role'];

            // Définissez le message de modification après la soumission du formulaire
            $modifMessage = "<p class='maj'>Les données utilisateurs ont bien été mises à jour.</p>";
        }

        echo "<p class='titre'>Modifications de vos paramètres</p>
        <form class='form' method='post'> 
            <label for='prenom'>Prénom :&nbsp;
                <input id='prenom' type='text' name='prenom' placeholder='Écrivez votre prénom' value='' required>
            </label>
            <label for='nom'>Nom :&nbsp;
                <input id='nom' type='text' name='nom' placeholder='Écrivez votre nom' value='' required>
            </label>
            <label for='age'>Âge :&nbsp;
                <input id='age' type='number' name='age' placeholder='Entrez votre âge' value='' required>
            </label>
            <label for='role'>Rôle :&nbsp;
                <select id='role' name='role'>
                    <option value='apprenant.e'>Apprenant.e</option>
                    <option value='formateur.trice'>Formateur.trice</option>
                </select>
            </label>
            <input type='submit' value='Valider les informations'>
        </form>";

        echo $modifMessage;
}
}
?>

<?php
if (isset($_GET['page']) && $_GET['page'] === "deconnexion") {
    session_destroy();
    echo "<p class='deco'>Vous êtes maintenant déconnecté.e.</p>";
}
?>
</body>
</html>