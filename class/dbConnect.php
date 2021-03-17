<?php //single ton pattern using instance to intanciate a static method for only one connection.
class dbConnect
{
    public $db;
    private static $_instance = null;
    private $_pdo, $_query, $_result, $_error = false, $_count = 0;

    private function _construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/dbname'), Config::get(mysql / username), Config::get(mysql / password));
            echo 'Connected';
        } catch (PDOException $e) {
            die($e->getMessage("Error: "));
        }
    }

    public static function getInstance()
    {   //set instance of db for reconnecting again ana again
        if (!isset(self::$_instance)) {
            self::$_instance = new dbConnect();
        }
        return self::$_instance;
    }
    public function query($sql, $params = array())
    {
        $this->error = false;
        if ($this->_query = $this->pdo->prepare($sql)) {    //perapares sql query || prevent sql inj
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {   //binds value from db
                    $this->_query->bindvalue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {     //checks if executed and stores to result set.
                $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->_result = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }
    public function error()
    {
        return $this->_error;
    }
    public function dbConnect()
    {
        $db = new mysqli('localhost', 'root', '', 'vmsys');
        if (mysqli_connect_errno()) {
            echo "Failed to connect database: " . mysqli_connect_error();
        }
        return $db;
    }
}

$db = new mysqli('localhost', 'root', '', 'vmsys');
if (mysqli_connect_errno()) {
    echo "Failed to connect database: " . mysqli_connect_error();
}
