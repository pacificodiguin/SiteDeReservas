<?php
session_start();
$logged_in = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link rel="stylesheet" href="Sitereservacs.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <style>
        header {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        .tab-menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tablink {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 0 5px;
            border-radius: 4px;
        }

        .tablink:hover {
            background-color: #002244;
        }

        .tab-content {
            display: none;
            text-align: center;
        }

        .tab-content.active {
            display: block;
        }

        .login-button {
            position: static;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: rgba(167, 167, 167, 0.7);
            color: #003366;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, border-color 0.3s;

        }

        .login-button:hover {
            background-color: #ff0000;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <header>
        <h1>3Irmãos</h1>
        <h1>Reserva de Hotéis</h1>
        <div class="header-controls">
         
 
        <?php if (!$logged_in): ?>
        <button class="login-button" onclick="openPopup('loginPopup')">Login</button>
    <?php else: ?>
        <a href="meuperfil.php" target="_blank">
        <img src="fotos\8847137.png" width="40" lang="40"></a>
        <p>Bem-vindo, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="login-button">Sair</a>
    <?php endif; ?>
</header>

    <section class="hotel">
        <h2>Carmel Charme Resort</h2>
        <div class="hotel-info">
            <img src="fotos\Charmel.jpeg" alt="Resort">
            <div class="hotel-details">
                <p><strong>Nota:</strong> 9.4 - Extraordinário</p>
                <p><strong>Localização:</strong> Barro Preto, Ceará, Brasil</p>
                <p>Este resort à beira-mar em Barro Preto possui um spa completo, piscina externa e muito mais.</p>
            </div>
        </div>
        <div class="hotel-amenities">
            <h3>Comodidades Populares</h3>
            <ul>
                <li>Bar</li><br>
                <li>Piscina</li><br>
                <li>Spa</li><br>
                <li>Academia</li><br>
                <li>Aceita Animais</li><br>
                <li>Lavanderia</li><br>
            </ul>

<?php if ($logged_in): ?>
<div class="hotel">
<form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Carmel Charme Resort">
    <input type="hidden" name="total_price" value="1500.00">
    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" required>
    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" required>
    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" required>
    <button type="submit">Reservar</button>
</form>
</div>
<?php endif; ?>
    </div>
    </section>
<br><br><br><br>


<section class="hotel">
    <h2>Solar dos Ventos Eco Lodge</h2>
    <div class="hotel-info">
        <img src="fotos/fernadodenoronha.jpg" alt="Eco Lodge">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.6 - Excepcional</p>
            <p><strong>Localização:</strong> Fernando de Noronha, Pernambuco, Brasil</p>
            <p>Com vistas deslumbrantes para o mar, este ecolodge oferece uma experiência de imersão na natureza, com práticas sustentáveis e muito conforto.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Café da manhã orgânico</li><br>
            <li>Trilhas ecológicas</li><br>
            <li>SPA com terapias naturais</li><br>
            <li>Wi-Fi gratuito</li><br>
            <li>Transfer aeroporto-hotel</li><br>
            <li>Serviço de babá</li><br>
        </ul>
        <?php if ($logged_in): ?>        
        <div class="hotel">
        <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Solar dos Ventos Eco Lodge">
    <input type="hidden" name="total_price" value="2500.00">

    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>

<br><br><br><br>

<section class="hotel">
    <h2>Mirante do Atlântico Resort</h2>
    <div class="hotel-info">
        <img src="fotos/floripa.jpg" alt="Resort">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.3 - Fantástico</p>
            <p><strong>Localização:</strong> Florianópolis, Santa Catarina, Brasil</p>
            <p>Situado no topo de uma colina com vista panorâmica para o oceano, o Mirante do Atlântico é o lugar perfeito para relaxar em grande estilo.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Piscina infinita</li><br>
            <li>Bar molhado</li><br>
            <li>Restaurante gourmet</li><br>
            <li>Jacuzzi privativa</li><br>
            <li>Aulas de ioga ao ar livre</li><br>
            <li>Serviço de quarto 24h</li><br>
        </ul>
        <?php if ($logged_in): ?>
        <div class="hotel">
        <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Mirante do Atlântico Resort"> 
    <input type="hidden" name="total_price" value="650.00"> 

    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>
<br><br><br><br>

<section class="hotel">
    <h2>Serra Verde Mountain Retreat</h2>
    <div class="hotel-info">
        <img src="fotos/gramado.jpg" alt="Retiro">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.8 - Excepcional</p>
            <p><strong>Localização:</strong> Gramado, Rio Grande do Sul, Brasil</p>
            <p>Aninhado nas montanhas da Serra Gaúcha, este retiro de luxo oferece tranquilidade e contato com a natureza em meio a florestas exuberantes.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Chalés com lareira</li><br>
            <li>Piscina aquecida</li><br>
            <li>Spa com banhos termais</li><br>
            <li>Degustação de vinhos regionais</li><br>
            <li>Passeios a cavalo</li><br>
            <li>Academia com vista para as montanhas</li><br>
        </ul>
        <?php if ($logged_in): ?>
        <div class="hotel">
            <h1>Reservar quarto do Hotel</h1>
            <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Serra Verde Mountain Retreat"> 
    <input type="hidden" name="total_price" value="800.00"> 

    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>
<br><br><br><br>

<section class="hotel">
    <h2>Oasis Urbano Hotel & Spa</h2>
    <div class="hotel-info">
        <img src="fotos/sp.jpeg" alt="Hotel Urbano">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.0 - Excelente</p>
            <p><strong>Localização:</strong> São Paulo, São Paulo, Brasil</p>
            <p>Localizado no coração de São Paulo, o Oasis Urbano combina modernidade e sofisticação, com um spa de classe mundial e um rooftop bar com vista para a cidade.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Rooftop com piscina</li><br>
            <li>Spa urbano</li><br>
            <li>Bar e restaurante premiado</li><br>
            <li>Salas de reunião modernas</li><br>
            <li>Serviço de concierge</li><br>
            <li>Estacionamento com manobrista</li><br>
        </ul>
        <?php if ($logged_in): ?>
        <div class="hotel">
            <h1>Reservar quarto do Hotel</h1>
            <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Oasis Urbano Hotel & Spa"> 
    <input type="hidden" name="total_price" value="750.00"> 

    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>
<br><br><br><br>

<section class="hotel">
    <h2>Vila Encantada Boutique Hotel</h2>
    <div class="hotel-info">
        <img src="fotos/paraty.jpg" alt="Boutique Hotel">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.5 - Encantador</p>
            <p><strong>Localização:</strong> Paraty, Rio de Janeiro, Brasil</p>
            <p>Este charmoso hotel boutique em Paraty oferece uma experiência única, com arquitetura colonial e suítes exclusivas decoradas com obras de arte locais.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Suítes temáticas</li><br>
            <li>Jardins tropicais</li><br>
            <li>Piscina com borda infinita</li><br>
            <li>Restaurante de cozinha local</li><br>
            <li>Roteiros culturais guiados</li><br>
            <li>Wi-Fi e estacionamento gratuitos</li><br>
        </ul>
        <?php if ($logged_in): ?>
        <div class="hotel">
            <h1>Reservar quarto do Hotel</h1>
            <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Vila Encantada Boutique Hotel"> 
    <input type="hidden" name="total_price" value="500.00">
    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>
<br><br><br><br>

<section class="hotel">
    <h2>Ilha do Sol Beach Resort</h2>
    <div class="hotel-info">
        <img src="fotos/buzios.jpeg" alt="Beach Resort">
        <div class="hotel-details">
            <p><strong>Nota:</strong> 9.7 - Maravilhoso</p>
            <p><strong>Localização:</strong> Búzios, Rio de Janeiro, Brasil</p>
            <p>Com praias privadas e bangalôs luxuosos à beira-mar, o Ilha do Sol Beach Resort é o refúgio ideal para quem busca relaxamento com estilo.</p>
        </div>
    </div>
    <div class="hotel-amenities">
        <h3>Comodidades Populares</h3>
        <ul>
            <li>Praia privada</li><br>
            <li>Bar e restaurante à beira-mar</li><br>
            <li>Atividades aquáticas (caiaque, stand-up paddle)</li><br>
            <li>Spa completo</li><br>
            <li>Serviço de transporte de barco</li><br>
            <li>Clubinho para crianças</li><br>
        </ul>
        <?php if ($logged_in): ?>
        <div class="hotel">
            <h1>Reservar quarto do Hotel</h1>
            <form action="carrinho.php" method="post">
    <input type="hidden" name="hotel_name" value="Ilha do Sol Beach Resort"> 
    <input type="hidden" name="total_price" value="450.00">

    <label for="checkin">Check-in:</label>
    <input type="date" name="checkin" id="checkin" min="<?= date('Y-m-d') ?>" required>

    <label for="checkout">Check-out:</label>
    <input type="date" name="checkout" id="checkout" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <label for="guests">Número de hóspedes:</label>
    <input type="number" name="guests" id="guests" min="1" required>

    <button type="submit">Reservar</button>
</form>
        </div>
        <?php endif; ?>
    </div>
</section>
<br><br><br><br>


<div class="popup" id="loginPopup">
    <div class="popup-content">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Usuário ou Email:</label><br>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
        <button class="close-popup" onclick="closePopup('loginPopup')">Fechar</button>
        <p>Não tem uma conta? <button onclick="openPopup('signupPopup')">Cadastrar-se</button></p>
    </div>
</div>

<div class="popup" id="signupPopup">
    <div class="popup-content">
        <h2>Cadastrar-se</h2>
        <form action="register.php" method="post">
            <label for="username">Nome Completo:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Cadastrar</button>
        </form>
        <button class="close-popup" onclick="closePopup('signupPopup')">Fechar</button>
        <p>Já tem uma conta? <button onclick="openPopup('loginPopup')">Entrar</button></p>
    </div>
</div>

<script>
    // Função para abrir popups
    function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
    }

    // Função para fechar popups
    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }
</script>

    <footer>
        <p>&copy; 2024 Reserva de Hotel</p>
    </footer>

</body>
</html>
