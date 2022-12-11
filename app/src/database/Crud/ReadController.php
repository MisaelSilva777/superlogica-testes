<?php

namespace App\database\Crud;

use PDO;
use PDOException;

/**
 * Class responsible for read registers in the database
 */
class ReadController extends ConnController {

    /**
    * Table to build query
    *
    * @var string
    */
    private $table;

    /**
     * Fields to read query, eg the id, name, type = :id, :name, :type
     *
     * @var string
     */
    private $fields;

    /**
     * Placeholder string with values to insert in the query
     * eg id=value&name=value
     *
     * @var array
     */
    private $places;


    /**
     * Result of the query
     *
     * @var array|null
     */
    private $result = null;

    /**
     * Error message
     *
     * @var string|null
     */
    private $error = null;


    /**
     * PDO Connection to execute prepared queries
     *
     * @var PDO
     */
    private $conn;

    /**
     * select query object
     *
     * @var string|object
     */
    private $select;


    /**
     * Method to read rows of the database table
     *
     * @param string $table       - table to make query
     * @param string $fields      - table fields of query and :values, eg name = :name, old = :old...
     * @param string $placeholder - query string of field name = field value of where
     * @return void
     */
    public function exeRead( string $table, string $fields = null, string $placeholder = null ): void {

        $this->table  = $table;
        $this->fields = $fields;

        if ( $placeholder ) {
            parse_str($placeholder, $this->places);
        }

        $this->connect();
        $this->getSyntax();
        $this->executeRead();

    }


    /**
     * Getter method to result
     *
     * @return array|null
     */
    function getResult(): array|null {

        return $this->result;

    }

    /**
     * Getter method to error
     *
     * @return string|null
     */
    function getError(): string|null {

        return $this->error;

    }

    /**
     * Return the rows quantity of query
     *
     * @return int
     */
    function getRowCount() : int {
        return $this->select->rowCount();
    }

    /**
     * Instance conn attribute with PDO Object
     * Prepare read query through conn attribute
     *
     * @return void
     */
    private function connect() : void {

        $this->conn = parent::getConn();

    }

    /**
     * Method to make syntax of read
     *
     * @return void
     */
    private function getSyntax(): void {

        $this->select = "SELECT * FROM {$this->table} {$this->fields}";

        $this->select = $this->conn->prepare($this->select);
        $this->select->setFetchMode(PDO::FETCH_ASSOC);

        if( ! $this->places ) return;

        foreach( $this->places as $key => $value ){

            if($key == 'offset' || $key == 'limit') {
                $value = (int) $value;
            }

            $this->select->bindValue(":$key", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);

        }

    }

    /**
     * Method for execute the query
     *
     * @return void
     */
    private function executeRead(){

        try {

            $this->select->execute();
            $this->result = $this->select->fetchAll();

        } catch (PDOException $e) {

            $this->error = $e->getMessage();

        }

    }

}

