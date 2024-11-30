<?php
session_start();
$logged_in = isset($_SESSION['nome']);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Restaurantes</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #003366;
    }

    header {
        color: white;
    font-family:'Montserrat', sans-serif;
    background-color: #002244;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
    }
    .header-controls{
        align-items: center;
    }
    
    h1 {
        margin: 0;
    }

    .restaurant {
        background: #fff;
        margin: 20px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .restaurant-info {
        display: flex;
        align-items: center;
    }
    .restaurant-amenities ul{
        padding: 20px;
    margin: 20px auto;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .restaurant-info img {
        width: 300px;
        height: auto;
        margin-right: 20px;
    }

    .reservation {
        padding: 20px;
        background-color: white;
        margin: 20px auto;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    button {
        padding: 10px 15px;
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

    .success-message {
        color: black;
        margin-top: 10px;
        display: none; 
    }

    footer {
    text-align: center;
    padding: 10px 0;
    background: #002244;
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
}

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
    }

    .close {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
        font-size: 24px;
    }
    
</style>
</head>
<body>
    <header>
        <h1>3Irmãos</h1>
        <h1>Reserva de Restaurantes</h1>
        
        <div class="header-controls">
            <input type="text" placeholder="Buscar restaurantes" name="Buscar restaurantes" id="Reserva">
            <button>Buscar</button>
            <br>
        </div>
           <?php if (!$logged_in): ?>
            <br>
        <button class="login-button" onclick="openPopup('loginPopup')">Login</button>
    <?php else: ?>
        <br>
        <p>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']); ?>!</p>
        <a href="logout.php" class="login-button">Sair</a>
    <?php endif; ?>
    </header>

<div class="popup" id="loginPopup">
    <div class="popup-content">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="nome">Usuário ou Email:</label>
            <input type="text" id="nome" name="nome" required><br>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
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
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
        <button class="close-popup" onclick="closePopup('signupPopup')">Fechar</button>
        <p>Já tem uma conta? <button onclick="openPopup('loginPopup')">Entrar</button></p>
    </div>
</div>

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

<script>

    function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }
</script>

    <section class="restaurant">
        <h2>Point da Picanha</h2>
        <div class="restaurant-info">
            <img src="fotos (1)\pointp.jpg" alt="point da icanha">
            <div class="restaurant-details">
                <p><strong>Nota:</strong> 9.4 - Extraordinário</p>
                <p><strong>Localização:</strong> Castanhal, Para, Brasil</p>
                <p>Este restaurante oferece pratos e churrasco deliciosos e uma vista deslumbrante da praça do estrela.</p>
            </div>
        </div>
        <div class="restaurant-amenities">
            <h3>Comodidades Populares</h3>
            <ul>
                <li>Variedade de espetos</li><br>
                <li>Vista para a esbelta praça do estrela</li><br>
                <li>Ambiente familiar</li><br>
                <li>Wi-Fi gratuito</li><br>
                <li>Estacionamento</li><br>
            </ul>
        </div>
         
<?php if ($logged_in): ?>
        <section class="reservation">
            <h3>Reservar Mesa</h3>
            <form id="reservation-form1">
                <label for="data">Data da Reserva:</label>
                <input type="date" id="data1" name="data" required>

                <label for="hora">Hora da Reserva:</label>
                <input type="time" id="hora1" name="hora" required>

                <label for="pessoas">Número de Pessoas:</label>
                <select id="pessoas1" name="pessoas" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

                
            </form>
            <form action="pagamento.php">
                <br>
               <button onclick="window.location.href='pagamento.php';"> Reservar </button>
               <div class="success-message" id="message1">Reserva confirmada!</div>
               
             
           </form>
            <?php endif; ?>
        </section>
    </section>

    <section class="restaurant">
        <h2>Restaurante rouxinol</h2>
        <div class="restaurant-info">
            <img src="fotos (1)\rouxinol.jpg" alt="Restaurante Vila Gourmet">
            <div class="restaurant-details">
                <p><strong>Nota:</strong> 9.6 - Excepcional</p>
                <p><strong>Localização:</strong> rouxinol, Castanhal, Para, Brasil</p>
                <p>Uma experiência gastronômica com ingredientes locais e uma leve adrenalina para chegar ao local.</p>
            </div>
        </div>
        <div class="restaurant-amenities">
            <h3>Comodidades Populares</h3>
            <ul>
                <li>passa a sensação de um filme de ação</li><br>
                <li>Ambiente rústico e acolhedor</li><br>
                <li>Eventos gastronômicos</li><br>
                <li>Wi-Fi gratuito</li><br>
            </ul>
        </div>

        <?php if ($logged_in): ?>
        <section class="reservation">
            <h3>Reservar Mesa</h3>
            <form id="reservation-form1">

                <label for="data">Data da Reserva:</label>
                <input type="date" id="data1" name="data" required>

                <label for="hora">Hora da Reserva:</label>
                <input type="time" id="hora1" name="hora" required>

                <label for="pessoas">Número de Pessoas:</label>
                <select id="pessoas1" name="pessoas" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

            </form>
            <form action="pagamento.php"><br>
               <button onclick="window.location.href='pagamento.php';"> Reservar </button>
               <div class="success-message" id="message1">Reserva confirmada!</div>
               
             
           </form>
            <?php endif; ?>
        </section>
    </section>

    <section class="restaurant">
        <h2>Restaurante Sabores do Papuquara</h2>
        <div class="restaurant-info">
            <img src="fotos (1)\papu.jpg" alt="Restaurante Sabores do Campo">
            <div class="restaurant-details">
                <p><strong>Nota:</strong> 9.3 - Fantástico</p>
                <p><strong>Localização:</strong> papuquara, Castanhal, Para, Brasil</p>
                <p>Um restaurante que oferece pratos típicos da culinária do fim do mundo em um ambiente acolhedor.</p>
            </div>
        </div>
        <div class="restaurant-amenities">
            <h3>Comodidades Populares</h3>
            <ul>
                <li>Churrasco gaúcho</li><br>
                <li>som automotivo</li><br>
                <li>Opções vegetarianas</li><br>
                <li>igarape</li><br>
            </ul>
        </div>

        <?php if ($logged_in): ?>
       <section class="reservation">
        <h3>Reservar Mesa</h3>
        <form id="reservation-form1">

            <label for="data">Data da Reserva:</label>
            <input type="date" id="data1" name="data" required>

            <label for="hora">Hora da Reserva:</label>
            <input type="time" id="hora1" name="hora" required>

            <label for="pessoas">Número de Pessoas:</label>
            <select id="pessoas1" name="pessoas" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </form>
        <form action="pagamento.php"><br>
               <button onclick="window.location.href='pagamento.php';"> Reservar </button>
               <div class="success-message" id="message1">Reserva confirmada!</div>
               
             
           </form>
        <?php endif; ?>
    </section>
</section>

    <div id="loginModal1" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="loginModal1">&times;</span>
            <h2>Login</h2>
            <form id="login-form1">
                <label for="name1">Nome</label>
                <input type="text" id="name1" required><br><br>
                <label for="email1">Email</label>
                <input type="email" id="email1" required><br><br>
                <label for="password1">Senha</label>
                <input type="password" id="password1" required><br><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>

    <div id="loginModal2" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="loginModal2">&times;</span>
            <h2>Login</h2>
            <form id="login-form2">
                <label for="name2">Nome</label>
                <input type="text" id="name2" required><br><br>
                <label for="email2">Email</label>
                <input type="email" id="email2" required><br><br>
                <label for="password2">Senha</label>
                <input type="password" id="password2" required><br><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>

    <div id="loginModal3" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="loginModal3">&times;</span>
            <h2>Login</h2>
            <form id="login-form3">
                <label for="name3">Nome</label>
                <input type="text" id="name3" required><br><br>
                <label for="email3">Email</label>
                <input type="email" id="email3" required><br><br>
                <label for="password3">Senha</label>
                <input type="password" id="password3" required><br><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>

    <script >
            document.addEventListener('DOMContentLoaded', function () {
            function setupReservationAndModal(reservationFormId, modalId, closeModalClass, loginFormId, messageId) {
                const reservationForm = document.getElementById(reservationFormId);
                const loginModal = document.getElementById(modalId);
                const closeModal = loginModal.querySelector(closeModalClass);
                const loginForm = document.getElementById(loginFormId);
                let isLoggedIn = false;

                reservationForm.addEventListener('submit', function (event) {
                    event.preventDefault();

                    if (!isLoggedIn) {
                        loginModal.style.display = 'flex';
                    } else {
                        document.getElementById(messageId).style.display = 'block';
                    }
                });

                closeModal.addEventListener('click', function () {
                    loginModal.style.display = 'none';
                });

                loginForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    isLoggedIn = true; 
                    loginModal.style.display = 'none';
                    document.getElementById(messageId).style.display = 'block'; 
                });

                window.onclick = function (event) {
                    if (event.target === loginModal) {
                        loginModal.style.display = 'none';
                    }
                };
            }

            setupReservationAndModal('reservation-form1', 'loginModal1', '.close', 'login-form1', 'message1');
        });
    </script>
    <footer>
        <p>&copy; 2024 Reserva de Restaurantes tres irmaos
        </p>
    </footer>
</body>

</html>
