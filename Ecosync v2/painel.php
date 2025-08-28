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
    <title>Painel - EcoSync</title>
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
        body {
            text-align: center;
        }

        /* Estrutura do layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header (Cabeçalho) */
        header {
            background: linear-gradient(135deg, #388e3c, #1b5e20); /* Gradiente mais vivo */
            color: #fff;
            padding: 25px 20px 40px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
            position: relative;
        }
        header h2 {
            margin: 0;
            font-size: 2.2rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        .user-name {
            color: #c5e1a5;
            font-weight: 700;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            font-size: 1rem;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }
        .logout-btn:hover {
            opacity: 1;
        }

        /* Botões de navegação */
        .btn-container {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #dcedc8;
            color: #2e7d32;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            min-width: 150px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .btn:hover {
            background: #c5e1a5;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Conteúdo principal e seções */
        main {
            flex: 1;
        }
        section {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
            text-align: justify;
        }
        section h3 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 20px;
            font-size: 2rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        .about-us-text {
            background-color: #f2f7f2;
            padding: 30px;
            border-radius: 12px;
            box-shadow: inset 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        .about-us-text p {
            margin-bottom: 1.5rem;
            text-align: justify;
            text-indent: 1.5em;
        }

        /* Cards de funcionalidade */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            line-height: 1.4;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        .card h4 {
            margin-top: 0;
            color: #1b5e20;
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
        }
        .card p {
            margin: 0;
            font-size: 0.95rem;
            color: #555;
        }
        .card .icon {
            font-size: 3.5rem;
            color: #2e7d32;
            margin-bottom: 15px;
        }

        /* Footer (Rodapé) */
        footer {
            background: #1b5e20;
            color: #fff;
            padding: 20px;
            margin-top: auto;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.15);
        }

        /* Media Queries para responsividade */
        @media (max-width: 768px) {
            header h2 {
                font-size: 1.6rem;
            }
            .logout-btn {
                font-size: 0.85rem;
            }
            .btn {
                padding: 10px 18px;
                font-size: 0.9rem;
            }
            section {
                margin: 30px auto;
            }
            section h3 {
                font-size: 1.75rem;
            }
            .card .icon {
                font-size: 3rem;
            }
            .card h4 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h2>Bem-vindo, <span class="user-name"><?php echo $_SESSION['usuario']; ?></span>!</h2>
        <a href="logout.php" class="logout-btn">Sair</a>
        
        <div class="btn-container">
            <a href="maps.php" class="btn"><i class="fas fa-map-marked-alt"></i> Mapas</a>
            <a href="rota.php" class="btn"><i class="fas fa-route"></i> Rotas Salvas</a>
            <a href="beneficios.php" class="btn"><i class="fas fa-medal"></i> Benefícios</a>
            <a href="trocas.php" class="btn"><i class="fas fa-sync-alt"></i> Trocas</a>
        </div>
    </header>

    <main>
        <section>
            <h3>Sobre Nós</h3>
            <div class="about-us-text">
                <p>
                    Nosso objetivo é promover soluções inovadoras para um mundo mais verde, unindo tecnologia de ponta e práticas sustentáveis. 
                    Acreditamos que a transformação para um futuro melhor depende da integração entre inovação, consciência ambiental e responsabilidade social. 
                </p>
                <p>
                    Por isso, desenvolvemos projetos que aliam eficiência tecnológica à preservação dos recursos naturais, incentivando empresas e pessoas a adotarem hábitos mais ecológicos. 
                    Nossa missão é contribuir para uma sociedade mais equilibrada, onde progresso e sustentabilidade caminhem lado a lado, garantindo qualidade de vida para as presentes e futuras gerações.
                </p>
            </div>
        </section>

        <section>
            <h3>Funcionalidades</h3>
            <div class="card-grid">
                <div class="card">
                    <div class="icon"><i class="fas fa-route"></i></div>
                    <h4>Rotas Salvas</h4>
                    <p>Salve suas rotas para acessá-las rapidamente sempre que precisar.</p>
                </div>
                <div class="card">
                    <div class="icon"><i class="fas fa-sync-alt"></i></div>
                    <h4>Trocas</h4>
                    <p>Troque seus materiais recicláveis por dinheiro ou outros produtos em nossos pontos de coleta.</p>
                </div>
                <div class="card">
                    <div class="icon"><i class="fas fa-map-pin"></i></div>
                    <h4>Mapas</h4>
                    <p>Encontre os pontos de coleta mais próximos de você e planeje suas rotas de descarte de forma eficiente.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 EcoSync. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
