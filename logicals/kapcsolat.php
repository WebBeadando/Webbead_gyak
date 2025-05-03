<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['uzenet'])) {
        $uzenetSzoveg = trim($_POST['uzenet']);

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=dbname1', 'dbname1', 'password', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            $felhasznalo_id = null;
            $nev = "Vendég";

            if (isset($_SESSION['login']) && is_array($_SESSION['login']) && isset($_SESSION['login']['id'])) {
                $felhasznalo_id = $_SESSION['login']['id'];
                $nev = $_SESSION['login']['nev'] ?? "Felhasználó";
            }

            $sql = "INSERT INTO uzenetek (nev, uzenet, felhasznalo_id)
                    VALUES (:nev, :uzenet, :felhasznalo_id)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':nev' => $nev,
                ':uzenet' => $uzenetSzoveg,
                ':felhasznalo_id' => $felhasznalo_id
            ]);

            $uzenet = "Üzenet sikeresen elküldve.";
        } catch (PDOException $e) {
            $uzenet = "Hiba: " . $e->getMessage();
        }
    } else {
        $uzenet = "Kérlek, írj be egy üzenetet!";
    }
}
?>