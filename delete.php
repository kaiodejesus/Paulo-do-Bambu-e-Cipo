<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Novo Produto</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #324a35;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="uploads/LOGO-Photoroom (4).png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          IFRO - Cacoal</a>
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
<?php
class Produto {
    private $conexao;

    public function __construct($host, $user, $password, $database) {
        $this->conexao = new mysqli($host, $user, $password, $database);

        if ($this->conexao->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function deletarPorNome($nomeproduto) {
        $sql = "DELETE FROM produto WHERE nomeproduto = ?";
        $stmt = $this->conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $nomeproduto);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<h1>Produto excluído com sucesso!</h1>";
                header("refresh:3;url=produtos_div.php");
            } else {
                echo "<h1>Nenhum produto encontrado com o nome informado.</h1>";
            }

            $stmt->close();
        } else {
            echo "<h1>Erro ao preparar a consulta SQL: " . $this->conexao->error . "</h1>";
        }
    }

    public function __destruct() {
        $this->conexao->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Deletar Produto</title>
</head>
<body>
    <h1>Deletar Produto</h1>
    <form action="" method="post">
        <label for="nomeproduto">Nome do Produto:</label>
        <input type="text" name="nomeproduto" id="nomeproduto" required>
        <br><br>
        <button type="submit">Deletar Produto</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nomeproduto'])) {
        $host = "localhost";
        $user = "root";
        $password = "root"; 
        $database = "produto";

        $produto = new Produto($host, $user, $password, $database);

        $nomeproduto = $_POST['nomeproduto']; 
        $produto->deletarPorNome($nomeproduto);
    }
    ?>
</body>
</html>

    
