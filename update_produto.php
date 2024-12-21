<?php


if (filter_has_var(INPUT_POST, "atualizar")) {
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
      });
    $diretorio = 'imagensProdutos/';
    $produto = new Produto;
    $produto->setNomeProduto(filter_input(INPUT_POST, 'nomeproduto'));
    $produto->setDescricao(filter_input(INPUT_POST, 'descricao'));
    $produto->setMaterial(filter_input(INPUT_POST, 'material'));
    $produto->setQuantidade(filter_input(INPUT_POST, 'quantidade'));
    $fotoAtual = filter_input(INPUT_POST, 'imagemAtual');
    $produto->setImagem($fotoAtual);
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }
    if (isset($_FILES['imagem'] )&& $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $arquivo = $_FILES['imagem'];
        
        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = $diretorio . $nomeArquivo;
        
        if (file_exists($diretorio . $fotoAtual)) {
            unlink($diretorio . $fotoAtual); // Apaga a foto antiga
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            die("Erro ao mover o arquivo.");
        }
        $aluno->setFoto($nomeArquivo);
    }



    // Atualiza aluno
    $id = intval(filter_input(INPUT_POST, 'codigo'));
    if($produto->update("codigo", $id )){  
        echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='produtos_div.php';</script>";

    }else{
        echo "<script>window.alert('Atualizado com sucesso.'); window.open(document.referrer,'_self');</script>";
    }
}
