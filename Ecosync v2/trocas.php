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
    <title>Trocas - EcoSync</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Open+Sans&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos globais e reset */
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: #f8fcf8; /* Fundo mais claro e suave */
            color: #2e4d2e;
            line-height: 1.6;
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
        }
        .back-btn:hover {
            background: #c5e1a5;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Cabeçalho */
        header {
            background: linear-gradient(135deg, #388e3c, #1b5e20); /* Gradiente mais vivo */
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

        /* Conteúdo principal */
        main {
            flex: 1;
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }
        main h2 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 20px;
            font-size: 2rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        /* Tabela de valores */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px; /* Espaço entre as linhas */
            margin: 20px 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
        }
        table th, table td {
            padding: 15px;
            text-align: center;
        }
        table th {
            background: #388e3c;
            color: #fff;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }
        table tr {
            transition: background-color 0.2s ease;
        }
        table tr:nth-child(even) {
            background: #f0f8f0;
        }
        table tr:hover {
            background: #c5e1a5;
        }
        table tr:first-child th:first-child {
            border-top-left-radius: 15px;
        }
        table tr:first-child th:last-child {
            border-top-right-radius: 15px;
        }
        table tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }
        table tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        /* Seção de opções */
        .options {
            margin-top: 40px;
            background: #f2f7f2;
            padding: 30px;
            border-radius: 15px;
            box-shadow: inset 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        .options h2 {
            margin-top: 0;
        }
        .options label {
            font-weight: bold;
            color: #1b5e20;
            margin-right: 5px;
        }
        select, input[type="number"] {
            padding: 12px;
            margin: 10px;
            border-radius: 10px;
            border: 2px solid #a5d6a7;
            font-size: 1rem;
            color: #2e4d2e;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            outline: none;
            background-color: #fff;
        }
        select:focus, input[type="number"]:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 3px rgba(56, 142, 60, 0.2);
        }
        .options button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #388e3c;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            font-size: 1.05rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin: 10px;
        }
        .options button:hover {
            background: #1b5e20;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .result {
            margin-top: 25px;
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            color: #1b5e20;
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
            main h2 {
                font-size: 1.75rem;
            }
            .options {
                padding: 20px;
            }
            .options button {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <a href="painel.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>

    <header>
        <h1>Trocas de Materiais</h1>
        <p>Troque recicláveis por dinheiro ou outros materiais</p>
    </header>

    <main>
        <h2>Tabela de Valores (preço médio por kg)</h2>
        <table>
            <tr>
                <th>Material</th>
                <th>Preço Médio (R$/kg)</th>
            </tr>
            <tr><td>Alumínio</td><td>R$ 6,50</td></tr>
            <tr><td>Cobre</td><td>R$ 25,00</td></tr>
            <tr><td>Ferro</td><td>R$ 0,50</td></tr>
            <tr><td>Papelão</td><td>R$ 0,30</td></tr>
            <tr><td>Plástico PET</td><td>R$ 2,00</td></tr>
            <tr><td>Vidro</td><td>R$ 0,20</td></tr>
        </table>

        <div class="options">
            <h2>Simule sua troca</h2>
            <label>Material:</label>
            <select id="material">
                <option value="6.5">Alumínio</option>
                <option value="25">Cobre</option>
                <option value="0.5">Ferro</option>
                <option value="0.3">Papelão</option>
                <option value="2">Plástico PET</option>
                <option value="0.2">Vidro</option>
            </select>

            <label>Peso (kg):</label>
            <input type="number" id="peso" min="0.1" step="0.1">

            <br>
            <button onclick="calcularValor()">💰 Trocar por Dinheiro</button>
            <button onclick="trocarMaterial()">🔄 Trocar por Outro Material</button>

            <div class="result" id="resultado"></div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 EcoSync. Todos os direitos reservados.</p>
    </footer>

    <script>
        function calcularValor() {
            const preco = parseFloat(document.getElementById('material').value);
            const peso = parseFloat(document.getElementById('peso').value);

            if (isNaN(peso) || peso <= 0) {
                document.getElementById('resultado').textContent = "Digite um peso válido!";
                return;
            }

            const valor = preco * peso;
            document.getElementById('resultado').textContent = `Valor estimado: R$ ${valor.toFixed(2).replace('.', ',')}`;
        }

        function trocarMaterial() {
            const peso = parseFloat(document.getElementById('peso').value);
            if (isNaN(peso) || peso <= 0) {
                document.getElementById('resultado').textContent = "Digite um peso válido!";
                return;
            }
            document.getElementById('resultado').textContent =
                "Você pode trocar esse material por outro de valor equivalente!";
        }
    </script>
</body>
</html>
