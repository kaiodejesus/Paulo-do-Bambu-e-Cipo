<?php
require_once 'Database.php';  // Importa a classe Database
require_once 'CRUD.php';  // Importa a classe Database

class Usuario extends CRUD {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivel;

    // Construtor para inicializar o PDO e o nome da tabela 'usuarios'
    public function __construct() {
        $pdo = Database::getConnection(); // Obtém a conexão com o banco
        parent::__construct($pdo, 'usuarios');  // Passa o PDO e o nome da tabela 'usuarios'
    }

    // Métodos set e get para os atributos
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNivel() {
        return $this->nivel;
    }

    // Implementação do método add (adicionar um novo usuário)
    public function add() {
        try {
            // Verifica se o email já existe
            $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $emailExistente = $stmt->fetchColumn();
            
            if ($emailExistente > 0) {
                return false; // Email já cadastrado
            }
            // Criptografa a senha
            $senhaCriptografada = password_hash($this->senha, PASSWORD_DEFAULT);
            
            // Insere o novo usuário na tabela
            $sql = "INSERT INTO " . $this->table . " (usuario, email, senha, nivel_acesso) VALUES (:nome, :email, :senha, :nivel)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->bindParam(':nivel', $this->nivel);
           
           
            return $stmt->execute(); // Retorna true se a inserção foi bem-sucedida
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir usuário: " . $e->getMessage());
        }
    }
    public function login($email, $senha) {
        try {
            // Busca o usuário pelo email
            $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Recupera o usuário encontrado
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha está correta
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Se o login for bem-sucedido, armazena as informações do usuário na sessão
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['usuario'];
                $_SESSION['usuario_nivel'] = $usuario['nivel'];

                return true; // Login bem-sucedido
            } else {
                return false; // E-mail ou senha inválidos
            }
        } catch (PDOException $e) {
            throw new Exception("Erro ao autenticar o usuário: " . $e->getMessage());
        }
    }

    // Implementação do método update (atualizar um usuário)
    public function update($field, $id, $value) {
        try {
            $sql = "UPDATE " . $this->table . " SET " . $field . " = :value WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':id', $id);

            return $stmt->execute(); // Retorna true se a atualização foi bem-sucedida
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }
}
?>
