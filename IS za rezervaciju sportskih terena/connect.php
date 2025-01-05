<?php
    $con = mysqli_connect("localhost","root","","IS za rezervaciju sportskih terena");
    if(!$con) {
        die(mysqli_error($con));
    }
?>