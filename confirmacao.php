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

// Finalizar compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'finalize_purchase') {
    $stmt = $pdo->prepare("UPDATE reservas SET status = 'confirmed' WHERE username = ? AND status = 'pending'");
    $stmt->execute([$_SESSION['username']]);
}

// Buscar reservas confirmadas
$stmt = $pdo->prepare("SELECT * FROM reservas WHERE username = ? AND status = 'confirmed'");
$stmt->execute([$_SESSION['username']]);
$reservas_confirmadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Confirmada</title>
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
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 10px 0;
            background-color: #003366;
            color: white;
        }

        .confirmation-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
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
    background-color: #003366;
    color: white;
}

.btn-danger, .tn-danger {
    background-color: #ff0000;
}

.btn-danger:hover, .tn-danger:hover {
    background-color: #cc0000;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Compras Confirmadas</h1>
        <?php if (count($reservas_confirmadas) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Hotel</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Hóspedes</th>
                        <th>Total (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas_confirmadas as $reserva): ?>
                        <h3>Compras Feitas!</h3>
                        <p>Obrigado por finalizar sua compra. Aqui estão os detalhes:</p>
                        <tr>
                            <td><?= htmlspecialchars($reserva['hotel_name']) ?></td>
                            <td><?= htmlspecialchars($reserva['checkin']) ?></td>
                            <td><?= htmlspecialchars($reserva['checkout']) ?></td>
                            <td><?= htmlspecialchars($reserva['guests']) ?></td>
                            <td><?= number_format($reserva['total_price'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <a href="SiteReserva.php">
            <button type="submit" class="btn">Voltar Para Tela Inicial</button></a>
            <br>
            <br>
            <a href="meuperfil.php">
            <button type="submit" class="tn">Ir Para o Perfil</button></a>
        <?php else: ?>
            <p>Não há reservas confirmadas no momento.</p>
            <a href="SiteReserva.php">
            <button type="submit" class="btn">Voltar Para Tela Inicial</button></a>
            <br><br>
            <a href="meuperfil.php">
            <button type="submit" class="tn">Ir Para o Perfil</button></a>
            
        <?php endif; ?>
    </div>
</body>
</html>
