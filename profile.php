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
        .offcanvas-header, .offcanvas-body {
            background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%) !important;
        }
        .nav-hover:hover {
            color: #f8f9fa; /* Change text color on hover */
            background-color: rgba(255, 255, 255, 0.1); /* Change background color on hover */
            border-radius: 5px; /* Add border-radius on hover for rounded corners */
            transition: background-color 0.3s ease, color 0.3s ease; /* Add smooth transition effect */
        }
    </style>
</head>

<body >
    <header>
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%) ">
            <div class="container">
                <img src="./pictures//Farha__1_-removebg-preview.png" style="width: 190px; height: 50px; margin-right: 10px; " class="navbar-brand">
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
                                    <input class="form-control me-2" style="border-radius: 15px;height: 27px; margin-top:8px" type="search" name="inputSearch" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline" type="submit" name="searchTitle"><i class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
                                </form>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link nav-hover" href="#footer" style="color: white;">Contact</a>
                            </li>
                            <?php
                            session_start();
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

include 'MyConnection.php';

if (isset($_SESSION['id_user']))

    detailsUser($_SESSION['id_user'], $conn);
?>
</main>





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
</body>

</html>






