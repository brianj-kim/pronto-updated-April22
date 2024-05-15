<?php
require_once('./.credentials.php');
  class DbConnect {
    
    private $user = USER;
    private $pass = PASS;
    private $dsn = DSN;
    private $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      // PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public function connect() {
      try {
        // $conn = new PDO('mysql:host=' .$this->host .';dbname=' . $this->db, $this->user, $this->pass);
        $conn = new PDO($this->dsn, $this->user, $this->pass, $this->options);
        return $conn;
      } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }
  }
?>
