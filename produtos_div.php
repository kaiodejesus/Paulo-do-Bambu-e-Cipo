<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> <!-- Inclui o estilo usado no index -->
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('bambuFundo.jpg');
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

        /* Logo centralizada */
        .logo1 {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .logo1 img {
            width: 120px;
        }

        /* Menu Toggle */
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

        /* Menu */
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
            transition: transform 0.5s ease-in-out; /* Mudança de transição mais suave */
        }

        .nav-menu.active {
            display: block;
            transform: translateX(0); /* O menu vai deslizar para a posição de visibilidade */
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

        main {
            padding-top: 100px;
        }

        #produtos {
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            max-width: 1200px;
            margin: 20px auto;
        }

        #produtos h2 {
            color: #ffdc73;
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .descricao-produtos {
            color: rgb(255, 255, 255);
            font-size: 1.1rem;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-item {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #324a35;
        }

        .product-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        .product-item h3 {
            font-size: 1.2rem;
            margin: 10px 0;
            font-weight: bold;
        }

        .product-item p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 10px;
            line-height: 1.4;
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
                <li><a href="paginaHome/indexpaulo.php">Home</a></li>
                <li><a href="#" class="active">Produtos</a></li>
                <li><a href="sobre.html">Sobre</a></li>
                <li><a href="index.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="produtos">
            <h2>NOSSOS PRODUTOS</h2>
            <p class="descricao-produtos">
                Confira nossa linha de produtos sustentáveis feitos com bambu e cipó, ideais para decorar e mobiliar com
                estilo e responsabilidade ambiental.
            </p>

            <div class="product-grid">
                <?php
                spl_autoload_register(function ($class) {
                    require_once "Classes/{$class}.class.php";
                });
                $produto = new Produto;
                $produtos = $produto->All();
                foreach ($produtos as $umProduto) {
                    ?>
                    <div class="product-item">
                        <img src="imagensProdutos/<?php echo $umProduto->imagem; ?>" alt="<?php echo $umProduto->nomeproduto; ?>" class="product-img">
                        <h3><?php echo $umProduto->nomeproduto; ?></h3>
                        <p><?php echo $umProduto->descricao; ?></p>
                        <p>Material: <?php echo $umProduto->material; ?></p>
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <p>
                                <a href="edtProduto.php?id=<?php echo $umProduto->codigo; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="delete.php" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 PB PAULO DO BAMBU. Todos os direitos reservados.</p>
    </footer>

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
