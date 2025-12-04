<?php
class Database {
    private $host     = "localhost";
    private $user     = "root";
    private $password = "";
    private $db_name  = "lab10web";
    public  $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function get($table) {
        $sql = "SELECT * FROM $table";
        return $this->conn->query($sql);
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values  = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }
}
?>