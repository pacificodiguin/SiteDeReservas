<?php
session_start();
$conn = new mysqli("localhost:3306", "root", "", "Restaurante");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$username = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$password = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (empty($username) || empty($password)) {
    echo "<script>
            alert('Preencha todos os campos!');
            window.location.href = 'SiteRestaurante.php'; // Retorna ao formulário de login
          </script>";
    exit;
}

$sql = "SELECT * FROM usuarios WHERE nome = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['senha'] === $password) {
        $_SESSION['nome'] = $user['nome'];
        echo "<script>
                alert('Login realizado com sucesso!');
                window.location.href = 'SiteRestaurante.php'; // Redireciona ao site principal
              </script>";
    } else {
        echo "<script>
                alert('Senha incorreta!');
                window.location.href = 'SiteRestaurante.php'; // Retorna ao formulário de login
              </script>";
    }
} else {
    echo "<script>
            alert('Usuário não encontrado!');
            window.location.href = 'SiteRestaurante.php'; // Retorna ao formulário de login
          </script>";
}

$stmt->close();
$conn->close();
?>

