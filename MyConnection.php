<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farha";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO attributes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display an error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}

function verify_user($email, $pdo)
{
    $stmCheckUser = $pdo->prepare("SELECT * FROM utilisateur WHERE email=:email");
    $stmCheckUser->bindParam(':email', $email);
    $stmCheckUser->execute();
    $data = $stmCheckUser->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) > 0) {
        return true;
    } else {
        return false;
    }
}

function login_user($email, $pw, $pdo)
{
    $stmLoginUser = $pdo->prepare("SELECT * FROM utilisateur WHERE email=:email AND motPasse=:pw");
    $stmLoginUser->bindParam(':email', $email);
    $stmLoginUser->bindParam(':pw', $pw);
    $stmLoginUser->execute();
    $data = $stmLoginUser->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($data)) {
        return $data[0]['idUtilisateur'];
    } else {
        return null;
    }
}



function detailsUser($idUser, $pdo)
{
    $stmDetailsUser = $pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUser ");
    $stmDetailsUser->bindParam(':idUser', $idUser);
    $stmDetailsUser->execute();
    $data = $stmDetailsUser->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="card mx-auto mt-5" style="max-width: 600px;">
        <div class="card-body ">
            <h5 class="card-title text-center">Your Profile</h5>
            <p class="card-text">Nom: <?php echo $data['nom']; ?></p>
            <p class="card-text">Prenom: <?php echo $data['prenom']; ?></p>
            <p class="card-text">Email: <?php echo $data['email']; ?></p>
        </div>
    </div>
    <br>
    <div class="card mx-auto mt-5" style="max-width: 600px;">
        <div class="card-body">
            <form id="editForm" action="updateProfile.php" method="post" style="display: none;">
            <input type="hidden" name="save" value="true"> <!-- Add this line -->
    <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
                <h5 class="card-title">Modification Profile</h5>
                <div class="mb-3">
                    <label for="newName" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $data['nom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="newPrenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="newPrenom" name="newPrenom" value="<?php echo $data['prenom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="newMot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="newMot_de_passe" name="newMot_de_passe" value="<?php echo $data['motPasse']; ?>">
                </div>
                <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
            </form>
            <button id="editButton" class="btn btn-secondary">Edit Profile</button>
        </div>
    </div>
    <?php
}
?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('editButton').addEventListener('click', function() {
            console.log("Button clicked");
            document.getElementById('editForm').style.display = 'block';
        });
    });
</script>

</body>
</html>