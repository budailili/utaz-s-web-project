<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['regisztral'])) {
        // Regisztráció mentése
        $_SESSION['adatbazis'][$_POST['lnév']] = [
            'vnev' => $_POST['vnev'],
            'knev' => $_POST['knev'],
            'login' => $_POST['lnév'],
            'pw' => $_POST['pw']
        ];
        $msg = "<p style='color:green;'>Sikeres regisztráció! Kérjük, jelentkezzen be.</p>";
    } elseif (isset($_POST['belep'])) {
        $l = $_POST['lnév'];
        $p = $_POST['pw'];
        if (isset($_SESSION['adatbazis'][$l]) && $_SESSION['adatbazis'][$l]['pw'] == $p) {
            $_SESSION['user'] = $_SESSION['adatbazis'][$l];
            header("Location: index.php?oldal=fooldal");
            exit();
        } else {
            $msg = "<p style='color:red;'>Hiba: Érvénytelen adatok!</p>";
        }
    }
}
?>

<div class="card">
    <div class="auth-container">
        <div>
            <h2>Bejelentkezés</h2>
            <?php echo $msg; ?>
            <form method="POST">
                <input type="text" name="lnév" placeholder="Felhasználónév" required>
                <input type="password" name="pw" placeholder="Jelszó" required>
                <button type="submit" name="belep" class="btn-primary">Belépés</button>
            </form>
        </div>

        <hr style="width:100%; border:0; border-top:1px solid #eee; margin: 20px 0;">

        <div>
            <h2>Regisztráció</h2>
            <form method="POST">
                <input type="text" name="vnev" placeholder="Vezetéknév" required>
                <input type="text" name="knev" placeholder="Keresztnév" required>
                <input type="text" name="lnév" placeholder="Login név" required>
                <input type="password" name="pw" placeholder="Jelszó" required>
                <button type="submit" name="regisztral" class="btn-accent">Regisztráció elküldése</button>
            </form>
        </div>
    </div>
</div>