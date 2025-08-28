<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Rotas Salvas - EcoSync</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4fff4;
        }
        .back-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 1000; /* Garante que o botão fique na frente */
        }
        .back-btn:hover {
            background: #1b5e20;
        }
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 70px; /* espaço pro botão de voltar */
            height: 100%;
            box-sizing: border-box;
        }
        h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }
        .rota {
            background: #fff;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <a href="painel.php" class="back-btn">⬅ Voltar</a>
    <div class="content">
        <h2>Rotas Salvas</h2>
        
        <div class="rota">
            <p><b>Casa</b> → <b>Ponto de Coleta Boa Viagem</b> (4,5 km)</p>
        </div>
        <div class="rota">
            <p><b>Trabalho</b> → <b>Ponto de Coleta Derby</b> (2,3 km)</p>
        </div>
    </div>
</body>
</html>