<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel - Foglalási & CRUD Kezelő</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; padding-bottom: 80px; }
        .booking-header { background: #003580; color: white; padding: 40px 20px 60px 20px; text-align: center; }
        .top-nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: 600; }
        .search-container { max-width: 900px; margin: -30px auto 30px; background: #ffb700; padding: 20px; border-radius: 8px; display: flex; gap: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); align-items: center; justify-content: center; }
        .search-container input { border: none; padding: 10px; border-radius: 4px; outline: none; }
        .admin-panel { max-width: 900px; margin: 20px auto; background: #fff; padding: 25px; border-radius: 12px; border: 2px dashed #003580; text-align: center; }
        .admin-panel input, .admin-panel label { padding: 10px; margin: 5px; }
        .results-list { max-width: 900px; margin: 0 auto; padding: 0 20px; }
        .hotel-card { background: white; border-radius: 12px; margin-bottom: 20px; overflow: hidden; display: flex; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e7e7e7; height: 160px; }
        .hotel-img { width: 220px; height: 100%; object-fit: cover; background: #ddd; }
        .hotel-details { padding: 20px; flex: 1; text-align: left; }
        .hotel-price-section { text-align: right; padding: 20px; border-left: 1px solid #f0f0f0; min-width: 180px; display: flex; flex-direction: column; justify-content: center; }
        .add-btn { background: #003580; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .del-btn { background: #d32f2f; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 0.8rem; }
        footer { background: #333; color: white; padding: 20px; text-align: center; position: fixed; bottom: 0; width: 100%; }
    </style>
</head>
<body>
    <div class="booking-header">
        <div class="top-nav"><a href="/">Főoldal</a><a href="/adminreact">Admin (React)</a></div>
        <h1>Lidi Travel – Foglalási & CRUD Kezelő</h1>
    </div>

    <div class="admin-panel">
        <h3 style="margin-top:0; color:#003580;">[ADMIN] Új szállás felvétele</h3>
        <input type="text" id="newName" placeholder="Szállás neve">
        <input type="number" id="newPrice" placeholder="Ár / éj / fő">
        <label style="background:#eee; border-radius:4px; cursor:pointer;">
            📷 Kép kiválasztása
            <input type="file" id="newImg" accept="image/*" style="display:none;">
        </label>
        <button class="add-btn" onclick="addHotel()">Hozzáadás</button>
    </div>

    <div class="search-container">
        <input type="text" id="dest" placeholder="Keresés..." onkeyup="renderHotels()">
        <label>Fő:</label> <input type="number" id="ppl" value="2" min="1" onchange="renderHotels()">
        <label>Éj:</label> <input type="number" id="nights" value="3" min="1" onchange="renderHotels()">
    </div>

    <div class="results-list" id="results"></div>

    <script>
        let hotels = [
            { name: "Krúdy Apartman", price: 11500, img: "https://images.unsplash.com/photo-1551882547-ff43c63ef53e?w=400" },
            { name: "Lidi Garden Resort", price: 18900, img: "https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400" }
        ];

        function addHotel() {
            const name = document.getElementById("newName").value;
            const price = document.getElementById("newPrice").value;
            const fileInput = document.getElementById("newImg");

            if (name && price) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    hotels.push({
                        name: name,
                        price: parseInt(price),
                        img: e.target.result || "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400"
                    });
                    renderHotels();
                    // Mezők ürítése
                    document.getElementById("newName").value = "";
                    document.getElementById("newPrice").value = "";
                    fileInput.value = "";
                };
                
                if (fileInput.files[0]) {
                    reader.readAsDataURL(fileInput.files[0]);
                } else {
                    // Ha nincs kép, alapértelmezett beállítása
                    hotels.push({ name, price: parseInt(price), img: "https://via.placeholder.com/400x300?text=Lidi+Travel" });
                    renderHotels();
                }
            } else { alert("Név és ár megadása kötelező!"); }
        }

        function deleteHotel(index) {
            hotels.splice(index, 1);
            renderHotels();
        }

        function renderHotels() {
            const container = document.getElementById("results");
            const query = document.getElementById("dest").value.toLowerCase();
            const ppl = parseInt(document.getElementById("ppl").value) || 1;
            const nights = parseInt(document.getElementById("nights").value) || 1;
            container.innerHTML = "";

            hotels.forEach((h, index) => {
                if (h.name.toLowerCase().includes(query)) {
                    const total = h.price * ppl * nights;
                    container.innerHTML += `
                        <div class="hotel-card">
                            <img src="${h.img}" class="hotel-img">
                            <div class="hotel-details">
                                <h3 style="margin:0; color:#003580;">${h.name}</h3>
                                <p style="color:#008009; font-weight:bold; font-size:0.9rem;">Ingyenes lemondás</p>
                            </div>
                            <div class="hotel-price-section">
                                <span style="font-size:12px; color:#666;">${ppl} fő, ${nights} éj</span>
                                <b style="font-size:22px; color:#003580; margin-bottom:10px;">${total.toLocaleString()} Ft</b>
                                <button class="del-btn" onclick="deleteHotel(${index})">Törlés [Admin]</button>
                            </div>
                        </div>`;
                }
            });
        }
        renderHotels();
    </script>
    <footer><p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p></footer>
</body>
</html>