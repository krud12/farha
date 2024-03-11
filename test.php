<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <form  method="post" action="home.php">
                <input type="search" name="inputSearch" placeholder="search">
                <button type="submit" name="searchTitle" >search</button>
            </form>
        </nav>
    </header>
    <main>
        <form method="post" action="home.php">
           <div>
              <button type="button" >category</button>
              <ul class="dropdown-menu">
                <li><button type="submit" name="category" value="cinema">cinema</button></li>
                <li><button type="submit" name="category">theatre</button></li>
                <li><button type="submit" name="category">musique</button></li>
              </ul>
            </div>
            <div class="input-group">
                <input type="date" name="start-date" class="form-control" >
                <span class="input-group-text">TO</span>
                <input type="date" name="end-date" class="form-control">
            </div>
            <button type="submit" name="search">search</button>
        </form>
        <?php
        require_once("./MyConnection.php");
        if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['category'])){
            $selectedcategory= $_POST['category'];   
            $requete=$conn->prepare("SELECT * from evenement inner join  version on evenement.idEvenement=version.idEvenement where categorie=:category");
             $requete->bindParam(':category' ,$selectedcategory);
             $requete-> execute(); 
        } elseif($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search'])){
             $startdate=$_post['start-date'];
             $enddate=$_post['end-date'];
             $requete=$conn->prepare("SELECT * from evenemnet inner join version on evenement.idEvenement=version.Idversion where dateEvenement between :start-date AND :end-date");
             $requete->bindParam(':start-date',$startdate);
             $requete->bindParam(':enddate-date',$enddate);
             $requete->execute();
       
       
            }else if($_SERVER['REQUEST_METHOD']=="POST" &&isset($_POST['searchTitle'])){
                $search="%". $_POST['inputSearch']."%";
                $requete=$conn->prepare("SELECT * from evenement inner join version on evenement.Idevenement=version.IdEvenement where title like :inputSearch");
                $requete->bindParam(':inputSearch',$search);
                $requete->execute();
            
            }else{
                $requete=$conn->prepare("SELECT * from evenement inner join version on evenement.idEvenement=version.idEvenement where dateEvenement> current_date()");
                $requete->execute();
            }

           $path='pictures';
            echo "<div>";
            while($row=$requete->fetch(PDO::FETCH_ASSOC)){
                echo "<img src='{$path}/{$row['imageEvenement']}'>";
            }

        
        









?>


    </main>
</body>
</html>