<?php

/**
 * Inherits most functionality from PHP::PDO class. Deals with connecting to MySql database.
 * IMPORTANT: This class is used for basic query functionality, and should not be relied on for daunting tasks.
 * If you are needing to use more advanced queries, it is suggested to create them manually, rather than looping through the methods here.
 * Looping through calling the same method over and over can be easier, but it is much more strain on the database and hinders loading speed.
 */
class Database extends PDO {

    /**
     * Query string being operated on
     */
    private $query;

    /**
     * List of parameters and the values to bind for query.
     */
    private $binding = array();

    /**
     * PDO statement used for binding parameters and securing further.
     */
    private $stmt;

    /**
     * Calls parent contruct of PDO class and initializes database connection by supplying constants from /libs/config/database.php
     */
    public function __construct() {
        try {
            parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        } catch (Exception $c) {
            die($c);
        }
    }

    /**
     * Binds all query parameters, based on PDO statement supplied.
     * @pre A PDO statement has been created, with a valid query generated
     * @post binded parameters on pdo statement and a secure query ready to parse
     */
    public function bind() {
        foreach ($this->binding as $bind) {
            $this->stmt->bindParam($bind[0], $bind[1]); //Element 0 = part of query to bind, element 1 is actual data.
        }
    }

    /**
     * Run through table names feeding them into query.
     */
    public function parseTables($tables) {
        if (is_array($tables)) {
            for ($c = 0; $c < sizeof($tables); $c++) {
                if ($c + 1 >= sizeof($tables)) {
                    $this->query.=$tables[$c] . ' ';
                } else {
                    $this->query.=$tables[$c] . ', ';
                }
            }
        } else {
            $this->query.=$tables . ' ';
        }
    }

    /**
     * Runs through array containing column values and appends them to query.
     * @param $columns array containing column names
     */
    private function parseColumns($columns) {
        if (array_keys($columns) !== range(0, count($columns) - 1)) { //Checking if array is hashmap or not. 
            $columnKey = array_keys($columns); //Run through key values since these are column names that contain column value. 
            for ($c = 0; $c < sizeof($columns); $c++) {
                $this->query.='`';
                if ($c + 1 < sizeof($columns)) {
                    $this->query.=$columnKey[$c] . '`, ';
                } else {
                    $this->query.=$columnKey[$c] . '` ';
                }
            }
        } else { //Just run through array normally, since it contains only a list of column names with no associated values.
            for ($c = 0; $c < sizeof($columns); $c++) {
                $this->query.='`';
                if ($c + 1 < sizeof($columns)) {
                    $this->query.=$columns[$c] . '`, ';
                } else {
                    $this->query.=$columns[$c] . '` ';
                }
            }
        }
    }

