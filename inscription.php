<?php
session_start();
include('MyConnection.php');

$errors = array();
$inscription_success = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['nom'])) {
        $errors['nom'] = "<span style='color: red;'>Saisir le nom</span> ";
    }

    if (empty($_POST['prenom'])) {
        $errors['prenom'] = "<span style='color: red;'>Saisir le prénom</span>";
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "<span style='color: red;'>Saisir l'email</span>";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "<span style='color: red;'>Saisir le mot de passe</span>";
    } elseif (strlen($_POST['password']) < 6) {
        $errors['password'] = "<span style='color: red;'>Minimum 6 caractères</span>";
    }

    if (empty($errors)) {
        if (!verify_user($_POST['email'], $conn)) {
            $insertQuery = "INSERT INTO utilisateur (nom, prenom, email, motPasse) VALUES (:name, :lastName, :email, :password)";
            $stmInsertUser = $conn->prepare($insertQuery);
            $stmInsertUser->bindParam(':name', $_POST['nom']);
            $stmInsertUser->bindParam(':lastName', $_POST['prenom']);
            $stmInsertUser->bindParam(':email', $_POST['email']);
            $stmInsertUser->bindParam(':password', $_POST['password']);
            $stmInsertUser->execute();
            $inscription_success = "Inscription réussie";

            $idUser = $_SESSION['id_user'];
        } else {
            echo "<span class='error'>Email existant</span> <br>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        .inscription-success {
            display: <?php echo !empty($inscription_success) ? 'block' : 'none'; ?>;
            padding: 20px;
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .close-btn {
            float: right;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form method="POST" action="inscription.php">
        <div class="container">
            <div id="connexion">
                <a href="./homepage.php"> <img src="./pictures//Farha__1_-removebg-preview.png"></a>
                <p class="paragraphe">Veuillez entrer vos détails personnels et Acheter votre Billet</p>
            </div>
            <div id="inscription">
                <h1 class="title">Créer un compte</h1>
                <p class="paragraphe">Veuillez remplir tous les champs</p>
                <div class="formulaire">
                    <div class="group-form">
                        <input type="text" placeholder="Nom" name="nom"><br>
                        <?php if (isset($errors['nom'])) {
                            echo "<span class='error'>" . $errors['nom'] . "</span>";
                        } ?>
                    </div>
                    <div class="group-form">
                        <input type="text" placeholder="Prénom" name="prenom"><br>
                        <?php if (isset($errors['prenom'])) {
                            echo "<span class='error'>" . $errors['prenom'] . "</span>";
                        } ?>
                    </div>
                    <div class="group-form">
                        <input type="email" placeholder="Email" name="email"><br>
                        <?php if (isset($errors['email'])) {
                            echo "<span class='error'>" . $errors['email'] . "</span>";
                        } ?>
                    </div>
                    <div class="group-form">
                        <input type="password" placeholder="Mot de passe" name="password"><br>
                        <?php if (isset($errors['password'])) {
                            echo "<span class='error'>" . $errors['password'] . "</span>";
                        } ?>
                    </div>
                    <div class="group-form">
                        <input type="submit" class="inscription" value="S'inscrire" name="submit"><br>
                    </div>
                    <p class="signin">Already have an account? <a href="./connecter.php">Se Connecter</a></p>
                </div>
                <!-- Display Inscription Success Message -->
                <div class="inscription-success" id="inscriptionSuccess">
                    <?php echo $inscription_success; ?>
                    <span class="close-btn" onclick="hideMessage()">X</span>
                </div>
            </div>
        </div>
    </form>

    <script>
        function hideMessage() {
            document.getElementById("inscriptionSuccess").style.display = "none";
        }
    </script>
</body>

</html>
