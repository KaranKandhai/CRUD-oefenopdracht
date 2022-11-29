<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfersysteem", "root", "");
    if (isset($_POST['verzenden'])) {
        $leerling = filter_input(INPUT_POST, "leerling", FILTER_SANITIZE_STRING);

        $vak = filter_input(INPUT_POST, "vak", FILTER_SANITIZE_STRING);

        $cijfer = filter_input(INPUT_POST, "cijfer", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $query = $db->prepare("INSERT INTO school(leerling,vak,cijfer) VALUES (:leerling, :vak, :cijfer)");

        $query->bindParam("leerling", $leerling);
        $query->bindParam("vak", $vak);
        $query->bindParam("cijfer", $cijfer);
        if ($query->execute()) {
            echo "De nieuwe gegevens zijn toegevoegd";
        } else {
            echo "Er is een fout opgetreden";
        }
        echo "<br>";

    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<form method="post" action="">
    <label>Leerling</label>
    <input type="text" name="leerling"><br>

    <label>Vak</label>
    <input type="text" name="vak"><br>

    <label>Cijfer</label>
    <input type="text" name="cijfer"><br>

    <input type="submit" name="verzenden" value="verzenden">
</form>

<a href="index.php">Terug naar Index</a>
