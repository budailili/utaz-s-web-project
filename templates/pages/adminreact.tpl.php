<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel Admin - Professzionális CRUD</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; margin: 0; }
        .admin-header { background: #003580; color: white; padding: 40px; text-align: center; border-bottom: 5px solid #ffb700; }
        .dashboard-container { max-width: 1100px; margin: auto; padding: 20px; }
        
        /* Statisztikai kártyák */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: center; border: 1px solid #e0e0e0; }
        .stat-card h4 { margin: 0; color: #666; font-size: 0.9rem; text-transform: uppercase; }
        .stat-card p { margin: 10px 0 0; font-size: 1.8rem; font-weight: bold; color: #003580; }

        /* Form dizájn */
        .add-panel { 
            background: white; padding: 30px; border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); margin-bottom: 40px;
            display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 15px; align-items: center;
        }
        .add-panel input, .add-panel select { padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        .add-btn { background: #003580; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .add-btn:hover { background: #006ce4; transform: scale(1.05); }

        /* Kártyák */
        .travel-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .travel-card { 
            background: white; border-radius: 15px; overflow: hidden; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: 0.3s; border: 1px solid #eee;
        }
        .travel-card img { width: 100%; height: 180px; object-fit: cover; }
        .card-body { padding: 20px; }
        .card-body h3 { margin: 0; color: #003580; }
        .status-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; margin-bottom: 10px; }
        .status-active { background: #e3fcef; color: #00875a; }
        
        .price-tag { font-size: 1.4rem; font-weight: bold; color: #26a69a; margin: 15px 0; }
        .del-btn { 
            width: 100%; padding: 12px; background: #fff1f0; color: #ff4d4f; 
            border: 1px solid #ffa39e; cursor: pointer; font-weight: bold; transition: 0.3s;
        }
        .del-btn:hover { background: #ff4d4f; color: white; }
    </style>
</head>
<body>

    <div class="admin-header">
        <h1>Lidi Travel – Partner Dashboard</h1>
        <p>Adminisztrációs központ az utazási csomagok kezeléséhez</p>
    </div>

    <div id="root"></div>

    <script type="text/babel">
        const { useState, useEffect } = React;

        function TravelManager() {
            // Adatbázis inicializálása (READ)
            const [items, setItems] = useState([
                { id: 1, name: "Bora Bora Luxus", price: 850000, type: "Tengerpart", img: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500" },
                { id: 2, name: "Svájci Alpok Síút", price: 320000, type: "Hegyvidék", img: "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=500" },
                { id: 3, name: "Római Városnézés", price: 145000, type: "Városnézés", img: "https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=500" }
            ]);

            const [newName, setNewName] = useState("");
            const [newPrice, setNewPrice] = useState("");
            const [newType, setNewType] = useState("Városnézés");

            // Statisztikák számítása valós időben
            const totalValue = items.reduce((sum, item) => sum + item.price, 0);
            const averagePrice = items.length > 0 ? Math.round(totalValue / items.length) : 0;

            // Új tétel hozzáadása (CREATE)
            const handleAdd = () => {
                if(!newName || !newPrice) return alert("Minden mezőt töltsön ki!");
                const newItem = {
                    id: Date.now(),
                    name: newName,
                    price: parseInt(newPrice),
                    type: newType,
                    img: "https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=500"
                };
                setItems([...items, newItem]);
                setNewName(""); setNewPrice("");
            };

            // Törlés (DELETE)
            const handleDelete = (id) => {
                if(confirm("Biztosan törli ezt a csomagot?")) {
                    setItems(items.filter(item => item.id !== id));
                }
            };

            return (
                <div className="dashboard-container">
                    {/* Statisztikai sáv */}
                    <div className="stats-grid">
                        <div className="stat-card">
                            <h4>Aktív ajánlatok</h4>
                            <p>{items.length} db</p>
                        </div>
                        <div className="stat-card">
                            <h4>Portfólió érték</h4>
                            <p>{totalValue.toLocaleString()} Ft</p>
                        </div>
                        <div className="stat-card">
                            <h4>Átlagos ár</h4>
                            <p>{averagePrice.toLocaleString()} Ft</p>
                        </div>
                    </div>

                    {/* Hozzáadás panel */}
                    <div className="add-panel">
                        <input type="text" placeholder="Úti cél neve" value={newName} onChange={e => setNewName(e.target.value)} />
                        <input type="number" placeholder="Ár (Ft)" value={newPrice} onChange={e => setNewPrice(e.target.value)} />
                        <select value={newType} onChange={e => setNewType(e.target.value)}>
                            <option>Városnézés</option>
                            <option>Tengerpart</option>
                            <option>Hegyvidék</option>
                            <option>Kalandtúra</option>
                        </select>
                        <button className="add-btn" onClick={handleAdd}>Csomag létrehozása</button>
                    </div>

                    {/* Kártyák megjelenítése */}
                    <div className="travel-grid">
                        {items.map(item => (
                            <div key={item.id} className="travel-card">
                                <img src={item.img} alt={item.name} />
                                <div className="card-body">
                                    <span className="status-badge status-active">{item.type}</span>
                                    <h3>{item.name}</h3>
                                    <div className="price-tag">{item.price.toLocaleString()} Ft</div>
                                    <button className="del-btn" onClick={() => handleDelete(item.id)}>Csomag eltávolítása</button>
                                </div>
                            </div>
                        ))}
                    </div>
                    
                    <div style={{textAlign: 'center', marginTop: '40px'}}>
                        <a href="/" style={{textDecoration: 'none', color: '#003580', fontWeight: 'bold'}}>← Vissza a főoldalra</a>
                    </div>
                </div>
            );
        }

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(<TravelManager />);
    </script>

    <footer>
        <p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p>
    </footer>
</body>
</html>