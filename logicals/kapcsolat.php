<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nev']) && !empty($_POST['email']) && !empty($_POST['uzenet'])) {
        $nev = trim($_POST['nev']);
        $email = trim($_POST['email']);
        $uzenetSzoveg = trim($_POST['uzenet']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                $dbh = new PDO('mysql:host=mysql.nethely.hu;dbname=adatb3941', 'adatb3941', 'adatb3941', 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

                $felhasznalo_id = null;
				if (isset($_SESSION['login']) && is_array($_SESSION['login']) && isset($_SESSION['login']['id'])) {
					$felhasznalo_id = $_SESSION['login']['id'];
					}

                $sql = "INSERT INTO uzenetek (nev, email, uzenet, felhasznalo_id)
                        VALUES (:nev, :email, :uzenet, :felhasznalo_id)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([
                    ':nev' => $nev,
                    ':email' => $email,
                    ':uzenet' => $uzenetSzoveg,
                    ':felhasznalo_id' => $felhasznalo_id
                ]);

                $uzenet = "Üzenet sikeresen elküldve.";
            } catch (PDOException $e) {
                $uzenet = "Hiba: " . $e->getMessage();
            }
        } else {
            $uzenet = "Hibás email cím.";
        }
    } else {
        $uzenet = "Minden mező kitöltése kötelező.";
    }
}
?>