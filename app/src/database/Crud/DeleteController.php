<?php

namespace App\database\Crud;

use PDOException;

/**
 * Class responsible for delete rows in the database
 */
class DeleteController extends ConnController {

   /**
    * Table to build query
    *
    * @var string
    */
    private $table;

    /**
     * Data to delete query, eg the id = :id of where
     *
     * @var array
     */
    private $data;

    /**
     * Placeholder string with values to insert in the query
     * eg id=value&name=value
     *
     * @var string
     */
    private $places;

    /**
     * True if row is excluded with success
     *
     * @var bool
     */
    private $result = false;

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
     * Delete query object
     *
     * @var string|object
     */
    private $delete;

    /**
     * function for execute delete in the database
     *
     * @param string $table       - table to execute delete
     * @param string $data        - field of where to make query
     * @param string $parseString - query string of field name = field value of where
     * @return void
     */
    public function exeDelete( string $table, string $data, string $parseString ): void {

        $this->table = $table;
        $this->data  = $data;
        parse_str($parseString, $this->places);

        $this->connect();
        $this->getSyntax();
        $this->executeDelete();

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
    private function connect(): void {

        $this->conn = parent::getConn();

    }

    /**
     * Construct syntax of delete
     *
     * @return void
     */
    private function getSyntax(): void{

       $this->delete = "DELETE FROM {$this->table} WHERE {$this->data}";
       $this->delete = $this->conn->prepare($this->delete);

    }

    /**
     * Method for execute the query
     *
     * @return void
     */
    private function executeDelete(): void{

        try {

            $this->delete->execute($this->places);
            $this->result = true;

        } catch ( PDOException $e ) {

            $this->error = $e->getMessage();

        }

    }

}

