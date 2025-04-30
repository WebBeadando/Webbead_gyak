<?php
$uzenet = "";

if (!isset($_SESSION['login'])) {
    $uzenet = "A képfeltöltés csak bejelentkezett felhasználók számára érhető el.";
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['kep'])) {
        $cel = './images/uploads/';
        $fajlnev = basename($_FILES['kep']['name']);
        $celut = $cel . $fajlnev;

        $kiterjesztes = strtolower(pathinfo($fajlnev, PATHINFO_EXTENSION));
        $ervenyes = in_array($kiterjesztes, ['jpg', 'jpeg', 'png', 'gif']);

        if (!$ervenyes) {
            $uzenet = "Csak JPG, PNG vagy GIF képek tölthetők fel.";
        } elseif ($_FILES['kep']['size'] > 2 * 1024 * 1024) { 
            $uzenet = "A fájl túl nagy. Maximum 2MB lehet.";
        } elseif (move_uploaded_file($_FILES['kep']['tmp_name'], $celut)) {
            $uzenet = "A kép sikeresen feltöltve.";
        } else {
            $uzenet = "Hiba történt a kép feltöltése során.";
        }
    }
}
?>