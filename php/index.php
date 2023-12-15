<!-- Un form dans utilisateurs avec nom prenom age role (un select avec option formateur / apprenant) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="form.css">
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
        <li><a href="?page=connexion">Connexion</a></li>
    </ul>
</nav>
</header>



<div class="warning">
    <p>Vous devez être connecté pour avoir accès à cette partie du site.</p>
</div>


<!-- Login -->
<!-- <p class="titre">Identifiez vous</p>

<form method="post" class="form">
    <label for="identifiant">Identifiant :&nbsp;
        <input type="text" name="identifiant" placeholder="Identifiant" required>
    </label>
    <label for="motDePasse">Mot de passe :&nbsp;
    <input type="text" name="motDePasse" placeholder="Mot de passe" required>
    </label>

    <input type="submit" value="Se connecter">
</form> -->










<!-- Formulaire modifications de vos paramètres -->
<!-- <p class="titre">Modifications de vos paramètres</p>

<form class="form" method="post"> 
        <label for="prenom">Prénom :&nbsp;
            <input id="prenom" type="text" name="prenom" placeholder="Écrivez votre prénom" required>
        </label>
        <label for="nom">Nom :&nbsp;
            <input id="nom" type="text" name="nom" placeholder="Écrivez votre nom" required>
        </label>
        <label for="age">Âge :&nbsp;
            <input id="age" type="number" name="age" placeholder="Entrez votre âge" required>
        </label>
        <label for="role">Rôle :&nbsp;
            <select id="role" name="role">
                <option value="apprenant">Apprenant</option>
                <option value="formateur">Formateur</option>
            </select>
        </label>
        <input type="submit" value="Valider les informations">
    </form> -->
</body>
</html>