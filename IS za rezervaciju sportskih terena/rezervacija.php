<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerviši</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="rezervisi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="centar" style="margin-top:30px">
        <h1>Rezerviši teren:</h1>
        <?php 
        $id = $_GET["id"];
        $sql = "SELECT * FROM tereni WHERE id=$id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        echo "<h2>" . htmlspecialchars($name) . "</h2>";
        ?>
    </div>
    
    <div class="forma">
        <form id="form" action="" class="kolona" method="POST">
            <label for="Ime">Ime</label>
            <input type="text" id="name" name="name" required><br>

            <label for="Prezime">Prezime</label>
            <input type="text" id="surname" name="surname" required><br>

            <label for="E-mail">E-mail</label>
            <input type="email" id="email" name="email" required><br>

            <label for="Telefon">Telefon</label>
            <input type="tel" id="tel" name="phone" required style="padding: 12px 15px;border: 1px solid #ccc;border-radius: 5px;font-size: 1rem;width: 100%;box-sizing: border-box;"><br>

            <div>
                <label for="Datum" style="display: flex; align-items: center">Datum</label>
                <input type="date" id="date" style="width:160px" name="date" required>

                <label for="Od" style="display: flex; align-items: center">Od:</label>
                <input type="number" min="0" max="24"style="width:110px" id="timeOd" name="timeOd" placeholder="Broj sati" required>

                <label for="Do" style="display: flex; align-items: center">Do:</label>
                <input type="number" style="width:110px" min="0" max="24" id="timeDo" name="timeDo" placeholder="Broj sati" required>
            </div>
            <div><input type="radio" name="money" id="" checked="checked">Keš<input type="radio" name="money" id="">Kreditna Kartica <input type="checkbox" name="" id="">Obezbijeđena oprema</div>
            <br><button type="button" id="calculate" style="margin-bottom:10px">Izračunaj cijenu rezervacije</button>
            <div id="price-result" style="height: 40px"></div><br>
            
            <input type="submit" id="rezervisi" name="rezervisi" value="Rezerviši">
            
            <div id="error-message" style="color: red; margin-top: 10px;"></div>
        </form>
        <?php
        error_reporting(0);
        $imeTerena = $row["name"];
        $ime = isset($_POST["name"]) ? $_POST["name"] : "";
        $prezime = isset($_POST["surname"]) ? $_POST["surname"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $datum = isset($_POST["date"]) ? $_POST["date"] : "";
        $timeOd = intval($_POST["timeOd"]);
        $timeDo = intval($_POST["timeDo"]);
        $cijena = $row["price"] * ($timeDo - $timeOd);
        if(isset($_POST["rezervisi"])) {
            if($timeOd < 25 && $timeDo < 25 && $timeOd >0 && $timeDo >0 && $timeDo > $timeOd) {
                $sql = "INSERT INTO rezervacije (terenId, imeTerena, ime, prezime, email, datum, timeOd, timeDo, cijena)
                                  VALUES ($id,'$imeTerena', '$ime', '$prezime', '$email', '$datum', $timeOd, $timeDo, $cijena)";
                $result = mysqli_query($con, $sql);
                $sql = "UPDATE tereni SET available=0, rezervisan=1 WHERE id=$id";
                $result = mysqli_query($con, $sql);
                header("Location: kraj.php");
            }
        } 
        
        ?>
    </div>
</body>
</html>
