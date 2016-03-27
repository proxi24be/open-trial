<?php

/**
 * User: bluenight
 * Date: 2/14/16
 * Time: 4:50 PM
 */
namespace Biosamples;

use PDO;

abstract class AuditTableTrigger {
	/**
	 *
	 * @var PDO
	 */
	private $_pdo;
	
	/**
	 * AuditTableTrigger constructor.
	 *
	 * @param PDO $pdo        	
	 */
	public function __construct(PDO $pdo) {
		$this->_pdo = $pdo;
	}
	
	/**
	 *
	 * @return PDO
	 */
	public function getPdo() {
		return $this->_pdo;
	}
	
	/**
	 *
	 * @param string $table_name        	
	 *
	 * @return boolean Return True if the operation end successfully, false otherwise.
	 */
	public abstract function addAuditTrigger($table_name);
	
	/**
	 *
	 * @param string $table_name        	
	 *
	 * @return boolean Return True if the operation end successfully, false otherwise.
	 */
	public abstract function deleteAuditTrigger($table_name);
}