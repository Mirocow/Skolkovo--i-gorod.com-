<?php
class mysqlConnection implements IConnection {private $host  = null;private $username = null;private $password = null;private $dbname  = null;private $port  = false;private $persistent = false;private $critical   = true;private $conn  = null;private $queryCache = array();private $isOpen     = false;public function __construct($v67b3dba8bc6778101892eb77249db32e, $vd56b699830e77ba53855679cb1d252da, $v5f4dcc3b5aa765d61d8327deb882cf99, $v4cd4a49f25984e26fe708c1fbd896653, $v901555fb06e346cb065ceb9808dcfc25 = false, $v23c6323bfb57bb630b8a2ecf703d6bb0 = false, $v7e85bcb66fb9a809d5ab4f62a8b8bea8 = true) {$this->host       = $v67b3dba8bc6778101892eb77249db32e;$this->username   = $vd56b699830e77ba53855679cb1d252da;$this->password   = $v5f4dcc3b5aa765d61d8327deb882cf99;$this->dbname     = $v4cd4a49f25984e26fe708c1fbd896653;$this->port       = $v901555fb06e346cb065ceb9808dcfc25;$this->persistent = $v23c6323bfb57bb630b8a2ecf703d6bb0;$this->critical   = $v7e85bcb66fb9a809d5ab4f62a8b8bea8;}public function open() {if($this->isOpen) return true;try {$vcf1e8c14e54505f60aa10ceb8d5d8ab3 = $this->host . ($this->port ? ':' . $this->port : '');if($this->persistent) {$this->conn = mysql_pconnect($vcf1e8c14e54505f60aa10ceb8d5d8ab3, $this->username, $this->password);}else {$this->conn = mysql_connect($vcf1e8c14e54505f60aa10ceb8d5d8ab3, $this->username, $this->password);}if($this->errorOccured()) throw new Exception();if(!mysql_select_db($this->dbname, $this->conn)) throw new Exception();mysql_query("SET NAMES utf8_general_ci", $this->conn);mysql_query("SET CHARSET utf8", $this->conn);mysql_query("SET CHARACTER SET utf8", $this->conn);mysql_query("SET SESSION collation_connection = 'utf8_general_ci'", $this->conn);}catch(Exception $ve1671797c52e15f763380b45e841ec32) {if($this->critical)    mysql_fatal();else    return false;}$this->isOpen = true;return true;}public function close() {if($this->isOpen) {mysql_close($this->conn);$this->isOpen = false;}}public function query($vbe571b25caf2bbed46f6e47182670bf7, $v3ede331cca63faafb68a34acb42767c6 = false) {if(!$this->open()) return false;$vbe571b25caf2bbed46f6e47182670bf7 = trim($vbe571b25caf2bbed46f6e47182670bf7, " \t\n");if(defined('SQL_QUERY_DEBUG') && SQL_QUERY_DEBUG) {echo $vbe571b25caf2bbed46f6e47182670bf7, "\r\n";}if(strtoupper(substr($vbe571b25caf2bbed46f6e47182670bf7, 0, 6)) != "SELECT" || defined('MYSQL_DISABLE_CACHE')) {$result = mysql_query($vbe571b25caf2bbed46f6e47182670bf7, $this->conn);if($this->errorOccured()) {throw new Exception($this->errorDescription($vbe571b25caf2bbed46f6e47182670bf7));}return $result;}$v0800fc577294c34e0b28ad2839435945 = md5($vbe571b25caf2bbed46f6e47182670bf7);if(isset($this->queryCache[$v0800fc577294c34e0b28ad2839435945]) && $v3ede331cca63faafb68a34acb42767c6 == false) {$result = $this->queryCache[$v0800fc577294c34e0b28ad2839435945][0];if($this->queryCache[$v0800fc577294c34e0b28ad2839435945][1]) {mysql_data_seek($result, 0);}}else {$result = mysql_query($vbe571b25caf2bbed46f6e47182670bf7, $this->conn);if( $this->errorOccured() ) {$this->queryCache[$v0800fc577294c34e0b28ad2839435945] = false;throw new databaseException( $this->errorDescription($vbe571b25caf2bbed46f6e47182670bf7) );}else {if(SQL_QUERY_CACHE) {$this->queryCache[$v0800fc577294c34e0b28ad2839435945] = array($result, mysql_num_rows($result));}}}return $result;}public function queryResult($vbe571b25caf2bbed46f6e47182670bf7, $v3ede331cca63faafb68a34acb42767c6 = false) {$result = $this->query($vbe571b25caf2bbed46f6e47182670bf7, $v3ede331cca63faafb68a34acb42767c6);return $result ? new mysqlQueryResult($result) : null;}public function errorOccured() {return (strlen(mysql_error($this->conn)) != 0);}public function errorDescription($vc4477f6813fbe8d695d230ed95c5e388 = null) {$v7343c51166ec07160acdf47370768d7a = mysql_error($this->conn);if($vc4477f6813fbe8d695d230ed95c5e388) $v7343c51166ec07160acdf47370768d7a .= " in query: " . $vc4477f6813fbe8d695d230ed95c5e388;return $v7343c51166ec07160acdf47370768d7a;}public function isOpen() {return $this->isOpen;}};?>