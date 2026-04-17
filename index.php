<?php
session_start();

// a) és b) Alapértelmezett oldal és jogosultság kezelés
$oldal = isset($_GET['oldal']) ? $_GET['oldal'] : 'fooldal';

// Kilépés kezelése
if ($oldal == 'kilepes') {
    session_destroy();
    header("Location: index.php?oldal=fooldal");
    exit();
}

$bejelentkezve = isset($_SESSION['user']);

// e) pont: A kért formátum: Bejelentkezett: Családi_név Utónév (Login_név)
$header_text = $bejelentkezve ? 
    "Bejelentkezett: " . $_SESSION['user']['vnev'] . " " . $_SESSION['user']['knev'] . " (" . $_SESSION['user']['login'] . ")" : 
    "Nincs bejelentkezve";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Lidi Travel Portál</h1>
    <div class="user-bar"><?php echo $header_text; ?></div>
</header>

<nav>
    <ul>
        <li><a href="index.php?oldal=fooldal">Főoldal</a></li>
        <li><a href="index.php?oldal=kepek">Képek</a></li>
        <li><a href="index.php?oldal=kapcsolat">Kapcsolat</a></li>
        <li><a href="index.php?oldal=crud">CRUD</a></li>
        
        <?php if (!$bejelentkezve): ?>
            <li><a href="index.php?oldal=auth" style="color:var(--accent)">Bejelentkezés</a></li>
        <?php else: ?>
            <li><a href="index.php?oldal=kilepes">Kilépés</a></li>
        <?php endif; ?>
    </ul>
</nav>

<main>
    <?php
    // Front-controller: fájlok betöltése a tartalom mappából
    $fajl = "tartalom/$oldal.php";
    if (file_exists($fajl)) {
        include($fajl);
    } else {
        include("tartalom/fooldal.php");
    }
    ?>
</main>

<footer>
    <p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf (GHX0DH)</strong></p>
    <p>&copy; 2026 Lidi Travel - Minden jog fenntartva.</p>
</footer>

</body>
</html>