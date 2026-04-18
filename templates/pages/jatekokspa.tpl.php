<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lidi Travel - SPA Játékok</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <style>
        body.spa-page {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');
            background-size: cover; background-position: center; background-attachment: fixed;
            margin: 0; font-family: 'Poppins', sans-serif; display: flex; flex-direction: column; min-height: 100vh;
        }
        /* Menü a két játék között */
        .spa-nav { background: rgba(0, 53, 128, 0.9); padding: 15px; text-align: center; }
        .spa-nav button { background: none; border: 2px solid #ffb700; color: white; padding: 10px 20px; margin: 0 10px; cursor: pointer; border-radius: 5px; font-weight: bold; }
        .spa-nav button.active { background: #ffb700; color: #003580; }

        .app-container { 
            background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(25px);
            padding: 40px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5); text-align: center; color: white;
            margin: 20px auto; width: 550px;
        }
        /* SZERENCSEKERÉK STÍLUSOK (Változatlanul) */
        .wheel-box { position: relative; width: 420px; height: 420px; margin: 30px auto; }
        .pointer {
            position: absolute; top: -35px; left: 50%; transform: translateX(-50%);
            width: 0; height: 0; border-left: 20px solid transparent; border-right: 20px solid transparent;
            border-top: 45px solid #ff4757; z-index: 100; filter: drop-shadow(0 5px 5px rgba(0,0,0,0.5));
        }
        .wheel {
            width: 100%; height: 100%; border-radius: 50%; border: 10px solid #fff;
            position: relative; overflow: hidden; box-shadow: 0 0 40px rgba(0,0,0,0.4);
            transition: transform 5s cubic-bezier(0.1, 0, 0.1, 1);
        }
        .wheel-label {
            position: absolute; top: 50%; left: 50%; width: 50%; height: 0;
            transform-origin: left center; text-align: right; padding-right: 45px;
            font-weight: 800; font-size: 13px; color: #111; text-transform: uppercase;
        }
        /* ÚJ JÁTÉK: MEMÓRIA RÁCS */
        .memory-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 20px; }
        .memory-card { 
            height: 80px; background: #003580; border: 2px solid white; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; font-size: 2rem; cursor: pointer;
        }
        .memory-card.flipped { background: #ffb700; color: #003580; }

        .spin-button, .action-btn { 
            padding: 15px 40px; background: #ffa502; color: #fff; border: none; 
            border-radius: 50px; cursor: pointer; font-size: 1.1rem; font-weight: bold;
            box-shadow: 0 10px 20px rgba(255, 165, 2, 0.4); margin-top: 15px;
        }
        .win-box { margin-top: 25px; padding: 20px; border-radius: 15px; background: rgba(46, 204, 113, 0.6); border: 2px solid #2ecc71; }
        .fail-box { margin-top: 25px; padding: 20px; border-radius: 15px; background: rgba(231, 76, 60, 0.6); border: 2px solid #e74c3c; }
    </style>
</head>
<body class="spa-page">
    <div id="root"></div>

    <script type="text/babel">
        const { useState, useEffect } = React;

        // --- 1. JÁTÉK: SZERENCSEKERÉK (A kódod változtatás nélkül) ---
        const FortuneWheel = () => {
            const [email, setEmail] = useState("");
            const [rotation, setRotation] = useState(0);
            const [isSpinning, setIsSpinning] = useState(false);
            const [prize, setPrize] = useState(null);

            const data = [
                { label: "10% Kedvezmény", color: "#f1c40f" },
                { label: "Sajnos nem nyert", color: "#9b59b6" },
                { label: "Még egy pörgetés!", color: "#e67e22" },
                { label: "Ingyen Reggeli", color: "#2ecc71" },
                { label: "5% Kedvezmény", color: "#bdc3c7" },
                { label: "Ajándék Ital", color: "#f39c12" },
                { label: "Sajnos nem nyert", color: "#d35400" },
                { label: "Transzfer út", color: "#3498db" },
                { label: "Még egy pörgetés!", color: "#e74c3c" },
                { label: "20% Kedvezmény", color: "#1abc9c" }
            ];

            const sliceDeg = 360 / data.length;

            const wheelStyle = {
                transform: `rotate(${rotation}deg)`,
                background: `conic-gradient(from 0deg, ${data.map((d, i) => `${d.color} ${i * sliceDeg}deg ${(i + 1) * sliceDeg}deg`).join(", ")})`
            };

            const spinWheel = () => {
                if (!email.includes("@")) { alert("Email kötelező!"); return; }
                const randomExtra = Math.floor(Math.random() * 360);
                const totalRotation = rotation + 1800 + randomExtra; 
                setRotation(totalRotation);
                setIsSpinning(true);
                setPrize(null);

                setTimeout(() => {
                    setIsSpinning(false);
                    const actualDeg = (totalRotation + 90) % 360;
                    const prizeIndex = Math.floor(((360 - actualDeg) % 360) / sliceDeg);
                    setPrize(data[prizeIndex].label);
                }, 5100);
            };

            return (
                <div className="app-container">
                    <h2>Lidi Travel Nyereményjáték</h2>
                    {!prize && !isSpinning && (
                        <input type="email" placeholder="Email címed..." value={email} onChange={e => setEmail(e.target.value)} style={{padding:'12px', borderRadius:'10px', border:'none', width:'80%', marginBottom:'20px'}}/>
                    )}
                    <div className="wheel-box">
                        <div className="pointer"></div>
                        <div className="wheel" style={wheelStyle}>
                            {data.map((d, i) => (
                                <div key={i} className="wheel-label" style={{ transform: `translate(0, -50%) rotate(${i * sliceDeg + sliceDeg/2}deg)` }}>
                                    <span>{d.label}</span>
                                </div>
                            ))}
                        </div>
                    </div>
                    <button className="spin-button" onClick={spinWheel} disabled={isSpinning || (prize && !prize.includes("Még")) || !email}>
                        {isSpinning ? "FORGÁS..." : "MEGPÖRGETEM!"}
                    </button>
                    {prize && (
                        <div className={prize.includes("nem") ? "fail-box" : "win-box"}>
                            {prize.includes("nem") ? prize : "GRATULÁLUNK! " + prize}
                        </div>
                    )}
                </div>
            );
        };

        // --- 2. JÁTÉK: ÚTI CÉL MEMÓRIA (Új SPA modul) ---
        const MemoryGame = () => {
            const icons = ['🗼', '🗽', '🕌', '⛩️', '🎡', '🏖️', '🗼', '🗽', '🕌', '⛩️', '🎡', '🏖️'];
            const [cards, setCards] = useState([]);
            const [flipped, setFlipped] = useState([]);
            const [solved, setSolved] = useState([]);

            useEffect(() => {
                setCards(icons.sort(() => Math.random() - 0.5));
            }, []);

            const handleFlip = (i) => {
                if (flipped.length === 2 || flipped.includes(i) || solved.includes(i)) return;
                const newFlipped = [...flipped, i];
                setFlipped(newFlipped);
                if (newFlipped.length === 2) {
                    if (cards[newFlipped[0]] === cards[newFlipped[1]]) {
                        setSolved([...solved, ...newFlipped]);
                        setFlipped([]);
                    } else {
                        setTimeout(() => setFlipped([]), 800);
                    }
                }
            };

            return (
                <div className="app-container">
                    <h2>Úti cél Párosító</h2>
                    <p>Találja meg a világ nevezetességeinek párjait!</p>
                    <div className="memory-grid">
                        {cards.map((icon, i) => (
                            <div key={i} className={`memory-card ${flipped.includes(i) || solved.includes(i) ? 'flipped' : ''}`} onClick={() => handleFlip(i)}>
                                {(flipped.includes(i) || solved.includes(i)) ? icon : '?'}
                            </div>
                        ))}
                    </div>
                    {solved.length === icons.length && <div className="win-box">Gratulálunk! Minden pár meglett!</div>}
                    <button className="action-btn" onClick={() => window.location.reload()}>Új játék</button>
                </div>
            );
        };

        // --- FŐ SPA VEZÉRLŐ ---
        const App = () => {
            const [activeGame, setActiveGame] = useState('wheel');

            return (
                <div>
                    <nav className="spa-nav">
                        <button className={activeGame === 'wheel' ? 'active' : ''} onClick={() => setActiveGame('wheel')}>Szerencsekerék</button>
                        <button className={activeGame === 'memory' ? 'active' : ''} onClick={() => setActiveGame('memory')}>Memória Játék</button>
                        <a href="/" style={{color:'white', marginLeft:'20px', textDecoration:'none'}}>← Főoldal</a>
                    </nav>
                    {activeGame === 'wheel' ? <FortuneWheel /> : <MemoryGame />}
                    <footer style={{textAlign:'center', padding:'20px', color:'white'}}>
                        <p>Készítette: <strong>Budai Lili (GVLRPX)</strong> & <strong>Bácskai József Kristóf(GHX0DH)</strong></p>
                    </footer>
                </div>
            );
        };

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(<App />);
    </script>
</body>
</html>