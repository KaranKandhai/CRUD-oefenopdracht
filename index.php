<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfersysteem", "root", "");
    $query = $db->prepare("SELECT * FROM school");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>";
    foreach ($result as $data) {
        echo "<a href='update.php?id=".$data['id']."'>";
        echo $data["leerling"] . " " . $data["vak"] . " " . $data["cijfer"];
        echo "</a>";
        echo "<br>";

    }
    echo "</table>";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<br
<a href="insert.php">Insert</a>

<style type="text/css">
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }
    td {
        border: 1px solid black;
        width: 100px;
    }
</style>
