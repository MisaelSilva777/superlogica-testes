<?php

namespace App\interfaces;

interface UserApiInterface {

	/**
	 * Method to get collection of all elements
	 *
	 */
	public function index();

	public function create( array $data );

}
