<?php

namespace App\interfaces;

interface UserApiInterface {

	/**
	 * Method to get collection of all elements
	 *
	 * @return void
	 */
	public function index();

	/**
	 * Method to create a new user
	 *
	 * @param array $data - data of new user.
	 * @return void
	 */
	public function create( array $data );

}
