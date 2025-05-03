<h2>Képgaléria</h2>

<?php if (!empty($uzenet)) echo "<p style='color: red;'>$uzenet</p>"; ?>

<?php if (isset($_SESSION['login'])): ?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="kep" accept="image/*" required>
        <button type="submit">Kép feltöltése</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['kep'])) {
        $upload_dir = './images/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = $_FILES['kep']['name'];
        $file_tmp = $_FILES['kep']['tmp_name'];
        $file_size = $_FILES['kep']['size'];
        $file_error = $_FILES['kep']['error'];

        if ($file_error === UPLOAD_ERR_OK) {
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_ext, $allowed_exts)) {
                $new_file_name = uniqid('img_', true) . '.' . $file_ext;
                $file_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    echo "<p style='color: blue;'>A kép sikeresen feltöltve!</p>";
                } else {
                    echo "<p style='color: red;'>Hiba történt a fájl mentésekor.</p>";
                }
            } else {
                echo "<p style='color: red;'>Csak képfájlok tölthetők fel!</p>";
            }
        } else {
            echo "<p style='color: red;'>Hiba történt a fájl feltöltésekor. Kód: $file_error</p>";
        }
    }
    ?>
<?php else: ?>
    <p>Csak bejelentkezett felhasználók tölthetnek fel képeket.</p>
<?php endif; ?>

<hr>

<div class="galeria">
    <?php

    $mappa2 = './images/uploads/';
    if (is_dir($mappa2)) {
        $kepek2 = array_diff(scandir($mappa2), array('.', '..'));
        foreach ($kepek2 as $kep) {
            echo "<div class='kepkartya'><img src=\"$mappa2$kep\" alt=\"Kép\" style=\"max-width:200px;\"></div>";
        }
    }
    ?>
</div>