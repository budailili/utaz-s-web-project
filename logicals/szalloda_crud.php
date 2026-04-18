<?php
// KAPCSOLAT
try {
    
     $host = 'sql111.infinityfree.com'; 
    $dbname = 'if0_41694563_web2'; 
    $user = 'if0_41694563'; 
    $pass = 'Q0brj5Ap0jJLVV'; 
    
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Kapcsolódási hiba: " . $e->getMessage());
}

// DELETE (POST-ra átírva!)
if(isset($_POST['delete_id'])) {
    $stmt = $dbh->prepare("DELETE FROM szalloda WHERE az = :id");
    $stmt->execute([':id' => $_POST['delete_id']]);
    header("Location: index.php?szalloda_crud");
    exit;
}

// ADD / UPDATE
if(isset($_POST['mentes'])) {
    if(isset($_POST['modositas'])) {
        // UPDATE
        $stmt = $dbh->prepare("UPDATE szalloda 
            SET nev = :nev, besorolas = :besorolas, tengerpart_tav = :tav 
            WHERE az = :az");

        $stmt->execute([
            ':nev' => $_POST['nev'],
            ':besorolas' => $_POST['besorolas'],
            ':tav' => $_POST['tengerpart_tav'],
            ':az' => $_POST['az']
        ]);
    } else {
        // INSERT
        $stmt = $dbh->prepare("INSERT INTO szalloda (az, nev, besorolas, tengerpart_tav) 
            VALUES (:az, :nev, :besorolas, :tav)");

        $stmt->execute([
            ':az' => $_POST['az'],
            ':nev' => $_POST['nev'],
            ':besorolas' => $_POST['besorolas'],
            ':tav' => $_POST['tengerpart_tav']
        ]);
    }

    header("Location: index.php?szalloda_crud");
    exit;
}

// EDIT - Adatok lekérése a szerkesztéshez
$szerkesztendo = null;
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM szalloda WHERE az = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $szerkesztendo = $stmt->fetch(PDO::FETCH_ASSOC);
}

// LISTÁZÁS
$szallodak = $dbh->query("SELECT * FROM szalloda")->fetchAll(PDO::FETCH_ASSOC);

// EDIT ADAT BETÖLTÉS
$editData = null;
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM szalloda WHERE az = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>