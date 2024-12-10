<?php
// Inicia o processo de cadastro se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Usuario.class.php'; // Inclui a classe Usuario

    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];

    // Cria uma nova instância da classe Usuario
    $usuario = new Usuario();
    
    // Configura os dados do usuário
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setNivel($nivel);

    // Chama o método add para inserir o novo usuário
    $resultado = $usuario->add();

    // Verifica se o cadastro foi bem-sucedido
    if ($resultado) {
        // Se o cadastro for bem-sucedido, exibe o alerta e redireciona
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'login.php';</script>";
    } else {
        // Se o cadastro falhar, exibe o alerta e redireciona
        echo "<script>alert('Erro ao cadastrar usuário!'); window.location.href = 'login.php';</script>";
    }
}
?>