<?php
class User
{
    // property declaration
    private $db;

    // method declaration
    public function __construct() {
        $this->db = new Database;
    }
    
    public function getUsers() {
        
        //$this->db->query("SELECT * FROM users"); ==> This is test
        
        $this->db->execute();
        $result = $this->db->resultSet();
        return $result;
    }
}
?>
