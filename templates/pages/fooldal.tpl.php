<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lidi Travel - Prémium Utazási Portál</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; margin: 0; font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        main { flex: 1; }
        header { background: #fff; padding: 10px; text-align: center; border-bottom: 1px solid #ddd; }
        
        nav { background: #003580; padding: 15px 0; position: sticky; top: 0; z-index: 1000; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        nav a { color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.3s; }
        nav a:hover { color: #ffb700; }

        .hero-section {
            background: linear-gradient(rgba(0, 53, 128, 0.5), rgba(0, 53, 128, 0.3)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600');
            height: 450px; background-size: cover; background-position: center;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: white; text-align: center;
        }
        .hero-text h2 { font-size: 3.5rem; margin: 0; text-shadow: 0 4px 10px rgba(0,0,0,0.5); }

        .welcome-box {
            background: white; max-width: 850px; margin: -60px auto 40px;
            padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            text-align: center; position: relative; z-index: 10;
        }

        .feature-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px; max-width: 1200px; margin: 40px auto; padding: 0 20px;
        }
        .feature-card {
            background: white; padding: 25px; border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-top: 5px solid #003580;
            transition: 0.3s; text-align: left;
        }
        .feature-card:hover { transform: translateY(-10px); border-top-color: #ffb700; }
        .feature-card h4 { margin: 0 0 10px 0; color: #003580; }
        .feature-card a { color: #006ce4; text-decoration: none; font-weight: bold; font-size: 0.9rem; }

        footer { background: #262626; color: white; padding: 30px; text-align: center; font-size: 0.9rem; }
    </style>
</head>
<body>

    

    <main>
        <div class="hero-section">
            <div class="hero-text">
                <h2>Lidi Travel</h2>
                <p>Élmények, melyek örökké tartanak.</p>
            </div>
        </div>

        <div class="welcome-box">
            <h3 style="color: #003580;">Üdvözöljük Budai Lili (GVLRPX) és Bácskai József Kristóf(GHX0DH) oldalán!</h3>
            <p>Projektünk célja egy modern utazási portál bemutatása, amely különböző webes technológiákat alkalmaz a CRUD műveletektől az objektumorientált JavaScriptig.</p>
        </div>

        <div class="feature-grid">
            <div class="feature-card">
                <h4>🏨 Szállások (JS)</h4>
                <p>Helyi tömbben tárolt adatok kezelése tiszta JavaScript segítségével.</p>
                <a href="/szallasok">Megnyitás →</a>
            </div>
            <div class="feature-card">
                <h4>⚙️ Admin (React)</h4>
                <p>React állapottal (useState) működő dinamikus csomagkezelő felület.</p>
                <a href="/adminreact">Kezelés →</a>
            </div>
            <div class="feature-card">
                <h4>🎡 Játékok (SPA)</h4>
                <p>Egyoldalas alkalmazás két belső React játékkal: Szerencsekerék és Memória.</p>
                <a href="/jatekokspa">Pörgetés →</a>
            </div>
            <div class="feature-card">
                <h4>🌐 Ajánlatok (Fetch)</h4>
                <p>Külső szerverről (Fetch API) betöltött partneri adatok megjelenítése.</p>
                <a href="/szerverajanlatok">Megtekintés →</a>
            </div>
            <div class="feature-card">
                <h4>📸 Galéria (Axios)</h4>
                <p>Szerveroldali képfeltöltés és CRUD műveletek React + Axios technológiával.</p>
                <a href="/partnergaleriaaxios">Belépés →</a>
            </div>
            <div class="feature-card">
                <h4>✈️ Flotta (OOJS)</h4>
                <p>Objektumorientált JavaScript szimuláció osztályokkal és öröklődéssel.</p>
                <a href="/flottakezelooojs">Indítás →</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p>
        <p>Lidi Travel - Web programozás-1 Beadandó (2026)</p>
    </footer>

</body>
</html>