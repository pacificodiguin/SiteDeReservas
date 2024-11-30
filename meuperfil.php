<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
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

// Buscar dados do usuário logado
$stmt = $pdo->prepare("SELECT username, email FROM usuarios WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="styles.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet"><!-- Seu CSS externo -->
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
            color: white;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info p {
            font-size: 18px;
            color: #555;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 10px 15px;
            background-color: rgba(167, 167, 167, 0.7);
            color: #003366;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn:hover {
            background-color: rgba(0, 51, 102, 0.9);
            color: white;
            border-color: rgb(255, 255, 255);
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
    <header>
        <h2>3Irmãos - Meu Perfil</h2>
        
    </header>

    <div class="container">
        <h1>Bem-vindo(a), <?= htmlspecialchars($user['username']) ?>!</h1>
        <div class="user-info">
            <img src="fotos\8847137.png" width="70" lang="70">
            <p><strong>Usuário:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>

        <div class="buttons">
            <a href="carrinho.php" class="btn">Acessar Carrinho</a>
            <a href="confirmacao.php" class="btn">Ver Compras Confirmadas</a>
            <a href="metodos_pagamento.php" class="btn">Meus Métodos De Pagamento</a>
        </div>
        <br>
                <a href="SiteReserva.php"class="btn">Voltar</a></a>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <p>&copy; 2024 Reserva de Hotel</p>
    </footer>
</body>
</html>
