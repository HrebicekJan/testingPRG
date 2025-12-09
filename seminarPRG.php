<?php
    // MySQL //
$host = 'localhost';
$db   = 'SPRG';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,         
    PDO::ATTR_EMULATE_PREPARES   => false,                  
];

try {
    // Připojení MySQL pomocí PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Chyba připojení: " . htmlspecialchars($e->getMessage());
    exit;
}

// query
$sql = "SELECT id, name, email, created_at FROM users ORDER BY id ASC";

try {
    $stmt = $pdo->query($sql); 
} catch (PDOException $e) {
    echo "Chyba dotazu: " . htmlspecialchars($e->getMessage());
    exit;
}

// fetchAll
$rows = $stmt->fetchAll(PDO::FETCH_OBJ);

// HTML
?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>Výpis uživatelů z DB</title>
<style>
    body{
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        background:#f4f6f8;
        color:#1f2937;
        padding:30px;
    }
    .card{
        max-width:900px;
        margin:0 auto;
        background:white;
        border-radius:12px;
        box-shadow:0 6px 20px rgba(31,41,55,0.08);
        padding:20px;
    }
    h1{ margin:0 0 12px 0; font-size:20px; }
    table{
        width:100%;
        border-collapse:collapse;
        margin-top:12px;
    }
    th, td{
        text-align:left;
        padding:10px 12px;
        border-bottom:1px solid #e6e9ee;
        font-size:14px;
    }
    th{
        background:#fbfdff;
        font-weight:600;
        color:#0f172a;
    }
    tr:hover td{ background:#fbfbff; }
    .muted{ color:#6b7280; font-size:13px; }
    .empty { padding:30px; text-align:center; color:#6b7280; }
</style>
</head>
<body>
<div class="card">
    <h1>Seznam uživatelů</h1>
    <p class="muted">Z databáze <strong><?php echo htmlspecialchars($db); ?></strong> — tabulka <strong>users</strong></p>

    <?php if (count($rows) === 0): ?>
        <div class="empty">Žádná data k zobrazení.</div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jméno</th>
                    <th>E-mail</th>
                    <th>Vytvořeno</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r->id); ?></td>
                        <td><?php echo htmlspecialchars($r->name); ?></td>
                        <td><?php echo htmlspecialchars($r->email); ?></td>
                        <td><?php echo htmlspecialchars($r->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
