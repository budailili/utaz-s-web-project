<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel - OOJS Flotta Kezelő</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f0f2f5; font-family: 'Poppins', sans-serif; margin: 0; }
        .oojs-container { max-width: 1000px; margin: 40px auto; padding: 20px; text-align: center; }
        
        /* Grafikus konténer a járműveknek */
        #flotta-megjelenito { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 20px; 
            margin-top: 30px; 
        }

        /* Jármű kártya stílusa */
        .jarmu-kartya {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 8px solid #003580;
            text-align: left;
            transition: 0.3s;
        }
        .jarmu-kartya:hover { transform: translateY(-5px); }
        .jarmu-kartya h3 { margin: 0; color: #003580; }
        .jarmu-kartya p { color: #666; font-size: 0.9rem; }
        .status-badge { 
            display: inline-block; padding: 4px 10px; border-radius: 20px; 
            font-size: 0.8rem; font-weight: bold; margin-top: 10px;
            background: #e3fcef; color: #00875a;
        }

        .control-panel { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .action-btn { 
            padding: 12px 25px; background: #ffb700; color: #003580; 
            border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;
        }
        .action-btn:hover { background: #003580; color: white; }
    </style>
</head>
<body>
    

    <div class="oojs-container">
        <div class="control-panel">
            <h2>Lidi Travel Logisztikai Központ</h2>
            <p>Objektumorientált szimuláció járműosztályokkal és öröklődéssel.</p>
            <button class="action-btn" onclick="flottaInditasa()">Aktuális Flotta Generálása</button>
        </div>

        <div id="flotta-megjelenito"></div>
    </div>

    <script>
        // 1. ŐSOSZTÁLY (class)
        class Jarmu {
            constructor(gyarto, evjarat) {
                this.gyarto = gyarto; //
                this.evjarat = evjarat;
            }

            // Alap metódus a grafikus megjelenítéshez (metódusok)
            letrehozKartya(tipusNev, extraInfo) {
                const div = document.createElement("div");
                div.className = "jarmu-kartya";
                
                div.innerHTML = `
                    <p style="font-size: 0.7rem; text-transform: uppercase; margin: 0;">${tipusNev}</p>
                    <h3>${this.gyarto}</h3>
                    <p>Gyártási év: ${this.evjarat}</p>
                    <p>${extraInfo}</p>
                    <span class="status-badge">RENDSZERBEN</span>
                `;

                // Dinamikus hozzáadás a DOM-hoz (document.body.appendChild szerűen egy konténerbe)
                document.getElementById("flotta-megjelenito").appendChild(div);
            }
        }

        // 2. SZÁRMAZTATOTT OSZTÁLY: REPÜLŐ (extends)
        class Repulo extends Jarmu {
            constructor(gyarto, evjarat, maxMagassag) {
                super(gyarto, evjarat); // Szülő konstruktor hívása (super)
                this.maxMagassag = maxMagassag;
            }

            megjelenit() {
                // Meghívjuk az ősosztály metódusát egyedi adatokkal
                super.letrehozKartya("Repülőgép", `✈️ Max magasság: ${this.maxMagassag} m`);
            }
        }

        // 3. SZÁRMAZTATOTT OSZTÁLY: BUSZ (extends)
        class Busz extends Jarmu {
            constructor(gyarto, evjarat, ferohely) {
                super(gyarto, evjarat); //
                this.ferohely = ferohely;
            }

            megjelenit() {
                super.letrehozKartya("Transzfer Busz", `🚌 Férőhelyek száma: ${this.ferohely} fő`);
            }
        }

        // Globális indító függvény
        function flottaInditasa() {
            const kontener = document.getElementById("flotta-megjelenito");
            kontener.innerHTML = ""; // Képernyő ürítése

            // Objektumok példányosítása az osztályokból
            const flotta = [
                new Repulo("Boeing 747", 2022, 11000),
                new Repulo("Airbus A320", 2024, 12000),
                new Busz("Mercedes-Benz", 2023, 52),
                new Busz("Setra", 2021, 48)
            ];

            // Minden objektumon meghívjuk a saját metódusát
            flotta.forEach(jarmu => jarmu.megjelenit());
        }
    </script>

    <footer>
        <p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p>
    </footer>
</body>
</html>