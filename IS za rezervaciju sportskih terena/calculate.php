<?php
include "connect.php";

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tereni WHERE id=$id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $timeOd = intval($_POST["timeOd"]);
        $timeDo = intval($_POST["timeDo"]);

        if ($timeOd < 25 && $timeDo < 25 && $timeDo > $timeOd) {
            $cijena = $row["price"] * ($timeDo - $timeOd);
            echo "<p>Cijena rezervacije: $" . htmlspecialchars($cijena) . "</p>";
        } else {
            echo '<p style="color:red;">Broj sati "Do" mora biti veći od broja sati "Od", i oba moraju biti manja od 25.</p>';
        }
    } else {
        echo "<p style='color:red;'>Teren nije pronađen.</p>";
    }
} else {
    echo "<p style='color:red;'>Nevažeći ID terena.</p>";
}
?>
