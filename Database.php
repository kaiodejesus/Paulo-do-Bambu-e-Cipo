<?php
class Database {
    private static $driver = 'mysql'; // Defina o tipo do banco de dados (exemplo: MySQL)
    private static $host = 'localhost'; // Endereço do servidor do banco de dados
    private static $dbName = 'cadastro_usuarios'; // Nome do banco de dados
    private static $username = 'root'; // Usuário do banco de dados
    private static $password = 'root'; // Senha do banco de dados
    private static $charset = 'utf8'; // Charset para a conexão
    private static $pdo = null; // Instância de conexão PDO
    private static $error; // Armazenar os erros da conexão

    // Método para obter a conexão com o banco de dados
    public static function getConnection() {
        if (self::$pdo === null) {
            try {
                // Configura o Data Source Name (DSN) para a conexão
                $dsn = self::$driver . ":host=" . self::$host . ";dbname=" . self::$dbName . ";charset=" . self::$charset;

                // Configurações para o PDO
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                // Cria a instância PDO
                self::$pdo = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                // Caso haja erro na conexão
                self::$error = $e->getMessage();
                echo "Erro na conexão com o banco de dados: " . self::$error;
                die();
            }
        }

        // Retorna a instância PDO
        return self::$pdo;
    }

    // Método público para testar a conexão e retornar mensagens
    public static function testConnection()
    {
        try {
            if (self::getConnection()) {
                return "Conexão bem-sucedida!";
            } else {
                return "Erro na conexão: " . self::$error;
            }
        } catch (Exception $e) {
            return "Erro inesperado: " . $e->getMessage();
        }
    }
}
