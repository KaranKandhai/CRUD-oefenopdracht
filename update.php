<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfersysteem", "root", "");
    if (isset($_POST['verzenden'])) {
        $leerling = filter_input(INPUT_POST, "leerling", FILTER_SANITIZE_STRING);

        $vak = filter_input(INPUT_POST, "vak", FILTER_SANITIZE_STRING);

        $cijfer = filter_input(INPUT_POST, "cijfer", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $query = $db->prepare("UPDATE school SET leerling = :leerling, vak = :vak, cijfer = :cijfer WHERE id = :id");

        $query->bindParam("leerling", $leerling);
        $query->bindParam("vak", $vak);
        $query->bindParam("cijfer", $cijfer);
        if ($query->execute()) {
            echo "De nieuwe gegevens zijn toegevoegd";
        } else {
            echo "Er is een fout opgetreden";
        }
        echo "<br>";

    } else {
        $query = $db->prepare("SELECT * FROM school WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$data) {
            $leerling = $data["leerling"];
            $vak = $data["vak"];
            $cijfer = $data["cijfer"];
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<form method="post" action="">
    <label>Leerling</label>
    <input type="" name="leerling" value="<?php echo $leerling; ?>"><br>

    <label>Vak</label>
    <input type="text" name="vak" value="<?php echo $vak; ?>"><br>

    <label>Cijfer</label>
    <input type="text" name="cijfer" value="<?php echo $cijfer; ?>"><br>

    <input type="submit" name="verzenden" value="verzenden">
</form>