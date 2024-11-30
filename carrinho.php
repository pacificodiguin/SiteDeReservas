<?php
session_start();
$logged_in = isset($_SESSION['username']);
if (!$logged_in) {
    header('Location: SiteReserva.php');
    exit();
}

$host = 'localhost:3306';
$dbname = 'hotel_reservation';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Remover reserva do carrinho
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = ? AND username = ?");
    $stmt->execute([$id, $_SESSION['username']]);
    header('Location: carrinho.php');
    exit();
}

// Buscar reservas pendentes
$stmt = $pdo->prepare("SELECT * FROM reservas WHERE username = ? AND status = 'pending'");
$stmt->execute([$_SESSION['username']]);
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotel_name = htmlspecialchars($_POST['hotel_name']);
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guests = intval($_POST['guests']);
    $total_price = floatval($_POST['total_price']);

    if (empty($checkin) || empty($checkout) || empty($guests) || empty($hotel_name)) {
        die("Por favor, preencha todos os campos.");
    }

    $checkin_date = DateTime::createFromFormat('Y-m-d', $checkin);
    $checkout_date = DateTime::createFromFormat('Y-m-d', $checkout);

    if (!$checkin_date || !$checkout_date || $checkin_date >= $checkout_date) {
        die("As datas de check-in e check-out são inválidas.");
    }

    if ($guests < 1) {
        die("O número de hóspedes deve ser pelo menos 1.");
    }

    // Inserir no banco de dados
    $stmt = $pdo->prepare("INSERT INTO reservas (username, hotel_name, checkin, checkout, guests, total_price) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['username'], $hotel_name, $checkin, $checkout, $guests, $total_price]);

    header('Location: carrinho.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Reserva de Hotéis</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <style>

body {
    font-family: 'arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #003366;
}

header {
    font-family: 'Montserrat', sans-serif;
    background-color: #002244;
    padding: 15px;
    text-align: center;
    color: white;
}

h1 {

    text-align: center;
    color: white;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

table th {
    background-color: #003366;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #ddd;
}

.btn, .tn {
    padding: 10px 15px;
    background-color: rgba(167, 167, 167, 0.7);
    color: #003366;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.3s, border-color 0.3s;
}

.btn:hover, .tn:hover {
    background-color: rgba(0, 51, 102, 0.9);
    color: white;
    border-color: rgb(255, 255, 255);
}

.btn-danger{
    padding:7px 10px;
    background-color: #ff0000;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.3s, border-color 0.3s;
}

.btn-danger:hover {
    background-color: #cc0000;
}

footer {
    text-align: center;
    margin-top: 50px;
    padding: 10px 0;
    background-color: #003366;
    color: white;
}

    </style>
</head>
<body>
    <div class="container">
        <header>
        <h1>Seu Carrinho de Reservas</h1>
        </header>

        <?php if (count($reservas) > 0): ?>
            <form action="confirmacao.php" method="POST">
                <input type="hidden" name="action" value="finalize_purchase">
                <table>
                    <thead>
                        <tr>
                            <th>Hotel</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Hóspedes</th>
                            <th>Total (R$)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $reserva): ?>
                            <tr>
                                <td><?= htmlspecialchars($reserva['hotel_name']) ?></td>
                                <td><?= htmlspecialchars($reserva['checkin']) ?></td>
                                <td><?= htmlspecialchars($reserva['checkout']) ?></td>
                                <td><?= htmlspecialchars($reserva['guests']) ?></td>
                                <td><?= number_format($reserva['total_price'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="carrinho.php?remove=<?= $reserva['id'] ?>" class="btn btn-danger">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn">Fazer Compra</button>
            </form>
            <br>
        <?php else: ?>
            <p>Seu carrinho está vazio.
                <br> <br>
                <a href="SiteReserva.php"><button type="submit" class="tn">Voltar a Tela Inicial</button></a></a></p>
        <?php endif; ?>
    </div>
</body>
</html>