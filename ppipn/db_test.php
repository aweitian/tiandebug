<?php
/**
 * @author awei.tian
 * date: 2013-10-14
 * 说明:
 */
define ( 'DB_HOST', "localhost" );
define ( 'DB_PORT', "3306" );
define ( 'DB_USER', "root" );
define ( 'DB_PASS', "007@mysql00" );
define ( 'DB_NAME', "debug" );
class testipndb {
	private $_link = null;
	private function _conn() {
		$dns = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";port=" . DB_PORT;
		try {
			$this->_link = new PDO ( $dns, DB_USER, DB_PASS );
		} catch ( PDOException $e ) {
			exit ( 'Connection failed: ' . $e->getMessage () );
		}
	}
	public function insertNewItem($title, $price) {
		// todo
		$this->_conn ();
		$sth = $this->_link->prepare ( "insert into `ppipn_test_demo` values(null,:title,:price,'fail',:datetime)" );
		$sth->bindParam ( ':title', $title, PDO::PARAM_INT );
		$sth->bindParam ( ':price', $price, PDO::PARAM_INT );
		$time = date ( "Y-m-d H:i:s", time () );
		$sth->bindParam ( ':datetime', $time, PDO::PARAM_STMT );
		$sth->execute ();
		$lastid = $this->_link->lastInsertId ();
		$this->_close ();
		return $lastid;
	}
	public function ok($postdat, $responsetext) {
		// todo
		$this->_conn ();
		$sid = $postdat ["item_number"];
		$sth = $this->_link->prepare ( "update `ppipn_test_demo` set `state`='ok' where sid=:sid" );
		$sth->bindParam ( ':sid', $sid, PDO::PARAM_INT );
		$sth->execute ();
		$this->_close ();
		// echo "payment ok";
	}
	public function fail($postdat, $responsetext) {
		// todo
		$this->_conn ();
		// echo "payment fail";
		$this->_close ();
	}
	private static function _close() {
		// $this->_link->close();
	}
}