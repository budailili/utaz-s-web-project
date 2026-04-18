<?php
if(isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        // Kapcsolódás
        
        
        $host = 'sql111.infinityfree.com'; 
        $dbname = 'if0_41694563_web2'; 
        $user = 'if0_41694563';             
        $pass = 'Q0brj5Ap0jJLVV';              

         $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass,
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
        // Felhsználó keresése
        $sqlSelect = "select id, csaladi_nev, uto_nev from felhasznalok where bejelentkezes = :bejelentkezes and jelszo = sha1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => $_POST['jelszo']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $_SESSION['csn'] = $row['csaladi_nev']; $_SESSION['un'] = $row['uto_nev']; $_SESSION['login'] = $_POST['felhasznalo'];
        }
    }
    catch (PDOException $e) {
        $errormessage = "Hiba: ".$e->getMessage();
    }      
}
else {
    header("Location: .");
}
?>


