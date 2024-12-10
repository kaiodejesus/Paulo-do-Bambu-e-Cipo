<?php
class Usuario {
    private $id;
    private $usuario;
    private $senha;
    private $email;
    private $nivel_acesso;

    
    public function __construct($usuario, $senha, $email, $nivel_acesso) {
        $this->usuario = $usuario;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
        $this->email = $email;
        $this->nivel_acesso = $nivel_acesso;
    }

    // Métodos GET e SET
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNivelAcesso() {
        return $this->nivel_acesso;
    }

    public function setNivelAcesso($nivel_acesso) {
        $this->nivel_acesso = $nivel_acesso;
    }

    // Método para adicionar ao banco de dados
    public function add($conn) {
        $sql = "INSERT INTO usuarios (usuario, senha, email, nivel_acesso) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $this->usuario, $this->senha, $this->email, $this->nivel_acesso);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>