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

<body  >
    <header>
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, rgba(0,36,28,1) 28%, rgba(64,169,191,1) 100%)">
            <div class="container">
                <img src="./pictures//Farha__1_-removebg-preview.png" style="width: 190px; height: 50px; margin-right: 10px;" class="navbar-brand">
                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style=color:#f8f9fa></span>
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
    
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./pictures//salle1 (1).jpg" class="d-block w-100" alt="...">
    </div>
   
   
  </div>
</div>

        <form class="nav-item mx-2 m-3" method="post" >
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #83C0C1;">
                    Category
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><button class="dropdown-item" type="submit" name="category" value="Cinéma">Cinéma</button></li>
                    <li><button class="dropdown-item" type="submit" name="category" value="Theatre">Theatre</button></li>
                    <li><button class="dropdown-item" type="submit" name="category" value="Musique">Musique</button></li>
                </ul>
            </div>

            <div class="input-group ">
                <input type="date" class="form-control" name="start_date" aria-label="Start date">
                <span class="input-group-text">to</span>
                <input type="date" class="form-control" name="end_date" aria-label="End date">
            </div>

            <button class="btn btn-outline" type="submit" name="search" style="background-color:  #83C0C1; color:white">Search</button>
        </form>







        <?php
        require_once('MyConnection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])) {
            $selectedCategory = $_POST['category'];
            $picRequete = $conn->prepare("SELECT * FROM evenement INNER JOIN version ON evenement.idEvenement = version.idEvenement WHERE categorie = :category");
            $picRequete->bindParam(':category', $selectedCategory);
            $picRequete->execute();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
            $selectedStartDate = $_POST['start_date'];
            $selectedEndDate = $_POST['end_date'];
            $picRequete = $conn->prepare("SELECT * FROM evenement INNER JOIN version ON evenement.idEvenement = version.idEvenement WHERE dateEvenement BETWEEN :start_date AND :end_date");
            $picRequete->bindParam(':start_date', $selectedStartDate);
            $picRequete->bindParam(':end_date', $selectedEndDate);
            $picRequete->execute();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchTitle'])) {
            $searchQuery = '%' . $_POST['inputSearch'] . '%';

            $picRequete = $conn->prepare("SELECT * FROM evenement INNER JOIN version ON evenement.idEvenement = version.idEvenement WHERE titre LIKE :inputSearch");
            $picRequete->bindParam(':inputSearch',  $searchQuery);

            $picRequete->execute();
        } else {

            $picRequete = $conn->prepare("SELECT * FROM evenement INNER JOIN version ON evenement.idEvenement = version.idEvenement WHERE dateEvenement > current_date()");
            $picRequete->execute();
        }


        $path = "pictures";
        echo "<div class='cards' style='display: flex; flex-wrap: wrap; justify-content:center'>";

        while ($row = $picRequete->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='card' style='width: 18rem; margin: 10px; '>";
            echo "<div style=' width:100%;height:30vh; overflow: hidden'>";
            echo "<img src='{$path}/{$row['imageEvenement']}' class='card-img-top' alt='... ' style='max-width: 100%;max-height: 100%;height:auto'>";
            echo "</div>";
            echo "<div  >";
            echo "<div class='card-body'>";
            echo "<div class='category' style='text-align: center; background-color:#83C0C1;color:white; width:100%'> <h5 class='card-categorie'>{$row['categorie']}</h5></div>";

            echo "<h3 class='card-title'>{$row['titre']}</h3>";

          
            $datetime = $row["dateEvenement"];
            $formatted_date = date("M d, Y", strtotime($datetime));
            $formatted_time = date("h:i A", strtotime($datetime));
            $calendar_icon = '<i class="fa-regular fa-calendar-days"></i>';
            $clock_icon = '<i class="fa-regular fa-clock"></i>';
            echo '<p class="card-date" ;">' . $calendar_icon . ' ' . $formatted_date . ' ' . $clock_icon . ' ' . $formatted_time . '</p>';
         
            echo "<div class='d-flex justify-content-around' style='width:100%;'>";
            echo "<div style='color: #40a9bf '><strong> Price: " . $row['tarifnormal'] . " MAD </strong></div>";

            echo "<a href='details.php?ID={$row['numVersion']}' class='btn btn-primary' style=' background-color: #00241c;' >Acheter</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }


        echo "</div>";
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