<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form method="post" action="connecter.php">
        <div class="container">
            <div id="connexion">
                <a href="./homepage.php">
                    <img src="./pictures//Farha__1_-removebg-preview.png">
                </a>
                <p class="paragraphe">
                    Veuillez entrer vos d'étails personnel et Acheter votre Billet
                </p>
            </div>
            <div id="inscription">
                <h1 class="title">Connecter</h1>
                <p class="paragraphe">
                    Veuillez remplir tous les champs
                </p>
                <div class="formulaire">
                    <div class="group-form">
                        <input type="text" placeholder="Email" name="email">
                    </div>
                    <div class="group-form">
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <div class="group-form">
                        <input type="submit" class="inscription" value="Se connecter" name="send">
                    </div>
                    <?php
                    session_start();
                    include "MyConnection.php";
                    if (isset($_POST['send'])) {
                        if (!empty($_POST['email']) && !empty($_POST['password'])) {
                            $idus = login_user($_POST['email'], $_POST['password'], $conn);
                            if ($idus != NULL) {
                                $_SESSION['id_user'] = $idus;
                                $_SESSION['loggedin'] = true; // Set the loggedin session variable to true
                                header('location:profile.php');
                            } else {
                                echo "<p class='error'>Email ou mot de passe incorrect</p>";
                            }
                        } else {
                            echo "<p class='error'>Veuillez remplir tous les champs</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
