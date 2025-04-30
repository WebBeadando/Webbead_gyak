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
<?php else: ?>
<p>Csak bejelentkezett felhasználók tölthetnek fel képeket.</p>
<?php endif; ?>

<hr>

<div style="display: flex; flex-wrap: wrap; gap: 10px;">
    <?php
    $mappa = './images/feltoltott/';
    if (is_dir($mappa)) {
        $kepek = array_diff(scandir($mappa), array('.', '..'));
        foreach ($kepek as $kep) {
            echo "<div style='border: 1px solid #ccc; padding: 5px;'><img src=\"$mappa$kep\" alt=\"Kép\" style=\"max-width:200px;\"></div>";
        }
    } else {
        echo "<p>Nincs feltöltött kép.</p>";
    }
    ?>
</div>