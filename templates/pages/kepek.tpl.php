<h2>Képgaléria</h2>

<?php if (empty($kepek)): ?>
    <p>Még nem történt képfeltöltés.</p>
<?php else: ?>
    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
        <?php foreach ($kepek as $kep): ?>
            <div style="border: 1px solid #ccc; padding: 5px;">
                <img src="<?= $kep ?>" alt="Galéria kép" style="max-width: 200px;">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($uzenet)) echo "<p style='color: red;'>$uzenet</p>"; ?>

<?php if (isset($_SESSION['login'])): ?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="kep" accept="image/*" required>
    <button type="submit">Kép feltöltése</button>
</form>
<<<<<<< Updated upstream
=======
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
>>>>>>> Stashed changes
<?php else: ?>
<p>Csak bejelentkezett felhasználók tölthetnek fel képeket.</p>
<?php endif; ?>

<hr>

<div style="display: flex; flex-wrap: wrap; gap: 10px;">
    <?php
<<<<<<< Updated upstream
    $mappa = './images/feltoltott/';
    if (is_dir($mappa)) {
        $kepek = array_diff(scandir($mappa), array('.', '..'));
        foreach ($kepek as $kep) {
            echo "<div style='border: 1px solid #ccc; padding: 5px;'><img src=\"$mappa$kep\" alt=\"Kép\" style=\"max-width:200px;\"></div>";
=======
    $mappa = './images/uploads/';
    if (is_dir($mappa)) {
        $kepek = array_diff(scandir($mappa), array('.', '..'));
        foreach ($kepek as $kep) {
            echo "<div style='border: 1px solid #ccc; padding: 5px;'><img src=\"/Webbead_gyak/images/uploads/$kep\" alt=\"Kép\" style=\"max-width:200px;\"></div>";
>>>>>>> Stashed changes
        }
    } else {
        echo "<p>Nincs feltöltött kép.</p>";
    }
    ?>
</div>