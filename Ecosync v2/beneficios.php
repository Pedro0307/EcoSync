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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVantagens - EcoSync</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Open+Sans&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos globais e reset */
        body {
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: #f8fcf8;
            color: #2e4d2e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Botão Voltar */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #dcedc8;
            color: #2e7d32;
            border: none;
            border-radius: 10px;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1000;
        }
        .back-btn:hover {
            background: #c5e1a5;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Cabeçalho */
        header {
            background: linear-gradient(135deg, #388e3c, #1b5e20);
            color: #fff;
            text-align: center;
            padding: 40px 20px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        header p {
            margin-top: 8px;
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Grid de Vantagens */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .card-content {
            padding: 20px;
            text-align: center;
            background-color: #e8f5e9;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-content h3 {
            margin: 0;
            color: #1b5e20;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
        }

        /* Rodapé */
        footer {
            background: #1b5e20;
            color: #fff;
            padding: 20px;
            margin-top: auto;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.15);
            text-align: center;
        }

        /* Media Queries para responsividade */
        @media (max-width: 768px) {
            .back-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            header h1 {
                font-size: 2rem;
            }
            header p {
                font-size: 1rem;
            }
            .grid {
                gap: 20px;
                padding: 30px 15px;
            }
        }
    </style>
</head>
<body>
    <a href="painel.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <header>
        <h1>EcoVantagens</h1>
        <p>Descubra empresas que oferecem benefícios para quem recicla</p>
    </header>

    <div class="grid">
        <a class="card" href="https://www.boticario.com.br/boti-recicla" target="_blank">
            <img src="https://placehold.co/500x350/dcedc8/2e4d2e?text=Boti+Recicla" alt="Boti Recicla">
            <div class="card-content"><h3>Boti Recicla – O Boticário</h3></div>
        </a>

        <a class="card" href="https://www.quemdisseberenice.com.br/sustentabilidade" target="_blank">
            <img src="https://placehold.co/500x350/c5e1a5/2e4d2e?text=Quem+Disse+Berenice" alt="Quem Disse Berenice">
            <div class="card-content"><h3>Quem Disse Berenice</h3></div>
        </a>

        <a class="card" href="https://www.natura.com.br/reciclagem" target="_blank">
            <img src="https://placehold.co/500x350/a5d6a7/2e4d2e?text=Natura+Recicla" alt="Natura Reciclagem">
            <div class="card-content"><h3>Natura Recicla</h3></div>
        </a>

        <a class="card" href="https://www.paodeacucar.com/reciclagem" target="_blank">
            <img src="https://placehold.co/500x350/81c784/2e4d2e?text=Pão+de+Açúcar" alt="Pão de Açúcar Reciclagem">
            <div class="card-content"><h3>Pão de Açúcar</h3></div>
        </a>
    </div>

    <footer>
        <p>&copy; 2025 EcoSync. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
