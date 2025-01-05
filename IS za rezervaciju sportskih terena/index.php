<?php
  include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IS za rezervaciju sportskih terena</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php 

  ?>
    <div id="mainTitle">
        <h1 class="mainTitle">IS za rezervaciju sportskih terena</h1>
        <a href="#rez"><button class="prelazBtn">Rezervišite sportski teren</button></a>
    </div>
    <div id="rez">
        <h1 class="rezText">Rezervišite Teren</h1>

        <div class="filter">
        <form action="#rez" method="POST">
          Lokacija: 
          <select name="lokacija" id="selectLokacija">
            <option value="">- Sve Lokacije -</option>
            <option value="Španija" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Španija" ? "selected" : "" ?>>Španija</option>
            <option value="Engleska" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Engleska" ? "selected" : "" ?>>Engleska</option>
            <option value="Brazil" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Brazil" ? "selected" : "" ?>>Brazil</option>
            <option value="Meksiko" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Meksiko" ? "selected" : "" ?>>Meksiko</option>
            <option value="Nemačka" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Nemačka" ? "selected" : "" ?>>Nemačka</option>
            <option value="Crna Gora" <?= isset($_POST["lokacija"]) && $_POST["lokacija"] === "Crna Gora" ? "selected" : "" ?>>Crna Gora</option>
          </select>&ensp;&ensp;

          Slobodan:&ensp;
          <input type="radio" name="slobodan" id="" value="1" <?= isset($_POST["slobodan"]) && $_POST["slobodan"] === "1" ? "checked" : "" ?>>Da&ensp; 
          <input type="radio" name="slobodan" id="" value="0" <?= isset($_POST["slobodan"]) && $_POST["slobodan"] === "0" ? "checked" : "" ?>>Ne
          &ensp;
          <input class="btn btn-primary" name="submit" type="submit" value="Pretrazi">&ensp;
        </form>
      </div>

        <?php
            if(isset($_POST["submit"])) {
              $Lokacija = isset($_POST["lokacija"]) ? $_POST["lokacija"] : "";
              $Slobodan = isset($_POST["slobodan"]) ? $_POST["slobodan"] : "";
              $sql = "SELECT * FROM tereni WHERE 1";
              if(!empty($Lokacija)) {
                $sql.=" AND place LIKE '%$Lokacija%'";
              }
              if(isset($_POST["slobodan"])) {
                $sql.=" AND available=$Slobodan";
              }
            } else {
              $sql = "SELECT * FROM tereni";
            }
            
            $result = mysqli_query($con, $sql);

            if ($result) {
              $count = 0;
              while ($row = mysqli_fetch_assoc($result)) {

              if ($count % 4 == 0) {
                  if ($count > 0) {
                      echo "</div>";
                  }
                  echo "<div class='row mb-4'>";
              }
              $id = $row["id"];
              $image = $row["image"];
              $imageData = base64_encode($image);
              $imageSrc = 'data:image/jpeg;base64,' . $imageData;

              $cardClass = ($row["available"] == 0) ? "opacity:0.5;transform:none;" : "";

              echo "<div class='col-md'>";
              echo "    <div class='card' style='width: 18rem;height:550px;$cardClass'>";
              echo "        <img src='".$imageSrc."' class='card-img-top' alt='...' style='width:286px;height:190px'>";
              echo "        <div class='card-body'>";
              echo "            <h5 class='card-title'>".$row["name"]."</h5>";
              echo "            <p class='card-text'>".$row["description"]."</p>";
              echo "            <p class='card-text'>"."<b>Lokacija:</b>&ensp;".$row["place"]."</p>";
              echo "            <p class='card-text'>"."<b>Kapacitet:</b>&ensp;".$row["capacity"]."</p>";
              if($row["available"] == 1) {
              echo "            <p class='card-text'>"."<b>Slobodan:</b>&ensp;Da</p>";
              }
              else {
              echo "            <p class='card-text zauzet'>"."<b>Slobodan:</b>&ensp;Ne</p>";
              } echo "<div style='display: flex;justify-content: space-between;align-items:center;'>";
              echo "            <p style='display:inline;margin-bottom:0px;' class='card-text cijena'>"."$".$row["price"]."</p>";
              if($row["available"] == 1) {
              echo "            <a href='rezervacija.php?id=".$id."'><button style='border:none;background-color:white;'><img style='width:50px;border-radius:50%;' src='slike/korpica.png'/></button></a>";
              } echo "</div>";
              echo "        </div>";
              echo "    </div>";
              echo "</div>";

            $count++;
          }
          echo "</div>";
      }
      ?>
      <a href="rezervisaniTereni.php"><button class="rezervisaniTereni">Vasi Rezervisani Tereni</button></a>

    </div>
</body>
</html>