<?php session_start(); ?>


<!-- Accueil et connexion pointe sur la page "identifiez vous" -->
<!-- Utilisateurs et parametres si on est connecté affiche le contenu des pages 
sinon la popup vous devez etre connecté apparait-->
<!-- Quand on est connecté, on appuie sur accueil et on a bienvenue prénom nom -->
<!-- Dans infos utilisateurs on a le nom prénom age et role -->
<!-- Dans paramètres, on vérifie que les input sont pas vides, on valide, on a la popup verte donnée maj -->
<!-- Quand on clic sur déco, la popup deco apparait et on est deco -->

<!DOCTYPE html>
<html lang="fr">
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
                echo '<li><a href="?page=deconnexion">Déconnexion</a></li>';
            }
            else {
                echo '<li><a href="?page=connexion">Connexion</a></li>';
            }
            ?>
        </ul>
    </nav>
    </header>

<?php
// Si l'utilisateur n'est pas connecté, affiche message warning sur pages user et parametres
if (!$userConnected) {
    if (isset($_GET['page']) && ($_GET['page'] === "utilisateurs" || $_GET['page'] === "parametres")) {
        echo "<p class='attention'>Vous devez être connecté.e pour accéder à cette page.</p>";
    }
}
?>

<?php
    if (isset($_GET['page']) && $_GET['page'] === "connexion") {
    $message = '';

    $identifiant_correct = 'roxane';
    $motDePasse_correct = '1234';
    
    if (isset($_POST['identifiant']) && isset($_POST['motDePasse'])) {
        if ($_POST['identifiant'] === $identifiant_correct && $_POST['motDePasse'] === $motDePasse_correct) {
            $message = "<p class='valide'>Vous êtes maintenant connecté.e.</p>";
            $_SESSION['user'] = $_POST['identifiant'];
    } else {
        $message = "<p class='erreur'>Mot de passe ou identifiant incorrect.</p>";
    }
}

echo "<div>
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
        if (isset($_SESSION['user'])) {
            $prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
            $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
        
            // Afficher le message de bienvenue avec le prénom et le nom
            echo "Bienvenue, " . $_SESSION['nom'] . " " . $_SESSION['prenom'];
        }
        $message = '';

        if (isset($_POST['identifiant']) && isset($_POST['motDePasse'])) {
            $identifiant_correct = 'roxane';
            $motDePasse_correct = '1234';

            if ($_POST['identifiant'] === $identifiant_correct && $_POST['motDePasse'] === $motDePasse_correct) {
                $message = "<p class='valide'>Vous êtes maintenant connecté.e.</p>";
                $_SESSION['user'] = $_POST['identifiant'];
            } else {
                $message = "<p class='erreur'>Mot de passe ou identifiant incorrect.</p>";
            }
        }
        echo "<div>
                <p class='titre'>Identifiez-vous</p>
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
    if (isset($_SESSION['user'])) {
        $prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
        $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
    
        // Afficher le message de bienvenue avec le prénom et le nom
        echo "Bienvenue, " . $_SESSION['nom'] . " " . $_SESSION['prenom'];
    }
    echo "<section>
            <p class='titre'>Vos informations utilisateurs</p>";

    if (isset($_SESSION['prenom'], $_SESSION['nom'], $_SESSION['age'], $_SESSION['role'])) {
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
$modifMessage = '';

if (isset($_GET['page']) && $_GET['page'] === "parametres") {
    if (isset($_SESSION['user'])) {
        $prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
        $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
    
        // Afficher le message de bienvenue avec le prénom et le nom
        echo "Bienvenue, " . $_SESSION['nom'] . " " . $_SESSION['prenom'];
    }
    if (!isset($_SESSION['user'])) {
        echo "<p class='titre'>Les informations ne sont pas disponibles.</p>";
    } else {
        if (isset($_POST['prenom']) && isset($_POST['nom']) &&
            isset($_POST['age']) && isset($_POST['role'])
        ) {
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['role'] = $_POST['role'];
            $modifMessage = "<p class='maj'>Les données utilisateurs ont bien été mises à jour.</p>";
        }

        echo "<p class='titre'>Modifications de vos paramètres</p>
        <form class='form' method='post'> 
            <label for='prenom'>Prénom :&nbsp;
                <input id='prenom' type='text' name='prenom' placeholder='Écrivez votre prénom' value='Roxane' required>
            </label>
            <label for='nom'>Nom :&nbsp;
                <input id='nom' type='text' name='nom' placeholder='Écrivez votre nom' value='Kirchmeyer' required>
            </label>
            <label for='age'>Âge :&nbsp;
                <input id='age' type='number' name='age' placeholder='Entrez votre âge' value='26' required>
            </label>
            <label for='role'>Rôle :&nbsp;
                <select id='role' name='role'>
                    <option value='Apprenant.e'>Apprenant.e</option>
                    <option value='Formateur.trice'>Formateur.trice</option>
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