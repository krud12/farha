<?php
include 'MyConnection.php'; // Include the file that contains the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $idUser = $_POST["idUser"];
    $newName = $_POST["newName"];
    $newPrenom = $_POST["newPrenom"];
    $newMot_de_passe = $_POST["newMot_de_passe"];

    // Update user's information in the database
    $stmUpdateUser = $pdo->prepare("UPDATE utilisateur SET nom = :newName, prenom = :newPrenom, motPasse = :newMot_de_passe WHERE idUtilisateur = :idUser");
    $stmUpdateUser->bindParam(':newName', $newName);
    $stmUpdateUser->bindParam(':newPrenom', $newPrenom);
    $stmUpdateUser->bindParam(':newMot_de_passe', $newMot_de_passe);
    $stmUpdateUser->bindParam(':idUser', $idUser);
    $stmUpdateUser->execute();

    // Redirect back to the profile page after updating
    header("Location: profile.php");
    exit();
}
?>
