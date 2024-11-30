<?php
session_start(); 
$conn = new mysqli("localhost:3306", "root", "", "Restaurante");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (empty($nome) || empty($email) || empty($senha)) {
    echo "<script>
            alert('Todos os campos são obrigatórios!');
            window.location.href = 'SiteRestaurante.php'; // Redireciona para o site principal
          </script>";
    exit();
}

$sql_check = "SELECT * FROM usuarios WHERE nome = ? OR email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ss", $nome, $email);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "<script>
            alert('Usuário ou email já cadastrado!');
            window.location.href = 'SiteRestaurante.php'; // Redireciona para o site principal
          </script>";
    exit();
}

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {

    echo "<script>
            alert('Cadastro realizado com sucesso! Faça o login.');
            window.location.href = 'SiteRestaurante.php'; // Redireciona ao site para login
          </script>";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt_check->close();
$stmt->close();
$conn->close();
?>
<script>
            alert('Cadastro realizado com sucesso! Faça o login.');
            window.location.href = 'SiteRestaurante.php'; 
</script>
