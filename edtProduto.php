<?php
// Conectando ao banco de dados (substitua os valores conforme necessário)
// $host = 'localhost';
// $dbname = 'produto';
// $username = 'root';  // Seu usuário do MySQL
// $password = '';  // Sua senha do MySQL

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Erro de conexão: " . $e->getMessage());
// }

// // Verifica se existe um produto para editar
// if (isset($_GET['codigo'])) {
//     $codigo = intval($_GET['codigo']);

//     // Buscando o produto pelo código
//     $stmt = $pdo->prepare("SELECT * FROM produto WHERE codigo = :codigo");
//     $stmt->bindParam(':codigo', $codigo);
//     $stmt->execute();
//     $produto = $stmt->fetch(PDO::FETCH_OBJ);
// }

// Processando o formulário para atualizar os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $material = $_POST['material'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_POST['imagemAtual'];  // Mantém a imagem atual, a menos que uma nova seja enviada

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['imagem']['tmp_name'], "imagensProdutos/$nomeImagem");
        $imagem = $nomeImagem;
    }

    // // Atualizando o produto no banco de dados
    // $stmt = $pdo->prepare("UPDATE produto SET nomeproduto = ?, descricao = ?, material = ?, quantidade = ?, imagem = ? WHERE codigo = ?");
    // $stmt->execute([$nomeproduto, $descricao, $material, $quantidade, $imagem, $codigo]);

    // header("Location: produtos_div.php");  // Redireciona para a página de produtos após a atualização
    // exit;
}
?>
<?php
  spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
  });

  // Verifica se existe um aluno para editar
  if (filter_has_var(INPUT_GET,"id")) {
    $prod = new Produto;
    $id = intval(filter_input(INPUT_GET, "id"));
    $produto = $prod->search("codigo",$id); // método para pegar os dados do aluno (implemente-o na classe Aluno)

    // Preenche os campos do formulário com os dados do aluno
  }
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Produto</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #324a35;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="uploads/LOGO-Photoroom (4).png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    IFRO - Cacoal
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produtos_div.php">Produtos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <form action="<?php echo htmlspecialchars("update_produto.php") ?>" method="post" class="row g-3" enctype="multipart/form-data">
            <input type="hidden" name="codigo" value="<?php echo $produto->codigo ?? ''; ?>" />

            <div class="col-12 mb-3">
                <label for="nomeproduto" class="form-label">Nome do Produto</label>
                <input type="text" name="nomeproduto" id="nomeproduto" class="form-control" value="<?php echo $produto->nomeproduto ?? ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $produto->descricao ?? ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label for="material" class="form-label">Material</label>
                <input type="text" name="material" id="material" class="form-control" value="<?php echo $produto->material ?? ''; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="<?php echo $produto->quantidade ?? ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                <?php if (!empty($produto->imagem)): ?>
                    <br>
                    <img src="imagensProdutos/<?php echo $produto->imagem; ?>" alt="Imagem Atual" width="100">
                    <input type="hidden" name="imagemAtual" value="<?php echo $produto->imagem; ?>" />
                <?php endif; ?>
            </div>
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-primary" name="atualizar">
                    Atualizar Produto
                </button>
            </div>
        </form>
    </div>

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
