<?php

$config = require 'config.php';
$page = $_GET['page'] ?? 'home'; 

if (!array_key_exists($page, $config['menu'])) {
    $page = 'home';
}

?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($config['site_title']) ?></title>
    <link rel="stylesheet" href="./stílus/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

</head>
<body>

<header>
    <h1><?= htmlspecialchars($config['site_title']) ?></h1>
    <nav>
        <ul>
            <?php foreach ($config['menu'] as $key => $name): ?>
                <li><a href="?page=<?= urlencode($key) ?>" class="<?= ($page === $key) ? 'active' : '' ?>">
			<?= htmlspecialchars($name) ?>
</a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<main>
    <?php
    $pageFile = "pages/{$page}.php";
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        echo "<p>Az oldal nem található.</p>";
    }
    ?>
</main>

<footer>
    <p>© 2025 - <?= htmlspecialchars($config['site_title']) ?></p>
</footer>

</body>
</html>