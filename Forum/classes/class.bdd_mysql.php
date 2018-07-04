<?php
 
class bdd_mysql {
 
    protected $_host;
    protected $_dbname;
    protected $_username;
    protected $_password;
 
    public function __construct($_host, $_dbname, $_username, $_password) {
        $this->_host = $_host;
        $this->_dbname = $_dbname;
        $this->_username = $_username;
        $this->_password = $_password;
    }
 
    public function MaConnexion() {
        $bdd = new PDO('mysql:host='.$this->_host.'; dbname='.$this->_dbname, $this->_username, $this->_password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
 
    public function __destruct()
    {
        // Déconnexion à la base de données
        $bdd = null;
    }
}
 
 
?>
