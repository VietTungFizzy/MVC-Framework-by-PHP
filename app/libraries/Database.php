<?php
class Database
{
    // property declaration
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    // method declaration

    /**
     * Instantiate database connection
     */
    public function __construct() {
        $conn = 'mysql:host='.$this->dbHost.';dbname='.$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Prepare statements
     * 
     * @param string
     */
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    /**
     * Bind parameters
     * 
     * @param parameter mixed, value mixed, type mixed
     */
    public function bind($parameter, $value, $type = NULL) {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->PDOStatement::bindParam ($parameter ,$value ,$type);
    }

    /**
     * Execute query
     * 
     * @return bool
     */
    public function execute() {
        return $this->statement->execute();
    }

    /**
     * Return result
     * 
     * @return array of Objects
     */
    public function resultSet() {
        return $this->statement->fetchAll(PDO::FETCH_OBJ) ;
    }

    /**
     * Return a specific row as an object
     * 
     * @return Object
     */
    public function resultSing() {
        return $this->statement->fetch(PDO::FETCH_OBJ) ;
    }

    /**
     * Get row count
     * 
     * @return integer
     */
    public function rowCount() {
        return $this->statement->rowCount() ;
    }
}
?>
