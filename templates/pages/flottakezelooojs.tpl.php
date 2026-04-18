<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel - OOJS Flotta Kezelő</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f0f2f5; font-family: 'Poppins', sans-serif; margin: 0; }
        .oojs-container { max-width: 1100px; margin: 40px auto; padding: 20px; text-align: center; }
        
        /* Grafikus irányítópult */
        #flotta-megjelenito { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 25px; 
            margin-top: 40px; 
        }

        /* Profi kártya dizájn */
        .jarmu-kartya {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-left: 10px solid #003580;
            text-align: left;
            transition: 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .jarmu-kartya:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
        .jarmu-kartya h3 { margin: 0; color: #003580; font-size: 1.4rem; }
        .jarmu-kartya p { color: #555; margin: 8px 0; font-size: 0.95rem; }
        
        .type-badge {
            background: #ffb700; color: #003580; padding: 4px 12px;
            border-radius: 50px; font-size: 0.75rem; font-weight: bold;
            display: inline-block; margin-bottom: 10px;
        }

        .action-btn { 
            padding: 15px 40px; background: #003580; color: white; 
            border: none; border-radius: 50px; font-weight: bold; 
            cursor: pointer; transition: 0.3s; font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(0,53,128,0.3);
        }
        .action-btn:hover { background: #006ce4; transform: scale(1.05); }
    </style>
</head>
<body>
    

    <div class="oojs-container">
        <div style="background: white; padding: 40px; border-radius: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <h2>Logisztikai Irányítópult</h2>
            <p>Objektumorientált struktúra: Osztályok, Öröklődés és Dinamikus DOM kezelés.</p>
            <button class="action-btn" onclick="flottaGeneralas()">Aktuális Flotta Indítása</button>
        </div>

        <div id="flotta-megjelenito"></div>
    </div>

    <script>
        // 1. ŐSOSZTÁLY (class)
        class Jarmu {
            constructor(gyarto, evjarat) {
                this.gyarto = gyarto; //
                this.evjarat = evjarat; //
            }

            // Grafikus kártya generáló metódus (metódusok)
            render(kategoria, ikon, specInfo) {
                const card = document.createElement("div"); //
                card.className = "jarmu-kartya";
                
                card.innerHTML = `
                    <span class="type-badge">${kategoria}</span>
                    <h3>${ikon} ${this.gyarto}</h3>
                    <p><strong>Kiadás éve:</strong> ${this.evjarat}</p>
                    <p><strong>Részletek:</strong> ${specInfo}</p>
                    <div style="margin-top:15px; font-size: 0.8rem; color: #00875a; font-weight: bold;">● ÜZEMKÉSZ</div>
                `;

                // Hozzáadás a kifutóhoz (document.body.appendChild logikával)
                document.getElementById("flotta-megjelenito").appendChild(card);
            }
        }

        // 2. SZÁRMAZTATOTT OSZTÁLY: REPÜLŐ (extends)
        class Repulo extends Jarmu {
            constructor(gyarto, evjarat, hatotav) {
                super(gyarto, evjarat); // Szülő konstruktor hívása (super)
                this.hatotav = hatotav;
            }

            aktivall() {
                super.render("Légiflotta", "✈️", `Maximális hatótáv: ${this.hatotav} km`);
            }
        }

        // 3. SZÁRMAZTATOTT OSZTÁLY: BUSZ (extends)
        class Busz extends Jarmu {
            constructor(gyarto, evjarat, tipus) {
                super(gyarto, evjarat); //
                this.tipus = tipus;
            }

            aktivall() {
                super.render("Szárazföldi Transzfer", "🚌", `Kategória: ${this.tipus} (Luxus)`);
            }
        }

        function flottaGeneralas() {
            const display = document.getElementById("flotta-megjelenito");
            display.innerHTML = ""; // Frissítés előtt törlés

            // Példányosítás és életszerű adatok
            const jarmuvek = [
                new Repulo("Boeing 747-8", 2023, 14815),
                new Repulo("Airbus A350", 2024, 15000),
                new Busz("Mercedes-Benz Tourismo", 2022, "Távolsági"),
                new Busz("Setra S 517 HDH", 2023, "Prémium VIP")
            ];

            jarmuvek.forEach(j => j.aktivall());
        }
    </script>

    <footer>
        <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p>
    </footer>
</body>
</html>