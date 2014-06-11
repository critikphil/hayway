<?php
class DbClass {
	
	protected $dbHost;
	protected $dbUser;
	protected $dbPass;
	
	protected $pdo;
	protected $dbName;
	
        private   $_table;
        protected $req;
	
	function  __construct(  )
        {
            global $dbConfigs;

            $this->dbHost = $dbConfigs['host'];
            $this->dbUser = $dbConfigs['user'];
            $this->dbPass = $dbConfigs['pass'];
            $this->dbName = $dbConfigs['name'];
            unset($dbConfigs);
	}
	
	function dbConnect()
        {
            try
            {
                $this->pdo = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
                die('Error : ' . $e->getMessage());
            }
	}
	
	function setDbParams( $_dbHost, $_dbUser, $_dbPass ){
		
            $this->dbHost = $_dbHost;
            $this->dbUser = $_dbUser;
            $this->dbPass = $_dbPass;
	}
	
	function getConnection(){
		
            return $this->pdo;
	}
        
        function setTable( $_table )
        {
            $this->_table = $_table;
        }
        
        function insert( array $_array )
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
            
            $columns = array();
            $values  = array();
            
            foreach ($_array as $key => $value) {
                $columns[] = $key;
                $values[]  = ':'.$key;
            }
            
            $stringColumns = implode(',', $columns);
            $stringValues  = implode(',', $values);

            $query = "INSERT 
                            INTO $this->_table
                            (
                                $stringColumns
                            )
                            VALUES 
                            (
                                $stringValues
                            )
                        ";

            try {
                if($this->doQuery($query, $_array)) {
                    return $this->getLastInsertId();
                }
                else {
                    return false;
                }
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
        function update( array $_array, array $_where )
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
        
            if(empty($_array)) {
                throw new SException('There is no data to update', 774);
            }
            
            $arraySet = array();
            foreach ($_array as $key => $value) {
                $arraySet[] = $key . ' = :' . $key;
            }
            $stringSet = implode(',', $arraySet);
            
            $stringWhere = '';
            if(!empty($_where)) {
                $i = 0;
                foreach ($_where as $key => $value) {
                    $stringWhere .= ($i == 0 ? ' WHERE ' : ' AND ') . $key . ' = :' . $key;
                    ++$i;
                }
            }
            
            $query = "UPDATE
                                $this->_table
                        SET
                                $stringSet
                        $stringWhere
                    ";

            try {
                return $this->doQuery($query, array_merge($_array, $_where));
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
        function delete(array $_where)
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
            
            if(empty($_where)) {
                throw new SException('There is not clause "where" for the delete method', 773);
            }
            
            $stringWhere = '';
            if(!empty($_where)) {
                $i = 0;
                foreach ($_where as $key => $value) {
                    $stringWhere .= ($i == 0 ? ' WHERE ' : ' AND ') . $key . ' = :' . $key;
                    ++$i;
                }
            }
            
            $query = "DELETE FROM
                                $this->_table
                        $stringWhere
                    ";

            try {
                return $this->doQuery($query, $_where);
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
        function selectAll(array $_where = array(), array $_orderBy = array())
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
            
            $stringWhere = '';
            if(!empty($_where)) {
                $i = 0;
                foreach ($_where as $key => $value) {
                    $stringWhere .= ($i == 0 ? ' WHERE ' : ' AND ') . $key . ' = :' . $key;
                    ++$i;
                }
            }
            $stringOrderBy = '';
            if(!empty($_orderBy)) {
                $stringOrderBy = 'ORDER BY ' . key($_orderBy) . ' ' . $_orderBy[key($_orderBy)];
            }
            
            $query = "SELECT
                                *
                        FROM
                                $this->_table
                        $stringWhere
                      $stringOrderBy
                     ";
            
            try {
                return $this->doQueryAll($query, $_where);
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
        function selectOne(array $_where = array())
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
            
            $stringWhere = '';
            if(!empty($_where)) {
                $i = 0;
                foreach ($_where as $key => $value) {
                    $stringWhere .= ($i == 0 ? ' WHERE ' : ' AND ') . $key . ' = :' . $key;
                    ++$i;
                }
            }
            
            $query = "SELECT
                                *
                        FROM
                                $this->_table
                        $stringWhere
                    ";

            try {
                return $this->doQueryOne($query, $_where);
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
        function selectColumn($_select, array $_where = array())
        {
            if(empty($this->_table)) {
                throw new SException('Table is not defined ( use self::setTable )', 771);
            }
            
            if(!is_string($_select)) {
                throw new SException('Invalid string parameter for $_select', 772);
            }
            
            $stringWhere = '';
            if(!empty($_where)) {
                $i = 0;
                foreach ($_where as $key => $value) {
                    $stringWhere .= ($i == 0 ? ' WHERE ' : ' AND ') . $key . ' = :' . $key;
                    ++$i;
                }
            }
            
            $query = "SELECT
                                $_select
                        FROM
                                $this->_table
                        $stringWhere
                    ";

            try {
                return $this->doQueryColumn($query, $_where);
            }
            catch (SException $e) {
                throw $e;
            }
        }
        
	function doQuery( $_query, $_vars = array() ){
            try {
                $this->req = $this->pdo->prepare($_query);
                return $this->req->execute($_vars);
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
	}
	
	function doQueryAll( $_query, $_vars = array() ){
            try {
                $this->req = $this->pdo->prepare($_query);
                $this->req->execute($_vars);
                return $this->req->fetchAll();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
	}
	
	function doQueryOne( $_query, $_vars = array() ){
            
            try {
                $this->req = $this->pdo->prepare($_query);
                $this->req->execute($_vars);
                return $this->req->fetch();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
	}
	
	function doQueryColumn( $_query, $_vars = array() ){
            
            try {
                $this->req = $this->pdo->prepare($_query);

                $this->req->execute($_vars) or die(print_r($this->req->errorInfo()));

                return $this->req->fetchColumn();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
	}
	
        function getLastInsertId()
        {
            try {
                return $this->pdo->lastInsertId();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
        }
	
        function getQuery()
        {
            return $this->pdo->queryString;
        }
        
        function beginTransaction()
        {
            try {
                return $this->pdo->beginTransaction();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
        }
	
        function commit()
        {
            try {
                return $this->pdo->commit();
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
        }
	
        function rollBack()
        {
            try {
                return $this->pdo->rollBack(); 
            }
            catch (PDOException $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
        }
	
}
?>