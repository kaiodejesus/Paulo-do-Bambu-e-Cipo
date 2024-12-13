<?php
session_start();  // Inicia a sessão

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Usuario.class.php';  // Inclui a classe Usuario

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Cria um novo objeto Usuario
    $usuario = new Usuario();

    // Chama o método para autenticar o usuário
    $resultado = $usuario->login($email, $senha);

    if ($resultado) {
        // Se o login for bem-sucedido, redireciona para a página principal
        header("Location: paginaHomee/paginaHome/indexpaulo.php");
        exit();
    } else {
        // Caso o login falhe, exibe uma mensagem de erro
        $erro = "E-mail ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Paulo Bambu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                            <p>Não tem login? <a href="CadUsuarioo.html">Cadastre-se aqui</a></p>
                        </form>

                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $erro; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
