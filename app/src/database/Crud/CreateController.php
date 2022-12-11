<?php

namespace App\database\Crud;

use PDOException;

/**
 * Class responsible for insert registers in the database
 */
class CreateController extends ConnController {

    /**
     * Table to build query
     *
     * @var string
     */
    private $table;

    /**
     * Data to insert in the database row
     *
     * @var array
     */
    private $data;

    /**
     * Id of new line inserted in the table
     *
     * @var int|null
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
     * insert query object
     *
     * @var string|object
     */
    private $insert;

    /**
     * Method for create a new register in the table
     *
     * @param string $table - table to build query.
     * @param array  $data  - array of elements to insert in the new row of table.
     * @return void
     */
    public function exeCreate( string $table, array $data ): void {

        $this->table = $table;
        $this->data  = $data;

        $this->connect();
        $this->makeSyntax();
        $this->executeInsert();

    }


    /**
     * Getter method to result
     *
     * @return int|null
     */
    function getResult(): int|null {

        return $this->result;

    }

    /**
     * Getter method to error
     *
     * @return void
     */
    function getError(): string {

        return $this->error;

    }

    /**
     * Instance conn attribute with PDO Object
     * Prepare insert query through conn attribute
     *
     * @return void
     */
    private function connect(): void {

        $this->conn = parent::getConn();

    }

    /**
     * Construct syntax of insert
     *
     * @return void
     */
    private function makeSyntax(): void{

        $filled = implode(',', array_keys($this->data));
        $places = ':' . implode(', :', array_keys($this->data));

        $this->insert = "INSERT INTO {$this->table} ({$filled}) VALUES ({$places})";

        $this->insert = $this->conn->prepare( $this->insert );

    }

    /**
     * Method for execute the query
     *
     * @return void
     */
    private function executeInsert(): void {

        try {

            $this->insert->execute( $this->data );
            $this->result = $this->conn->LastInsertId();

        } catch ( PDOException $e ) {

            $this->error = $e->getMessage();

        }

    }
}

