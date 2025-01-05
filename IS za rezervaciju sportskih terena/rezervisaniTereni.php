<?php
    include "connect.php";

    if(isset($_POST["otkazi"])) {
        $terenId = intval($_POST["terenId"]);
        $sqlUpdateTeren = "UPDATE tereni SET rezervisan = 0, available = 1 WHERE id=$terenId";
        $resultUpdate = mysqli_query($con, $sqlUpdateTeren);
        $sqlDeleteRezervacija = "DELETE FROM rezervacije WHERE terenId = $terenId";
        $result = mysqli_query($con, $sqlDeleteRezervacija);
        echo "<script>window.location.href='rezervisaniTereni.php';</script>";
        exit();
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervisani Tereni</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div id="rez">
        <h1 class="rezText">Rezervisani Tereni</h1><br><br>
            
        <?php
            $Lokacija = isset($_POST["lokacija"]) ? $_POST["lokacija"] : "";
            $Slobodan = isset($_POST["slobodan"]) ? $_POST["slobodan"] : "";
            $sql ="SELECT * FROM tereni WHERE rezervisan = 1";
        
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

              
              echo "<div class='col-md'>";
              echo "    <div class='card' style='width: 18rem;height:550px;transform: none;'>";
              echo "    <form action='rezervisaniTereni.php' method='POST'>";
              echo "        <img src='".$imageSrc."' class='card-img-top' alt='...' style='width:286px;height:190px'>";
              echo "        <div class='card-body'>";
              echo "            <h5 class='card-title'>".$row["name"]."</h5><br>";
              echo "            <p class='card-text'>"."<b>Lokacija:</b>&ensp;".$row["place"]."</p>";
              echo "            <p class='card-text'>"."<b>Kapacitet:</b>&ensp;".$row["capacity"]."</p>";
              $sql1 = "SELECT rezervacije.*,tereni.name AS terenName FROM rezervacije JOIN tereni ON rezervacije.terenId = tereni.id WHERE rezervacije.terenId = $id";
              $result1 = mysqli_query($con, $sql1);
              $row1 = mysqli_fetch_assoc($result1);
              $id=$row1["terenId"];
              echo "<input type='hidden' name='terenId' value='" . $id . "'>";
              echo "<p><b>Ime i Prezime:</b>&ensp;".$row1["ime"]."&ensp;".$row1["prezime"]."</p>";
              echo "<p><b>Datum:</b>&ensp;".$row1["datum"]."</p>";
              echo "<div style='display: flex;justify-content: space-around;'><p><b>Od:</b>&ensp;".$row1["timeOd"]."h</p><p><b>Do:</b>&ensp;".$row1["timeDo"]."h</p></div>";
              echo "<div style='display: flex;justify-content: center;align-items:center;'>";
              echo "            <p style='display:inline;margin-bottom:0px;' class='card-text cijena'>"."$".$row1["cijena"]."</p>";
              echo "</div>";
              echo "<div style='display: flex;justify-content: center;align-items:center;'>";
              echo "            <input type='submit' class='btn btn-danger' name='otkazi' value='Otkaži rezervaciju'>";
              echo "</div>";
              echo "        </div>";
              echo "    </div>";
              echo "</form>";
              echo "</div>";

            $count++;
          }
          echo "</div>";
      }
            ?>
        <a href="index.php#rez"><button class="rezervisaniTereni">Rezerviši Nove Terene</button></a>

</body>
</html>