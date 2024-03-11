<?php
session_start();
//MODAL
function modal(){
    $_SESSION['modal'] = true;
    echo 'silduhufsodjvmdjfwxmio';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e3a6c966c2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Great+Vibes&family=Irish+Grover&family=Kolker+Brush&family=Rowdies:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">

    <title>Brief13</title>
    <style>
        .offcanvas-header,
        .offcanvas-body {
            background: linear-gradient(90deg, rgba(0, 36, 28, 1) 28%, rgba(64, 169, 191, 1) 100%) !important;
        }

        .nav-hover:hover {
            color: #f8f9fa;
            /* Change text color on hover */
            background-color: rgba(255, 255, 255, 0.1);
            /* Change background color on hover */
            border-radius: 5px;
            /* Add border-radius on hover for rounded corners */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Add smooth transition effect */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%) ">
            <div class="container">
                <img src="./pictures//Farha__1_-removebg-preview.png" style="width: 190px; height: 50px; margin-right: 10px;" class="navbar-brand">
                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header text-black border-bottom">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="./pictures//Farha__1_-removebg-preview.png" style="width: 120px; height: auto; margin-right: 10px;" class="navbar-brand"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item mx-2">
                                <a href="./homepage.php" class="nav-link nav-hover" style="color: white;">Home</a>
                            </li>
                            <li class="nav-item mx-2">
                                <form class="d-flex" method="post" action="./homepage.php">
                                    <input class="form-control me-2" style="border-radius: 15px;height: 27px;margin-top:8px" type="search" name="inputSearch" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline" type="submit" name="searchTitle"><i class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
                                </form>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link nav-hover" href="#footer" style="color: white;">Contact</a>
                            </li>
                            <?php

                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                // If user is logged in, display "Your Account" link
                                echo "<li class='nav-item mx-2'>";
                                echo "<a class='nav-link nav-hover' href='./profile.php' style='color: white;'>Your Account</a>";
                                echo "</li>";
                            } else {
                                // If user is not logged in, display "Profile" link
                                echo "<li class='nav-item mx-2'>";
                                echo "<a class='nav-link nav-hover' href='./inscription.php' style='color: white;'>Profile</a>";
                                echo "</li>";
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                // If user is logged in, display "Logout" link
                                echo "<li class='nav-item mx-2'>";
                                echo "<a class='nav-link nav-hover' href='./logout.php' style='color: white;'>Logout</a>";
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
        require_once('MyConnection.php');

        if (isset($_GET['ID'])) {
            $ID = $_GET['ID'];

            try {
                // Prepare and execute the first query
                $picRequete = $conn->prepare("SELECT evenement.*, version.*, salle.descriptionSalle 
            FROM evenement 
            INNER JOIN version ON evenement.idEvenement = version.idEvenement 
            INNER JOIN salle ON version.NumSalle = salle.NumSalle
            WHERE version.numVersion = :ID");

                // Bind parameter and execute the query
                $picRequete->bindParam(':ID', $ID);
                $picRequete->execute();

                // Fetch the result of the first query
                $eventDetails = $picRequete->fetch(PDO::FETCH_ASSOC);

                // Prepare and execute the second query
                $picRequete2 = $conn->prepare("SELECT * FROM evenement 
            INNER JOIN version ON evenement.idEvenement = version.idEvenement 
            WHERE evenement.categorie = :categorie");

                // Bind parameter and execute the query
                $picRequete2->bindParam(':categorie', $eventDetails['categorie']);
                $picRequete2->execute();

                // Fetch the result of the second query
                $eventDetails2 = $picRequete2->fetch(PDO::FETCH_ASSOC);

                // Chemin vers le dossier des images
                $path = "pictures";

                // Affichage des détails de l'événement
                echo "<h2 style='text-align: center; margin-top:30px; margin-bottom:30px'>{$eventDetails['titre']}</h2>";

                echo '<div class="row justify-content-center">';

                echo ' <div class="col-sm-6">';
                echo "<img src='{$path}/{$eventDetails['imageEvenement']}' alt='Event Image' class='img-fluid' style='margin-left:20px'>";

                echo "<p style='color:white; text-align: center;'>Description: <br>{$eventDetails['description']}</p>";
                echo "</div>";

                echo ' <div class="col-sm-6">';
                echo "<div class='card' style='width: 80%; margin-left: 20px;'>";



                echo '<div class="card-body">';

                // Formatage de la date et de l'heure
                $datetime = $eventDetails["dateEvenement"];
                $formatted_date = date("M d, Y", strtotime($datetime));
                $formatted_time = date("h:i A", strtotime($datetime));
                $calendar_icon = '<i class="fa-regular fa-calendar-days"></i>';
                $clock_icon = '<i class="fa-regular fa-clock"></i>';

                // Affichage de la date et de l'heure
                echo "<h5 class='card-categorie' style='text-align: center;'>Catégorie: {$eventDetails['categorie']}</h5>";

                echo "<p class='card-date' style='text-align: center;'>{$calendar_icon} {$formatted_date} {$clock_icon} {$formatted_time}</p>";

                echo "<h6 style='text-align: center; color: red;'>{$eventDetails['descriptionSalle']}</h6>";

                echo "<form method='post' action=''>";
                echo "<div class='d-flex justify-content-around'>";
                echo "<div><strong> Tarif Normal: " . $eventDetails['tarifnormal'] . " MAD </strong></div>";
                echo "<input type='number' name='QuantitéTarifNormal' style='border-radius: 10px; border-style: none; background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%);color:white'>";
                echo "</div>";
                echo "<br>";
                echo "<div class='d-flex justify-content-around'>";
                echo "<div><strong> Tarif Réduit: " . $eventDetails['tarifReduit'] . " MAD </strong></div> ";
                echo "<input type='number' name='QuantitéTarifReduit' style='border-radius: 10px; border-style: none; background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%);color:white'>";
                echo "</div>";
                echo "<br>";

                // Current date and time
                $currentDate = date("Y-m-d H:i:s");

                // Calculate the difference in seconds
                $diff = strtotime($datetime) - strtotime($currentDate);

                // Calculate the remaining days, hours, minutes, and seconds
                $days = floor($diff / (60 * 60 * 24));
                $hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
                $minutes = floor(($diff % (60 * 60)) / 60);
                $seconds = $diff % 60;
                echo '<div id="countdown">';
                echo '<div class="countdown-item">
                 <div class="countdown-circle"><span id="days">' . $days . '</span></div>
                   <p>Jours</p>
                </div>
                <div class="countdown-item">
                 <div class="countdown-circle"><span id="hours">' . $hours . '</span></div>
                  <p>Heure</p>
                </div>
               <div class="countdown-item">
               <div class="countdown-circle" ><span id="minutes">' . $minutes . '</span></div>
                <p>Minute</p>
              </div>
              <div class="countdown-item">
               <div class="countdown-circle"> <span id="seconds" >' . $seconds . '</span></div>
                 <p>Second</p>
              </div>';
             echo "</div>";

                echo "<div style='text-align: center;'>";
                if (isset($_SESSION['id_user'])) {
                    echo "<button type='submit' name='acheter' class='btn btn-primary' style='background-color: #00241c; border-radius: 15px; border-style: none' onclick='modal()'>Acheter Maintenant</button>";
                } else {
                    echo"<p>Il faut d'abord <a href='inscription.php' ' style='color: #40a9bf';>s'inscrire</a></p>";
                 }
                 echo "</form>";
                echo "<p style='color: #40a9bf;'> Vite!! Achetez votre tickets rapidement </p>";
                echo "<h6> Partagez cet evenement</h6>";
                echo "<div class='social-icons mt-4'>
        <a href='https://www.facebook.com/'><i class='fab fa-facebook-f' style='color: #40a9bf;'></i></a>
        <a href='https://twitter.com/i/flow/login'><i class='fab fa-twitter' style='color: #40a9bf;'></i></a>
        <a href='https://www.instagram.com/'><i class='fab fa-instagram' style='color: #40a9bf;'></i></a>
    </div>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                

                echo "<h3 style='margin-left:30px' > Description: </h3>";
                echo "<br>";
                echo "<p style='margin-left:30px'>{$eventDetails['description']}</p>";

                echo "<h3 style='text-align: center;margin-top:90px'>Autre Evenement</h3>";
                echo "<p style='text-align: center;'> de meme catégorie</p>";

                echo "<div class='card' style='width: 18rem; margin: 10px; '>";
                echo "<div style=' width:100%;height:30vh; overflow: hidden'>";
                echo "<img src='{$path}/{$eventDetails2['imageEvenement']}' class='card-img-top' alt='... ' style='max-width: 100%;max-height: 100%;height:auto'>";
                echo "</div>";
                echo "<div  >";
                echo "<div class='card-body'>";
                echo "<div class='category' style='text-align: center; background-color:#83C0C1;color:white; width:100%'> <h5 class='card-categorie'>{$eventDetails2['categorie']}</h5></div>";

                echo "<h3 class='card-title'>{$eventDetails2['titre']}</h3>";


                $datetime = $eventDetails2["dateEvenement"];
                $formatted_date = date("M d, Y", strtotime($datetime));
                $formatted_time = date("h:i A", strtotime($datetime));
                $calendar_icon = '<i class="fa-regular fa-calendar-days"></i>';
                $clock_icon = '<i class="fa-regular fa-clock"></i>';
                echo '<p class="card-date" ;">' . $calendar_icon . ' ' . $formatted_date . ' ' . $clock_icon . ' ' . $formatted_time . '</p>';

                echo "<div class='d-flex justify-content-around' style='width:100%;'>";
                echo "<div style='color: #40a9bf '><strong> Price: " . $eventDetails2['tarifnormal'] . " MAD </strong></div>";

                
            echo "<a href='details.php?ID={$eventDetails['numVersion']}' class='btn btn-primary' style=' background-color: #00241c;' >Acheter</a>";

                echo "</div>";
                echo "</div>";
                echo "</div>";

                echo "</div>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>


<?php
// if(isset($_POST['acheter'])){
//     $QuantitéTarifNormal= $_POST['QuantitéTarifNormal'];
//     $QuantitéTarifReduit= $_POST['QuantitéTarifReduit'];
//     $picRequete = $conn->prepare("SELECT * FROM evenement  WHERE  tarifnormal= :tarifnormal AND tarifReduit=:tarifReduit");
//     $picRequete->bindParam(':tarifnormal', $QuantitéTarifNormal);
//     $picRequete->bindParam(':tarifReduit', $QuantitéTarifNormal);
//     $picRequete->execute();
    
    // Display the modal after executing the query
   

?>







    </main>

    <script>
        // Set the initial countdown values from PHP
        var days = <?php echo $days; ?>;
        var hours = <?php echo $hours; ?>;
        var minutes = <?php echo $minutes; ?>;
        var seconds = <?php echo $seconds; ?>;

        // Function to update the countdown
        function updateCountdown() {
            seconds--;
            if (seconds < 0) {
                seconds = 59;
                minutes--;
                if (minutes < 0) {
                    minutes = 59;
                    hours--;
                    if (hours < 0) {
                        hours = 23;
                        days--;
                        if (days < 0) {
                            // Countdown is over
                            days = 0;
                            hours = 0;
                            minutes = 0;
                            seconds = 0;
                        }
                    }
                }
            }

            // Display the updated countdown
            document.getElementById('days').innerHTML = days;
            document.getElementById('hours').innerHTML = hours;
            document.getElementById('minutes').innerHTML = minutes;
            document.getElementById('seconds').innerHTML = seconds;

            // Call the function again after 1 second
            setTimeout(updateCountdown, 1000);
        }

        // Start the countdown when the page loads
        window.onload = function() {
            updateCountdown();
        };
    </script>


    <footer class=" text-white py-5" style="background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%) " id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4">

                    <img src="./pictures//Farha__1_-removebg-preview.png" alt="Farha Logo" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <h5>À propos de nous</h5>
                    <p>Notre association offre divers événements culturels et sociaux pour la communauté. Rejoignez-nous pour participer à nos prochains événements.</p>
                </div>

                <div class="col-md-4">
                    <h5>Contactez-nous</h5>
                    <address>
                        <strong>Farha</strong><br>
                        Tanger, Morocco<br>
                        <abbr title="Téléphone">Tel:</abbr> (+212) 6 45 67 89 00<br>
                        <abbr title="Email">Email:</abbr> info@Farha.com
                    </address>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f " style="  color: #40a9bf;"></i></a>
                        <a href="#"><i class="fab fa-twitter " style="  color: #40a9bf;"></i></a>
                        <a href="#"><i class="fab fa-instagram " style="  color: #40a9bf;"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <p>&copy; 2024 Farha. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>
  </div>
</div>

<?php
    $modal=$_SESSION['modal'];
    if($modal){
        ?>
            <div class="position-fixed top-0 d-block" style="width: 100%; height:100%;">
<div class="position-fixed top-0 bg-black" style="width: 100%; height:100%; opacity:70%"></div>
<div tabindex="2" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <?php
    }
?>
</div>
</body>
</html>
