<?php
class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "musicsite";
    public $conn;

    // Connect to the database
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // SELECT: fetch all or by condition
    public function select($query) {
        $result = $this->conn->query($query);
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    // INSERT: single row
    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_map([$this->conn, 'real_escape_string'], array_values($data)));
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        try{
            $res=$this->conn->query($sql);
           if (!$res) {
                throw new Exception("Query failed: " . $mysqli->error);
            }
            return $this->conn->insert_id;
        }catch(mysqli_sql_exception $e){
            return 0;
        }
            
    }

    // UPDATE: with simple WHERE clause
    public function update($table, $data, $where) {
        $updates = [];
        foreach ($data as $key => $value) {
            $value = $this->conn->real_escape_string($value);
            $updates[] = "$key = '$value'";
        }
        $updateStr = implode(", ", $updates);
        $sql = "UPDATE $table SET $updateStr WHERE $where";
        return $this->conn->query($sql);
    }
    // UPDATE: with simple WHERE clause
    public function delete($table, $where) {
        $sql = "DELETE from $table WHERE $where";
        return $this->conn->query($sql);
    }

    // Close connection
    public function close() {
        $this->conn->close();
    }
}

$db=new DB();
?>