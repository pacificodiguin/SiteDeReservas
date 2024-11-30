<?php
session_start();
$logged_in = isset($_SESSION['nome']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Restaurante</title>
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

        .header-controls {
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

        .restaurant-amenities ul {
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
        <h1>Reserva 3Irmãos</h1><br>
        <br>
        <h2>Débito</h2>
        <div class="header-controls">
        </form>
            <form action="pagamento.php">
                
               <button onclick="window.location.href='pagamento.php';"> Cancelar </button>
              
               
             
           </form>

           
        </div>
    </header>

    <div class="restaurant">
        <div class="restaurant-info">
        
            <div>
                <h2>Preencha os campos abaixo:</h2>
                <p>realize o pagamento para sua reserva ser concluída</p><br>
                <br>
              
        
        <form action="name" method="name">
            <label for="nome">Escreva O Nome Que Está No Cartão:</label>
            <input type="text" id="texte" name="name"  maxlength="50" required><br>
            <br>
            <label for="number">Numero do Cartão:</label>
            <input type="text" id="text" name="codigo" maxlength="20" required><br>
            <br>
            <label for="number">CCV:</label>
            <input type="text" id="text" name="cvv"  maxlength="3" required><br>
            <br>

            <button onclick="window.location.href='pagamentoconcluido.php';"> Pagar </button>
           
        </form>
       
    
              
            </div>
        </div>
        <div class="restaurant-amenities">
           
    </div>
