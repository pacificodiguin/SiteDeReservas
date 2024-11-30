document.addEventListener('DOMContentLoaded', function () {
    // Função para configurar o modal de reserva e login
    function setupReservationAndModal(reservationFormId, modalId, closeModalClass, loginFormId, messageId) {
        const reservationForm = document.getElementById(reservationFormId);
        const loginModal = document.getElementById(modalId);
        const closeModal = loginModal.querySelector(closeModalClass);
        const loginForm = document.getElementById(loginFormId);
        let isLoggedIn = false; // Estado para verificar se o usuário está logado

        // Quando o botão de reserva for clicado
        reservationForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar que o formulário seja enviado imediatamente

            if (!isLoggedIn) {
                // Exibe o modal de login se o usuário não estiver logado
                loginModal.style.display = 'flex';
            } else {
                // Se o usuário já estiver logado, prosseguir com a reserva
                document.getElementById(messageId).textContent = 'Reserva confirmada!';
            }
        });

        // Fechar o modal de login
        closeModal.addEventListener('click', function () {
            loginModal.style.display = 'none';
        });

        // Quando o formulário de login for enviado
        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const name = loginForm.querySelector('input[type="text"]').value;
            const email = loginForm.querySelector('input[type="email"]').value;
            const password = loginForm.querySelector('input[type="password"]').value;

            if (name && email && password) {
                isLoggedIn = true; // Considerar que o login foi bem-sucedido
                loginModal.style.display = 'none'; // Fechar o modal
                document.getElementById(messageId).textContent = 'Login bem-sucedido. Reserva confirmada!';
            }
        });

        // Fechar o modal ao clicar fora dele
        window.onclick = function (event) {
            if (event.target === loginModal) {
                loginModal.style.display = 'none';
            }
        };
    }

    // Configurar o modal e a reserva para o Restaurante Sabor do Mar
    setupReservationAndModal('reservation-form1', 'loginModal1', '.close', 'login-form1', 'message1');

    // Configurar o modal e a reserva para o Restaurante Vila Gourmet
    setupReservationAndModal('reservation-form2', 'loginModal2', '.close', 'login-form2', 'message2');

    // Configurar o modal e a reserva para o Restaurante Sabores do Campo
    setupReservationAndModal('reservation-form3', 'loginModal3', '.close', 'login-form3', 'message3');
});
