<?php
abstract class CRUD {
    protected $pdo;
    protected $table;

    
    public function __construct($pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    
    abstract public function add();

   
    abstract public function update($field, $id, $value);

   
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
