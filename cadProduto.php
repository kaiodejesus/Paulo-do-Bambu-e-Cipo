<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Paulo Bambu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image: url('bambu3.jpg'); /* Caminho para a imagem de fundo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: linear-gradient(0deg, #016924, #011407);
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo1 {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .logo1 img {
            width: 150px;
        }

        .menu-toggle {
            font-size: 30px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            z-index: 1100;
            transition: all 0.3s ease;
            position: absolute;
            left: 15px;
        }

        .menu-toggle .bar {
            display: block;
            width: 30px;
            height: 4px;
            background-color: white;
            margin: 6px 0;
            transition: all 0.3s ease;
        }

        .menu-toggle.active .bar1 {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .menu-toggle.active .bar2 {
            opacity: 0;
        }

        .menu-toggle.active .bar3 {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .nav-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #054705;
            padding-top: 60px;
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.5s ease-in-out;
        }

        .nav-menu.active {
            display: block;
            transform: translateX(0);
        }

        .nav-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-menu ul li {
            margin: 20px 0;
        }

        .nav-menu ul li a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            font-size: 18px;
            transition: 0.3s;
        }

        .nav-menu ul li a:hover {
            background-color: #09001d;
            padding-left: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 150px auto 20px; /* Adiciona mais margem superior para espaçamento */
            padding: 20px;
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .container img {
            max-width: 300px;
            margin-right: 20px;
            border-radius: 10px;
        }

        .history {
            flex: 1;
        }

        .history h2 {
            margin-bottom: 20px;
            color: #016924;
            font-size: 2rem;
        }

        .history p {
            margin: 10px 0;
            line-height: 1.6;
            color: #333;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <header>
        <button class="menu-toggle" id="menuToggle">
            <span class="bar bar1"></span>
            <span class="bar bar2"></span>
            <span class="bar bar3"></span>
        </button>
        <div class="logo1">
            <img src="lg.png" alt="Logo">
        </div>
        <nav class="nav-menu" id="navMenu">
            <ul>
                <li><a href="../indexpaulo.php">Home</a></li>
                <li><a href="../produtos_div.php">Produtos</a></li>
                <li><a href="../sobre.html" class="active">Sobre</a></li>
                <li><a href="../index.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="container">
            <img src="paulo.jpeg" alt="Paulo do Bambu">
            <div class="history">
                <h2>A História de Paulo Bambu</h2>
                <p>
                    A minha história com o artesanato começou por volta de 2010, quando eu estava na sala de espera de um consultório dentista, observei sobre a mesa que havia um vaso muito lindo, onde imaginei como ele ficaria feito de bambu, aguçando minha curiosidade e minha imaginação. O que também me influenciou muito foi uma pequena decoração simples de bambu, que foi deixada no sítio onde eu trabalhava. Aquilo me fez querer aperfeiçoá-la ou mudar seu formato. Meus colegas tentaram refazê-la, mas não conseguiram. Quando tentei, logo consegui.
                </p>
                <p>
                    Então comecei a inventar outras delas e a cada novo modelo que fazia, recebia sempre mais elogios das pessoas ao meu redor. Com esses elogios, percebi minha autoestima aumentando, me fazendo permanecer cada vez mais no artesanato. Tirei a minha carteira de artesão no ano de 2016, sendo reconhecido e podendo participar de algumas instituições e feiras locais, me profissionalizando e criando mais experiências.
                </p>
                <p>
                    Com isso, tive oportunidade de vender maiores conjuntos dos meus artesanatos, então vi a necessidade de abrir um CNPJ no ano de 2021 para vendas mais seguras e emissões de notas fiscais para meus clientes. O artesanato hoje me traz alegria e alívio, aumentando cada vez mais minha autoestima e minha criatividade, e pretendo sempre continuar inovando nas minhas criações.
                </p>
            </div>
        </section>
    </main>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const menuToggle = document.getElementById("menuToggle");
            const navMenu = document.getElementById("navMenu");

            menuToggle.addEventListener("click", () => {
                navMenu.classList.toggle("active");
                menuToggle.classList.toggle("active");
            });
        });
    </script>
</body>
</html>