<?php

namespace App\models;

use App\database\Crud\CreateController;
use App\database\Crud\ReadController;

/**
 * User model class
 */
class UserModel {

    /**
     * Order model table name
     *
     * @var string
     */
    private $table = 'users';

    /**
     * User id
     *
     * @var string
     */
    private $id;

    /**
     * Full name
     *
     * @var string|null
     */
    private $full_name;

    /**
     * Username of user
     *
     * @var string|null
     */
    private $username;

    /**
     * Zipcode of user
     *
     * @var string|null
     */
    private $zipcode;

    /**
     * Email of user
     *
     * @var string|null
     */
    private $email;

    /**
     * Password of user
     *
     * @var string|null
     */
    private $password;


    /**
     * Constructor method to instance model of user
     *
     * @param string $full_name
     * @param string $username
     * @param string $zipcode
     * @param string $email
     * @param string $password
     */
    public function __construct (
        string $full_name = null,
        string $username = null,
        string $zipcode = null,
        string $email = null,
        string $password = null
    ) {
        $this->full_name = $this->setFullName( $full_name );
        $this->username  = $this->setUsername( $username );
        $this->zipcode   = $this->setZipcode( $zipcode );
        $this->email     = $this->setEmail( $email );
        $this->password  = $this->setPassword( $password );
    }

    /**
     * Return a collection of users
     *
     * @return array|null
     */
    public function index() : array|null {

        $read = new ReadController();
        $read->exeRead( $this->table );

        if ( ! $read->getResult() ) {
            return [];
        }

        return $read->getResult();

    }

    /**
     * Return if a user exists by your username
     *
     * @return bool
     */
    public function checkExistsUser() : bool {

        $read = new ReadController();
        $read->exeRead( $this->table, "WHERE username = :username", "username=" . $this->username );

        if ( ! $read->getResult() ) {
            return false;
        }

        return true;

    }

    /**
     * Return if a user exists by your email
     *
     * @return bool
     */
    public function checkExistsEmail() : bool {

        $read = new ReadController();
        $read->exeRead( $this->table, "WHERE email = :email", "email=" . $this->email );

        if ( ! $read->getResult() ) {
            return false;
        }

        return true;

    }

    /**
     * Create a new User
     *
     * @return bool;
     */
    public function create() : bool {

        $create = new CreateController();

        $create->exeCreate( $this->table, [
            'name'     => $this->full_name,
            'username' => $this->username,
            'zipcode'  => $this->zipcode,
            'email'    => $this->email,
            'password' => $this->password
        ] );

        return ! empty( $create->getResult() ) ? true : false;

    }

    /**
     * Function to return id of user
     *
     * @return string|null
     */
    public function getId(): string|null{
        return $this->id;
    }

    /**
     * Function to return full name of user
     *
     * @return string|null
     */
    public function getFullName(): string|null{
        return $this->full_name;
    }

    /**
     * Method to set full name
     *
     * @param string|null $full_name - full name to fill attribute.
     * @return void
     */
    public function setFullName( string|null $full_name ) : void {
        $this->full_name = $full_name;
    }

    /**
     * Function to return username of user
     *
     * @return string|null
     */
    public function getUsername(): string|null{
        return $this->username;
    }

    /**
     * Method to set username
     *
     * @param string|null $username - username to fill attribute.
     * @return void
     */
    public function setUsername( string|null $username ) : void {
        $this->username = $username;
    }

    /**
     * Function to return zipcode of user
     *
     * @return string|null
     */
    public function getZipcode(): string|null{
        return $this->zipcode;
    }

    /**
     * Method to set zipcode
     *
     * @param string|null $zipcode - zipcode to fill attribute.
     * @return void
     */
    public function setZipcode( string|null $zipcode ) : void {
        $this->zipcode = $zipcode;
    }

    /**
     * Function to return email of user
     *
     * @return string|null
     */
    public function getEmail(): string|null{
        return $this->email;
    }

    /**
     * Method to set email
     *
     * @param string|null $email - email to fill attribute.
     * @return void
     */
    public function setEmail( string|null $email ) : void {
        $this->email = $email;
    }

    /**
     * Function to return password of user
     *
     * @return string|null
     */
    public function getPassword(): string|null{
        return $this->password;
    }

    /**
     * Method to set password
     *
     * @param string|null $password - password to fill attribute.
     * @return void
     */
    public function setPassword( string|null $password ) : void {
        $this->password = ! empty( $password ) ? md5( $password ) : $password ;
    }

}