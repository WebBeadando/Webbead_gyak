<<<<<<< Updated upstream
<h2>About Us</h2>
<p>We are a great company doing great things.</p>
=======
<?php if (!isset($_SESSION['login'])): ?>
    <p>Ez az oldal csak bejelentkezett felhasználók számára érhető el.</p>
<?php else: ?>
    <h2>Beérkezett üzenetek</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Név</th>
            <th>Email</th>
            <th>Üzenet</th>
            <th>Dátum</th>
        </tr>

        <?php
        try {
            $dbh = new PDO('mysql:host=127.0.0.1;port=3306;dbname=uzenet', 'root', '',
                array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            $stmt = $dbh->query("SELECT nev, email, uzenet, datum, felhasznalo_id
                                 FROM uzenetek
                                 ORDER BY datum DESC");

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nev = $row['felhasznalo_id'] ? htmlspecialchars($row['nev']) : "Vendég";
                echo "<tr>
                        <td>{$nev}</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . nl2br(htmlspecialchars($row['uzenet'])) . "</td>
                        <td>{$row['datum']}</td>
                      </tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='4'>Hiba: " . $e->getMessage() . "</td></tr>";
        }
        ?>
    </table>
<?php endif; ?>
>>>>>>> Stashed changes
