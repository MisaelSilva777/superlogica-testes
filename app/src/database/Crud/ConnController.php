<?php

namespace App\database\Crud;

use ErrorException;
use PDOException;
use PDO;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Class responsible for connect with database
 */
class ConnController{

    /**
     * Environment variable of Host.
     *
     * @var string
     */
    private $Host;

    /**
     * Environment variable of Username.
     *
     * @var string
     */
    private $User;

    /**
     * Environment variable of Pass.
     *
     * @var string
     */
    private $Pass;

    /**
     * Environment variable of Database name.
     *
     * @var string
     */
    private $Dtbs;


    /**
     * PDO Attribute
     *
     * @var PDO
     */
    private $connect = null;

    /**
     * Method to connect with the database
     *
     * @return PDO
     */
    private function dbConnect() : PDO {

        $this->setDatabaseVariables();

        try {

            if ( $this->connect !== null ){
                return $this->connect;
            }

            $dsn     = 'mysql:host=' .$this->Host. ';dbname='. $this->Dtbs;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"];

            $this->connect = new PDO($dsn, $this->User, $this->Pass, $options);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            throw new ErrorException( $e->getMessage() );

        }

        return $this->connect;

    }

    /**
     * Function to populate class attributes to connect with db.
     *
     * @return void
     */
    private function setDatabaseVariables(): void {

        defineEnvVars();

        $this->Host = DB_HOST;
        $this->User = DB_USER;
        $this->Pass = DB_PASS;
        $this->Dtbs = DB_DTBS;

    }


    /**
     * Method to get PDO Object
     *
     * @return PDO
     */
    public static function getConn(): PDO {
        return ( new self )->dbConnect();
    }
}

