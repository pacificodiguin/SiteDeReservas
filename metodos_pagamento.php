<?php

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

// Adicionar novo método de pagamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_metodo'])) {
    $novo_metodo = trim($_POST['novo_metodo']);
    if (!empty($novo_metodo)) {
        $stmt = $pdo->prepare("INSERT INTO metodos_pagamento (metodo) VALUES (?)");
        $stmt->execute([$novo_metodo]);
        header("Location: metodos_pagamento.php");
        exit();
    }
}

// Alterar status de ativação
if (isset($_GET['toggle_id'])) {
    $id = (int)$_GET['toggle_id'];
    $stmt = $pdo->prepare("UPDATE metodos_pagamento SET ativo = NOT ativo WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: metodos_pagamento.php");
    exit();
}

// Buscar todos os métodos de pagamento
$stmt = $pdo->query("SELECT * FROM metodos_pagamento");
$metodos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Métodos de Pagamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'arial', sans-serif;
            background-color: #003366;
            margin: 0;
            padding: 0;
        }

        header {
            font-family: 'Montserrat', sans-serif;
            background-color: #002244;
            padding: 15px;
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

        h1 {
            text-align: center;
            color: #333;
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
            background-color: #f4f4f9;
            color: #333;
        }

        .btn {
            padding: 6px 12px;
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

        form {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            background-color: rgba(167, 167, 167, 0.7);
            color: #003366;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        button:hover {
            background-color: rgba(0, 51, 102, 0.9);
            color: white;
            border-color: rgb(255, 255, 255);
        }

        footer {
            text-align: center;
            margin-top: 30px;
            padding: 10px 0;
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h2>3Irmãos - Métodos de Pagamento</h2>
    </header>

    <div class="container">
        <h1>Meus Métodos de Pagamento</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Método</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metodos as $metodo): ?>
                    <tr>
                        <td><?= $metodo['id'] ?></td>
                        <td><?= htmlspecialchars($metodo['metodo']) ?></td>
                        <td><?= $metodo['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                        <td>
                            <a class="btn" href="?toggle_id=<?= $metodo['id'] ?>">
                                <?= $metodo['ativo'] ? 'Desativar' : 'Ativar' ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="post">
            <input type="text" name="novo_metodo" placeholder="Novo método de pagamento" required>
            <button type="submit">Adicionar</button>
        </form><br>
        <a href="SiteReserva.php">
            <button type="submit" class="btn">Voltar Para Tela Inicial</button></a>
            <br><br>
            <a href="meuperfil.php">
            <button type="submit" class="tn">Ir Para o Perfil</button></a>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <p>&copy; 2024 Reserva de Hotel</p>
    </footer>
</body>
</html>
