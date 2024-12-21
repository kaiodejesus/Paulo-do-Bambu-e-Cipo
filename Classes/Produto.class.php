<?php

class Produto extends CRUD{
    protected $table = "produto";
    private $codigo;
    private $nomeProduto;
    private $descricao;
    private $material;
    private $quantidade;
    private $imagem;

    public function __construct() {
        
    }

   
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;

        return $this;
    }

    
    public function getCodigo()
    {
        return $this->codigo;
    }

    
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    
    public function getDescricao()
    {
        return $this->descricao;
    }

   
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    
    public function getMaterial()
    {
        return $this->material;
    }

    
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    
    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    function add(){
        $sql = "INSERT INTO produto (nomeproduto, descricao, material, quantidade, imagem) 
                VALUES (:nomeProduto, :descricao, :material, :quantidade, :imagem)";

        $stmt = Database::prepare($sql);

        $stmt->bindParam(':nomeProduto', $this->nomeProduto);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':material', $this->material);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':imagem', $this->imagem);

        return $stmt->execute();
    }

    function update($campo, $codigo){
        $sql = "UPDATE $this->table SET nomeproduto=:nomeProduto, descricao=:descricao, material=:material, 
                quantidade=:quantidade, imagem=:imagem WHERE $campo=:codigo";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':nomeProduto', $this->nomeProduto);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':material', $this->material);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
