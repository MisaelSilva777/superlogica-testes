<?php

namespace App\database\Crud;

use PDO;
use PDOException;

/**
 * Class responsible for update registers in the database
 */
class UpdateController extends ConnController {

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
     * Array of values with new data to the row
     *
     * @var array
     */
    private $data;

    /**
     * Placeholder string with values to insert in the query
     * eg id=value&name=value
     *
     * @var array
     */
    private $places;

    /**
     * Result of update
     *
     * @var bool|null
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
     * Update query object
     *
     * @var string|object
     */
    private $update;

    /**
     * Undocumented function
     *
     * @param string $table       - table to run db query
     * @param array  $data        - array with new data of row
     * @param string $fields      - table fields of query and :values, eg id = :id
     * @param string $placeholder - query string of field name, eg id=00
     * @return void
     */
    public function exeUpdate( string $table, array $data, string $fields, string $placeholder){

        $this->table  = $table;
        $this->data   = $data;
        $this->fields = $fields;
        parse_str($placeholder, $this->places);

        $this->connect();
        $this->prepareSyntax();
        $this->executeUpdate();

    }

    /**
     * Getter method to result
     *
     * @return bool|null
     */
    function getResult(): bool|null {

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
     * Instance conn attribute with PDO Object
     * Prepare delete query through conn attribute
     *
     * @return void
     */
    private function connect() : void {

        $this->conn = parent::getConn();

    }

    /**
     * Make the syntax to update row
     *
     * @return void
     */
    private function prepareSyntax() : void {

        $places = [];

        foreach ($this->data as $key => $value){
            $places[] = $key .' = :'. $key;
        }

        $places = implode(', ', $places);

        $this->update = "UPDATE {$this->table} SET {$places} WHERE {$this->fields}";

        $this->update = $this->conn->prepare($this->update);

    }

    /**
     * Method to execute update
     *
     * @return void
     */
    private function executeUpdate(){

        try {

            $this->update->execute(array_merge($this->data, $this->places));
            $this->result = true;

        } catch (PDOException $e) {

            $this->erro = $e->getMessage();

        }

    }
}