    /**
     * Checks current where array to see if there is at least 1 upcoming value that is not null. This will declare if the current array
     * element should include: AND at the end, as it's expecting another value.
     * @param $where the where clause the check in array form.
     * @param $start the starting position in where clause to begin looking from
     * @return true if there is 1 or more non null values, false otherwise.
     */
    private function whereHasAnotherNonNull($where, $start) {
        $whereKey = array_keys($where);
        for ($c = $start + 1; $c < sizeof($where); $c++) {
            if (is_array($where[$whereKey[$c]])) {
                if ($where[$whereKey[$c]][0] != null) {
                    return true;
                }
            } else {
                if ($where[$whereKey[$c]] != null) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Similar to whereHasAnotherNonNull, this will check if another element in the array is not null, meaning the query can include a ',' preparing for it.
     * @param type $update array containing update contents.
     * @param type $start the first element to start on in array.
     */
    private function updateHasAnotherNonNull($update, $start) {
        $keys = array_keys($update);
        for($c=$start+1; $c<sizeof($update); $c++) {
            if($update[$keys[$c]]!=null) {
                return true;
            }
        }
        return false;
    }

    /**
     * Appends where clauses to query
     * @param $where an associative array containing column names and the condition they must meet
     * @note If an element in the $where array is to contain addition conditions, then further checks are done.
     * Example: array('table_column'=>
     * 								array('value', '>', 'EXCEPTION));
     * In the above example, the where clause would search for table_columns with a value (GREATER THAN) specified.
     * Any valid operators may be used in this approach, by default the == will be used.
     * If exception is set, for example: 'table' bind parameters will not be used, but rather assign table name dynamically.
     * This is in the rare case that literal representation is needed, where binding param doesn't work.
     * @note If for any reason you want a condition to accept everything, simply set the value to null. 
     * Example: array('table_column'=>'null'). This would allow any table_column value to be accepted.
     */
    private function parseWhere($where) {
        /* if (!empty($where)) {
          $whereKey = array_keys($where);
          for ($c = 0; $c < sizeof($where); $c++) {
          if (is_array($where[$whereKey[$c]])) { //If the where element is yet another array, assume further conditions are being checked inside.
          if ($where[$whereKey[$c]][0] != null) {
          //the line below would run something such as array('data', 'condition') which results in checking if data meets condition.
          if ($c + 1 < sizeof($where)) {
          array_push($this->binding, array($whereKey[$c], $where[$whereKey[$c]][0]));
          $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . "'" . $where[$whereKey[$c]][0] . "' AND "; //index 1 = operator, index 0 = value.
          } else {
          array_push($this->binding, array($whereKey[$c], $where[$whereKey[$c]][0]));
          $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . "'" . $where[$whereKey[$c]][0] . "' "; //index 1 = operator, index 0 = value.
          }
          }
          } else {
          if ($where[$whereKey[$c]] != null) {
          if ($c + 1 < sizeof($where)) {
          array_push($this->binding, array($whereKey[$c], $where[$whereKey[$c]]));
          $this->query.=$whereKey[$c] . " = " . "'" . $where[$whereKey[$c]] . "' AND "; //If no additional conditions are used, just check if column is = to specified value.
          } else {
          array_push($this->binding, array($whereKey[$c], $where[$whereKey[$c]]));
          $this->query.=$whereKey[$c] . " = " . "'" . $where[$whereKey[$c]] . "' ";
          }
          }
          }
          }
          } else {
          $this->query.="1 ";
          } */
        if (!empty($where)) {
            if ($this->whereHasAnotherNonNull($where, -1)) { //Checking form first element in array, if anything is not null
                $this->query.="WHERE ";
            }
            $whereKey = array_keys($where);
            for ($c = 0; $c < sizeof($where); $c++) {
                if (is_array($where[$whereKey[$c]])) { //If the where element is yet another array, assume further conditions are being checked inside. 
                    //the line below would run something such as array('data', 'condition') which results in checking if data meets condition.
                    if ($c + 1 < sizeof($where) && $where[$whereKey[$c]][0] != null) {
                        if ($this->whereHasAnotherNonNull($where, $c)) {
                            if ($where[$whereKey[$c]][2] != 'table') {
                                array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]][0]));
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . ':' . $whereKey[$c] . " AND "; //index 1 = operator, index 0 = value. 
                            } else {
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . $where[$whereKey[$c]][0] . " AND "; //index 1 = operator, index 0 = value. 
                            }
                            
                        } else {
                            if ($where[$whereKey[$c]][2] != 'table') {
                                array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]][0]));
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . ':' . $whereKey[$c] . " "; //index 1 = operator, index 0 = value. 
                            } else {
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . $where[$whereKey[$c]][0] . " "; //index 1 = operator, index 0 = value. 
                            }
                            
                        }
                        
                    } else {
                        if ($where[$whereKey[$c]][0] != null) {
                            if ($where[$whereKey[$c]][2] != 'table') {
                                array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]][0]));
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . ':' . $whereKey[$c] . " "; //index 1 = operator, index 0 = value. 
                            } else {
                                $this->query.=$whereKey[$c] . " " . $where[$whereKey[$c]][1] . $whereKey[$c] . " "; //index 1 = operator, index 0 = value. 
                            }
                        }
                    }
                } else {
                    if ($c + 1 < sizeof($where) && $where[$whereKey[$c]] != null) {
                        if ($this->whereHasAnotherNonNull($where, $c)) {
                            array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]]));
                            $this->query.=$whereKey[$c] . " = " . ':' . $whereKey[$c] . ' AND '; //If no additional conditions are used, just check if column is = to specified value.
                        } else {
                            array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]]));
                            $this->query.=$whereKey[$c] . " = " . ':' . $whereKey[$c] . " "; //If no additional conditions are used, just check if column is = to specified value.
                        }
                    } else {
                        if ($where[$whereKey[$c]] != null) {
                            array_push($this->binding, array(':' . $whereKey[$c], $where[$whereKey[$c]]));
                            $this->query.=$whereKey[$c] . " = " . ':' . $whereKey[$c] . ' ';
                        }
                    }
                }
            }
        } else {
            $this->query.="WHERE 1 ";
        }
    }

    /**
     * Parse order clause of sql query.
     * Note: if array is specified, then array[0] = the column to order by, and array[1] is the direction (ie ASC/DESC)
     * If value is only supplied as single variable being column name, the results will be ordered in DESC order.
     */
    private function parseOrder($order) {
        if (is_array($order)) {
            $this->query.="ORDER BY " . $order[0] . " " . $order[1] . " ";
        } else {
            $this->query.="ORDER BY $order DESC ";
        }
    }

    /**
     * Specifies limitation of results from query. 
     * @param $limit the limit, or rather last row to return within count. 
     * @param $start the beginning row to start on. Default is 0.
     */
    private function parseLimit($limit, $start = 0) {
        if($limit!=null) {
            $this->query.="LIMIT $start, $limit ";
        }
    }

    /**
     * Builds match query for searching data with FULLTEXT search.
     * @param $columns the columns to match with, must be FULLTEXT searche enabled
     * @param $text the text being searched
     */
    private function parseMatch($columns, $text, $type) {
        $this->query.=" MATCH(";
        for ($c = 0; $c < sizeof($columns); $c++) {
            if ($c + 1 < sizeof($columns)) {
                $this->query.="$columns[$c], ";
            } else {
                $this->query.="$columns[$c] ) ";
            }
        }
        switch ($type) {
            case 'boolean': $this->query.="AGAINST ('*$text*' IN BOOLEAN MODE) ";
                break;
            case 'natural': $this->query.="AGAINST ('*$text*' IN NATURAL LANGUAGE MODE) ";
                break;
            default: $this->query.="AGAINST ('$text' IN NATURAL LANGUAGE MODE) ";
        }
    }

    private function parseUpdate($data) {
        $updatedKeys = array_keys($data);
        for ($c = 0; $c < sizeof($data); $c++) {
            $key = $updatedKeys[$c];
            if ($c + 1 < sizeof($data)&&$this->updateHasAnotherNonNull($data, $c)) {
                if($data[$key]!=null) {
                    array_push($this->binding, array(':'.$key, $data[$key]));
                    $this->query.="$updatedKeys[$c] = :".$key.", ";
                }
            } else {
                if($data[$key]!=null) {
                    array_push($this->binding, array(':'.$key, $data[$key]));
                    $this->query.="$updatedKeys[$c] = :".$key." ";
                }
            }
        }
    }

    /**
     * Return the most recent rows. This method requires the table to contain at least one row in which identifies time.
     * @param $table the table to get rows from.
     * @param $columns Array containing column names to select
     * @param $where Associative array containing column names and the condition they must meet.
     * @param $order Column to order rows by
     * @param $limit maximum amount of rows to return
     * @param $since the earliest date to gather content from, must be specified
     */
    public function getRecent($table, $columns, $where, $order, $since, $limit) {
        $this->query = "SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table ";
        $this->parseWhere($where);
        $this->parseOrder($order);
        $this->parseLimit($limit);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $rows = $this->stmt->fetchAll();
        $this->cleanQuery();
        return $rows;
    }

    /**
     * Returns rows based on page being viewed. An example would be a list of users, where you are viewing page 6 of this data. 
     * @param $table the table to get rows from.
     * @param $columns Array containing column names to select
     * @param $where Associative array containing column names and the condition they must meet.
     * @param $order Column to order rows by
     * @param $page the page determining which data to render.
     * @param $limit maximum amount of rows to return
     */
    public function getByPage($table, $columns, $where, $order, $page, $limit) {
        $start = ($page * $limit) - $limit;
        $this->query = "SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table ";
        $this->parseWhere($where);
        $this->parseOrder($order);
        $this->parseLimit($limit, $start);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $rows = $this->stmt->fetchAll();
        $this->cleanQuery();
        return $rows;
    }

    /**
     * Returns all specified information from a table
     * @param $table the table to get information from
     * @param $columns the columns to get
     */
    public function getAll($table, $columns) {
        $this->query.="SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table";
        $stmt = $this->prepare($this->query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $this->cleanQuery();
        return $rows;
    }

    /**
     * Returns list of tables in database
     * @param $database the database to display tables from.	
     */
    public function getTables($database) {
        $query = "SHOW TABLES FROM $database";
        $stmt = $this->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $this->cleanQuery();
    }

    /**
     * Return single row matching query
     * @param $table the table to get row from
     * @param $columns the columns to render within row
     * @param $where the columns and the values in which they must contain.
     */
    public function getRow($table, $columns, $where) {
        $this->query.="SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table ";
        $this->parseWhere($where);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $row = $this->stmt->fetch();
        $this->cleanQuery();
        return $row;
    }

    /**
     * Used to acquire multiple table rows, as opposed to picking only one.
     * @param $table the table to get row from
     * @param $columns the columns to render within row
     * @param $where the columns and the values in which they must contain.
     */
    public function getRows($table, $columns, $where, $order, $limit=null) {
        $this->query.="SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table ";
        $this->parseWhere($where);
        $this->parseOrder($order, 'DESC');
        $this->parseLimit($limit, 0);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $rows = $this->stmt->fetchAll();
        $this->cleanQuery();
        return $rows;
    }

    /**
     * Updates a the specified columns within a row.
     * @param $table the table to update
     * @param $data associative array containing the columns to update and their new values
     * @param $where associative array containing columns and conditions they must meet
     * @param Hashmap containing column names and the data to update with. 
     */
    public function update($table, $data, $where = 1) {
        $this->query.="UPDATE $table SET ";
        $this->parseUpdate($data);
        $this->parseWhere($where);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $this->cleanQuery();
    }

    /**
     * Return row count from table based on specific conditions
     * @param $table the table to get row count from
     * @param $where hashmap of column names and the conditions they must meet. 
     */
    public function getCount($table, $where) {
        $this->query = "SELECT COUNT(*) FROM ";
        $this->parseTables($table);
        $this->parseWhere($where);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $row = $this->stmt->fetch();
        $this->cleanQuery();
        return $row[0];
    }

    /**
     * Insert row data into specified mysql table
     * @param $table the table the insert new row into
     * @param $columns array containing column names for insertion
     */
    public function insertRow($table, $columns) {
        $start = 0;
        $index = 0;
        $keys = array_keys($columns);
        $this->query = "INSERT INTO $table (";
        $this->parseColumns($columns);
        $this->query.=") VALUES(";
        for ($c = 0; $c < sizeof($columns); $c++) { //Listing column values and attaching to query
            if ($c + 1 < sizeof($columns)) {
                array_push($this->binding, array(':'.$keys[$c], $columns[$keys[$c]]));
                $this->query.= ":" . $keys[$c] . ", ";
            } else {
                array_push($this->binding, array(':'.$keys[$c], $columns[$keys[$c]]));
                $this->query.= ':' . $keys[$c].'';
            }
        }
        $this->query .= ")";
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        try {
            $this->stmt->execute();
        } catch (Exception $e) {
            return false;
        }
        $this->cleanQuery();
        return true;
    }

    /**
     * Run full text search and return data matching in order of relevance
     * @param $table the table to search in
     * @param $columns the columns to return from rows in search
     * @param $match array containing the columns to check search data for. Must be enabled for FULLTEXT search
     * @param $search the text to search
     * @param $type the type of search, such as boolean, and natural.
     * @param $page the page of results to return, in case the viewer wishes to scroll through search rows.
     * @param $limit max amount of results to return per page.
     */
    public function search($table, $columns, $match, $search, $type, $page, $limit) {
        $this->query.="SELECT ";
        $this->parseColumns($columns);
        $this->query.="FROM $table WHERE ";
        $this->parseMatch($match, $search, $type);
        $start = ($page * $limit) - $limit;
        $this->parseLimit($limit, $start);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $rows = $this->stmt->fetchAll();
        $this->cleanQuery();
        return $rows;
    }

    /**
     * Return value of all columns added together, based on row specification.
     * @param $table the table to work with
     * @param $column the column to add values within
     * @param $where array containing column names and the values they must meet.
     */
    public function getRowSum($table, $column, $where) {
        $this->query.="SELECT SUM(".$column.") FROM $table ";
        $this->parseWhere($where);
        $this->stmt = $this->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $rows = $this->stmt->fetchAll();
        $this->cleanQuery();
        return $rows[0][0];
    }

    public function cleanQuery() {
        $this->query = null;
        $this->binding = array();
    }

}

?>