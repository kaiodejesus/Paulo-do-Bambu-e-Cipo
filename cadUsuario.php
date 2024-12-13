<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Usuario.class.php'; 

    // Coletar os dados do formulário
    $usuarioNome = $_POST['nome']; // Reflete a coluna "usuario" no banco de dados
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nivelAcesso = $_POST['nivel']; // Reflete a coluna "nivel_acesso" no banco de dados

    // Instanciar e configurar o usuário
    $usuario = new Usuario();
    $usuario->setNome($usuarioNome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setNivel($nivelAcesso);

    // Inserir o usuário
    $resultado = $usuario->add();

    // Exibir resultado
    if ($resultado) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário!'); window.location.href = 'index.php';</script>";
    }
}
?>